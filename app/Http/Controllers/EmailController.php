<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function view(){

    	$data = array(
    		'title' => 'Please confirm registration'
		);
    	return view('confirmations.email-sent')->with($data);
    }
    public function send(Request $request,$hashValue){
    	$name  = $request->student_name;
    	$email  = $request->email;
    	$hash = $hashValue;

        Mail::send('confirmations.email-sent', ['name' => $name, 'email' => $email,'hash'=>$hash], function ($message) use ($name,$email)
        {

            $message->from('info@zerograd.com', 'ZeroGrad');

            $message->to($email);
            $message->subject('ZeroGrad: Your Registration');

        });

        return response()->json(['message' => 'Request completed']);
    }

    public function sendEmployer(Request $request){
    	$name  = $request->company_name;
    	$email  = $request->email;
    	// $password 

        Mail::send('confirmations.email-sent', ['name' => $name, 'email' => $email], function ($message) use ($name,$email)
        {

            $message->from('info@zerograd.com', 'ZeroGrad');

            $message->to($email);
            $message->subject('ZeroGrad: Your Registration');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
