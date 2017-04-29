<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class HomeController extends Controller
{
    //Display Index
    public function index(){
		return view('welcome');
    }

    //Search
    public function search(Request $request){
    	if($request->searchkeywords){
    		$keywords = explode(' ',$request->searchkeywords);
	    	$postings = array();
	    	foreach($keywords as $keyword){
	    		$posting =	DB::table('postings')
	    					->select('*')
	    					->where('keywords','like','%'. $keyword .'%')
	    					->orWhere('description','like','%' . $keyword . '%')
	    					->get();
				if($posting){
					array_push($postings,$posting);
				}
	    	}if($request->searchlocation){
	    		//later
	    	}

	    	
    	}

    	$data = array(
    		'postings' => $postings
		);

		return view('search-results')->with($data);
    }

    //FOR TESTING DELETE AFTER STYLING IS DONE
    public function searchResults(){

    	$postings =	DB::table('postings')
	    					->select('*')
	    					->get();


    	$data = array(
    		'postings' => $postings
		);

		return view('search-results')->with($data);
    }

}
