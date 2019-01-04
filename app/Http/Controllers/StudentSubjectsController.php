<?php

namespace App\Http\Controllers;

use App\Department;
use App\Registration;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentSubjectsController extends Controller
{

    public function mySubjects(){
        $student = Student::where('user_id' ,Auth::id())->first();

        $regs = DB::select('select d.id as d_id , d.name as d_name, s.id as s_id , s.name as s_name from department d 
                          inner join subject s on d.id = s.department_id 
                          inner join registrations r on r.subject_id = s.id 
                          where r.students_id = ?',[$student->id] );

        $regMap = null;
        $dIDs = array();
        foreach($regs as $reg){
            $dIDs[] = $reg->d_id;
        }

        $departments = Department::whereIn('id' , $dIDs)->get();
        foreach ($departments as $department){
            $regMap[$department->id] = array();
        }
        foreach($regs as $reg){
            foreach ($departments as $department) {
                if($reg->d_id == $department->id){
                    $regMap[$department->id][] = Subject::where('id' , $reg->s_id )->get();
                }
            }
        }

        return view('gueststudent.my_subjects')->with(compact('departments' ,'regMap'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::select('select d.id , d.name , s.id , s.name from department d 
                          inner join subject s on d.id = s.department_id 
                          inner join registrations r on r.subject_id = s.id 
                          where r.students_id = ?',[Auth::user()->id] );

        dd($users);
//        select d.id , d.name , s.id , s.name from department d
//        inner join subject s on d.id = s.department_id
//        inner join registrations r on r.subject_id = s.id where r.students_id = 1;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
