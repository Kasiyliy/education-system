<?php

namespace App\Http\Controllers;

use App\Message;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        $students = Student::select('students.id','students.firstName' , 'students.lastName' , 'students.middleName',  'subject.name as subjectName', 'subject.id as subjectId', DB::raw('count(m.id) as unread'))
            ->join('registrations' , 'registrations.students_id' , '=' , 'students.id')
            ->join('subject', 'subject.id' , '=' ,'registrations.subject_id')
            ->join('users', 'users.id' , '=' ,'subject.user_id')
            ->join('users as u2', 'u2.id' , '=' ,'students.user_id')
            ->leftJoin('messages as m',  function($join)
            {
                $join->on('m.acceptor_user_id', '=', DB::raw(Auth::id()));
                $join->on('m.read', '=', DB::raw('false'));
                $join->on('u2.id', '=', 'm.sender_user_id');
            })
            ->where('users.id',$currentUser->id )
            ->where('registrations.deleted_at',null)
            ->where('subject.deleted_at',null)
            ->where('users.deleted_at',null)
            ->orderBy('unread' , 'desc')
            ->groupBy('students.id')
            ->groupBy('students.firstName')
            ->groupBy('students.lastName')
            ->groupBy('students.middleName')
            ->groupBy('subjectName')
            ->groupBy('subjectId')
            ->get();



        return view('chats.index' , compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'acceptor_user_id' => 'required',
            'content' => 'required',
            'subject_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else {
            $message = new Message;
            $message->content = $request->content;
            $message->subject_id = $request->subject_id;
            $message->acceptor_user_id = $request->acceptor_user_id;
            $message->sender_user_id = Auth::user()->id;
            $message->save();
            return redirect()->back();
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

    }

    public function show2($studentId , $subjectId)
    {
        $currentUser = Auth::user();
        $student = Student::findOrFail($studentId);
        $subject = Subject::findOrFail($subjectId);
        $students = Student::select('students.id')->distinct()
            ->join('registrations' , 'registrations.students_id' , '=' , 'students.id')
            ->join('subject', 'subject.id' , '=' ,'registrations.subject_id')
            ->join('users', 'users.id' , '=' ,'subject.user_id')
            ->join('users as studentUser', 'studentUser.id' , '=' ,'students.user_id')
            ->where('users.id',$currentUser->id )
            ->where('registrations.deleted_at',null)
            ->where('subject.deleted_at',null)
            ->where('users.deleted_at',null)
            ->where('studentUser.deleted_at',null)
            ->where('students.id',$studentId)
            ->get();
        if(count($students) == 0){
            $notification= array('title' => trans('messages.error'), 'body' => trans('messages.error_student_account'));
            return redirect()->back()->with("error",$notification);;
        }
        if(!$student->user_id){
            $notification= array('title' => trans('messages.error'), 'body' => trans('messages.error_student_account'));
            return redirect()->back()->with("error",$notification);;
        }

        $messages = Message::whereIn('acceptor_user_id' ,[$currentUser->id , $student->user->id])
            ->whereIn('sender_user_id' ,[$currentUser->id , $student->user->id])
            ->where('subject_id' ,$subjectId )
            ->orderBy('created_at' ,'desc')->get();

        $unReadMessages = Message::where('acceptor_user_id' ,$currentUser->id)
            ->where('sender_user_id' ,$student->user->id)
            ->where('subject_id' ,$subjectId )
            ->where('read' ,false)
            ->orderBy('created_at' ,'desc')->get();
        foreach ($unReadMessages as $unRead){
            $unRead->read = true;
            $unRead->save();
        }


        return view('chats.chat',compact('student','subject', 'messages'));
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
        //
    }
}
