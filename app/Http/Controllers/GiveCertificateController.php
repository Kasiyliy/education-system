<?php

namespace App\Http\Controllers;

use App\Certificate;
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

            'text1' => 'string|max:37',
            'text2' => 'string|max:37',
            'text3' => 'string|max:37',
            'text4' => 'string|max:37',
            'text5' => 'string|max:37',
            'text6' => 'string|max:37',
            'text7' => 'string|max:37',

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
                $notification = array('title' => 'Изменение', 'body' => 'Сертификат успешно изменен');
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
                $notification = array('title' => 'Изменение', 'body' => 'Сертификат успешно изменен');
                return Redirect::route('certificate.show')->with("success", $notification);
            }
        }
    }

    public function send_email($student_id, $course_id)
    {

        $msg = "Congrtulations!";
        mail(Auth::user()->email,"ASTC Global certificate!",$msg);

        dd(Auth::user()->email);
        Session::flash('warning', 'Сертификат отправлен на почту!');
        return redirect()->back();
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

    public function create_certificate($course_id)
    {

    }
}
