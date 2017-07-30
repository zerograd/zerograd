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

    public function sendEmployer(Request $request,$hashValue){
    	$name  = $request->company_name;
    	$email  = $request->company_email;
    	

        Mail::send('confirmations.employer-confirmation', ['name' => $name, 'email' => $email], function ($message) use ($name,$email)
        {

            $message->from('info@zerograd.com', 'ZeroGrad');

            $message->to($email);
            $message->subject('ZeroGrad: Your Registration');

        });

        return response()->json(['message' => 'Request completed']);
    }

    //Reset via login page
    public function sendPasswordReset($email,$hashValue){

        $emailTo = $email;
        Mail::send('password-reset', ['key' => $hashValue], function ($message) use ($emailTo)
        {

            $message->from('info@zerograd.com', 'ZeroGrad');

            $message->to($emailTo);
            $message->subject('ZeroGrad: Your Password Reset Key');

        });

        return response()->json(['message' => 'Request completed']);
    }

    //Reset by an admin

    public function adminPasswordReset($email,$hashValue){
        $emailTo = $email;
        Mail::send('confirmations.admin-reset-password', ['key' => $hashValue], function ($message) use ($emailTo)
        {

            $message->from('info@zerograd.com', 'ZeroGrad');

            $message->to($emailTo);
            $message->subject('ZeroGrad: Your Password Reset Key');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
