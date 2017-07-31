<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\simple_html_dom;
use Response;

class ParseController extends Controller
{

	private $variables;

	public function __construct(){
		$this->variables = array(
			'1-2',
			'1-3',
			'1 - 3',
			'1 - 2',
			'1 year',
			'2 year',
			'3 year',
			'One year',
			'Two years',
			'Three years',
			'new grad',
			'new graduate',
			'entry-level',
			'Junior',
			'beginner',
		);
	}

    //Fetch HTML content and parse it
    public function fetch($link = null){

    	//Get HTML 
    	$html = file_get_html($link);

    	//Get the summary
    	$summary = '';
    	foreach ($html->find('span#job_summary') as $summary) {
    			$summary = strip_tags($summary->outertext);		
		}

		$summary = strtoupper($summary);

		//return variable: if it returns true entry-level position
		$retValue = false;
		$count = 0;
		//Search variables in summary
		foreach($this->variables as $v){
			$toUppercase = strtoupper($v);
			if(strpos($summary, $toUppercase) !== false){
				$retValue = true;
				$count++;
			}
		}

		if($count > 5){//Consider it an entry-level position
			return Response::json($retValue);
		}else{
			return Response::json(false);
		}

		
    }
}
