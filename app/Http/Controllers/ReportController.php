<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Report;
use App\Model\Student;
use App\Model\Section;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::all();

        return view('pages.report.index', compact('sections'));
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
        $sections = Section::all();

        $reports = Report::selectRaw('students.crd_id,students.std_id,students.firstname,students.middlename,students.lastname,reports.created_at,reports.purpose , sections.id , sections.name as sectname, sections.grade as sectgrade')
            ->join('sections', 'reports.sct_id', '=', 'sections.id')
            ->join('students', 'reports.std_id', '=', 'students.id');


        if ($request->grade != 0) {
             $reports = $reports->where('sections.grade' , $request->grade);
        }

        if ($request->section != 0) {
             $reports = $reports->where('sections.id' , $request->section);
        }

        if (isset($request->purpose)) {
             $reports = $reports->where('reports.purpose' , $request->purpose);
        }

        if (isset($request->std_id)) {
             $reports = $reports->where('students.std_id' , $request->std_id);
        }

        if (isset($request->name)) {
             $reports = $reports->where('students.name' , $request->name);
        }

        if (isset($request->from) && isset($request->to)) {
              $reports = $reports->whereBetween('reports.created_at', array($request->from, $request->to));
        }


        $reports = $reports->get();

        return view('pages.report.index', compact('reports','sections'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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


    public function export()
    {
      return Excel::download(new LogsExport, "UserLogs".date('mdY').".xlsx");
    }
}
