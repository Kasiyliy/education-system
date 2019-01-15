<?php

namespace App\Http\Controllers;

use App\HelpFeedback;
use Illuminate\Support\Facades\URL;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class HelpFeedbackController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function helpfeedback( Request $request)
    {
        $data=$request->all();
        $rules=[
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'message' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            $url = URL::route('help');
            $url .= "#help1";
            return redirect()->to($url)->withErrors($validator);
        }
        $helpfeedback = new HelpFeedback();
        $helpfeedback->name=$request->name;
        $helpfeedback->surname=$request->surname;
        $helpfeedback->email=$request->email;
        $helpfeedback->message=$request->message;
        $helpfeedback->feedback=false;
        $helpfeedback->save();

        $notification = array( 'body' => 'Ваше обращение отправлено');
        return view('gueststudent.help')->with('success',$notification);
    }
}
