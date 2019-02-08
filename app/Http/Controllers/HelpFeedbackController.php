<?php

namespace App\Http\Controllers;

use App\HelpFeedback;
use App\Institute;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class HelpFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = HelpFeedback::all();
        return view('feedback.index', compact("feedbacks"));
    }

    public function answer($id)
    {
        try {
            $feedbacks = HelpFeedback::findOrFail($id);
            return view('feedback.answer', compact('feedbacks'));
        } catch (Exception $e) {
            $notification = array('title' => 'Data Answer', 'body' => "There is no record.");
            return Redirect::route('feedback.admin')->with("error", $notification);
        }
    }
    public function sendanswer(Request $request){
        $data = $request->all();
        $rules = [
            'email' => 'required',
            'message' => 'required|max:255',
            'answer' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $institute = Institute::first();
        $email = $request->email;
        $message = $request->message;
        $answer = $request->answer;
        if ($institute) {
            $this::sendMail($email , $answer);
        } else {
        }

        $notification = array('title' => trans('messages.messages') , 'body' =>trans('messages.messages_send'));
        return redirect()->back()->with("success" , $notification);
    }

    public static function sendMail($to, $body){
        $to_name = Auth::user()->firstname.' '.Auth::user()->lastname;
        $to_email = $to;
        $data = array('name'=>$to_name, "body" => $body);

        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('');
            $message->from('mail.globalastc@gmail.com','GlobalASTC');
        });
    }

    public function destroy($id)
    {
        $feedback = HelpFeedback::findOrFail($id);
        $feedback->delete();
        $notification = array('title' => trans('messages.delete') , 'body' =>trans('messages.delete_success'));
        return Redirect::route('feedback.admin')->with("success", $notification);
    }

    public function feedbacksend(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'message' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $url = URL::route('feedback');
            $url .= "#help1";
            return redirect()->to($url)->withErrors($validator);
        }
        $helpfeedback = new HelpFeedback();
        $helpfeedback->name = $request->name;
        $helpfeedback->surname = $request->surname;
        $helpfeedback->email = $request->email;
        $helpfeedback->message = $request->message;
        $helpfeedback->feedback = true;
        $helpfeedback->save();

        Session::flash('success', trans('messages.messages_send'));
        return redirect()->back();
    }


    public function helpfeedback(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'message' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $url = URL::route('help');
            $url .= "#help1";
            return redirect()->to($url)->withErrors($validator);
        }
        $helpfeedback = new HelpFeedback();
        $helpfeedback->name = $request->name;
        $helpfeedback->surname = $request->surname;
        $helpfeedback->email = $request->email;
        $helpfeedback->message = $request->message;
        $helpfeedback->feedback = false;
        $helpfeedback->save();

        Session::flash('success', trans('messages.messages_send'));
        return redirect()->back();
    }
}
