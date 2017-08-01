<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Response;
use Vendor\Unirest\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\SearchLog;
use Cache;

class APIController extends Controller
{
    //http://localhost/zerograd/public/apicheck/ca/toronto/0/java e.g.



    public function index(){
			$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";
    	    
   //  		$opts = array(
			//   'http'=>array(
			//     'method'=>"GET",
			//     'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			//   )
			// );

			// $context = stream_context_create($opts);

			// // Open the file using the HTTP headers set above

			$apiString = 'https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=<required>&limit=6&q=<required>&radius=25&sort=date&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2';
			// $res = file_get_contents($apiString, false, $context);

    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;
			// return $results;


			//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();

			$postings = array();
			$parser = new ParseController();
			foreach ($results->results as $post) {

				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}

				
			}

			
			



			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			return $postings;
    }

    public function spotlight(){
    	$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";
    	    
   //  		$opts = array(
			//   'http'=>array(
			//     'method'=>"GET",
			//     'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			//   )
			// );

			// $context = stream_context_create($opts);

			// // Open the file using the HTTP headers set above

			$apiString = 'https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=<required>&limit=3&q=<required>&radius=25&sort=<required>&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2';
			// $res = file_get_contents($apiString, false, $context);

    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;
			// return $results;


			//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();

			$postings = array();
			$parser = new ParseController();
			foreach ($results->results as $post) {

				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}

				
			}

			
			



			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			return $postings;
    }

    public function getSearch(){

    		if(Session::has('user_id')){
			  	SearchLog::log(array(
	    		  'user_id' => Session::get('user_id'),
	    		  'ip_address' => $_SERVER['REMOTE_ADDR'],
	    		  'searches' => str_replace(' ',',',$_POST['searchkeywords']),
	    		  'search_time' => date('Y-m-d H:i:s')
				));
	    	}

    		$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";
    	   

			$location = (strlen($_POST['searchlocation']) > 0)?$_POST['searchlocation']:"<required>";
			$query =(strlen($_POST['searchkeywords']) > 0)?$_POST['searchkeywords']:"<required>";
			$co = 'ca';
			$query = str_replace(" ","%20",$query);
			$location = str_replace(" ","%20",$location);
    	    $apiString = "https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=$co&filter=0&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=Toronto&latlong=<required>&limit=6&q=$query&radius=25&sort=date&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2";


    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;
			// return $results;


			//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();

			$postings = array();
			$parser = new ParseController();

			//Only add if it is an entry-level position
			foreach ($results->results as $post) {
				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}
			}


			
			



			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'keywords' => ($query == '<required>')?'None':urldecode($query),
				'page' => 1,
				'limit' => 6,
				'categories' => $categories,
				'cat_id' => 0,
				'numberOfResults' => $results->totalResults,
				'numberOfPages' => ceil($results->totalResults / 6),
				'postings' => $postings,
				'badges' => $badges,
				'location' => ($location == '<required>')?'':urldecode($location)
			);
			
			return view('browse-jobs')->with($data);
    }

    public function browseJobs(){
    	$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";
    	    
   //  		$opts = array(
			//   'http'=>array(
			//     'method'=>"GET",
			//     'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			//   )
			// );

			// $context = stream_context_create($opts);

			// // Open the file using the HTTP headers set above

			$apiString = 'https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=<required>&limit=<required>&q=<required>&radius=25&sort=<required>&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2';
			// $res = file_get_contents($apiString, false, $context);

    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;
			// return $results;


			//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();

			$postings = array();
			$parser = new ParseController();
			foreach ($results->results as $post) {

				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}

				
			}

			
			



			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'page' => 1,
				'limit' => 10,
				'categories' => $categories,
				'cat_id' => 0,
				'numberOfResults' => $results->totalResults,
				'numberOfPages' => ceil($results->totalResults / 10),
				'postings' => $postings,
				'badges' => $badges,
				'location' => 'Toronto',
				'keywords' => 'None'
			);
			
			return view('browse-jobs')->with($data);

			
    }


    public function pagination(){
    
    	$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";

    	//options for API
    	$opts = array(
			  'http'=>array(
			    'method'=>"GET",
			    'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			  )
			);

			$context = stream_context_create($opts);

    	//For now filter by experience. will need to filter by location and date later
		
		// $_POST variables 
		$location = $_POST['location'];
		$category = $_POST['category'];
		$page = isset($_POST['page'])?$_POST['page']:'10';
		$start = '0';
		if($page) $start = 10 * ($page -1);
		$co = 'CA' ; //default for now 
		$kilometers = empty($_POST['kilometers'])?'25':$_POST['kilometers'];
		
		$keywords = isset($_POST['keywords'])?str_replace(' ',',',$_POST['keywords']):'<required>';
		$date = ($_POST['category'] == 'recent')?'date':'<required>';

		//postalCode has precedence over location
		if(!empty($postalCode)) $location = $postalCode;






		unset($_POST['location']);
		unset($_POST['category']);


		$statuses = '';
		$levels = '';

		foreach($_POST as $key=>$value){
			if(strpos($key,'type') !== false){
				$statuses .= $value . ',';
			}else if(strpos($key,'level') !== false){
				$levels .= $value . ',';
			}
		}



		$statuses = substr($statuses,0,-1);
		$levels = substr($levels,0,-1);

		

        $apiString = "https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=$co&filter=0&format=json&fromage=<required>&highlight=<required>&jt=$statuses&l=$location&latlong=<required>&limit=6&q=$keywords&radius=$kilometers&sort=$date&st=<required>&start=$start&useragent=<required>&userip=<required>&v=2";

        // return $apiString;

        $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;


        $postings = array();
        $parser = new ParseController();
		foreach ($results->results as $post) {
				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}
			}

		
			

			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'page' => $page,
				'limit' => 10,
				'cat_id' => 0,
				'numberOfResults' => $results->totalResults,
				'numberOfPages' => ceil($results->totalResults / 6),
				'postings' => $postings,
				'badges' => $badges,
				'location' => 'Toronto'
			);
			
			return array(
				'numberOfResults' => $results->totalResults,
				'view' => view('sub-results')->with($data)->render()
			);

			   

        



    }

    public function filterAPI(){
    
    	$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";

    	//options for API
    	$opts = array(
			  'http'=>array(
			    'method'=>"GET",
			    'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			  )
			);

			$context = stream_context_create($opts);

    	//For now filter by experience. will need to filter by location and date later
		
		// $_POST variables 
		$location = $_POST['location'];
		$category = $_POST['category'];
		$co = 'CA' ; //default for now 
		$kilometers = empty($_POST['kilometers'])?'25':$_POST['kilometers'];
		
		$keywords = isset($_POST['keywords'])?str_replace(' ',',',$_POST['keywords']):'<required>';
		$date = ($_POST['category'] == 'recent')?'date':'<required>';

		//postalCode has precedence over location
		if(!empty($postalCode)) $location = $postalCode;






		unset($_POST['location']);
		unset($_POST['category']);


		$statuses = '';
		$levels = '';

		foreach($_POST as $key=>$value){
			if(strpos($key,'type') !== false){
				$statuses .= $value . ',';
			}else if(strpos($key,'level') !== false){
				$levels .= $value . ',';
			}
		}



		$statuses = substr($statuses,0,-1);
		$levels = substr($levels,0,-1);

		

        $apiString = "https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=$co&filter=0&format=json&fromage=<required>&highlight=<required>&jt=$statuses&l=$location&latlong=<required>&limit=6&q=$keywords&radius=$kilometers&sort=$date&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2";

        // return $apiString;

        $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;


        $postings = array();
        $found = 'no';
        	if(isset($results->results) && sizeof($results->results) > 0) {
        		$found = 'yes';
        		$parser = new ParseController();
        		foreach ($results->results as $post) {
				if(Cache::has($post->jobkey)){
					$postings[] = $post;
				}else{
					$retValue = $parser->fetch($post->url);
					if($retValue == true){
						$postings[] = $post;
						Cache::put($post->jobkey,'',22*60);
					}
				}
			}
        	}
			

		
			

			
			 


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'page' => 1,
				'limit' => 10,
				'cat_id' => 0,
				'numberOfResults' => isset($results->totalResults)?$results->totalResults:0,
				'numberOfPages' => isset($results->totalResults)?ceil($results->totalResults / 6):0,
				'postings' => $postings,
				'badges' => $badges,
				'location' => 'Toronto'
			);
			
			return array(
				'numberOfResults' => isset($results->totalResults)?$results->totalResults:0,
				'view' => view('sub-results')->with($data)->render()
			);

			   

        



    }

    public function map(){
    	$apiKey = "VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B";
    	    
   //  		$opts = array(
			//   'http'=>array(
			//     'method'=>"GET",
			//     'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			//   )
			// );

			// $context = stream_context_create($opts);

			// // Open the file using the HTTP headers set above

			$apiString = 'https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=1&limit=<required>&q=<required>&radius=25&sort=<required>&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2';
			// $res = file_get_contents($apiString, false, $context);

    		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$apiString); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Mashape-Key: ' . $apiKey
			));
			$output = curl_exec($ch);   

			// convert response
			$output = json_decode($output);

			// handle error; error output
			if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

			  var_dump($output);
			}

			$results = $output;
			// return $results;


			//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();

			$postings = array();
			foreach ($results->results as $post) {
				$posting = array();
				$posting['lat'] = $post->latitude;
				$posting['lng'] = $post->longitude;
				array_push($postings, $posting);
			}

			
			



			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'page' => 1,
				'limit' => 10,
				'categories' => $categories,
				'cat_id' => 0,
				'numberOfResults' => $results->totalResults,
				'numberOfPages' => ceil($results->totalResults / 10),
				'postings' => json_encode($postings),
				'badges' => $badges,
				'location' => 'Toronto',
				'keywords' => 'None'
			);
			
			
			return view('map')->with($data);
    }



}
