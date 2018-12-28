<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Validator;
use App\Account;
use App\Sector;
use Carbon\Carbon;
use App\FeeCollection;
use DB;
use App\Department;
use App\Student;
use App\Institute;
class ReportController extends Controller
{
	public function __construct()
    {
        $this->middleware('account');
    }
	protected $semesters=[
		'L1T1' => '1st Year 1st Semester',
        'L1T2' => '1st Year 2nd Semester',
        'L2T1' => '2nd Year 1st Semester',
        'L2T2' => '2nd Year 2nd Semester',
        'L3T1' => '3rd Year 1st Semester',
        'L3T2' => '3rd Year 2nd Semester',
        'L4T1' => '4th Year 1st Semester',
        'L4T2' => '4th Year 2nd Semester'
	];

	public function reportByType(Request $request){
		$types = [
			'Income' => 'Income',
			'Expence' => 'Expence',
		];
		$fromDate = Carbon::yesterday();
		$toDate = Carbon::today();
		$type="Income";
		if ($request->isMethod('post'))
		{
			$dateRange=$request->input('DateRange');
			$type=$request->input('type');
			$dateList=explode('-',$dateRange);
			$fromDate=Carbon::createFromFormat('d/m/Y', trim($dateList[0]));
			$toDate=Carbon::createFromFormat('d/m/Y', trim($dateList[1]));

		}


		$accounts = Account::with(array('sector' =>  function($query) use ($type){
			$query->where('type',$type);
		}))->whereHas('sector',function($query) use ($type) {
			$query->where('type',$type);
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->get();
		$total = Account::with(array('sector' =>  function($query) use ($type){
			$query->where('type',$type);
		}))->whereHas('sector',function($query) use ($type) {
			$query->where('type',$type);
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->sum('amount');
		$fromDate=$fromDate->format('d/m/Y');
		$toDate=$toDate->format('d/m/Y');
		return view('reports.account.types',compact('types','type','total','accounts','fromDate','toDate'));
	}
	public function reportBalance(Request $request){

		$fromDate = Carbon::yesterday();
		$toDate = Carbon::today();

		if ($request->isMethod('post'))
		{
			$dateRange=$request->input('DateRange');
			$dateList=explode('-',$dateRange);
			$fromDate=Carbon::createFromFormat('d/m/Y', trim($dateList[0]));
			$toDate=Carbon::createFromFormat('d/m/Y', trim($dateList[1]));

		}


		$incomes = Account::with(array('sector' =>  function($query){
			$query->where('type','Income');
		}))->whereHas('sector',function($query){
			$query->where('type','Income');
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->get();
		$incomeTotal = Account::with(array('sector' =>  function($query){
			$query->where('type','Income');
		}))->whereHas('sector',function($query){
			$query->where('type','Income');
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->sum('amount');
		$expences = Account::with(array('sector' =>  function($query){
			$query->where('type','Expence');
		}))->whereHas('sector',function($query){
			$query->where('type','Expence');
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->get();
		$expenceTotal = Account::with(array('sector' =>  function($query){
			$query->where('type','Expence');
		}))->whereHas('sector',function($query){
			$query->where('type','Expence');
		})
		->where('date','>=',$fromDate->format('Y-m-d'))
		->where('date','<=',$toDate->format('Y-m-d'))
		->sum('amount');
		$balance = $incomeTotal - $expenceTotal;
		$fromDate=$fromDate->format('d/m/Y');
		$toDate=$toDate->format('d/m/Y');
		return view('reports.account.balance',compact('incomes','expences','incomeTotal','expenceTotal','balance','fromDate','toDate'));
	}
}
