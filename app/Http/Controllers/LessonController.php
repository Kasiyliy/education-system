<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use Storage;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = [];
        if(Auth::user()->group == User::ADMIN){
            $lessons = Lesson::all();
        }else if(Auth::user()->group == User::TEACHER){
            $lessons = Lesson::join('subject', 'subject.id' , '=' ,'lessons.subject_id')
            ->where('subject.user_id' , Auth::id())->get();
        }
        return view('lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = [];
        if (Auth::user()->group == User::ADMIN) {
            $subjects = Subject::all();
        } else if (Auth::user()->group == User::TEACHER) {
            $subjects = Subject::where('user_id', Auth::id())->get();
        }
        if (count($subjects) == 0) {
            Session::flash('warning', ['title' => 'Ошибка!', 'body' => 'Не добавлены под курсы!']);
            return redirect()->back();
        }
        return view('lesson.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'subject_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $lesson = new Lesson;
            $lesson->name = $request->name;
            $lesson->description = $request->description;
            $lesson->subject_id = $request->subject_id;

            $checkForExist = Lesson::select('*')
                ->where('subject_id', '=', $lesson->subject_id)
                ->count();
            if ($checkForExist == null) {
                $lesson->save();
                Session::flash('success', ['title' => 'Добавление!', 'body' => 'Урок сохранен!']);
                return redirect()->route('lesson-part.index', ['id' => $lesson->id]);
            } else {
                $notification = array('title' => 'Добавление!', 'body' => 'У под курса уже есть урок!');
                return redirect()->back()->with('error' , $notification);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lesson.show')->with(compact('lesson'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('lesson.edit')->with('lesson' ,$lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $lesson = Lesson::findOrFail($id);
            $lesson->name = $request->name;
            $lesson->description = $request->description;
            $lesson->save();
            $notification = array('title' => 'Изменение!', 'body' => 'Изменения внесены!');
            return redirect()->back()->with('success', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return redirect()->back();
    }
}
