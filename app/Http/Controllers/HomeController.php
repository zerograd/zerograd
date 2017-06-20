<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Session;
use App\SearchLog;

class HomeController extends Controller
{
    //Display Index
    public function index(){

    	$advices = DB::table('tips_advice')
    					->select('*')
    					->inRandomOrder()
    					->get();

		$postings = DB::table('postings')
						->select('*')
						->join('companies','companies.id','=','postings.company_id')
						->take(4)
						->inRandomOrder()
						->get();

		$badges = ['#E3C610','#10E358','#108EE3'];
		$sizeOfJobs = DB::table('postings')->select('*')->count();
		$sizeOfMembers = DB::table('students')->select('*')->count();
		$sizeOfResumes = DB::table('resume')->select('*')->count();
		$sizeOfCompanies = DB::table('companies')->select('*')->count();

		$categories = DB::table('categories')
						->select('*')
						->take(3)
						->inRandomOrder()
						->get();
    	$data = array(
    		'advices' => $advices,
    		'postings' => $postings,
    		'badges' => $badges,
    		'sizeOfJobs' => $sizeOfJobs,
    		'sizeOfMembers' => $sizeOfMembers,
    		'sizeOfResumes' => $sizeOfResumes,
    		'sizeOfCompanies' => $sizeOfCompanies,
    		'categories' => $categories

		);
		
		return view('welcome')->with($data);
    }

    public function login(){
    	return view('logins.main-login');
    }

