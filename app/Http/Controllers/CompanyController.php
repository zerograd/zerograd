<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CompanyController extends Controller
{
    //
    public function index($id = null){

    	$company = DB::table('companies')
    					->select('*')
    					->where('id',$id)
    					->first();

    	$data = array(
    		'company' => $company
		);
    	
		return view('company')->with($data);
    }
}
