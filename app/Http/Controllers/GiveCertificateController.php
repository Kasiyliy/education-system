<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Institute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Subject;
use App\StudentCertificate;
use Mail;
use Session;

class GiveCertificateController extends Controller
{
    public function index()
    {
    }

    public function update($id)
    {
        $certificate = Certificate::select('*')
            ->where('subject_id', '=', $id)
            ->first();
        $subject_id = $id;
        if ($certificate == null) {
            $certificate = Certificate::select('*')
                ->where('id', '=', '0')
                ->first();
            return view('certificate.edit', compact('certificate', 'subject_id'));
        } else {
            return view('certificate.edit', compact('certificate', 'subject_id'));
        }
    }

    public function change($certificate_id, $subject_id, Request $request)
    {
        $data = $request->all();
        $rules = [
            'goden' => 'integer|max:20',
            'inspired_by' => 'required|max:20',
            'on_behalf_and_for' => 'required|max:20',

            'text1' => 'string|max:21',
            'text2' => 'string|max:21',
            'text3' => 'string|max:21',
            'text4' => 'string|max:21',
            'text5' => 'string|max:21',
            'text6' => 'string|max:21',
            'text7' => 'string|max:21',

        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            if ($certificate_id == 0) {
                $certificate = new Certificate();
                $certificate->goden_do = $request->goden;
                $certificate->inspired_by = $request->inspired_by;
                $certificate->on_behalf_and_for = $request->on_behalf_and_for;
                $certificate->text1 = $request->text1;
                $certificate->text2 = $request->text2;
                $certificate->text3 = $request->text3;
                $certificate->text4 = $request->text4;
                $certificate->text5 = $request->text5;
                $certificate->text6 = $request->text6;
                $certificate->text7 = $request->text7;
                $certificate->subject_id = $subject_id;
                $certificate->save();
                $notification = array('title' => trans('messages.update') , 'body' =>trans('messages.update_success'));
                return Redirect::route('certificate.show')->with("success", $notification);
            } else {
                $certificate = Certificate::findOrFail($certificate_id);
                $certificate->goden_do = $request->goden;
                $certificate->inspired_by = $request->inspired_by;
                $certificate->on_behalf_and_for = $request->on_behalf_and_for;
                $certificate->text1 = $request->text1;
                $certificate->text2 = $request->text2;
                $certificate->text3 = $request->text3;
                $certificate->text4 = $request->text4;
                $certificate->text5 = $request->text5;
                $certificate->text6 = $request->text6;
                $certificate->text7 = $request->text7;
                $certificate->subject_id = $subject_id;
                $certificate->save();
                $notification = array('title' => trans('messages.update') , 'body' =>trans('messages.update_success'));
                return Redirect::route('certificate.show')->with("success", $notification);
            }
        }
    }

    public function send_email($student_id, $course_id)
    {

        $institute = Institute::first();
        if ($institute) {
            $from = $institute->email;
            $to = Auth::user()->email;
            $subject = "ASTC Global certificate";
            $body = "Congratulations! Your certificate is ready! Download it from here: " . $this->get_info($student_id, $course_id);
            //$this::sendMail($from, $to, $subject, $body);
            $this::sendMail();
            Session::flash('success', 'Сертификат отправлен на почту!');
        } else {
            Session::flash('error', 'Ошибка отправки сообщения, свяжитесь с администратором сайта!');
        }

        return redirect()->back();
    }

    public static function sendMail(){
        $to_name = 'Kasya';
        $to_email = 'asilkhan-al@mail.ru';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");

        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail');
            $message->from('mail.globalastc@gmail.com','Artisans Web');
        });
    }

    public static function sendMail2($from,$to,$subject,$body)
    {
        $charset = 'utf-8';
        mb_language("ru");
        $headers  = "MIME-Version: 1.0 \n" ;
        $headers .= "From: ASTCGlobal <no-reply@mail.astcglobal.org> \n";
        $headers .='X-Mailer: PHP/' . phpversion();
        $headers .= "Reply-To: <".$from."> \n";
        $headers .= "Content-Type: text/html; charset=$charset \n";
        $subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';
        mail($to,$subject,$body,$headers);
    }

    public function put_info($student_id, $course_id)
    {
        $subject_id = $course_id;
        $user_id = $student_id;

        $teacher_id1 = Subject::select('user_id')
            ->where('id', '=', $subject_id)
            ->first();
        $teacher_id = $teacher_id1->user_id;

        $goden1 = Certificate::select('goden_do')
            ->where('subject_id', '=', $course_id)
            ->first();
        $goden2 = $goden1->goden_do;

        $goden_do = Carbon::now()->addYear('' . $goden2);
        $converteddate = date("Y-m-d",strtotime($goden_do));

        $certificate = StudentCertificate::select('*')
            ->where('user_id', '=', $user_id)
            ->where('subject_id', '=', $subject_id)
            ->first();


        if (!$certificate) {
            $IdNo = abs(crc32(uniqid()));

            $certificate = new StudentCertificate();
            $certificate->IdNo = $IdNo;
            $certificate->subject_id = $subject_id;
            $certificate->user_id = $user_id;
            $certificate->teacher_id = $teacher_id;
            $certificate->goden_do = $converteddate;
            $certificate->save();
            return redirect()->route('certificate' ,compact('IdNo'));

        } else {
            $certificate_id = $certificate->IdNo;
            return redirect()->route('certificate',compact('certificate_id'));
        }

    }


    public function get_info($student_id, $course_id)
    {
        $subject_id = $course_id;
        $user_id = $student_id;

        $teacher_id1 = Subject::select('user_id')
            ->where('id', '=', $subject_id)
            ->first();
        $teacher_id = $teacher_id1->user_id;

        $goden1 = Certificate::select('goden_do')
            ->where('subject_id', '=', $course_id)
            ->first();
        $goden2 = $goden1->goden_do;

        $goden_do = Carbon::now()->addYear('' . $goden2);
        $converteddate = date("Y-m-d",strtotime($goden_do));

        $certificate = StudentCertificate::select('*')
            ->where('user_id', '=', $user_id)
            ->where('subject_id', '=', $subject_id)
            ->first();


        if (!$certificate) {
            $IdNo = abs(crc32(uniqid()));

            $certificate = new StudentCertificate();
            $certificate->IdNo = $IdNo;
            $certificate->subject_id = $subject_id;
            $certificate->user_id = $user_id;
            $certificate->teacher_id = $teacher_id;
            $certificate->goden_do = $converteddate;
            $certificate->save();
            return route('pustota' ,compact('IdNo'));

        } else {
            $certificate_id = $certificate->IdNo;
            return route('pustota',compact('certificate_id'));
        }

    }

    public function create_certificate($course_id)
    {

    }
}
