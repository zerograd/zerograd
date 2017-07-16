<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;
use File;
class EmployerController extends Controller
{
    //
    public function getRegister(){
    	 $data = array(

        );

        return view('registrations.employer')->with($data);
    }

    public function logout(){
        Session::forget('employer_id');
        Session::forget('company_name');
        Session::forget('company_email');
        return redirect('/newtheme');
    }

    public function postRegister(Request $request){
    	$count = DB::table('companies')->where('company_email',$request->email)->count();
        if($count > 0){
            return "User Already Exist";
        }

        $previousInsertId;
        foreach($request->except('_token','project_id') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('companies')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  if($key == 'password'){
                        DB::table('companies')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => md5($value)
                    ));
                  }else{
                    DB::table('companies')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
                  }
            }
        }

        
        return "success";
    }

    public function verifyLogin(Request $request){
        $employer = DB::table('companies')
                ->select('*')
                ->where('company_email',$request->company_email)
                ->where('password',md5($request->password))
                ->first();      
        if(sizeof($employer) > 0){
            Session::put('logged','yes');
            Session::put('employer_id',$employer->id);
            Session::put('company_name',$employer->company_name);
            Session::put('company_email',$employer->company_email);
            return "success";
        }else{
            return "failed";
        }
    }

    public function home(){

        $allPostings = DB::table('postings')
                        ->select('*')
                        ->where('company_id',Session::get('employer_id'))
                        ->orderBy('posted_date','DESC')
                        ->take(4)
                        ->get();

        $whoApplied = DB::table('applied_to')
                        ->select('students.student_name','students.student_id','students.avatar','profile_skills.skills','postings.title','postings.id')
                        ->join('students','students.student_id','=','applied_to.user_id')
                        ->join('profile_skills','profile_skills.user_id','=','students.student_id')
                        ->join('postings','postings.id','=','applied_to.posting_id')
                        ->where('applied_to.company_id',Session::get('employer_id'))
                        ->get();

        // return $whoApplied;
        $data = array(
            'id' => Session::get('employer_id'),
            'postings' => $allPostings,
            'whoApplied' => $whoApplied
        );


        // return $data;
        return view('homepages.employer')->with($data);
    }

    public function getCreatePosting(){

        $categories = DB::table('categories')
                        ->select('*')
                        ->get();
        $data = array(
            'id' => Session::get('employer_id'),
            'categories' => $categories
        );


        // return $data;
        return view('create-posting')->with($data);
    }

    public function postCreatePosting(Request $request){
        $previousInsertId;
        foreach($request->except('_token','skill') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('postings')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  
                    DB::table('postings')
                    ->where('id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
        
            }
        }

        return redirect('/employer/home');
    }

    public function getProfile(){

      $profileInfo =  DB::table('companies')
            ->select('*')
            ->where('id',Session::get('employer_id'))
            ->first();
 

        $data = array(
            'id' => Session::get('employer_id'),
            'profileInfo' => $profileInfo
        );
        // return $data;
        return view('profiles.employer')->with($data);
    }

    public function postProfile(Request $request){
        
        foreach($request->except('_token') as $key=>$value){
                  
                    DB::table('companies')
                    ->where('id',Session::get('employer_id'))
                    ->update(array(
                        "$key" => "$value"
                    ));
        
        
        }

        return redirect('/employer/home');

    }

    //new theme functions

    public function addJob(){

        if(!Session::has('employer_id')){
            Session::flash('message','Please register to access this feature.');
            return redirect('/employer/myaccount'. '#tab2');
        }

        $categories = DB::table('categories')
                        ->select('*')
                        ->get();


        $data = array(
            'categories' => $categories
        );

        return view('add-jobs')->with($data);
    }


    //return an object with search and count
    


    public function manageJobs(){

        if(!Session::has('employer_id')){
            Session::flash('message','Please register to access this feature.');
            return redirect('/employer/myaccount'. '#tab2');
        }

        $postings = DB::table('postings')
                        ->select('*')
                        ->where('company_id',Session::get('employer_id'))
                        ->get();

        $whoApplied = DB::table('applied_to')
                        ->select('posting_id')
                        ->where('company_id',Session::get('employer_id'))
                        ->get();

        //Parse the object and get all IDs
        $appliedIDs = array();
        foreach($whoApplied as $applied){
            array_push($appliedIDs,$applied->posting_id);
        }

        
        
        $postingCounts = array();

        

        $data = array(
            'postings' => $postings,
            'appliedIDs' =>$appliedIDs,
        );


        
        return view('manage-jobs')->with($data);
    }

    public function manageApplications($posting = null){

        // $path = storage_path(). '\app\covers\6rmXU3DoneWygilNuW8RmMzK2eqwQBvGWCxwQ1IZ.pdf';

        // return response()->download($path);

        if(!Session::has('employer_id')){
            Session::flash('message','Please register to access this feature.');
            return redirect('/employer/myaccount'. '#tab2');
        }

        $forAllPositions = 'All Positions';
        if($posting == null){
            $applicants = DB::table('applied_to')
                                ->select('applied_to.*','students.student_name','students.email')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('status','!=','deleted')
                                ->take(6)
                                ->get();
        }else{
            $postingName = DB::table('postings')->select('postings.title')->where('id',$posting)->first()->title;
            $forAllPositions = $postingName;
            $applicants = DB::table('applied_to')
                                ->select('applied_to.*','students.student_name','students.email')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('applied_to.posting_id',$posting)
                                ->where('status','!=','deleted')
                                ->take(6)
                                ->get();
        }


        

        $statues = array('New','Interviewed','Offer','Hired','Archived');

        $data = array(
            'forAllPositions' => $forAllPositions,
            'applicants' => $applicants,
            'statues' => $statues,
            'posting' => isset($posting)?$posting:''
        );

        return view('manage-applications')->with($data);
    }

    public function browseResumes(){

        if(!Session::has('employer_id')){
            Session::flash('message','Please register to access this feature.');
            return redirect('/employer/myaccount'. '#tab2');
        }

        $data = array(

        );

        return view('browse-resumes')->with($data);
    }

    public function myAccount(){
        $data = array(

        );

        return view('employer-account')->with($data);
    }

    public function downloadCSV($postingID = null,$id = null){

        //Download CSV for all positions
        if($id == 'All'){

        }else{

            $applicant = DB::table('applied_to')
                        ->select('applied_to.cover_letter','students.student_name')
                        ->join('students','students.student_id','=','applied_to.user_id')
                        ->where('applied_to.user_id',$id)
                        ->where('posting_id',$postingID)
                        ->first();


            $path = storage_path(). "\app\\" . $applicant->cover_letter;

             return response()->download($path,$applicant->student_name . '.' . File::extension($applicant->cover_letter));
        }
    }

    public function updateApplication(Request $request){
        $applyID = $request->id;
        foreach($request->except('_token','id') as $key=>$value){
                DB::table('applied_to')
                    ->where('id',$applyID)
                    ->update(array(
                        "$key" => $value
                    ));
        }
        DB::table('applied_to')
                    ->where('id',$applyID)
                    ->update(array(
                        "viewed" => 'yes'
                    ));
    }


    public function filterApplications(Request $request){

        $status = isset($request->status)?$request->status:'';
        $name = isset($request->name)?$request->name:'';
        $posting = $request->id;
        $applicants = DB::table('applied_to');

        //if this is is a filter for specific posting
        if($posting == null){
            
                                $applicants->select('applied_to.*','students.student_name','students.email')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('applied_to.status','!=','deleted');
                               
                                
        }else{
            $applicants->select('applied_to.*','students.student_name','students.email')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('applied_to.posting_id',$posting)
                                ->where('applied_to.status','!=','deleted');
        }


        //Filters
        if($status != ''){
            $applicants->where('status',$status);
        }
        if($name != ''){
            if($name == 'name'){
                $applicants->orderBy('students.student_name','ASC');
            }else if($name == 'rating'){
                $applicants->orderBy('applied_to.rating','DESC');
            }else{
                $applicants->orderBy('applied_to.created','DESC');
            }
        }

        $applicants = $applicants->take(6)->get();

        $statues = array('New','Interviewed','Offer','Hired','Archived');

        $data = array(
            'applicants' => $applicants,
            'statues' => $statues,
            'posting' => isset($posting)?$posting:''
        );

        return view('sub-manage-applications')->with($data);
    }
}
