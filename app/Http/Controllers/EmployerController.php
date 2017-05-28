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
            Session::put('employer_id',$employer->id);
            Session::put('company_name',$employer->company_name);
            Session::put('company_email',$employer->company_email);
            return "success";
        }else{
            return "failed";
        }
    }

    public function home(){
        $data = array(
            'id' => Session::get('employer_id')
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
}
