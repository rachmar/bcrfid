<?php

namespace App\Http\Controllers\Admin;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;
use App\Model\Section;
use App\Model\Student;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::all();

        $announcement = Announcement::all();

        return view('pages.admin.announcement.index', compact('sections'));

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



        $announcement = new Announcement();
        $announcement->sct_id = $request->sct_id;
        $announcement->subj = $request->subj;
        $announcement->msg = $request->msg;
        $announcement->save();


        $phones = Student::select('phone')->where('sct_id', $request->sct_id)->get();
        $rphones = array();
        foreach ($phones as $phone) {
            $rphones[] = $phone->phone;
        }

        $rphones = implode(',', $rphones);

        $client = new Client();
        $res = $client->request('POST', 'https://semaphore.co/api/v4/messages',[
            'form_params' =>  [
                'apikey' => 'c065acbea63c2815207e68778f423712',
                'number' => $rphones,
                'message' => $request->msg,
                'sendername' => 'SEMAPHORE'
            ]
        ]);

        echo $res->getStatusCode();

        echo $res->getBody();

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
