<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Institute;
use App\Certificate;
use App\StudentCertificate;
use App\User;
use App\Subject;
use App;

class HomeController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        if ($user) {
            return redirect()->to('/dashboard');
        }

        $error = Session::get('error');
        $institute = Institute::select('name')->first();
        if (!$institute) {
            $institute = new Institute;
            $institute->name = "Название учереждения";
        }
        return view('home', compact('error', 'institute'));
    }

    public function mail()
    {
        return view('mail');
    }

    public function lock()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('/')->with('warning', trans('messages.session'));
        auth()->logout();

        return view('lock', compact('user'));
    }

    public function setLangEng()
    {
        Session::put('language', 'en');
        return redirect()->back();
    }

    public function setLangRus()
    {
        Session::put('language', 'ru');
        return redirect()->back();
    }

    public function ourvalues()
    {
        return view('gueststudent.our_values');
    }

    public function contacts()
    {
        $institute = Institute::select('*')->first();
        if (!$institute) {
            $institute = new Institute;
            $institute->name = "Название учереждения";
        }
        return view('gueststudent.contacts', compact('error', 'institute'));
    }

    public function help()
    {
        return view('gueststudent.help');
    }

    public function feedback()
    {
        return view('gueststudent.feedback');
    }

    public function certificates()
    {
        $certificates = StudentCertificate::select('student_certificates.IdNo as IdNo' ,
            'students.firstName as studentfirstname', 'students.lastName as studentlastname'
        , 'users.firstname as teacherfirstname' , 'users.lastname as teacherlastname' , 'subject.name as subjectname' ,
            'student_certificates.created_at as created_at' , 'student_certificates.goden_do as goden_do' )
            ->leftJoin('users' , 'users.id' , '=' , 'student_certificates.teacher_id')
            ->leftJoin('subject' , 'subject.id' , '=' , 'student_certificates.subject_id')
            ->leftJoin('students' , 'students.user_id' , '=' , 'student_certificates.user_id')
            ->distinct('IdNo')
            ->get();
        return view('certificate.index')->with(compact('certificates'));
    }


    public function subject_certificate()
    {
        $subjects = App\Subject::select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        return view('certificate.show', compact('subjects'));
    }

    public function instruction()
    {
        return view('instruction.index');
    }

}
