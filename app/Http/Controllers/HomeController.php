<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Institute;
use App;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

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

    public function lock()
    {
        $user = auth()->user();
        if (!$user)

            return redirect()->to('/')->with('warning', 'Сессия завершена, пожалуйста войдите в система снова.');
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
        return view('gueststudent.contacts');
    }
}
