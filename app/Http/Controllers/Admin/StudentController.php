<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Student;
use App\Model\Section;

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

        $students = Student::selectRaw('students.*, sections.name as sectname, sections.grade as sectgrade')
            ->join('sections', 'students.sct_id', '=', 'sections.id')
            ->get();

        return view('pages.admin.student.index', compact('students','sections'));
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
        $student->name = $request->name;
        $student->parent = $request->parent;
        $student->phone = $request->phone;
        $student->save();

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
        $student->name = $request->name;
        $student->parent = $request->parent;
        $student->phone = $request->phone;
        $student->save();

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
