<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    //
    public function getRegister(){
    	 $data = array(

        );

        return view('registrations.employer')->with($data);
    }

    public function postRegister(Request $request){
    	$count = DB::table('students')->where('email',$request->email)->count();
        if($count > 0){
            return "User Already Exist";
        }

        $previousInsertId;
        foreach($request->except('_token','project_id') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('students')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  if($key == 'password'){
                        DB::table('students')
                    ->where('student_id',$previousInsertId)
                    ->update(array(
                        "$key" => md5($value)
                    ));
                  }else{
                    DB::table('students')
                    ->where('student_id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
                  }
            }
        }

        
        return "success";
    }
}
