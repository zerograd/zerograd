<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Dompdf\Dompdf;
use URL;

class StudentController extends Controller
{
    //
    public function index(){
    	return view('logins.student-login');
    }

    public function logout(){
        Session::forget('user_id');
        Session::forget('student_name');
        Session::forget('email');
        return redirect('/newtheme');
    }


    public function getRegister(){
        $data = array(

        );

        return view('registrations.student')->with($data);
    }

    public function postRegister(Request $request){
        $count = DB::table('students')->where('email',$request->email)->count();
        if($count > 0){
            Session::flash('user_exists','User already Exists');
            return redirect('/my-account'. '#tab2');
        }else if($request->password1 != $request->password2) {
            Session::flash('password_match','Passwords do not match');
            return redirect('/my-account'. '#tab2');
        }

        $requestData = $request->except('_token','project_id','password1','password2');
        $requestData['password'] = $request->password1;
        $previousInsertId;
        foreach( $requestData as $key=>$value){
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

         $hash = md5( rand(0,1000) );
        DB::table('students')
                    ->where('student_id',$previousInsertId)
                    ->update(array(
            "verifyKey" => $hash
        ));

        //Send Email

            $emailer = new EmailController();
            $emailer->send($request,$hash);


        Session::flash('email_sent','Confirmation email sent');
        return redirect('/');

    }

    public function verifyLogin(Request $request){
    	$student = DB::table('students')
	    		->select('*')
	    		->where('email',$request->email)
	    		->where('password',md5($request->password))
	    		->first();

        $passwordWasReset = DB::table('students')
                ->select('*')
                ->where('email',$request->email)
                ->where('passwordReset',$request->password)
                ->first();

        if($passwordWasReset){
            Session::put('logged','yes');
            Session::put('user_id',$passwordWasReset->student_id);
            Session::put('student_name',$passwordWasReset->student_name);
            Session::put('email',$passwordWasReset->email);


            //Update last login 
            DB::table('students')
                ->where('student_id',$passwordWasReset->student_id)
                ->update(array(
                    'last_login' => date("Y-m-d H:i:s")
                ));

            return "success";
        }

        if(!$student){
            return "Login failed.Please try again";
        }
        if($student->verified != 1){
            return 'Please verify your account using the email that was sent to you';
        }
	    if(sizeof($student) > 0 or sizeof($passwordWasReset) > 0){
            Session::put('logged','yes');
	    	Session::put('user_id',$student->student_id);
	    	Session::put('student_name',$student->student_name);
	    	Session::put('email',$student->email);


            //Update last login 
            DB::table('students')
                ->where('student_id',$student->student_id)
                ->update(array(
                    'last_login' => date("Y-m-d H:i:s")
                ));

	    	return "success";
	    }else{
	    	return "login failed.Try Again";
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
        

        $appliedTo = DB::table('applied_to')
                        ->select('applied_to.posting_id','applied_to.created','postings.title','companies.company_name',DB::raw('companies.id as companyID'))
                        ->join('postings','postings.id','=','applied_to.id')
                        ->join('companies','companies.id','=','applied_to.company_id')
                        ->where('user_id',Session::get('user_id'))
                        ->get();


                //Timeline : for now connections only

        

        $notifications = $this->getNotifications();
        
                $data = array(
            'searches' => $searches,
            'opportunities' => $opportunities,
            'id' => Session::get('user_id'),
            'notifications' => $notifications['post_notifications'],
            'notificationsSize' => sizeof($notifications['post_notifications']),
            'appliedTo' => $appliedTo
        );


        // return $data;
    	return view('homepages.student')->with($data);
    }

    public function profile($id = null){

       
        $data = array(

        );
        

    	return view('profile')->with($data);
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
       
        $data = array(
            'student' => $student,
            'resume'  => $resume,
            'education' => $education,
            'works' => $workExperience,
            'summary' => isset($resume->summary)?$resume:$summary,
        );
        $templateChosen = $resume->selected_template;

        $html = view('templates.resume-template-'.$templateChosen)->with($data)->render();
        $pdf = new Dompdf();

        $pdf->loadHtml($html);

        $pdf->render();
        return $pdf->stream($student->student_name. '.pdf',array('Attachment'=> 0));
    }

    public function publicProfile($id = null){
        
        $student = DB::table('students')
                        ->select('students.title','students.status','students.website','profile_summary.*','profile_skills.skills')
                        ->join('profile_summary','profile_summary.user_id','=','students.student_id')
                        ->join('profile_skills','profile_skills.user_id','=','students.student_id')
                        ->where('student_id',$id)
                        ->first();

        //If student does not exist redirect to 404

        if(!$student){
            return view('errors.404');
        }

        //Path to image
        $path = '';
        if($student->avatar){
         $path = asset('storage/avatars/' . $student->avatar);
        }else{
            $path = URL::asset('images/resumes-list-avatar-01.png');
        }
        $data = array(
            'student' => $student,
            'path' => $path,
            'id' => $id
        );

        if(!Session::has('user_id') && !Session::has('employer_id')){
            return view('public-profile')->with($data);
        }

        // return $data;
        return view('profile')->with($data);
    }

    public function publicProfileEdit($id = null){


        $student = DB::table('students')
                        ->select('students.title','students.status','students.website','profile_summary.*','profile_skills.skills')
                        ->join('profile_summary','profile_summary.user_id','=','students.student_id')
                        ->join('profile_skills','profile_skills.user_id','=','students.student_id')
                        ->where('student_id',$id)
                        ->first();

        //If student does not exist redirect to 404

        if(!$student){
            return view('errors.404');
        }

        if(Session::has('user_id') && Session::get('user_id') == $id){
            //do nothing
        }else if(!Session::has('user_id') || !Session::has('employer_id')){
            Session::flash('no_permission','You do not have permission to edit this page');
            return redirect('/');
        }else if(Session::get('user_id') != $id){
            Session::flash('no_permission','You do not have permission to edit this page');
            return redirect('/');
        }

        

        //Path to image
        $path = '';
        if($student->avatar){
         $path = asset('storage/' . $student->avatar);
        }else{
            $path = URL::asset('images/resumes-list-avatar-01.png');
        }
        $data = array(
            'student' => $student,
            'path' => $path
        );

        

        // return $data;
        return view('edit-profile')->with($data);
    }

    public function uploadImage(Request $request){

        $path = null;

        //If image was uploaded and is a valid image 
        if($request->file('res_file')){
            $fileType = $request->file('res_file')->getMimeType();

            if($fileType == 'image/jpeg' || $fileType = 'image/png'){

                //Upload so the image will be available via public 
                $path = $request->file('res_file')->store('avatars','public');

                DB::table('profile_summary')
                    ->where('id',Session::get('user_id'))
                    ->update(array(
                        'avatar' => $path
                    ));
            }else{
                Session::flash('res_image','Not a valid image type');
                return redirect('/profile/' . Session::get('user_id') . '/edit');
            }
        }

         Session::flash('profile_updated','Profile Updated.');
        return redirect('/profile/' . Session::get('user_id') . '/edit');
    }

    public function publicProfileUpdate(Request $request){
        $name = $request->name;
        $summary = $request->summary;
        $status = $request->status;
        $title = $request->title;
        $email = $request->email;
        $website = $request->website;

        $user_id = Session::get('user_id');

        //Update profile
        DB::table('profile_summary')
            ->where('user_id',$user_id)
            ->update(array(
                'summary' => $summary,
                'email' => $email,
                'name' => $name,
            ));
        DB::table('profile_skills')
            ->where('user_id',$user_id)
            ->update(array(
                'skills' => $request->skills
            ));
        //Update student status and title
        DB::table('students')
            ->where('student_id',$user_id)
            ->update(array(
                'status' => $status,
                'title' => $title,
                'website' => $website
            ));

        return "Success";
    }

    public function getSettings(){

        if(!Session::has('user_id')){
            return redirect('/');
        }

        $data = array(

        );

        return view('student-settings')->with($data);
    }

    public function updatePersonalInfo(Request $request){
        foreach($request->except('_token') as $key=>$value){
            DB::table('students')
            ->where('student_id',Session::get('user_id'))
            ->update(array(
                "$key" => $value
            ));
        }

        Session::put('student_name',$request->student_name);
        Session::put('email',$request->email);
        Session::flash('info_updated','Info updated');
        return redirect('/settings');
    }

    public function updatePassword(Request $request){
        $password = trim($request->password);
        $confirmpassword = trim($request->confirmpassword);

        if($password !== $confirmpassword){
            Session::flash('password_match','Password do not match');
            return redirect('/settings');
        }

        DB::table('students')
            ->where('student_id',Session::get('user_id'))
            ->update(array(
                'password' => md5($password)
            ));

        Session::flash('password_update','Password updated.');
        return redirect('/settings');
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

    //NEw theme functions
    public function myAccount(){
        $data = array(

        );

        return view('my-account')->with($data);
    }
    
    public function dashboard(){
        $data = array(

        );

        return view('dashboard')->with($data);
    }

    public function jobAlerts(){

        if(!Session::has('user_id')){
            Session::flash('message','Register to access this feature.');
            return redirect(route('my-account'). '#tab2');
        }

        $alerts = DB::table('job_alerts')
                    ->select('*')
                    ->where('user_id',Session::get('user_id'))
                    ->get(); 

        $frequency = array(
            'Daily' => 'Daily',
            'Weekly' => 'Weekly',
            'Fortnightly' => 'Fortnightly',
        );

        $status = array(
            'Full-Time' => 'Full-Time',
            'Part-Time' => 'Part-Time',
            'Internship' => 'Internship',
            'Freelance' => 'Freelance',
            'Temporary' => 'Temporary'
        );

        
                    

        $data = array(
            'alerts' => $alerts,
            'alertSize' => sizeof($alerts),
            'frequency' => $frequency,
            'status' => $status
        );

        return view('job-alerts')->with($data);
    }

    public function createJobAlerts(Request $request){
        DB::table('job_alerts')
            ->insert(array(
                'name' => $request->name,
                'keywords' => $request->keywords,
                'location' => $request->location,
                'frequency' => $request->frequency,
                'status' => $request->status,
                'user_id' => Session::get('user_id')
            )); 
        return redirect('job-alerts');
    }

    public function updateJobAlerts(Request $request){
        foreach($request->except('_token','id') as $key=>$value){
             DB::table('job_alerts')
                ->where('id',$request->id)
                ->update(array(
                    "$key" => $value
                ));
        }
        return "Saved";    
    }

    public function deleteJobAlerts(Request $request){
        DB::table('job_alerts')
            ->where('id',$request->id)
            ->delete();

        return url('/job-alerts');
    }

    public function seenJob(Request $request){
        $currentValue = DB::table('students')
                         ->select('seen')
                         ->where('student_id',Session::get('user_id'))
                         ->first()->seen;

         //update value
        DB::table('students')
            ->where('student_id',Session::get('user_id'))
            ->update(array(
                'seen' => $currentValue + 1
        ));
    }
}
