<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Exam;
use App\Department;
use App\Student;
use App\Subject;
use App\Account;

class DashboardController extends Controller {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		$error = Session::get('error');
		$success=Session::get('success');
		$totalAdmit = Student::count();
		$totalDepartment = Department::count();
		$totalSubject = Subject::count();
		$total = [
			'admitted' =>$totalAdmit,
			'department' =>$totalDepartment,
			'subject' =>$totalSubject
		];
		return view('dashboard',compact('error','success','total'));
	}
	function datahelper($data)
	{
		$DataKey = [];
		$DataVlaue =[];
		foreach ($data as $d) {
			array_push($DataKey,date("F", mktime(0, 0, 0, $d->month, 10)));
			array_push($DataVlaue,$d->amount);

		}
		return ["key"=>$DataKey,"value"=>$DataVlaue];

	}

}
