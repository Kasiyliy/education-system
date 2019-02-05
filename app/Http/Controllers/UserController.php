<?php

namespace App\Http\Controllers;

use App\TeacherControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

use App\Student;
use Session;
use App\Institute;
use Validator;
use Hash;

use Illuminate\Support\Facades\DB;
use App\Http\Helpers\AppHelper;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['login', 'logout', 'settings', 'postSettings']]);
    }

    /**
     * Make Login
     *
     * @return Response
     */

    public function login()
    {

        if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password')))) {
            $name = Auth::user()->firstname . ' ' . Auth::user()->lastname;
            Session::put('name', $name);
            Session::put('user_session_sha1', AppHelper::getUserSessionHash());

            if (Auth::user()->group == User::TEACHER) {
                $teacherControl = new TeacherControl();
                $teacherControl->user_id = Auth::id();
                $teacherControl->entered = true;
                $teacherControl->save();

            }

            $institute = Institute::select('name')->first();
            if (!$institute) {
                if (Auth::user()->group != User::ADMIN) {

                    return Redirect::to('/')->with('warning', 'Информация об учереждение не введена! Пожалуйста свяжитесь с администартором.');
                } else {
                    $institute = new Institute;
                    $institute->name = "Учереждение";
                    Session::put('inName', $institute->name);
                    $notification = array('title' => 'Отсутствие информации', 'body' => 'Пожалуйста введите информацию про учереждение.');
                    return Redirect::to('/institute')->with('warning', $notification);

                }
            } else {
                Session::put('inName', $institute->name);
                Session::put('inNameShort', AppHelper::getShortName($institute->name));

                if (Auth::user()->group == User::STUDENT and Auth::user()->student()->get()) {
                    return Redirect::to('/guest')->with('success', "Вы вошли в систему.");
                }
                $notification = array('title' => 'Логин', 'body' => 'Вы вошли в систему.');
                return Redirect::to('/dashboard')->with('success', $notification);
            }

        } else {

            return Redirect::to('/login')->with('error', 'Ваш логин/пароль были введены не верно');

        }


    }

    public function logout()
    {
        if (Auth::user()) {
            if (Auth::user()->group == User::TEACHER) {
                $teacherControl = new TeacherControl();
                $teacherControl->user_id = Auth::id();
                $teacherControl->entered = false;
                $teacherControl->save();

            }
        }
        Auth::logout();

        session()->forget('name');
        return Redirect::to('/')->with('success', 'Вы вышли из системы!');
    }

    /**
     * Show all user.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.create');
    }


    /**
     * add student to account
     */
    public function addstudent()
    {
        $users = User::leftJoin('students', 'users.id', '=', 'students.user_id')
            ->select('users.id', 'users.login')
            ->where('users.group', '=', 'Student')
            ->whereNull('students.user_id')
            ->lists('users.login', 'users.id');

        $students = Student::whereNull('user_id')->get();

        $studentList = Student::select('id', DB::raw("concat(lastName ,' ', firstName, ' ', middleName) AS name"))
            ->whereNull('students.user_id')
            ->orderby('name', 'asc')
            ->lists('name', 'id');

        $studentWithAccounts = Student::leftJoin('users', 'users.id', '=', 'students.user_id')
            ->select('students.user_id', 'users.login', 'students.firstName', 'students.lastName')
            ->whereNotNull('user_id')->get();

        return view('user.addstudent')->with(compact('students', 'users', 'studentWithAccounts', 'studentList'));
    }

    public function deleteAccount($id)
    {
        $user = Student::where('students.user_id', '=', $id)
            ->update(['students.user_id' => null]);
        $notification = array('title' => trans('messages.delete'), 'body' => trans('messages.delete_success'));
        return Redirect::route('user.addstudent')->with("success", $notification);

    }

    public function createstudent(Request $request)
    {
        $data = $request->all();
        $rules = [
            'student_id' => 'required',
            'user_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('user.addstudent')->withInput()->withErrors($validator);
        } else {
            $student = Student::findOrFail($request->student_id);
            $student->user_id = $request->user_id;
            $student->save();
            $notification = array('title' => trans('messages.save'), 'body' => trans('messages.account_add'));
            return Redirect::route('user.addstudent')->with("success", $notification);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'group' => 'required',
            'login' => 'required|unique:users',
            'emal' => 'email',
            'password' => 'required|confirmed|min:6'
        ];
        $message = [

            'unique' => 'Такой логин уже существует!'
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return Redirect::route('user.create')->withInput()->withErrors($validator);
        } else {
            $user = new User;
            $user->create($data);

            $notification = array('title' => trans('messages.insert'), 'body' => trans('messages.insert_success'));

            return Redirect::route('user.create')->with("success", $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->group == User::ADMIN){
            $notification = array('title' => trans('messages.delete'), 'body' =>trans('messages.delete_error'));
            return Redirect::route('user.index')->with("warning", $notification);
        }
        $user->delete();

        $notification = array('title' => trans('messages.delete'), 'body' => trans('messages.delete_success'));
        return Redirect::route('user.index')->with("success", $notification);
    }

    /**
     * Change the specified user informations.
     *
     * @return Response
     */
    public function settings($id)
    {
        $user = User::select('*')
            ->where('id' , '=' , $id)
            ->first();
        return view('user.settings', compact('user'));
    }

    public function postSettings(Request $request)
    {

        if ($request->exists('for')) {
            $data = $request->except(['userName', 'group']);
            if ($request->input('for') == "info") {
                $rules = [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'email',

                ];
            } else {
                if (!Hash::check($request->input('oldpassword'), Auth()->user()->password)) {

                    $notification = array('title' => 'Ошибка валидации', 'body' => 'Старый пароль не соответсвует!!!');
                    return Redirect::back()->with('error', $notification);
                }
                $rules = [
                    'oldpassword' => 'required|min:6',
                    'password' => 'required|confirmed|min:6'
                ];
            }
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }


            $user = User::findOrFail(Auth()->user()->id);
            $user->fill($data)->save();

            $name = $user->firstname . ' ' . $user->lastname;
            Session::put('name', $name);

            $notification = array('title' => trans('messages.update'), 'body' => trans('messages.update_success'));
            return Redirect::back()->with('success', $notification);
        }
        return Redirect::back()->with('error', 'Invalid request!!!');


    }


}
