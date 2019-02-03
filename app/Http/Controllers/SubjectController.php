<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\Subject;
use App\User;
use App\Department;
use Validator;
use App\Transformers\SubjectTransformer;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->middleware('teacher', ['except' => ['subjetsByDptSem']]);
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subjects = null;
        if(Auth::user()->group == User::TEACHER){
            $subjects = Subject::with('department')->where('user_id',Auth::user()->id )->get();
        }else{
            $subjects = Subject::with('department')->get();
        }
        return view('subject.index', compact('subjects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
        return view('subject.create', compact('departments'));
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
            'name' => 'required',
            'code' => 'required|unique:subject,code',
            'price' => 'required',
            'department_id' => 'required|numeric',
            'description' => 'required',
            'points' => 'required',
            'plans' => 'required'

        ];
        $data['user_id'] = Auth::user()->id;

        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('subject.create')->withInput()->withErrors($validator);
        } else {

            $this->subject->create($data);
            $notification = array('title' => trans('messages.insert'), 'body' => trans('messages.insert_success'));
            return Redirect::route('subject.create')->with("success", $notification);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
            $subject = Subject::findOrFail($id);
            return view('subject.edit', compact('departments', 'subject'));
        } catch (Exception $e) {
            $notification = array('title' => trans('messages.error'), 'body' => trans('messages.info_error'));
            return Redirect::route('subject.index')->with("error", $notification);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'department_id' => 'required|numeric',
            'description' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            try {
                $subject = Subject::findOrFail($id);
                $subject->fill($data)->save();
                $notification = array('title' => trans('messages.update'), 'body' => trans('messages.update_success'));
                return Redirect::route('subject.index')->with("success", $notification);
            } catch (Exception $e) {
                $notification = array('title' => trans('messages.error'), 'body' => trans('messages.info_error'));
                return Redirect::route('subject.index')->with("error", $notification);
            }
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
        $subject = Subject::findOrFail($id);
        $subject->delete();
        $notification = array('title' => trans('messages.delete'), 'body' => trans('messages.delete_success'));
        return Redirect::route('subject.index')->with("success", $notification);

    }

    public function subjetsByDptSem($department, $semester)
    {
        $subs = Subject::where('department_id', $department)->get();
        $subjects = Fractal()->collection($subs, new SubjectTransformer());
        return Response()->json(
            [
                'success' => true,
                'subjects' => $subjects
            ], 200
        );


    }


}
