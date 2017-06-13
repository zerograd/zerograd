<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;

class EmployerController extends Controller
{
    //
    public function getRegister(){
    	 $data = array(

        );

        return view('registrations.employer')->with($data);
    }

    public function logout(){
        Session::forget('employer_id');
        Session::forget('company_name');
        Session::forget('company_email');
        return redirect('/');
    }

    public function postRegister(Request $request){
    	$count = DB::table('companies')->where('company_email',$request->email)->count();
        if($count > 0){
            return "User Already Exist";
        }

        $previousInsertId;
        foreach($request->except('_token','project_id') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('companies')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  if($key == 'password'){
                        DB::table('companies')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => md5($value)
                    ));
                  }else{
                    DB::table('companies')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
                  }
            }
        }

        
        return "success";
    }

    public function verifyLogin(Request $request){
        $employer = DB::table('companies')
                ->select('*')
                ->where('company_email',$request->company_email)
                ->where('password',md5($request->password))
                ->first();      
        if(sizeof($employer) > 0){
            Session::put('logged','yes');
            Session::put('employer_id',$employer->id);
            Session::put('company_name',$employer->company_name);
            Session::put('company_email',$employer->company_email);
            return "success";
        }else{
            return "failed";
        }
    }

    public function home(){

        $allPostings = DB::table('postings')
                        ->select('*')
                        ->where('company_id',Session::get('employer_id'))
                        ->orderBy('posted_date','DESC')
                        ->take(4)
                        ->get();

        $whoApplied = DB::table('applied_to')
                        ->select('students.student_name','students.student_id','students.avatar','profile_skills.skills','postings.title','postings.id')
                        ->join('students','students.student_id','=','applied_to.user_id')
                        ->join('profile_skills','profile_skills.user_id','=','students.student_id')
                        ->join('postings','postings.id','=','applied_to.posting_id')
                        ->where('applied_to.company_id',Session::get('employer_id'))
                        ->get();

        // return $whoApplied;
        $data = array(
            'id' => Session::get('employer_id'),
            'postings' => $allPostings,
            'whoApplied' => $whoApplied
        );


        // return $data;
        return view('homepages.employer')->with($data);
    }

    public function getCreatePosting(){
        $data = array(
            'id' => Session::get('employer_id')
        );


        // return $data;
        return view('create-posting')->with($data);
    }

    public function postCreatePosting(Request $request){
        $previousInsertId;
        foreach($request->except('_token') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('postings')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  
                    DB::table('postings')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
        
            }
        }

        return redirect('/employer/home');
    }

    public function getProfile(){

      $profileInfo =  DB::table('companies')
            ->select('*')
            ->where('id',Session::get('employer_id'))
            ->first();
 

        $data = array(
            'id' => Session::get('employer_id'),
            'profileInfo' => $profileInfo
        );
        // return $data;
        return view('profiles.employer')->with($data);
    }

    public function postProfile(Request $request){
        
        foreach($request->except('_token') as $key=>$value){
                  
                    DB::table('companies')
                    ->where('id',Session::get('employer_id'))
                    ->update(array(
                        "$key" => "$value"
                    ));
        
        
        }

        return redirect('/employer/home');

    }
}
