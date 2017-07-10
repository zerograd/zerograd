<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Response;
use Vendor\Unirest\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\SearchLog;

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

			$apiString = 'https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=<required>&limit=<required>&q=java&radius=25&sort=<required>&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2';
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

			return $output;

			
    }

    public function getSearch(){

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
			foreach ($results->results as $post) {
				$postings[] = $post;
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
			
        $jobtypes = explode(' ',$_POST['jobtypes']);
        $levels = ($_POST['levels'] != 'Any') ? explode(' ',$_POST['levels']):"<required>";
        $date = $_POST['date'];
        $keywords = $_POST['keywords'];
        //Default values if no request sent
        $location = (strlen($_POST['location']) > 0)?$_POST['location']:'toronto';
        $co = 'ca';
        if($date == 'newest') $date = 'date';



        //Determin the Job Types that were sent
        $jobStatus = array(
        	'Full-Time' => 'fulltime',
        	'Part-Time' => 'parttime',
        	'Internship' => 'internship'
    	);

    	$jobQueryString = '';

    	if(is_array($jobtypes) && !in_array('All',$jobtypes )){
    		foreach($jobtypes as $type){
    			if(array_key_exists($type, $jobStatus)){
    				$jobQueryString = $jobQueryString . $jobStatus[$type] .',';
    			}	
    		}
    		$jobQueryString = substr($jobQueryString,0,-1);
    	}else{
    		$jobQueryString = '<required>';
    	}

    	
    	//Get categories
			$categories = DB::table('categories')
							->select('*')
							->get();
		 $keywords = str_replace(" ","%20",$keywords);					
         $location = str_replace(" ","%20",$location);
        $apiString = "https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=$co&filter=0&format=json&fromage=<required>&highlight=<required>&jt=$jobQueryString&l=$location&latlong=<required>&limit=6&q=$keywords&radius=25&sort=$date&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2";


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
			foreach ($results->results as $post) {
				$postings[] = $post;
			}

		
			

			$found = 'no';
			if(sizeof($results->results) > 0) $found = 'yes';


			$badges = ['#E3C610','#10E358','#108EE3'];
			$data = array(
				'found' => $found,
				'keywords' => $keywords,
				'page' => 1,
				'limit' => 6,
				'categories' => $categories,
				'cat_id' => 0,
				'numberOfResults' => $results->totalResults,
				'numberOfPages' => ceil($results->totalResults / 6),
				'postings' => $postings,
				'badges' => $badges
			);

        return array(
			'limit' => $results->totalResults - 6,
			'numberOfResults' => $results->totalResults,
			'view' => view('api-results')->with($data)->render()
		);



    }
}
