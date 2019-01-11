<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quiz;
use http\QueryString;
use Validator;
use Session;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quiz.questions.index')->with(compact('quiz'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $question = Question::findOrFail($id);
        return view('quiz.questions.edit')->with(compact('question'));
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
        $question = Question::findOrFail($id);
        $question->answers()->delete();
        $data = $request->all();
        $rules = [
            "variantCBs" => "required|array|min:1",
            "variants" => "required|array|min:1",
            "value" => "required"
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $question->value = $request->value;
            $question->save();

            foreach ($request->variants as $key => $val) {
                $answer = new Answer();
                $answer->value = $request->variants[$key];
                $answer->right = array_key_exists($key, $request->variantCBs);
                $answer->question_id = $question->id;
                $answer->save();
            }
            Session::flash('success', ['title' => 'Успешно!', 'body' => 'Тест сохранен!']);
            return redirect()->back();

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
        $question = Question::findOrFail($id);
        if ($question->answers()->count() > 0) {
            $question->answers()->delete();
        }
        $question->delete();
        return redirect()->back();
    }

    public function createQuestion(Request $request, $id)
    {

        $quiz = Quiz::findOrFail($id);
        $data = $request->all();
        $rules = [
            "variantCBs" => "required|array|min:1",
            "variants" => "required|array|min:1",
            "value" => "required"
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $question = new Question;
            $question->value = $request->value;
            $question->quiz_id = $quiz->id;
            $question->save();

            foreach ($request->variants as $key => $val) {
                $answer = new Answer();
                $answer->value = $request->variants[$key];
                $answer->right = array_key_exists($key, $request->variantCBs);
                $answer->question_id = $question->id;
                $answer->save();
            }
            Session::flash('success', ['title' => 'Успешно!', 'body' => 'Тест сохранен!']);
            return redirect()->back();

        }
    }
}
