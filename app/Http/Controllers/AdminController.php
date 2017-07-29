<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){
    	$data = array(

		);

		return view('admin.home');
    }

    public function manageUsers(Request $request){

    	$data = array();

    	if($request->maximize){
    		$data = array(
    			'maximize' => 'maximize'
			);
	    	
    	}else{
    		$data = array(
    			'maximize' => 'minimize'
			);
    	}

    	return view('admin.sub-manage-user')->with($data);

    	
    }
}
