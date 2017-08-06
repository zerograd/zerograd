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
    	$postings =	DB::table('postings')
					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
					->orWhere('keywords','like','%'. $request->searchkeywords .'%')
					->orWhere('title','like','%'. $request->searchkeywords .'%')
					->orWhere('description','like','%'. $request->searchkeywords .'%');
					if(isset($request->location)){
						$postings->orWhere('location','like','%'. $request->location .'%');
					}
					
		$postings = $postings->get();

		

		$numberOfResults = sizeof($postings); 
		$numberOfPages = ceil($numberOfResults / 6);
    	
    	$postings =	DB::table('postings')
					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
					->orWhere('keywords','like','%'. $request->searchkeywords .'%')
					->orWhere('title','like','%'. $request->searchkeywords .'%')
					->orWhere('description','like','%'. $request->searchkeywords .'%');
					if(isset($request->location)){
						$postings->orWhere('location','like','%'. $request->location .'%');
					}
					
		$postings = $postings->take(6)->get();

		
    // 	if($request->searchkeywords && $request->searchlocation ){
    // 		$keywords = explode(' ',$request->searchkeywords);
	   //  	$postings = array();
	   //  	foreach($keywords as $keyword){
	   //  		$posting =	DB::table('postings')
	   //  					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	   //  					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	   //  					->where('keywords','like','%'. $keyword .'%')
	   //  					->orWhere('title','like','%'. $keyword .'%')
	   //  					->where('location',$request->searchlocation)
	   //  					->get();
				// if(sizeof($posting) > 0){
				// 	foreach($posting as $post){
				// 		array_push($postings,$post);
				// 	}
				// }
	   //  	}
    // 	}
    // 	else if($request->searchkeywords){
    // 		$keywords = explode(' ',$request->searchkeywords);
	   //  	$postings = array();
	   //  	foreach($keywords as $keyword){
	   //  		$posting =	DB::table('postings')
	   //  					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	   //  					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	   //  					->where('keywords','like','%'. $keyword .'%')
	   //  					->orWhere('title','like','%'. $keyword .'%')
	   //  					->get();
				// if(sizeof($posting) > 0){
				// 	foreach($posting as $post){
				// 		array_push($postings,$post);
				// 	}
				// }
	   //  	}

	    	
    // 	}else if($request->searchlocation){
	   //  		$posting =	DB::table('postings')
	   //  					->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	   //  					->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
	   //  					->where('location','=',$request->searchlocation)
	   //  					->orWhere('title','like','%'. $request->searchlocation .'%')
	   //  					->get();
				// if(sizeof($posting) > 0){
				// 	$postings = $posting;
				// }
    // 	}
    	$found = "no";
    	$categories = DB::table('categories')
						->select('*')
						->get();

    	 if(isset($postings) && sizeof($postings) > 0) {
    	 	$found = "yes"; 
    	 	$badges = ['#E3C610','#10E358','#108EE3'];
    	 	
    	 	$data = array(
	    		'postings' => $postings,
	    		'found' => $found,
	    		'keywords' => $request->searchkeywords,
	    		'categories' => $categories,
	    		'cat_id' => 0,
	    		'numberOfResults' => $numberOfResults,
	    		'numberOfPages' => $numberOfPages,
	    		'page' => 1,
	    		'limit' => 6,
	    		'badges' => $badges
			);
    	 }else{
    	 	$data = array(
	    		'postings' => array(),
	    		'found' => $found,
	    		'categories' => $categories,
	    		'cat_id' => 0,
	    		'numberOfResults' =>0,
	    		'page' => 1,
	    		'numberOfPages' => 0,
	    		'limit' => 6,
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
    		'cat_id' => 0,
    		'limit' => 6,
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
    	
    	//Load more if request was from main search
    	if(isset($request->keywords)){
    		$postings = DB::table('postings');
    		$postings = $postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'));
	    				if(isset($request->location)){
							$postings->orWhere('location','like','%'. $request->location .'%');
						}
	    				$postings->whereIn('required_experience',$yearsOfExperience)
	    				->where('salary','>=',$from)
	    				->where('salary','<=',$to);
	    				if(isset($request->category) && $request->category != 'All'){
							$postings->where('cat_id','like','%'. $category .'%');
						}
	    				$postings->where('keywords','like','%'. $request->keywords .'%')
						->orWhere('title','like','%'. $request->keywords .'%')
						->orWhere('description','like','%'. $request->keywords .'%');

			
    	}

    	// return $postings->toSql();
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
    	
		if(isset($request->keywords)){
    		$postings = DB::table('postings');
    		$postings = $postings->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
	    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'));
	    				if(isset($request->location)){
							$postings->orWhere('location','like','%'. $request->location .'%');
						}
	    				$postings->whereIn('required_experience',$yearsOfExperience)
	    				->where('salary','>=',$from)
	    				->where('salary','<=',$to);
	    				if(!in_array("All",$jobStatuses)){
	    					$postings->whereIn('status',$jobStatuses);
	    				}
	    				
	    				if(isset($request->category) && $request->category != 'All'){
							$postings->where('cat_id','like','%'. $category .'%');
						}
	    				$postings->where('keywords','like','%'. $request->keywords .'%')
						->orWhere('title','like','%'. $request->keywords .'%')
						->orWhere('description','like','%'. $request->keywords .'%');

			
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

    	 $categories = DB::table('categories')
						->select('*')
						->get();
		$numberOfPages = ceil(sizeof($postings) / 6);
		$numberOfResults = sizeof($postings);
    	$data = array(
    		'postings' => $postings,
    		'found' => $found,
    		'keywords'=>isset($request->searchkeywords)?$request->searchkeywords:"",
    		'badges' => $badges,
    		'cat_id' => $id,
    		'categories'=>$categories,
    		'numberOfResults' => $numberOfResults,
    		'page' => 1,
    		'numberOfPages' => $numberOfPages,
    		'limit' => 1
		);
    	
		return view('search-results')->with($data);
    }

    public function about(){
    	return view('about');
    }



    // NEW THEME FUNCTION BELOWS

    public function newtheme(){

    	$postingsCount = DB::table('postings')->select('*')->count();


    	//Recent jobs 
    	$recentJobs = DB::table('postings')->select(DB::raw('postings.*'))
    						->orderBy('postings.posted_date','DESC')
    						->take(5)
    						->get();

		$sizeOfJobs = DB::table('postings')->select('*')->count();
		$sizeOfMembers = DB::table('students')->select('*')->count();
		$sizeOfResumes = DB::table('resume')->select('*')->count();
		$sizeOfCompanies = DB::table('companies')->select('*')->count();

		$api = new APIController();
		$spotLight = $api->spotlight();

		$spotlightArray = array();

		


		//Resources
		$resources = DB::table('resources')
					->select('*')
					->take(3)
					->get();

		foreach ($resources as $resource) {
			$resource->image_path = null;
			$image_path = '';
			if($resource->res_image) {
				$image_path = asset('storage/' . $resource->res_image);
				$resource->image_path = $image_path;
			}
		}
		
    	$data = array(
    		'postingsCount' => $postingsCount,
    		'recentJobs' => $recentJobs,
    		'sizeOfJobs' => $sizeOfJobs,
    		'sizeOfMembers' => $sizeOfMembers,
    		'sizeOfResumes' => $sizeOfResumes,
    		'sizeOfCompanies' => $sizeOfCompanies,
    		'spotLight' => $spotLight,
    		'resources' => $resources
		);
    	return view('main')->with($data);
    }

    public function contact(){

        $data = array(

        );
        return view('contact')->with($data);
    }

    public function browseJobs(){
    	$data = array(

        );
        return view('browse-jobs')->with($data);
    }

    public function browseCategories(){
    	$data = array(

        );
        return view('browse-categories')->with($data);
    }

    public function resources(){

    	$resources = DB::table('resources')
    					->select('*')
    					->orderBy('created','DESC')
    					->take(4)
    					->get();

		foreach ($resources as $resource) {
			$resource->image_path = null;
			$resource->res_title = str_replace(' ','-',$resource->res_title);
			$image_path = '';
			if($resource->res_image) {
				$image_path = asset('storage/' . $resource->res_image);
				$resource->image_path = $image_path;
			}
		}

				//Popular Resources

		$popularResources = DB::table('resources')
							->select('*')
							->orderBy('res_views','DESC')
							->take(3)
							->get();
		foreach ($popularResources as $popularResource) {
			$popularResource->image_path = null;
			$popularResource->res_title = str_replace(' ','-',$popularResource->res_title);
			$image_path = '';
			if($popularResource->res_image) {
				$image_path = asset('storage/' . $popularResource->res_image);
				$popularResource->image_path = $image_path;
			}
		}

		//Recent Resources
		$recentResources = DB::table('resources')
							->select('*')
							->orderBy('created','DESC')
							->take(3)
							->get();

		foreach ($recentResources as $recentResource) {
			$recentResource->image_path = null;
			$recentResource->res_title = str_replace(' ','-',$recentResource->res_title);
			$image_path = '';
			if($recentResource->res_image) {
				$image_path = asset('storage/' . $recentResource->res_image);
				$recentResource->image_path = $image_path;
			}
		}

    	$data = array(
    		'resources' => $resources,
    		'popularResources' => $popularResources,
    		'recentResources' => $recentResources
        );
        return view('resources')->with($data);
    }

    public function getResource($id = null,$title = null){

    	$resource = DB::table('resources')
    					->select('*')
    					->where('res_id',$id)
    					->first();

    
		if(!$resource) return view('errors.404');

		$currentView = DB::table('resources')
							->select('res_views')
							->where('res_id',$id)
							->first()->res_views;

		//Update view count
			DB::table('resources')
					->where('res_id',$id)
					->update(array(
						'res_views' => $currentView + 1
					));


		$path = '';
		if($resource->res_image) $path = asset('storage/' . $resource->res_image);

		//Popular Resources

		$popularResources = DB::table('resources')
							->select('*')
							->orderBy('res_views','DESC')
							->take(3)
							->get();
		foreach ($popularResources as $popularResource) {
			$popularResource->image_path = null;
			$popularResource->res_title = str_replace(' ','-',$popularResource->res_title);
			$image_path = '';
			if($popularResource->res_image) {
				$image_path = asset('storage/' . $popularResource->res_image);
				$popularResource->image_path = $image_path;
			}
		}

		//Recent Resources
		$recentResources = DB::table('resources')
							->select('*')
							->orderBy('created','DESC')
							->take(3)
							->get();

		foreach ($recentResources as $recentResource) {
			$recentResource->image_path = null;
			$recentResource->res_title = str_replace(' ','-',$recentResource->res_title);
			$image_path = '';
			if($recentResource->res_image) {
				$image_path = asset('storage/' . $recentResource->res_image);
				$recentResource->image_path = $image_path;
			}
		}

    	$data = array(
    		'resource' => $resource,
    		'image_path' => $path,
    		'popularResources' => $popularResources,
    		'recentResources' => $recentResources
        );
        return view('get-resource')->with($data);
    }

    public function verifyAccount($id = null){
    	$student = DB::table('students')->select('student_id','verified')->where('verifyKey',$id)->first();
    	if($student->verified == 1){
    		Session::flash('verified','Your account is already verified. Please Login and Enjoy!');

			return redirect('/my-account');
    	}
    	DB::table('students')
    		->where('student_id',$student->student_id)
    		->update(array(
    			'verified' => 1
			));


		Session::flash('verified','Your account is now verified. Login and Enjoy!');

		return redirect('/my-account');
    }

    public function passwordReset(Request $request){
    	$email = '';

    	if($request->company_email){//reseting employer password
    		$email = $request->company_email;
    		$hash = md5( rand(0,1000) );
	        DB::table('companies')
	                    ->where('company_email',$email)
	                    ->update(array(
	            "passwordReset" => $hash
	        ));
    	}else if($request->email){ //reseting student password
    		$email = $request->email;
    		$hash = md5( rand(0,1000) );
	        DB::table('students')
	                    ->where('email',$email)
	                    ->update(array(
	            "passwordReset" => $hash
	        ));

    	}

    	
        //Send Email

        $emailer = new EmailController();
        $emailer->sendPasswordReset($email,$hash);

    }

    public function newPassword(Request $request){
    	if($request->student){// newPassword for students
    		if($request->passwordReset) { //lost the password and are resetting
    			$count = DB::table('students')->select('*')->where('passwordReset',$request->passwordReset)->count();

    			if($count > 0){
    				$password = $request->password;

    				DB::table('students')->
    					where('passwordReset',$request->passwordReset)
    					->update(array(
							'password' => md5($password)
						));

					return 'Password has been changed';
    			}else{
    				return 'Invalid Password Reset Key';
    			}
    		}else{ // logged in and changing password

    		}
    	}else if($request->employer){
			if($request->passwordReset) { //lost the password and are resetting
    			$count = DB::table('companies')->select('*')->where('passwordReset',$request->passwordReset)->count();

    			if($count > 0){
    				$password = $request->password;

    				DB::table('companies')->
    					where('passwordReset',$request->passwordReset)
    					->update(array(
							'password' => md5($password)
						));

					return 'Password has been changed';
    			}else{
    				return 'Invalid Password Reset Key';
    			}
    		}else{ // logged in and changing password

    		}
    	}
    }
}
