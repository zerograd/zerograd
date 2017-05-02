<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class HomeController extends Controller
{
    //Display Index
    public function index(){

    	$advices = DB::table('tips_advice')
    					->select('*')
    					->inRandomOrder()
    					->get();

    	$data = array(
    		'advices' => $advices
		);
		return view('welcome')->with($data);
    }

    //Search
    public function search(Request $request){

    	if($request->searchkeywords){
    		$keywords = explode(' ',$request->searchkeywords);
	    	$postings = array();
	    	foreach($keywords as $keyword){
	    		$posting =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->where('keywords','like','%'. $keyword .'%')
	    					->get();
				if(sizeof($posting) > 0){
					foreach($posting as $post){
						array_push($postings,$post);
					}
				}
	    	}if($request->searchlocation){
	    		//later
	    	}

	    	
    	}
    	$found = "no";
    	 if(isset($postings) && sizeof($postings) > 0) {
    	 	$found = "yes"; 
    	 	$data = array(
	    		'postings' => $postings,
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords
			);
    	 }else{
    	 	$data = array(
	    		'postings' => array(),
	    		'found' => $found,
	    		'keywords' => isset($request->searchkeywords)?$request->searchkeywords:""
			);
    	 }
    	 
    	

		return view('search-results')->with($data);
    }

    //FOR TESTING DELETE AFTER STYLING IS DONE
    public function searchResults(){

    	$postings =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->get();

		$found = "no";
    	 if($postings) $found = "yes"; 

    	$data = array(
    		'postings' => $postings,
    		'found' => $found,
    		'keywords'=>isset($request->searchkeywords)?$request->searchkeywords:""
		);
    	
		return view('search-results')->with($data);
    }

    public function filter(Request $request){
    	//For now filter by experience. will need to filter by location and date later
    	if($request->experience != 0){
    		$keywords = explode(' ',$request->searchkeywords);
    		$postings = array();
    		foreach($keywords as $keyword){
	    			$posting = DB::table('postings')
	    				->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    				->where('required_experience',$request->experience)
	    				->where('keywords','like','%'. $keyword .'%')
	    				->get();

    				if(sizeof($posting) > 0){
					    foreach($posting as $post){
						array_push($postings,$post);
					}
				}
			}
    	}else{
    		$keywords = explode(' ',$request->searchkeywords);
    		$postings = array();
    		foreach($keywords as $keyword){
	    			$posting = DB::table('postings')
	    				->select('*')
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    				->where('keywords','like','%'. $keyword .'%')
	    				->get();

    				if(sizeof($posting) > 0){
					foreach($posting as $post){
						array_push($postings,$post);
					}
				}
			}
    	}

    	$found = "no";
    	 if(isset($postings)) {
    	 	$found = "yes"; 
    	 	$data = array(
	    		'postings' => $postings,
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords
			);
    	 }else{
    	 	$data = array(
	    		'postings' => array(),
	    		'found' => $found,
	    		'keywords' => isset($request->searchkeywords)?$request->searchkeywords:""
			);
    	 }
    	 

		return view('results')->with($data);
    }

    public function about(){
    	return view('about');
    }

}
