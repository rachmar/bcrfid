<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Model\Student;
use App\Model\Section;
use App\Model\Report;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.search.index');
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
        $student = Student::selectRaw('students.*, sections.name as sectname, sections.grade as sectgrade')
            ->join('sections', 'students.sct_id', '=', 'sections.id')
            ->where('students.crd_id', $request->crd_id )
            ->first();

        if (!empty($student)) {


            if ($student->islogged != 1) {
                $student->islogged = 1;
                $purpose = "IN";
            }else{
                $student->islogged = 0;
                $purpose = "OUT";
            }
            $student->save();


            $report = new Report();
            $report->std_id = $student->id;
            $report->sct_id = $student->sct_id;
            $report->purpose = $purpose;
            $report->save();

            $this->sendMessageSemaphore($student,$purpose);
             
        }

        return view('pages.search.store', compact('student','purpose'));


    }

    private function sendMessageSemaphore($student , $purpose){

        $msg = "Good Day! Mr/Mrs. ".$student->firstname." ".$student->middlename." ".$student->lastname." was ".$purpose." to our school premise on ".date("l jS \of F Y h:i A");
    
        $client = new Client();
        $res = $client->request('POST', 'https://semaphore.co/api/v4/messages',[
            'form_params' =>  [
                'apikey' => 'c065acbea63c2815207e68778f423712',
                'number' => $student->phone,
                'message' => $msg,
                'sendername' => 'BROKENSHIRE'
            ]
        ]);

        // echo $res->getStatusCode();
        // echo $res->getBody();
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
