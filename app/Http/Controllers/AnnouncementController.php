<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;
use App\Model\Section;
use App\Model\Student;
use App\Model\Log;
use Auth;

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
        $announcements = Announcement::selectRaw(
            'announcements.*, sections.name as sectname, sections.grade as sectgrade')
            ->join('sections', 'announcements.sct_id', '=', 'sections.id')
            ->get();

        return view('pages.announcement.index', compact('sections','announcements'));

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
        $announcement->msg = $request->msg;
        $announcement->save();

        $phones = Student::select('phone')->where('sct_id', $request->sct_id)->get();

        if (!is_numeric($request->sct_id)) {

            if (strcasecmp( $request->sct_id, 'only_eleven' ) == 0) {
                $phones = Student::selectRaw('students.phone,sections.grade')
                ->join('sections', 'students.sct_id', '=', 'sections.id')
                ->where('sections.grade', 11)
                ->get();
            }

            if (strcasecmp( $request->sct_id, 'only_twelve' ) == 0) {
                $phones = Student::selectRaw('students.phone,sections.grade')
                ->join('sections', 'students.sct_id', '=', 'sections.id')
                ->where('sections.grade', 12)
                ->get();
            }

            if(strcasecmp( $request->sct_id, 'all' ) == 0 ){
                $phones = Student::select('phone')->get();
            }
        }

        $rphones = array();
        foreach ($phones as $phone) {
            $rphones[] = $phone->phone;
        }

        $rphones = implode(',', $rphones);

        echo $rphones;
        $client = new Client();
        $res = $client->request('POST', 'https://semaphore.co/api/v4/messages',[
            'form_params' =>  [
                'apikey' => 'c065acbea63c2815207e68778f423712',
                'number' => $rphones,
                'message' => $request->msg,
                'sendername' => 'BROKENSHIRE'
            ]
        ]);

        echo $res->getStatusCode();
        echo $res->getBody();



        $log = new Log();
        $log->msg =  Auth()->user()->name.' created an announcement';
        $log->save();


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
