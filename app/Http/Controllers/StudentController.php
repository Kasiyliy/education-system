<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Student;
use App\Department;
use App\Subject;
use Validator;
use Session;
use Carbon\Carbon;
use App\Registration;
use App\Transformers\StudentTransformer;


class StudentController extends Controller {
	protected $student;
	
	public function __construct(Student $student)
	{
		$this->middleware('admin',['except' => ['registeredStudentList']]);
		$this->student = $student;
	}
	/**
	* Display  listing of the resource.
	*
	* @return Response
	*/

	public function index()
	{
		$students =Student::all();
		return view('student.index',compact('students'));
	}
	public function index2(Request $request)
	{
		$students =Student::all();

		return view('student.index',compact('students'));
	}

	public function studentList($subID)
	{

		$registeredStudents = Registration::select('id','students_id','subject_id')
		->where('deleted_at', '=', null)
		->where('subject_id', '=', $subID)
		->get();
	
		$students =Student::select('id','firstName','lastName','middleName')
		->get();
		return Response()->json([
			'success' => true,
			'students' => $students,
			'registeredStudents' => $registeredStudents
		], 200);

	}
	public function registeredStudentList($sID,$session,$semester)
	{

		$sdts=Registration::with(array('student' =>  function($query){
			$query->select('id','firstName','middleName','lastName');
		}))
		->where('subject_id',$sID)
		->get();

		$students= Fractal()->collection($sdts, new StudentTransformer());
		return Response()->json([
			'success' => true,
			'students' => $students
		], 200);

	}



	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		$departments = Department::select('id','name')->orderby('name','asc')->lists('name', 'id');
		return view('student.create',compact('departments'));
	}


	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store(Request $request)
	{
		$data=$request->all();
		$rules=[
			'firstName' => 'required',
			'lastName' => 'required',
			'gender' => 'required',
			'dob' => 'required',
			'mobileNo' => 'required'
		];
		$validator = Validator::make($data, $rules);
		//$errors=$validator->messages()->toArray();
		if ($validator->fails())
		{
			return Redirect::route('student.create')->withInput()->withErrors($validator);

			// return Response()->json([
			// 	'error' => true,
			// 	'message' => $errors
			// ], 400);
		}
		$student = new Student;
		$student->create($data);
		// return Response()->json([
		// 	'success' => true,
		// 	'message' => "Student data store successfully."
		// ], 200);
		$notification= array('title' => 'Data Store', 'body' => 'Student admitted succesfully.');
		return Redirect::route('student.create')->with("success",$notification);

	}


	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($id)
	{
		try
		{

			$student = Student::with('department')->where('id',$id)->first();
			return view('student.show',compact('student'));
		}
		catch (Exception $e)
		{
			$notification= array('title' => 'Data Edit', 'body' => "There is no record.");
			return Redirect::route('student.index')->with("error",$notification);
		}
	}


	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
	{
		try
		{
			$departments =Department::select('id','name')->orderby('name','asc')->lists('name', 'id');
			$student = Student::findOrFail($id);
			return view('student.edit',compact('departments','student'));
		}
		catch (Exception $e)
		{
			$notification= array('title' => 'Data Edit', 'body' => "There is no record.");
			return Redirect::route('student.index')->with("error",$notification);
		}
	}


	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update(Request $request,$id)
	{
		$data=$request->all();
		$rules=[
			'firstName' => 'required',
			'lastName' => 'required',
			'gender' => 'required',
			'dob' => 'required',
			'mobileNo' => 'required'
		];
		$validator = Validator::make($data, $rules);
		//$errors=$validator->messages()->toArray();
		if ($validator->fails())
		{
			return Redirect::route('student.edit',[$id])->withInput()->withErrors($validator);
			// return Response()->json([
			// 	'error' => true,
			// 	'message' => $errors
			// ], 400);
		}
		else {
			try {
				$student = Student::findOrFail($id);
				$student->fill($data)->save();
				// return Response()->json([
				// 	'success' => true,
				// 	'message' => "Student Information Updated Succesfully."
				// ], 200);
				$notification= array('title' => 'Изменение', 'body' => "Информация успешно изменена");
				return Redirect::route('student.index')->with("success",$notification);
			}
			catch (Exception $e)
			{
				$notification= array('title' => 'Изменение', 'body' => "Нету никаких записей");
				return Redirect::route('student.index')->with("error",$notification);
			}
		}
	}


	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id)
	{
		$student = Student::findOrFail($id);
		$student->delete();
		$notification= array('title' => 'Удаление', 'body' => 'Студент успешно удален.');
		return Redirect::route('student.index')->with("success",$notification);
	}

	/**
	*These below code is responsible for
	*student registration
	*
	*
	*/
	public function regCreate()
	{
		$students=[];
		$subjects = Subject::select('id','name')->orderby('name','asc')->lists('name', 'id');
		return view('student.registration.create',compact('subjects','students'));
	}
	public function regStore(Request $request){
		$data=$request->all();
		$rules=[
			'subject_id' => 'required',
		];
		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return back()->withErrors($validator);
		}
		if(!$request->exists('ids') || !count($data['ids']) || !$request->exists('registeredIds') || !count($data['registeredIds'])){
			$validator->errors()->add('Студент', 'Пожалуйста выберите хотя бы одного студента!');
			return back()->withErrors($validator);
		}
		if(!$request->exists('dateToLearn') || $data['dateToLearn'] == null ){
			$validator->errors()->add('Дата','Выберите дату по которое студент будет проходить курс');
			return back()->withErrors($validator);
		}
		$nowadate = Carbon::now();
		if($data['dateToLearn'] < $nowadate){
			$validator->errors()->add('Студент', 'Вы выбрали срок который уже прошел!');
			return back()->withErrors($validator);
		}
		$toBeRegisterStudents = [] ;
		$alreadyRegistered = 0;
		$newRegistration = 0;
		$dateToLearn = $data['dateToLearn'];
		foreach ($data['ids'] as  $id){
			$isExists = false;
			$isWantTo = $this->isWantToRegister($id,$data['registeredIds']);
			if($isWantTo){
				$sts = Registration::where('subject_id',$data['subject_id'])
				->where('students_id',$id)->first();
				if($sts){
					$isExists = true;
					$alreadyRegistered +=1;
				}
				if(!$isExists){
					$toBeRegisterStudents [] = [
						'subject_id' => $data['subject_id'],
						'students_id' => $id,
						'date_to_learn' => $dateToLearn,
						'created_at' => Carbon::now(),
						'updated_at' => Carbon::now()
					];
					
					$newRegistration +=1;
				}
			}
		}
		Registration::insert($toBeRegisterStudents);
		$notification= array('title' => ' Добавление ', 'body' => $newRegistration.' Студент успешно зарегестрирован на под курс.');
		

		if($alreadyRegistered){
			$notification= array('title' => ' Добавление ', 'body' => $newRegistration.' студентов успешно зарегестрировано и '.$alreadyRegistered.' уже были зарегестрированы!');
		}
		return back()->with("success",$notification);

	}
	private  function isWantToRegister($id,$registeredIds)
	{
		foreach ($registeredIds as $key => $value) {
			if($id==$key)
			{
				return 1;
			}
		}
		return 0;
	}

	public function regIndex(){
		$subjects = Subject::select('id','name')->orderby('name','asc')->lists('name', 'id');
		$selectSub="";
		$students =array();
		return view('student.registration.index',compact('students','subjects','selectSub'));
	}
	public function regList(Request $request){

		$students=Registration::with(array('student' =>  function($query){
			$query->select('id','firstName','middleName','lastName');
		}))
		->where('subject_id',$request->input('subject_id'))
		->get();

		$subjects = Subject::select('id','name')->orderby('name','asc')->lists('name', 'id');
		$selectSub=$request->input('subject_id');
		return view('student.registration.index',compact('students','subjects','selectSub'));

	}
	public function regDestroy($id)
	{
		$student=Registration::findOrFail($id);
		$student->delete();
		$notification= array('title' => 'Удаление', 'body' => 'Отмена добавления на подкурс.');
		return Response()->json([
			'success' => true,
			'message' => $notification
		], 200);

	}

}
