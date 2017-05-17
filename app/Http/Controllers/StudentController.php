<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Dompdf\Dompdf;

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
            'volunteering' => $volunteering,
            'id' => $id
        );
        

    	return view('profiles.student')->with($data);
    }

    // SUMMARY 
    public function submitSummary(Request $request){
        DB::table('profile_summary')
            ->where('user_id',$request->id)
            ->update(array(
                "summary" => $request->summary
            ));
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

    public function saveSkills(Request $request){
        $skills = implode(',',$request->skills);
        DB::table('profile_skills')
            ->where('user_id',$request->id)
            ->update(array(
                'skills' => $skills
            ));
    }

    public function updateProfileProject(Request $request){
        $previousInsertId;
        foreach($request->except('_token','project_id') as $key=>$value){
            if(isset($request->project_id)){
                DB::table('profile_projects')
                ->where('id',$request->project_id)
                ->update(array(
                    "$key" => "$value"
                ));
            }else if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('profile_projects')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  DB::table('profile_projects')
                ->where('id',$previousInsertId)
                ->update(array(
                    "$key" => "$value"
                ));
            }
        }
    }

    public function updateSchool(Request $request){
        $previousInsertId;
        foreach($request->except('_token','education_id') as $key=>$value){
            if(isset($request->education_id)){
                DB::table('education')
                ->where('education_id',$request->project_id)
                ->update(array(
                    "$key" => "$value"
                ));
            }else if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('education')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  DB::table('education')
                ->where('education_id',$previousInsertId)
                ->update(array(
                    "$key" => "$value"
                ));
            }
        }
    }

    public function deleteSchool(Request $request){
        DB::table('education')
            ->where('education_id',$request->education_id)
            ->delete();
        return "Deleted";
    }

    public function saveTopResume(Request $request){

    }

    public function updateWork(Request $request){
        $previousInsertId;
        foreach($request->except('_token','id') as $key=>$value){
            if(isset($request->id)){
                DB::table('work_experience')
                ->where('id',$request->id)
                ->update(array(
                    "$key" => "$value"
                ));
            }else if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('work_experience')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  DB::table('work_experience')
                ->where('id',$previousInsertId)
                ->update(array(
                    "$key" => "$value"
                ));
            }
        }
    }

    public function updateVolunteer(Request $request){
        $previousInsertId;
        foreach($request->except('_token','id') as $key=>$value){
            if(isset($request->id)){
                DB::table('volunteer')
                ->where('id',$request->id)
                ->update(array(
                    "$key" => "$value"
                ));
            }else if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('volunteer')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  DB::table('volunteer')
                ->where('id',$previousInsertId)
                ->update(array(
                    "$key" => "$value"
                ));
            }
        }
    }

    public function deleteExperience(Request $request){
        DB::table('work_experience')
            ->where('id',$request->id)
            ->delete();
        return "Deleted";
    }

    public function deleteVolunteer(Request $request){
        DB::table('volunteer')
            ->where('id',$request->id)
            ->delete();
        return "Deleted";
    }

    public function deleteProfileProject(Request $request){
        DB::table('profile_projects')
            ->where('id',$request->project_id)
            ->delete();
        return "Deleted";
    }

    //For the resume add preview panel that says "Education and projects are populated from profile. As it is good to have a resume and profile that are closely related"
    public function previewResume($id = null){
        $student = DB::table('students')
                    ->select('student_name','email')
                    ->where('student_id',$id)
                    ->first();
        $resume = DB::table('resume')
                    ->select('*')
                    ->where('user_id',$id)
                    ->first();
        $education = DB::table('education')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();

        $workExperience = DB::table('work_experience')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();
        $volunteerExperience = DB::table('volunteer')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();

        $skills = DB::table('profile_skills')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();

        $projects = DB::table('profile_projects')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();
        $data = array(
            'student' => $student,
            'resume'  => $resume,
            'education' => $education,
            'works' => $workExperience,
            'volunteers' => $volunteerExperience,
            'skills' => $skills,
            'projects' => $projects
        );

        $html = view('resume-template-1')->with($data)->render();
        $pdf = new Dompdf();

        $pdf->loadHtml($html);

        $pdf->render();
        return $pdf->stream($student->student_name. '.pdf',array('Attachment'=> 0));
    }

    public function publicProfile($id = null){
        $user = DB::table('students')
                    ->select('*')
                    ->join('profile_summary','profile_summary.user_id','=','students.student_id')
                    ->where('student_id',$id)
                    ->first();

        $educations = DB::table('education')
                        ->select('*')
                        ->where('user_id',$id)
                        ->get();
        $skills = DB::table('profile_skills')
                        ->select('*')
                        ->where('user_id',$id)
                        ->get();
        $projects = DB::table('profile_projects')
                        ->select('*')
                        ->where('user_id',$id)
                        ->get();
        $data = array(
            'user' => $user,
            'educations' => $educations,
            'skills' => $skills,
            'projects' => $projects
        );

        
        return view('student')->with($data);
    }

}
