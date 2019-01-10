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
        $lessons = Lesson::all();
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
        if(Auth::user()->group == User::ADMIN){
            $subjects = Subject::all();
        }else if(Auth::user()->group == User::TEACHER){
            $subjects = Subject::where('user_id' , Auth::id())->get();
        }
        if(count($subjects)==0){
            Session::flash('warning',['title' => 'Ошибка!' ,'body' =>'Не добавлены под курсы!']);
            return redirect()->back();
        }
        return view('lesson.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
//            'presentation' => 'required|file|max:50000|mimes:pdf',
            'subject_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else {
//            $presentation = $request->presentation;
//            $presentation_new_name = time() . $presentation->getClientOriginalName();
//            $fullPath = $presentation->move('assets/files/lessons', $presentation_new_name);
            $lesson = new Lesson;
//            $lesson->presentation = $fullPath;
            $lesson->name = $request->name;
            $lesson->description = $request->description;
            $lesson->subject_id = $request->subject_id;
            $lesson->save();
            Session::flash('success', ['title' => 'Успешно!' , 'body' =>'Урок сохранен!']);

            return redirect()->route('lesson-part.index', ['id'=> $lesson->id ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
//        if(file_exists($lesson->presentation)){
//            unlink($lesson->presentation);
//        }
        $lesson->delete();
        return redirect()->back();
    }
}
