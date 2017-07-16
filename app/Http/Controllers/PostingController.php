<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Session;

class PostingController extends Controller
{
    //
    public function index($id = null,$title = null){

    	$posting = DB::table('postings')
    				->select(DB::raw('postings.*'),DB::raw('companies.id AS companyID'),DB::raw('companies.company_name'),DB::raw('categories.cat_name'))
    				->leftJoin('companies',DB::raw('companies.id'),'=',DB::raw('postings.company_id'))
                    ->join('categories','categories.cat_id','=','postings.cat_id')
    				->where(DB::raw('postings.id'),$id)
    				->first();

        $saved = DB::table('saved_jobs')
                    ->select('*')
                    ->where('user_id',Session::get('user_id'))
                    ->where('post_id',$id)
                    ->count();

         //Check to see if they have already applied to this position
        $appliedTo = DB::table('applied_to')->where('user_id',Session::get('user_id'))->where('posting_id',$id)->count();


        $requirements = explode(',',$posting->requirements);

    	$data = array(
    		'posting' => $posting,
            'post_id' => $id,
            'saved' => $saved,
            'appliedTo' => $appliedTo,
            'requirements' => $requirements
		);

        
		return view('job')->with($data);
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

    public function applyJob(Request $request){
        $postID = $request->id;
        $studentID = Session::get('user_id');


        //Check to see if they have already applied to this position
        $appliedTo = DB::table('applied_to')->where('user_id',$studentID)->where('posting_id',$postID)->count();

        if($appliedTo > 0){
            return "applied already";
        }

        $posting = DB::table('postings')->select('company_id')->where('id',$postID)->first();


        if($request->file('user_file')){
            $path = $request->file('user_file')->store('covers');
        }
        

        // Create the applied to link
        DB::table('applied_to')
            ->insert(array(
                'user_id' => $studentID,
                'company_id' => $posting->company_id,
                'posting_id' => $postID,
                'message' => $request->message,
                'cover_letter' => isset($path)?$path:"",
                'status' => 'new'
            ));

        return "applied";
    }


    public function createJob(Request $request){

        $previousID = '';

        foreach($request->except('_token') as $key=>$value){
            if($previousID == ''){
                $previousID = DB::table('postings')
                                    ->insertGetId(array(
                                        "$key" => $value
                                    ));
            }else{
                if($key == 'requirements') {
                    DB::table('postings')
                        ->where('id',$previousID)
                        ->update(array(
                            "$key" => $value
                    ));

                    DB::table('postings')
                        ->where('id',$previousID)
                        ->update(array(
                            "keywords" => $value
                    ));
                }
                DB::table('postings')
                        ->where('id',$previousID)
                        ->update(array(
                            "$key" => $value
                ));
            }
        }

        DB::table('postings')
                        ->where('id',$previousID)
                        ->update(array(
                            "company_id" => Session::get('employer_id')
                        ));

        return redirect(route('manage-jobs'));
    }

    public function markFilled(Request $request){
            DB::table('postings')
                    ->where('id',$request->id)
                    ->update(array(
                        'filled' => $request->mark
                    ));
    }

    public function deleteJob(Request $request){
        DB::table('postings')
                    ->where('id',$request->id)
                    ->delete();
        return 'deleted';
    }
}
