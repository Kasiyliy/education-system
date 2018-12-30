<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Student;
use App\Department;
use App\Subject;
use Validator;
use App\Exam;
use App\Quiz;
use Carbon\Carbon;
use App\Transformers\MarksTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Serializers\MySerializer;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    public function Create()
    {
        $subjects = [];
        $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
        return view('quiz.create', compact('departments',  'subjects'));
    }

    public function Store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'subject_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            $quiz = new Quiz();
            $quiz->name = $data['name'];
            $quiz->description = $data['description'];
            $quiz->subject_id = $data['subject_id'];
            $quiz->save();

            $notification = array('title' => 'Data Stored!', 'body' => 'Quiz created!');
            return redirect()->back()->with("success", $notification);
        }
    }

    public function index()
    {
        $exam = "";
        $marks = [];
        $subjects = [];
        $exams = $this->exams;
        $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
        $selectDep = "";
        $selectSub = "";
        $session = "";
        return view('quiz.index', compact('selectDep', 'selectSub', 'departments', 'marks', 'subjects', 'exam', 'exams'));

    }

    public function index2(Request $request)
    {

        $data = $request->all();

        $rules = [
            'subject_id' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            return Response()->json([
                'error' => true,
                'message' => $errors
            ], 400);
        } else {
            $quizes = DB::table('quizes')
                ->select('quizes.id', 'quizes.name', 'subject.name as subjectName')
                ->join('subject', 'subject.id', '=', 'quizes.subject_id')
                ->where('quizes.subject_id', $data['subject_id'])
                ->where('quizes.deleted_at', '=', null)
                ->get();

            return Response()->json([
                'success' => true,
                'message' => "Quizes fetched successfully",
                'quizes' => $quizes
            ], 200);

        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'raw_score' => 'required',
            'percentage' => 'required',
            'weight' => 'required',
            'percentage_x_weight' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            return Response()->json([
                'error' => true,
                'message' => $errors
            ], 400);
        } else {
            $exam = Exam::findOrFail($id);
            $exam->fill($data)->save();

            return Response()->json([
                'success' => true,
                'message' => "Marks updated successfully.",
                'marks' => $exam
            ], 200);

        }
    }

    public function destroy($id){

        $quiz = Quiz::where('id' , $id)->first();
        $quiz->delete();
        $notification= array('title' => 'Удаление', 'body' => 'Тест удален.');
        return Response()->json([
            'success' => true,
            'message' => $notification
        ], 200);

    }
}
