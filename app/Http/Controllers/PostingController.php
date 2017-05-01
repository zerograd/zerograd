<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class PostingController extends Controller
{
    //
    public function index($id = null,$keywords = null){
    	$posting = DB::table('postings')
    				->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
    				->where(DB::raw('postings.id'),$id)
    				->first();
    	$data = array(
    		'posting' => $posting,
    		'keywords' => $keywords
		);

		return view('posting')->with($data);
    }
}
