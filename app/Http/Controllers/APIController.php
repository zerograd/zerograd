<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Response;
use Vendor\Unirest\Request;

class APIController extends Controller
{
    //
    public function index(){
    		$opts = array(
			  'http'=>array(
			    'method'=>"GET",
			    'header'=>"X-Mashape-Key:VkkqCtqYZ1mshzkpvgVYh664G3PVp15ust8jsnAp6PjXWDxz1B"               
			  )
			);

			$context = stream_context_create($opts);

			// Open the file using the HTTP headers set above
			$res = file_get_contents('https://indeed-indeed.p.mashape.com/apisearch?publisher=8346533341188358&callback=<required>&chnl=<required>&co=ca&filter=<required>&format=json&fromage=<required>&highlight=<required>&jt=<required>&l=toronto&latlong=<required>&limit=<required>&q=java&radius=25&sort=<required>&st=<required>&start=<required>&useragent=<required>&userip=<required>&v=2', false, $context);
			$results = json_decode($res, true);
			return $results;
    }
}
