<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\Section;
use App\Model\Log;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::all();
        $students = Student::selectRaw('
                students.*,
                sections.name as sectname,
                sections.grade as sectgrade')
            ->join('sections', 'students.sct_id', '=', 'sections.id')
            ->get();

        return view('pages.student.index', compact('students','sections'));
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
        $student = new Student();
        $student->crd_id = $request->crd_id;
        $student->std_id = $request->std_id;
        $student->sct_id = $request->sct_id;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->parent = $request->parent;
        $student->phone = $request->phone;
        if (!empty($request->photo)) {
            $filename  = 'item-img-'.md5(uniqid()).date('dmY').'.' .$request->photo->getClientOriginalExtension();
            $student->photo = $request->photo->storeAs('', $filename, 'public');
        }
        $student->save();


        $log = new Log();
        $log->msg =  Auth()->user()->name.' register a new student, Student ID: '.$request->std_id;
        $log->save();

        return redirect()->back()->with(['title'=>'Success!','status'=>'Student Succesfully Created!','mode'=>'success']);
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
        $student = Student::find($request->id);
        $student->crd_id = $request->crd_id;
        $student->std_id = $request->std_id;
        $student->sct_id = $request->sct_id;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->parent = $request->parent;
        $student->phone = $request->phone;
        if (!empty($request->photo)) {
            $filename  = 'item-img-'.md5(uniqid()).date('dmY').'.' .$request->photo->getClientOriginalExtension();
            $student->photo = $request->photo->storeAs('', $filename, 'public');
        }
        $student->save();

        $log = new Log();
        $log->msg =  Auth()->user()->name.' update a student, Student ID: '.$request->std_id;
        $log->save();

        return redirect()->back()->with(['title'=>'Success!','status'=>'Student Succesfully Edited!','mode'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->destroy($id); 

        return redirect()->back()->with(['title'=>'Deleted!','status'=>'Student Succesfully Deleted!','mode'=>'success']);
    }
    
}
