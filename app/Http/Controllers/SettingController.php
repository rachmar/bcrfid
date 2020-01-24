<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Role;
use App\Model\Section;
use Illuminate\Http\Request;
use App\Model\Log;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections = Section::all();

        $teachers = User::whereHas('roles', function($q){
            $q->where('name','Teacher');
        })->get();

        return view('pages.setting.index', compact('teachers','sections'));

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

        switch ($request->action) {

            case 'teacher':
                
                $teacher  = Role::where('name', 'Teacher')->first();
                $trimName = strtolower(preg_replace('/\s+/', '', $request->name));

                $user = new User();
                $user->name = strtoupper($request->name);
                $user->email = $trimName.'@bcrfid.com';
                $user->username = $trimName;
                $user->password = bcrypt('adminadmin');
                $user->save();
                $user->roles()->attach($teacher);


                $log = new Log();
                $log->msg =  Auth()->user()->name.' create a new teacher, Teacher : '.$request->name;
                $log->save();

                break;

            case 'section':
                
                $section = new Section();
                $section->grade = $request->grade;
                $section->name = $request->name;
                $section->save();

                $log = new Log();
                $log->msg =  Auth()->user()->name.' create a new section, Section : '.$request->name;
                $log->save();

                break;
            
            default:
                # code...
                break;
        }


        return redirect()->back()->with(['title'=>'Success!','status'=>'Succesfully Created!','mode'=>'success']);

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
    public function destroy(Request $request, $id)
    {

        switch ($request->action) {

            case 'teacher':

                $user = User::find($id);
                $user->roles()->detach();
                $user->destroy($id); 

                
                break;

            case 'section':
                
                $section = Section::find($id);
                $section->destroy($id); 

                break;
            
            default:
                # code...
                break;
        }


        return redirect()->back()->with(['title'=>'Success!','status'=>'Succesfully Deleted!','mode'=>'success']);
    }
}
