<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class PostingController extends Controller
{
    //
    public function index($id = null){
    	$posting = DB::table('postings')
    				->select('*')
    				->where('id',$id)
    				->first();
    	$data = array(
    		'posting' => $posting
		);
		
		return view('posting')->with($data);
    }
}
