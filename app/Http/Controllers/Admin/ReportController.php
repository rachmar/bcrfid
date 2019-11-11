<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Report;
use App\Model\Student;
use App\Model\Section;
use App\Model\Unauthorize;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unauthorizes = Unauthorize::all();

        $reports = Report::selectRaw('students.crd_id,students.std_id,students.name,reports.created_at,reports.purpose, students.name , sections.name as sectname, sections.grade as sectgrade')
            ->join('sections', 'reports.sct_id', '=', 'sections.id')
            ->join('students', 'reports.std_id', '=', 'students.id')
            ->get();

        return view('pages.admin.report.index', compact('reports','unauthorizes'));
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


    public function search(Request $request)
    {   


        $trades = Account::where('type','trade')->get();

        $transactions = new Transaction;

        $transactions = $transactions->selectRaw('accounts.id, transactions.trans_id, transactions.method , accounts.name , accounts.type, transactions.created_at , sum(transactions.grams) as total_grams , sum(transactions.total) as total_price');
        $transactions = $transactions->join('accounts', 'transactions.account_id', '=', 'accounts.id');

            if ($request->trade_id != 0) {
                 $transactions = $transactions->where('transactions.account_id' , $request->trade_id);
            }

            if (isset($request->from) && isset($request->to)) {
                  $transactions = $transactions->whereBetween('transactions.created_at', array($request->from, $request->to));
            }

        $transactions =$transactions->groupBy('transactions.trans_id');


        $total = $transactions->sum('total');

        $transactions = $transactions->get();


        return view('pages.admin.report.index',compact('transactions', 'trades' , 'total'));
    } 
}
