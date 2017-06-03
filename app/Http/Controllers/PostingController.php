<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Session;

class PostingController extends Controller
{
    //
    public function index($title=null,$id = null){
    	$posting = DB::table('postings')
    				->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'))
    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
    				->where(DB::raw('postings.id'),$id)
    				->first();

        $saved = DB::table('saved_jobs')
                    ->select('*')
                    ->where('user_id',Session::get('user_id'))
                    ->where('post_id',$id)
                    ->count();

    	$data = array(
    		'posting' => $posting,
            'post_id' => $id,
            'saved' => $saved
		);

		return view('posting')->with($data);
    }

    public function saveJob($id = null){
        if(!Session::has('user_id')) return 0;

        DB::table('saved_jobs')
            ->insert(array(
                'user_id' => Session::get('user_id'),
                'post_id' => $id
            ));
        return 1;
    }

    public function unsaveJob($id = null){
        DB::table('saved_jobs')
            ->where('user_id',Session::get('user_id'))
            ->where('post_id',$id)
            ->delete();
        return 1;
    }
}
