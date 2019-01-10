<?php

namespace App\Http\Controllers;

use App\CurrentLesson;
use App\Department;
use App\Lesson;
use App\LessonPart;
use Session;
use App\Message;
use App\Quiz;
use App\QuizResult;
use App\Registration;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentSubjectsController extends Controller
{

    public function mySubjects(){
        $student = Student::where('user_id' ,Auth::id())->first();

        $subjects = Subject::
            join('registrations','registrations.subject_id' , '=' ,'subject.id')
            ->where('registrations.students_id' , $student->id)
            ->where('registrations.date_to_learn' , '<=', 'now()')
            ->select('subject.*')
            ->get();

        $sortedSubjectsArray = array();
        foreach ($subjects as $subject){
            if(!array_key_exists($subject->department_id,$sortedSubjectsArray)){
                $sortedSubjectsArray[$subject->department_id] = array();
            }
            $sortedSubjectsArray[$subject->department_id][] = ($subject);
        }
        return view('gueststudent.my_subjects')->with(compact('sortedSubjectsArray'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();

        return view("gueststudent.all_subjects")->with(compact('subjects'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registration = Registration::where('students_id', Auth::user()->student->id)
                                    ->where('subject_id' , $id)->get();
        if(count($registration) == 0){
            return redirect()->back()->with(['error'  => 'Нет доступа!']);
        }


        $subject = Subject::findOrFail($id);
        $lessons = $subject->lessons()->orderBy('id' ,'asc')->get();

        $quizes = $subject->quizes()->get();
        return view('gueststudent.subject')->with(compact('subject', 'lessons','quizes'));
    }

    public function showLesson($id)
    {

        $lesson = Lesson::with('lessonParts')->findOrFail($id);
        if($lesson->lessonParts->count() == 0){
            Session::flash('warning',  'Урок еще не готов!');
            return redirect()->back();
        }

        $firstLessonPart = LessonPart::where('lesson_id' ,$lesson->id )->orderBy('id' ,'asc')->first();
        $currentLessonPart = CurrentLesson::select('current_lessons.*')
            ->join('lesson_parts', 'lesson_parts.id' , '=' ,'current_lessons.lesson_part_id')
            ->join('lessons', 'lessons.id' , '=' ,'lesson_parts.lesson_id')
            ->where( 'lesson_parts.lesson_id', $lesson->id )
            ->where( 'current_lessons.user_id', Auth::id())
            ->first();

        if(!$currentLessonPart){
            $currentLessonPart = new CurrentLesson();
            $currentLessonPart->user_id = Auth::id();
            $currentLessonPart->lesson_part_id = $firstLessonPart->id;
            $currentLessonPart->save();
        }

        $lessonPart = $currentLessonPart->lessonPart;
        return view('gueststudent.lesson')->with(compact('lesson','lessonPart','currentLessonPart'));
    }

    public function nextLessonPart($currentLessonPartId){
        $currentLessonPart = CurrentLesson::findOrFail($currentLessonPartId);

        $lessonParts = $currentLessonPart->lessonPart->lesson->lessonParts()->orderBy('id' , 'asc')->get();
        $newLessonPartID = 0;
        $break = false;
        for ($i = 0; $i < count($lessonParts); $i++){
            if($break){
                $newLessonPartID = $lessonParts[$i]->id;
                break;
            }
            if($lessonParts[$i]->id == $currentLessonPart->lesson_part_id && $i + 1 != count($lessonParts)){
                $break = true;
            }
        }

        if($newLessonPartID == $currentLessonPart->lesson_part_id || $newLessonPartID == 0){
            return Response()->json([
                'error' => true,
                'message' => "",
            ]);
        }else{
            $currentLessonPart->lesson_part_id = $newLessonPartID;
            $currentLessonPart->save();
            $currentLessonPart = CurrentLesson::with('lessonPart')->find($currentLessonPart->id);
            return Response()->json([
                'error' => false,
                'message' => $currentLessonPart,
            ]);
        }
    }

    public function showQuiz($id)
    {
        try{
            $quiz = Quiz::findOrFail($id);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'  => 'Нет доступа!']);
        }

        $registration = Registration::where('students_id', Auth::user()->student->id)
            ->where('subject_id' , $quiz->subject->id)->get();
        if(count($registration) == 0){
            return redirect()->back()->with(['error'  => 'Нет доступа!']);
        }

        $quizResult = QuizResult::where('student_id', Auth::user()->student->id)->where('quiz_id' , $quiz->id)->get()->last();
        if($quizResult){
            return view('gueststudent.quiz')->with(compact('quiz' , 'quizResult'));
        }else{
            return view('gueststudent.quiz')->with(compact('quiz' ));
        }
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

    public function chat($id)
    {
        $subject = Subject::findOrFail($id);

        $currentUser = Auth::user();

        $registration = Registration::where('students_id', $currentUser->student->id)
            ->where('subject_id' , $id)->get();
        if(count($registration) == 0){
            return redirect()->back()->with(['error'  => 'Нет доступа!']);
        }


        $messages = Message::whereIn('acceptor_user_id' ,[$currentUser->id , $subject->user->id])
            ->whereIn('sender_user_id' ,[$currentUser->id , $subject->user->id])
            ->where('subject_id' ,$subject->id )
            ->orderBy('created_at' ,'desc')->get();

        return view('gueststudent.chat', compact('subject' , 'messages'));
    }
}
