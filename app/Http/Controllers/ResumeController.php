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



        //Templates
        $templates = DB::table('templates')->select('*')->get();

        //make sure the resume record is for builder and not another type
        $chosenTemplate = DB::table('resume')->select('*')->where('builder','yes')->where('user_id',$id)->first();

        //The chosen template..render it
        $templateData = array(

        );

        $data = array(
            'templates' => $templates,
            'template' => $templateData,
            'templateNumber' => $chosenTemplate->selected_template,
            'id' => $id
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

    public function postResumeTemplate(Request $request){
        $number = $request->number;
        $id = $request->id;
        //Previous Choice
        DB::table('resume')
            ->where('user_id',$id)
            ->where('builder','yes')
            ->update(array(
                'selected_template'=> $number
            ));

        $data = array(

        );


        return view('templates.resume-template-' . $number)->with($data)->render();
    }

   // Function to process data from resume builder

    public function postViaResumeBuilder(Request $request){
        
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

    public function updateResumeViaInput(Request $request){
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

    public function testTemplate($id = null){
        return view('templates.resume-template-' . $id);
    }
}

