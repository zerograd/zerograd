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

        // Uploaded resume if chosen



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

    public function createResume(Request $request){

        

        $user_id = Session::get('user_id');
        $values = array();
            parse_str($request->data, $values);
        $student_name = Session::get('student_name');
        $title = $values['title'];
        $summary = $values['summary'];
        $city = $values['city'];


        //Create the resume
        $insertID = DB::table('resume')
                    ->insertGetId(array(
                        'student_name' =>$student_name,
                        'title' =>$title,
                        'summary' =>$summary,
                        'city' => $city,
                        'user_id' => $user_id
                    ));


        //Grab education ids & experience ids
        $educationIDs = '';      
        $experienceIDs = '';  

        $educations = $request->education;
        $experiences = $request->experience;

        if($educations){
           foreach($educations as $education){
             if($education['school']){
                $id = DB::table('education')
                    ->insertGetId(array(
                        'school' => $education['school'],
                        'start' => $education['completion'],
                        'program' => $education['program'],
                        'user_id' => $user_id
                    ));

                if($id) $educationIDs .= $id . ',';
             }   
                
            } 
        }
        

            if($experiences){
                foreach($experiences as $experience){
             if($experience['employer']){
               $id = DB::table('work_experience')
                    ->insertGetId(array(
                        'company_name' => $experience['employer'],
                        'start' => $experience['completion'],
                        'job_title' => $experience['job_title'],
                        'user_id' => $user_id
                    ));

                 if($id) $experienceIDs .= $id . ',';
             }   
                
            }

            }

            DB::table('resume')
                ->where('resume_id',$insertID)
                ->update(array(
                    'education_id' => $educationIDs,
                    'work_experience_id' => $experienceIDs
                ));

        return url('/manage-resume');

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

    public function deleteResume(Request $request){


        $experienceIDs = DB::table('resume')->select('work_experience_id')->where('resume_id',$request->id)->first()->work_experience_id;

        $educationIDs = DB::table('resume')->select('education_id')->where('resume_id',$request->id)->first()->education_id;


        $educationIDs = substr($educationIDs,0,-1);
        $experienceIDs = substr($experienceIDs,0,-1);

        $educationIDs = explode(',',$educationIDs);
        $experienceIDs = explode(',',$experienceIDs);

        foreach($educationIDs as $id){
            DB::table('education')
                ->where('education_id',$id)
                ->delete();
        }

        foreach($experienceIDs as $id){
            DB::table('work_experience')
                ->where('id',$id)
                ->delete();
        }

        

        DB::table('resume')
            ->where('resume_id',$request->id)
            ->delete();

        return url('/manage-resume');
    }

    public function uploadResume(Request $request){


        $fileType = $request->file('user_file')->getMimeType();

        

        if($fileType == 'application/pdf' || $fileType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $fileType == 'application/msword') {
            

            $path = $request->file('user_file')->store('resumes');

            //Store in DB path
            DB::table('resume')
                ->insert(array(
                    'student_name' => Session::get('student_name'),
                    'email' => Session::get('email'),
                    'user_id' => Session::get('user_id'),
                    'resume_uploaded' => 'yes',
                    'path' => $path
                ));

            Session::flash('message','Resume uploaded.');

            return redirect('/manage-resume');
        }

        Session::flash('message','Please upload a PDF or Word doc.');
        return redirect('/resume/add');
        
    }

    public function updateResume(Request $request){


        $fileType = $request->file('user_file')->getMimeType();

        

        if($fileType == 'application/pdf' || $fileType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $fileType == 'application/msword') {
            

            $path = $request->file('user_file')->store('resumes');

            //Store in DB path
            DB::table('resume')
                ->where('resume_id',$request->id)
                ->update(array(
                    'path' => $path
                ));

            Session::flash('message','Resume uploaded.');

            return redirect('/manage-resume');
        }

        
        Session::flash('failed','Please upload a PDF or Word Doc.');
        return redirect('/manage-resume');
    }
}

