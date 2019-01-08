<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizResult;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class QuizResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getQuestion($allQuestions, $id){
        foreach ($allQuestions as $question){
            if($question->id == $id){
                return $question;
            }
        }
        return null;
    }

    public function store(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quiz_id);
        $allQuestionsCount = $quiz->questions->count();
        $rightAnswersCount = 0;
        $allQuestions = $quiz->questions;
        $data = json_decode($request->values);
        foreach ($data as $datum){
            $questionId = $datum->id;
            $question = $this->getQuestion($allQuestions,$questionId);
            $answerIDs = $datum->selected;
            $rightOnes = 0;
            $selectedRightOnes = 0;
            foreach ($question->answers as $answer){
                if($answer->right){
                    $rightOnes++;
                }
                foreach ($answerIDs as $answerID){
                    if($answer->id == $answerID ){
                        if($answer->right) {
                            $selectedRightOnes++;
                        }else{
                            $selectedRightOnes--;
                        }
                    }
                }
            }
            if($rightOnes == $selectedRightOnes && $selectedRightOnes!=0){
                $rightAnswersCount++;
            }
        }
        $res = $rightAnswersCount * 100/$allQuestionsCount;
        
        if($res < 0){
            $res = 0;
        }
        $quizResult = new QuizResult;
        $quizResult->student_id = Auth::user()->student->id;
        $quizResult->quiz_id = $quiz->id;
        $quizResult->percentage = $res;
        //s$quizResult->save();

        return Response()->json([
			'error' => false,
			'message' => $quizResult->toJson(),
			 ], 200);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
