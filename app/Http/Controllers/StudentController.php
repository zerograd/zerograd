<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;

class StudentController extends Controller
{
    //
    public function index(){
    	return view('logins.student-login');
    }

    public function verifyLogin(Request $request){
    	$student = DB::table('students')
	    		->select('*')
	    		->where('email',$request->email)
	    		->where('password',md5($request->password))
	    		->first();

	    if(sizeof($student) > 0){
	    	Session::put('user_id',$student->student_id);
	    	Session::put('student_name',$student->student_name);
	    	Session::put('email',$student->email);
	    	return "success";
	    }else{
	    	return "failed";
	    }
    }

    public function home(){
        $searches = DB::table('user_history')
                        ->select('searches')
                        ->where('user_id',Session::get('user_id'))
                        ->orderBy('search_time','DESC')
                        ->take(4)
                        ->get();
        $data = array(
            'searches' => $searches
        );

        // return $data;
    	return view('homepages.student')->with($data);
    }

    public function profile($id = null){

        $education = DB::table('education')
                        ->select('*')
                        ->where('user_id',$id)
                        ->get();
        $resume = DB::table('resume')
                        ->select('*')
                        ->where('user_id',$id)
                        ->first();
        $profileSummary = DB::table('profile_summary')
                        ->select('summary')
                        ->where('user_id',$id)
                        ->first();  

        $resumeSkills = explode(',',$resume->skills);

        $profileSkills = DB::table('profile_skills')
                            ->select('skills')
                            ->where('user_id',$id)
                            ->first();
        $skills = explode(',', $profileSkills->skills);

        $profileProjects = DB::table('profile_projects')
                            ->select('*')
                            ->where('user_id',$id)
                            ->get();

        $workExperience = DB::table('work_experience')
                            ->select('*')
                            ->where('user_id',$id)
                            ->get();
        $volunteering = DB::table('volunteer')
                            ->select('*')
                            ->where('user_id',$id)
                            ->get();
        $data = array(
            'educations' => $education,
            'resume' => $resume,
            'profileSummary' => $profileSummary,
            'resumeSkills' => $resumeSkills,
            'skills' => $skills,
            'profileProjects' => $profileProjects,
            'workExperience' => $workExperience,
            'volunteering' => $volunteering
        );
        

    	return view('profiles.student')->with($data);
    }

    public function searchTool(){
        $companies = DB::table('companies')
                        ->select('company_name','id')
                        ->get();
        $data = array(
            'companies' => $companies
        );
        return view('search-tool')->with($data);
    }
}
