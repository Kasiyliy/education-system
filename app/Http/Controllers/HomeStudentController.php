<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class HomeStudentController extends Controller {

    public function guest()
    {
        return view('gueststudent.home');
    }

}


?>