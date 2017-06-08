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


    public function getRegister(){
        $data = array(

        );

        return view('registrations.student')->with($data);
    }

    public function postRegister(Request $request){
        $count = DB::table('students')->where('email',$request->email)->count();
        if($count > 0){
            return "User Already Exist";
        }

        $previousInsertId;
        foreach($request->except('_token','project_id') as $key=>$value){
             if(!isset($previousInsertId)){//Create if doesn't exist
                
                    $previousInsertId = DB::table('students')->insertGetId(array(
                            "$key" => "$value"
                        )
                    );
                
            }else{
                  if($key == 'password'){
                        DB::table('students')
                    ->where('student_id',$previousInsertId)
                    ->update(array(
                        "$key" => md5($value)
                    ));
                  }else{
                    DB::table('students')
                    ->where('student_id',$previousInsertId)
                    ->update(array(
                        "$key" => "$value"
                    ));
                  }
            }
        }

        DB::table('resume')
            ->insert(array(
                'user_id' => $previousInsertId
            ));

        DB::table('profile_projects')
            ->insert(array(
                'user_id' => $previousInsertId
            ));

        DB::table('profile_skills')
            ->insert(array(
                'user_id' => $previousInsertId
            ));

        DB::table('profile_summary')
            ->insert(array(
                'user_id' => $previousInsertId
            ));
        

        return "success";

    }

    public function verifyLogin(Request $request){
    	$student = DB::table('students')
	    		->select('*')
	    		->where('email',$request->email)
	    		->where('password',md5($request->password))
	    		->first();

	    if(sizeof($student) > 0){
            Session::put('logged','yes');
	    	Session::put('user_id',$student->student_id);
	    	Session::put('student_name',$student->student_name);
	    	Session::put('email',$student->email);
	    	return "success";
	    }else{
	    	return "failed";
	    }
    }

    public function getSumUnseen($obj){
        $sum = 0;
        foreach($obj as $o){
            if($o->seen == 'no'){
                $sum++;
            }
        }
        return $sum;
    }

    public function getNotifications(){
        $get_notifications = DB::table('notifications')
                            ->select('*')
                            ->where('user_id',Session::get('user_id'))
                            ->orderBy('created','DESC')
                            ->take(4)
                            ->get();

        $post_notifications = array();

        foreach ($get_notifications as $notification){
            if($notification->type_id == 1){//friend request
               $request =  DB::table('friend_request')
                    ->select(DB::raw('friend_request.*'),'students.student_name','students.student_id')
                    ->join('students','students.student_id','=','friend_request.user_id')
                    ->where('id',$notification->friend_request_id)
                    ->first();
                if(isset($request)){
                    $request->notification_id = $notification->id;
                    $request->type = 1;
                    array_push($post_notifications,$request);
                }
            }else if($notification->type_id == 2){
                $request =  DB::table('friends')
                    ->select(DB::raw('friends.*'),'students.student_name','students.student_id')
                    ->join('students','students.student_id','=','friends.friend_id')
                    ->where('user_id',Session::get('user_id'))
                    ->first();
                $request->notification_id = $notification->id;
                $request->type = 2;
                $request->seen = 'no';
                array_push($post_notifications,$request);
            }else if($notification->type_id == 3){
                $request =  DB::table('friends')
                    ->select(DB::raw('friends.*'),'students.student_name','students.student_id')
                    ->join('students','students.student_id','=','friends.friend_id')
                    ->where('id',$notification->friend_request_id)
                    ->first();
                $request->notification_id = $notification->id;
                $request->type = 3;
                $request->seen = 'no';
                array_push($post_notifications,$request);
            }
        }

        return array(

            'post_notifications' => $post_notifications
        );
    }

    public function home(){
        $searches = DB::table('user_history')
                        ->select('searches')
                        ->where('user_id',Session::get('user_id'))
                        ->orderBy('search_time','DESC')
                        ->take(4)
                        ->get();

        
                            
        $keywords = array();
        foreach($searches as $search){
            array_push($keywords,explode(',',$search->searches));
        }
        $keywords = array_flatten($keywords);

        //Get Posting keywords
        $postings = DB::table('postings')
                    ->select('*')
                    ->orderBy('posted_date','DESC')
                    ->take(4)
                    ->get();

        $opportunities = array();
        $threshold = 1 ; //Posting contains at least 1 word
        foreach($postings as $posting){
            $keywordsArray = explode(",",$posting->keywords);
            $currentCount = 0;
            foreach($keywords as $keyword){
                if(in_array($keyword, $keywordsArray)) $currentCount++;
            }
            if($currentCount >= $threshold){
                array_push($opportunities,$posting);
            }

        }
        

        

        
        //Timeline : for now connections only

        

        $notifications = $this->getNotifications();
        
                $data = array(
            'searches' => $searches,
            'opportunities' => $opportunities,
            'id' => Session::get('user_id'),
            'notifications' => $notifications['post_notifications'],
            'notificationsSize' => sizeof($notifications['post_notifications'])
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

        $notifications = $this->getNotifications();
        $post_notifications = $notifications['post_notifications'];

        $data = array(
            'educations' => $education,
            'resume' => $resume,
            'profileSummary' => $profileSummary,
            'resumeSkills' => $resumeSkills,
            'skills' => $skills,
            'profileProjects' => $profileProjects,
            'workExperience' => $workExperience,
            'volunteering' => $volunteering,
            'id' => $id,
            'notifications' => isset($post_notifications)?$post_notifications:"",
            'notificationsSize' => isset($post_notifications)?sizeof($post_notifications):"",
            'sumOfUnSeen' => $this->getSumUnseen($post_notifications),
            'timeline' =>$notifications['timeline']
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
        foreach($request->except('_token','project_id') as $key=>$value){
                DB::table('resume')
                ->where('user_id',$request->user_id)
                ->update(array(
                    "$key" => "$value"
                ));
        }
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

        //Default no for public reason
        $friend = 'no';

        $friends = DB::table('friends')
                    ->select('*')
                    ->where('user_id',Session::get('user_id'))
                    ->orWhere('friend_id',Session::get('user_id'))
                    ->count();

        if($friends > 0) $friend = "yes";
        $data = array(
            'user' => $user,
            'educations' => $educations,
            'skills' => $skills,
            'projects' => $projects,
            'friend' => $friend
        );

        
        return view('student')->with($data);
    }

    public function sendRequest(Request $request){

        if(!Session::has('user_id')){
            return "Login";
        }

        $from = Session::get('user_id');
        $to = $request->id;

        //add temporarily to table
        $friendID = DB::table('friend_request')->insertGetId(array(
                            "user_id" => $from,
                            'friend_id' => $to
        ));

        //send the notification
        DB::table('notifications')
            ->insert(array(
                'user_id' => $to,
                'type_id' => 1,
                'friend_request_id' => $friendID
        ));

    }

    public function acceptRequest(Request $request){
        $from = $request->id;
        $currentUser = Session::get('user_id');
       $firstID = DB::table('friends')
            ->insertGetId(array(
                            "user_id" => $from,
                            'friend_id' => $currentUser
        ));
       $secondID  =     DB::table('friends')
            ->insertGetId(array(
                            "user_id" => $currentUser,
                            'friend_id' => $from
        ));
        DB::table('friend_request')
            ->where('user_id',$currentUser)
            ->where('friend_id',$from)
            ->delete();
        DB::table('friend_request')
            ->where('user_id',$from)
            ->where('friend_id',$currentUser)
            ->delete();


        //send the notification
        
        DB::table('notifications')
            ->insert(array(
                'user_id' => $from,
                'type_id' => 2
        ));
            DB::table('notifications')
            ->insert(array(
                'user_id' => $currentUser,
                'type_id' => 3,
                'friend_request_id' => $secondID
        ));
            DB::table('notifications')
            ->insert(array(
                'user_id' => $from,
                'type_id' => 3,
                'friend_request_id' => $firstID

        ));
    }

    public function seenNotification(Request $request){
        DB::table('notifications')
            ->where('id',$request->id)
            ->update(array(
                'seen' => 'yes'
            ));
    }
}