    //Search
    public function search(Request $request){

    	if(Session::has('user_id')){
		  	SearchLog::log(array(
    		  'user_id' => Session::get('user_id'),
    		  'ip_address' => $request->ip(),
    		  'searches' => str_replace(' ',',',$request->searchkeywords),
    		  'search_time' => date('Y-m-d H:i:s')
			));
    	}

    	if($request->searchkeywords && $request->searchlocation ){
    		$keywords = explode(' ',$request->searchkeywords);
	    	$postings = array();
	    	foreach($keywords as $keyword){
	    		$posting =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->where('keywords','like','%'. $keyword .'%')
	    					->orWhere('title','like','%'. $keyword .'%')
	    					->where('location',$request->searchlocation)
	    					->get();
				if(sizeof($posting) > 0){
					foreach($posting as $post){
						array_push($postings,$post);
					}
				}
	    	}
    	}
    	else if($request->searchkeywords){
    		$keywords = explode(' ',$request->searchkeywords);
	    	$postings = array();
	    	foreach($keywords as $keyword){
	    		$posting =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->where('keywords','like','%'. $keyword .'%')
	    					->orWhere('title','like','%'. $keyword .'%')
	    					->get();
				if(sizeof($posting) > 0){
					foreach($posting as $post){
						array_push($postings,$post);
					}
				}
	    	}

	    	
    	}else if($request->searchlocation){
	    		$posting =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->where('location','=',$request->searchlocation)
	    					->orWhere('title','like','%'. $request->searchlocation .'%')
	    					->get();
				if(sizeof($posting) > 0){
					$postings = $posting;
				}
    	}
    	$found = "no";
    	 if(isset($postings) && sizeof($postings) > 0) {
    	 	$found = "yes"; 
    	 	$badges = ['#E3C610','#10E358','#108EE3'];
    	 	$data = array(
	    		'postings' => $postings,
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords,
	    		'badges' => $badges
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
    	$from = isset($request->from)?$request->from:0;
    	$to = isset($request->to)?$request->to:1000000;
    	$yearsOfExperience = array(1,2,3);

    	$postings = DB::table('postings')->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    				->where('location','like','%'.'%')
	    				->whereIn('required_experience',$yearsOfExperience)
	    				->where('salary','>=',$from)
	    				->where('salary','<=',$to)
	    				->where('cat_id','like','%'.'%')
	    				->orderBy('posted_date','DESC')
	    				->get();
		$numberOfResults = sizeof($postings);
		$categories = DB::table('categories')
						->select('*')
						->get();

		$found = "no";
    	 if($postings) $found = "yes"; 

    	 $badges = ['#E3C610','#10E358','#108EE3'];

    	 $numberOfPages = ceil(sizeof($postings) / 6);

    	$data = array(
    		'postings' => $postings->take(6),
    		'found' => $found,
    		'keywords'=>isset($request->searchkeywords)?$request->searchkeywords:"",
    		'badges' => $badges,
    		'categories' => $categories,
    		'numberOfResults' => $numberOfResults,
    		'numberOfPages' => $numberOfPages,
    		'page' => 1,
		);
    	
		return view('search-results')->with($data);
    }

    public function loadMore(Request $request){
    	$page = $request->page;
    	$limit = $request->limit;
    	$jobStatuses = explode(' ',$request->jobtypes);
    	$postings	= DB::table('postings');
    	$from = isset($request->from)?$request->from:0;
    	$to = isset($request->to)?$request->to:1000000;
    	$category = ($request->category == 'All')?'':$request->category;
    	$yearsOfExperience = explode(' ',$request->levels);
    	if(in_array("Any",$yearsOfExperience)){
    		$yearsOfExperience = array(1,2,3);
    	}
    	if($request->date == 'newest'){
    		if(in_array("All",$jobStatuses)){
    		
	    				$postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    				->where('location','like','%'. $request->location .'%')
	    				->whereIn('required_experience',$yearsOfExperience)
	    				->where('salary','>=',$from)
	    				->where('salary','<=',$to)
	    				->where('cat_id','like','%'. $category .'%')
	    				->orderBy('posted_date','DESC');
	    	}else{
	    		
		    				$postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
		    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
		    				->whereIn('status',$jobStatuses)
		    				->where('location','like','%'. $request->location .'%')
		    				->whereIn('required_experience',$yearsOfExperience)
		    				->where('salary','>=',$from)
	    					->where('salary','<=',$to)
	    					->where('cat_id','like','%'. $category .'%')
		    				->orderBy('posted_date','DESC');
	    	}
    	}else{
    		// calculate most relevant jobs 
    	}
    	

    	$found = "no";
    	$badges = ['#E3C610','#10E358','#108EE3'];
    	 $offset = ($page - 1) * 6;
    	 $temp = $postings;
    	 $numberOfResults = sizeof($temp->get());
    	 $numberOfPages = ceil( $numberOfResults / 6);
    	 	$found = "yes"; 
   
    	 	
    	 		$postings = $postings->skip($offset)->take(6)->get();
    	 	
    	 	$data = array(
	    		'postings' => $postings,
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords,
	    		'badges' => $badges,
	    		'numberOfResults' => $numberOfResults,
	    		'limit' => $numberOfResults - 6,
	    		'numberOfPages' => $numberOfPages,
	    		'page' => $page,
			);
 
    	 

		return view('results')->with($data);
    }

    public function filter(Request $request){
    	//For now filter by experience. will need to filter by location and date later

    	$jobStatuses = explode(' ',$request->jobtypes);
    	$postings	= DB::table('postings');
    	$from = isset($request->from)?$request->from:0;
    	$to = isset($request->to)?$request->to:1000000;
    	$category = ($request->category == 'All')?'':$request->category;
    	$yearsOfExperience = explode(' ',$request->levels);
    	if(in_array("Any",$yearsOfExperience)){
    		$yearsOfExperience = array(1,2,3);
    	}
    	if($request->date == 'newest'){
    		if(in_array("All",$jobStatuses)){
    		
	    				$postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    				->where('location','like','%'. $request->location .'%')
	    				->whereIn('required_experience',$yearsOfExperience)
	    				->where('salary','>=',$from)
	    				->where('salary','<=',$to)
	    				->where('cat_id','like','%'. $category .'%')
	    				->orderBy('posted_date','DESC');
	    	}else{
	    		
		    				$postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
		    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
		    				->whereIn('status',$jobStatuses)
		    				->where('location','like','%'. $request->location .'%')
		    				->whereIn('required_experience',$yearsOfExperience)
		    				->where('salary','>=',$from)
	    					->where('salary','<=',$to)
	    					->where('cat_id','like','%'. $category .'%')
		    				->orderBy('posted_date','DESC');
	    	}
    	}else{
    		// calculate most relevant jobs 
    	}
    	
		


  //   	if($request->experience != 0){

  //   		$keywords = explode(' ',$request->searchkeywords);
  //   		$postings = array();
  //   		foreach($keywords as $keyword){
	 //    			$posting = DB::table('postings')
	 //    				->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	 //    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	 //    				->where('required_experience',$request->experience)
	 //    				->where('keywords','like','%'. $keyword .'%')
	 //    				->get();

  //   				if(sizeof($posting) > 0){
		// 			    foreach($posting as $post){
		// 				array_push($postings,$post);
		// 			}
		// 		}
		// 	}
  //   	}else{
  //   		$keywords = explode(' ',$request->searchkeywords);
  //   		$postings = array();
  //   		foreach($keywords as $keyword){
	 //    			$posting = DB::table('postings')
	 //    				->select('*')
	 //    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	 //    				->where('keywords','like','%'. $keyword .'%')
	 //    				->get();

  //   				if(sizeof($posting) > 0){
		// 			foreach($posting as $post){
		// 				array_push($postings,$post);
		// 			}
		// 		}
		// 	}
  //   	}

    	$found = "no";
    	$badges = ['#E3C610','#10E358','#108EE3'];
    	$temp = $postings;
    	$numberOfPages = ceil(sizeof($temp->get()) / 6);
    	$numberOfResults = sizeof($temp->get());
    	 if(sizeof($postings->get()) > 0) {
    	 	$found = "yes"; 
    	 	$data = array(
	    		'postings' => $postings->take(6)->get(),
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords,
	    		'badges' => $badges,
	    		'numberOfResults' => $numberOfResults ,
	    		'numberOfPages' => $numberOfPages,
	    		'page' => 1,
			);
			return array(
			'limit' => $numberOfResults - 6,
			'numberOfResults' => $numberOfResults,
			'view' => view('results')->with($data)->render()
			);
    	 }
    	 
    	 return array(
    	 	'numberOfResults' => sizeof($temp->get()),
	 	);

					
    }

    //For categories on main page
    public function getfilterByCategory($id = null){

    	$postings =	DB::table('postings')
	    					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	    					->leftJoin('categories',DB::raw('postings.cat_id'),'=',DB::raw('categories.cat_id'))
	    					->where('postings.cat_id',$id)
	    					->get();

		$found = "no";
    	 if($postings) $found = "yes"; 

    	 $badges = ['#E3C610','#10E358','#108EE3'];

    	$data = array(
    		'postings' => $postings,
    		'found' => $found,
    		'keywords'=>isset($request->searchkeywords)?$request->searchkeywords:"",
    		'badges' => $badges
		);
    	
		return view('search-results')->with($data);
    }

    public function about(){
    	return view('about');
    }

}
