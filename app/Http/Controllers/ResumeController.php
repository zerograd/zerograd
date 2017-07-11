<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Dompdf\Dompdf;

class ResumeController extends Controller
{
    //
    public function resumeBuilder($id = null){



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

        if($profileSkills){
            $skills = explode(',', $profileSkills->skills);
        }
        

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

        $resumeUploaded = DB::table('students')->select('resume_uploaded')->where('student_id',$id)->first()->resume_uploaded;
        $snaps = array(asset('images/resume-1-snap.png'),asset('images/resume-2-snap.png'),asset('images/resume-3-snap.png'));
    	$data = array(
    		'educations' => $education,
            'resume' => $resume,
            'profileSummary' => $profileSummary,
            'resumeSkills' => $resumeSkills,
            'skills' => isset($skills)?$skills:"",
            'profileProjects' => $profileProjects,
            'workExperience' => $workExperience,
            'volunteering' => $volunteering,
            'id' => $id,
            'snaps' => $snaps,
            'currentSnap' => 1,
            'templateChosen' => $resume->selected_template,
            'resume_uploaded' => $resumeUploaded
		);

		return view('resume-builder')->with($data);
    }

    public function save(Request $request){
    	foreach($request->except('_token','project_id') as $key=>$value){
                DB::table('resume')
                ->where('user_id',$request->user_id)
                ->update(array(
                    "$key" => "$value"
                ));
        }
    }

    public function processResume(Request $request){

        $id = $request->id;
        $templateChosen = isset($request->template)?$request->template:1;
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

        $summary = DB::table('profile_summary')
                    ->select('*')
                    ->where('user_id',$id)
                    ->first();
        $data = array(
            'student' => $student,
            'resume'  => $resume,
            'education' => $education,
            'works' => $workExperience,
            'volunteers' => $volunteerExperience,
            'skills' => $skills,
            'projects' => $projects,
            'summary' => $summary
        );

        //Update chose of template
        DB::table('resume')
            ->where('user_id',$id)
            ->update(array(
                'selected_template'=>$templateChosen
            ));
        if($templateChosen == 1){
            $html = view('templates.resume-template-' . $templateChosen)->with($data);
        }else if($templateChosen == 2){
            $html = view('templates.resume-template-' . $templateChosen)->with($data);
        }else if($templateChosen == 3){
            $html = view('templates.resume-template-' . $templateChosen)->with($data);
        }
        

        return $html;
    }

    public function resumeUploaded(Request $request){
        $choice = $request->choice;
        DB::table('students')
            ->where('student_id',$request->student_id)
            ->update(array(
                'resume_uploaded' => $choice
            ));
    }

    public function addResume(){

        if(!Session::has('user_id')){
            Session::flash('message','Please sign up to access this feature.');
            return redirect(route('my-account'). '#tab2');
        }
        $data = array(

        );

        return view('add-resume')->with($data);
    }

    public function manageResume(){

        if(!Session::has('user_id')){
            Session::flash('message','Please sign up to access this feature.');
            return redirect(route('my-account'). '#tab2');
        }

        $resumes = DB::table('resume')
                        ->select(DB::raw('resume.*'),'students.student_name')
                        ->join('students','students.student_id','=','resume.user_id')
                        ->where('user_id',Session::get('user_id'))
                        ->get();

        $data = array(
            'resumes' => $resumes,
            'resumeSize' => sizeof($resumes)
        );

        return view('manage-resume')->with($data);
    }
}
