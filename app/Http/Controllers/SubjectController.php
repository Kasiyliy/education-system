<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\Subject;
use App\Department;
use Validator;
use App\Transformers\SubjectTransformer;
class SubjectController extends Controller
{
    protected $subject;
    public function __construct(Subject $subject)
    {
        $this->middleware('teacher', ['except' => ['subjetsByDptSem']]);
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $subjects = Subject::with('department')->get();
        return view('subject.index', compact('subjects', 'semesters'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
        return view('subject.create', compact('departments'));
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
         'name' => 'required',
         'code' => 'required|unique:subject,code',
         'price' => 'required|numeric',
         'department_id' => 'required|numeric',
         'description' => 'required'
        ];
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('subject.create')->withInput()->withErrors($validator);
        }
        else {

            $this->subject->create($data);
            $notification= array('title' => 'Информация сохранена', 'body' => 'Под курс успешно добавлен.');
            return Redirect::route('subject.create')->with("success", $notification);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            $departments = Department::select('id', 'name')->orderby('name', 'asc')->lists('name', 'id');
            $subject = Subject::findOrFail($id);
            return view('subject.edit', compact('departments', 'subject'));
        }
        catch (Exception $e)
        {
            $notification= array('title' => 'Изменение', 'body' => "Никаих записей нету");
            return Redirect::route('subject.index')->with("error", $notification);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $data=$request->all();
        $rules=[
         'name' => 'required',
         'code' => 'required',
         'credit' => 'required|numeric',
         'department_id' => 'required|numeric',
         'description' => 'required|max:255'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            try {
                $subject = Subject::findOrFail($id);
                $subject->fill($data)->save();
                $notification= array('title' => 'Изменение', 'body' => 'Под курс успешно изменен.');
                return Redirect::route('subject.index')->with("success", $notification);
            }
            catch (Exception $e)
            {
                $notification= array('title' => 'Изменение', 'body' => "никаких записей нету.");
                return Redirect::route('subject.index')->with("error", $notification);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        $notification= array('title' => 'Удаление', 'body' => 'Под курс успешно удален.');
        return Redirect::route('subject.index')->with("success", $notification);

    }
    public function subjetsByDptSem($department,$semester)
    {
        $subs = Subject::where('department_id', $department)->get();
        $subjects=Fractal()->collection($subs, new SubjectTransformer());
        return Response()->json(
            [
            'success' => true,
            'subjects' => $subjects
            ], 200
        );



    }


}
