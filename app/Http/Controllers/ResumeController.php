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

        if(!Session::has('user_id')){
            Session::flash('no_permission','Do not have access to view this page.');
            return redirect('/');
        }else if (Session::get('user_id') != $id){
            Session::flash('no_permission','Do not have access to view this page.');
            return redirect('/');
        }



        //Templates
        $templates = DB::table('templates')->select('*')->get();

        
        //First time using 
        $firstTime = '';

        //User

        $user = DB::table('resume')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->first();

        //If the user has used the builder before
        if($user){

            //make sure the resume record is for builder and not another type


        $skills = json_encode(explode(',',$user->skills));

        $works = DB::table('work_experience')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->get();
        //Change work to match front-end work JSON
        foreach($works as $work){
            $work->company = $work->company_name;
            $work->info = $work->duties;
            $work->list = explode(',',$work->list);
            $work->title = $work->job_title;
        }

        $education = DB::table('education')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->get();

        foreach($education as $school){
            $school->complete = $school->completed;
            $school->degree = $school->program;
            $school->id = $school->education_id;
        }

        $projects = DB::table('projects')
                    ->select('*')
                    ->where('user_id',$id)
                    ->get();

        foreach($projects as $project){
            $project->list = explode(',',$project->list);
        }

    }else{ // Create and Insert
        DB::table('resume')
            ->insert(array(
                'user_id' => $id,
                'builder' => 'yes',
                'student_name' => '',
                'selected_template' => 5
            ));
        $firstTime = 'yes';

        $skills = json_encode(array());
        $works = array();
        $education = array();
        $projects = array();
    }

    $chosenTemplate = DB::table('resume')->select('*')->where('builder','yes')->where('user_id',$id)->first();




        $data = array(
            'templates' => $templates,
            'templateNumber' => $chosenTemplate->selected_template,
            'id' => $id,
            'user' => $user,
            'skills' => $skills,
            'works' => json_encode($works),
            'education' => json_encode($education),
            'projects' => json_encode($projects),
            'firstTime' => $firstTime
        );

        // return $data;

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
        $user = $request->user;
        
        $count  =  DB::table('resume')
            ->select('*')
            ->where('user_id',$user['user_id'])
            ->where('builder','yes')
            ->count();


        //Insert info resume if new
        if($count == 0){
            DB::table('resume')
                ->insert(array(
                'student_name' => $user['name'],
                'email' => $user['email'],
                'title' => $user['title'],
                'city' => $user['city'],
                'summary' => $user['summary'],
                'skills' => implode(',',$user['skills']),
                'telephone_number' => $user['phone']
            ));
        }else{
            DB::table('resume')
            ->where('user_id',$user['user_id'])
            ->where('builder','yes')
            ->update(array(
                'student_name' => $user['name'],
                'email' => $user['email'],
                'title' => $user['title'],
                'city' => $user['city'],
                'summary' => $user['summary'],
                'skills' => implode(',',$user['skills']),
                'telephone_number' => $user['phone']
            ));
        }

        

        // Updating work experience 

            $works = $user['works'];

            foreach($works as $work){
                //Find the work to update
                $count = DB::table('work_experience')->select('*')->where('id',$work['id'])->where('user_id',$user['user_id'])->where('builder','yes')->count();

                //New Work Experience
                if($count == 0){
                    DB::table('work_experience')
                        ->insert(array(
                            'builder' => 'yes',
                            'user_id' => $user['user_id'],
                            'company_name' =>  $work['company'],
                            'job_title' => $work['title'],
                            'duties' => ($work['info'] != '')?$work['info']:'',
                            'list' => ($work['list'])? implode(',' ,$work['list']): '',
                            'start' => $work['start'],
                            'completed' => $work['completed'] ,
                        ));
                }else{
                    DB::table('work_experience')
                        ->where('user_id',$user['user_id'])
                        ->where('id',$work['id'])
                        ->where('builder','yes')
                        ->update(array(
                            'company_name' =>  $work['company'],
                            'job_title' => $work['title'],
                            'duties' => ($work['info'] != '')?$work['info']:(($work['duties'])? implode(',' ,$work['duties']): ''),
                            'list' => ($work['list'])? implode(',' ,$work['list']): '',
                            'start' => $work['start'],
                            'completed' => $work['completed'] ,
                        ));
                }
            }

            // Updating projects 

            $projects = $user['projects'];

            foreach($projects as $project){
                //Find the project to update
                $count = DB::table('projects')->select('*')->where('id',$project['id'])->where('user_id',$user['user_id'])->count();

                //New Project
                if($count == 0){
                    DB::table('projects')
                        ->insert(array(
                            'user_id' => $user['user_id'],
                            'name' => $project['name'],
                            'info' => ($project['info'] != '')?$project['info']:'',
                            'role' => $project['role'],
                            'list' => ($project['list'])? implode(',' ,$project['list']): '',
                            'start' => $project['start'],
                            'completed' => $project['completed']
                        ));
                }else{
                    DB::table('projects')
                        ->where('user_id',$user['user_id'])
                        ->where('id',$project['id'])
                        ->update(array(
                            'name' => $project['name'],
                            'info' => ($project['info'] != '')?$project['info']:'',
                            'role' => $project['role'],
                            'list' => ($project['list'])? implode(',' ,$project['list']): '',
                            'start' => $project['start'],
                            'completed' => $project['completed']
                        ));
                }
            }

        //Updating school info

            $education = $user['education'];

            foreach($education as $school){
                //Find the school to update
                $count = DB::table('education')->select('*')->where('education_id',$school['id'])->where('user_id',$user['user_id'])->where('builder','yes')->count();

                //New Work Experience
                if($count == 0){
                    DB::table('education')
                        ->insert(array(
                            'builder' => 'yes',
                            'user_id' => $user['user_id'],
                            'school' => $school['school'],
                            'program' => $school['degree'],
                            'start' => $school['start'],
                            'completed' => $school['complete'],
                        ));
                }else{
                    DB::table('education')
                        ->where('user_id',$user['user_id'])
                        ->where('education_id',$school['id'])
                        ->where('builder','yes')
                        ->update(array(
                            'school' => $school['school'],
                            'program' => $school['degree'],
                            'start' => $school['start'],
                            'completed' => $school['complete'],
                        ));
                }
            }
    }

    public function deleteViaResumeBuilder(Request $request){
        $type = $request->type;
        $data = $request->data;
        if($type == 'work'){
            DB::table('work_experience')
                ->where('id',$data['id'])
                ->delete();
        }else if($type == 'project'){
            DB::table('projects')
                ->where('id',$data['id'])
                ->delete();
        }else if($type == 'school'){
            DB::table('education')
                ->where('education_id',$data['id'])
                ->delete();
        }else if($type == 'skills'){
            DB::table('resume')
                ->where('user_id',$request->user_id)
                ->update(array(
                    'skills' => implode(',',$data)
                ));
        }
    }

    public function deleteBuilderResume(Request $request){
        DB::table('resume')
            ->where('user_id',$request->user_id)
            ->where('builder','yes')
            ->delete();

             DB::table('work_experience')
            ->where('user_id',$request->user_id)
            ->where('builder','yes')
            ->delete();

             DB::table('education')
            ->where('user_id',$request->user_id)
            ->where('builder','yes')
            ->delete();

             DB::table('projects')
            ->where('user_id',$request->user_id)
            ->delete();

            return redirect('/resume-builder/profile/' . $request->user_id);
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


    public function previewResume($id = null){
        $resume = DB::table('resume')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->first();
        $education = DB::table('education')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->get();

        $workExperience = DB::table('work_experience')
                    ->select('*')
                    ->where('user_id',$id)
                    ->where('builder','yes')
                    ->get();

        $projects = DB::table('projects')
                     ->select('*')
                    ->where('user_id',$id)
                    ->get();
       
        $data = array(
            'resume'  => $resume,
            'education' => $education,
            'works' => $workExperience,
            'projects' => $projects,
            'summary' => $resume->summary
        );
        $templateChosen = $resume->selected_template;

        $html = view('pdfs.resumes.resume-template-'.$templateChosen)->with($data)->render();
        $pdf = new Dompdf();

        $pdf->loadHtml($html);

        $pdf->render();
        return $pdf->stream($resume->student_name. '.pdf',array('Attachment'=> 0));
    }
}

