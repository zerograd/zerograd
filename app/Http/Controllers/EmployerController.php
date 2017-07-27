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
    	$count = DB::table('companies')->where('company_email',$request->company_email)->count();
        if($count > 0){
            Session::flash('user_exists','User already Exists');
           return redirect('/employer/myaccount' . '#tab2');
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

        $hash = md5( rand(0,1000) );
        DB::table('companies')
                    ->where('id',$previousInsertId)
                    ->update(array(
            "password" => $hash
        ));

        //Send Email

        $emailer = new EmailController();
        $emailer->sendEmployer($request,$hash);

        Session::flash('email_sent','Confirmation email sent');
        return redirect('/');
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
                                ->select('applied_to.*','students.student_name','students.email','students.seen','students.student_id','students.last_login')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('status','!=','deleted')
                                ->take(6)
                                ->get();
        }else{
            $postingName = DB::table('postings')->select('postings.title')->where('id',$posting)->first()->title;
            $forAllPositions = $postingName;
            $applicants = DB::table('applied_to')
                                ->select('applied_to.*','students.student_name','students.email','students.seen','students.student_id','students.last_login')
                                ->join('students','students.student_id','=','applied_to.user_id')
                                ->where('company_id',Session::get("employer_id"))
                                ->where('applied_to.posting_id',$posting)
                                ->where('status','!=','deleted')
                                ->take(6)
                                ->get();
        }

        
        //Part 1 of 4 needed to determine scoring system
        //function will determine their percentage (worth 25%)
        $applicants = $this->studentsSeen($applicants);

        //Part 2 of 4 needed to determin scoring system
        //function will determine their percentage (worth 25%)
        $applicants = $this->profileCompletion($applicants);

        //Part 3 of 4 needed to determin scoring system
        //function will determine their percentage (worth 25%)
        $applicants = $this->frequency($applicants);

        //Part 4 of 4 needed to determin scoring system
        //function will determine their percentage (worth 25%)
        $applicants = $this->profileMatch($applicants,$posting);
        
                

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


    //Function to get count of seen jobs for students 
    //Complexity O(n)
    public function studentsSeen($applicants){
        foreach ($applicants as $applicant) {
            $seenValue = $applicant->seen;
            $percentage = 0;
            //Receives 25%
            if($seenValue >= 0 && $seenValue <= 5){
                $percentage = 25;
            }if($seenValue >= 6 && $seenValue <= 10){
                $percentage = 50;
            }if($seenValue >= 10 && $seenValue <= 15){
                $percentage = 75;
            }if($seenValue >= 16){
                $percentage = 100;
            }

            //the weight of this function
            $percentage = $percentage * 0.25;
            $applicant->seen_percentage = $percentage;
        }
        return $applicants;
    }

    //Function get see how complete their profile is
    //Complexity O(n)
    public function profileCompletion($applicants){
        foreach ($applicants as $applicant) {

            $applicantID = $applicant->student_id;
            $percentage = 0;

            //Skills 
            $skills = DB::table('profile_skills')->select('*')->where('user_id',$applicantID)->count();

            //Projects
            $projects = DB::table('profile_projects')->select('*')->where('user_id',$applicantID)->count();

            //Summary and Avatar
            $profileSummary = DB::table('profile_summary')->select('*')->where('user_id',$applicantID)->first();

            //linkedIn
            $linkedIn = DB::table('students')->select('linkedin')->where('student_id',$applicantID)->first()->linkedin;

            if($skills > 0) $percentage += 20;
            if($projects > 0) $percentage += 20;
            if($profileSummary){ //Summary was created 
                $percentage += 20;

                if($profileSummary->avatar) $percentage += 20;
            }
            if($linkedIn) $percentage += 20;

            //the weight of this function
            $percentage = $percentage * 0.25;
            $applicant->profilePercentage = $percentage;
        }
        return $applicants;
    }

    //Function to get see how frequent the student is
    public function frequency($applicants){
        foreach ($applicants as $applicant) {

            $applicantID = $applicant->student_id;
            $percentage = 0;
            
            //Their last login
            $date1 = date_create($applicant->last_login);

            //current time
            $today = date("Y-m-d H:i:s");    
            $date2 = date_create($today);

            //difference in time
            $diff=date_diff($date1,$date2);

            $days = $diff->days;

            if($days >= 0 && $days <= 2) $percentage = 100;
            else if($days >= 3 && $days <= 6) $percentage = 75;
            else if($days >= 7 && $days <= 15) $percentage = 50;
            else if($days >= 16) $percentage = 25;


            //the weight of this function
            $percentage = $percentage * 0.25;
            $applicant->frequencyPercentage = $percentage;
        }
        return $applicants;
    }

    public function profileMatch($applicants,$posting){

        //if it is for a particular posting
        if($posting){


            $keywords = DB::table('postings')->select('keywords')->where('id',$posting)->first()->keywords;
            $description = DB::table('postings')->select('description')->where('id',$posting)->first()->description;


            //Create string of terms
            $terms = $keywords . ' ' . $description;
            $sizeofTerms = str_word_count($terms);
            


            foreach ($applicants as $applicant) {

            $applicantID = $applicant->student_id;
            $count = 0;

            //Get the users skills and summary for matching

            $profileSummary = DB::table('profile_summary')->select('summary')->where('id',$applicantID)->first()->summary;
            $profileSkills = DB::table('profile_skills')->select('skills')->where('id',$applicantID)->first()->skills;

            $profileSkills = explode(',',$profileSkills);

            $profileSummary = str_replace(array('.', ',',"'"), ' ' , $profileSummary);

            $profileSummary = explode(' ',$profileSummary);

            //Check if skill is in terms
            foreach($profileSkills as $skill){
                if($skill != '' && strpos($terms,$skill) !== false) $count++;
            }

            //Check if summary matches terms

            
            foreach($profileSummary as $word){
                

                if($word != '' && strpos($terms,$word) !== false) $count++;
            }

            $percentage = 0;
            
            if($count < $sizeofTerms){
                $percentage = $count / $sizeofTerms;
            }
            


            //the weight of this function
            $percentage = ($percentage * 100) * 0.25;
            $applicant->profilePercentage = $percentage;
            }  
        }

        return $applicants;
        
    }
}
