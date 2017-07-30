<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;
use File;

class AdminController extends Controller
{
    //

    public function index(){
    	$data = array(

		);

		return view('admin.home');
    }

    public function manageUsers(Request $request){

    	$data = array();

    	if($request->maximize){


    		//Admin Users

    		$adminUsers = DB::table('admin_users')
    						->select('admin_users.name','admin_users.id','admin_permissions.role')
    						->join('admin_permissions','admin_permissions.admin_perm_id','=','admin_users.role_id')
    						->get();

    		$data = array(
    			'maximize' => 'maximize',
    			'emailExist' => isset($request->email_exist)?$request->email_exist:null,
    			'adminUsers' => $adminUsers
			);
	    	
    	}else{
    		$data = array(
    			'maximize' => 'minimize'
			);
    	}

    	return view('admin.sub-manage-user')->with($data);

    	
    }

 

    public function generatePassword(Request $request){

    	$salt = '$2y2';

    	$hash = md5( rand(0,1000) );

    	$hash = $salt . $hash . $salt;

    	$exist = DB::table('admin_users')
    		->select('*')
    		->where('password',$hash)
    		->count();
		if($exist == 0){
			return $hash;
		}
	}

	public function create(Request $request){
		$email = $request->email;
		$emailExist = DB::table('admin_users')->select('*')->where('email',$email)->count();
		if($emailExist > 0){

			Session::flash('email_exist','This email already Exist');
			return redirect('/admin/home');
		}

		DB::table('admin_users')
			->insert(array(
				'name' => $request->name,
				'password' => $request->password,
				'role_id' => $request->role_id,
				'email' => $request->email
			));
		Session::flash('user_created','New User created');
		return redirect('/admin/home');
	}

	public function edit(Request $request){

		$adminUser = DB::table('admin_users')
    						->select('admin_users.name','admin_users.id','admin_permissions.role','admin_users.email','admin_users.role_id')
    						->join('admin_permissions','admin_permissions.admin_perm_id','=','admin_users.role_id')
    						->where('admin_users.id',$request->id)
    						->first();
		$roles = DB::table('admin_permissions')
					->select('*')
					->get();

		$data = array(
			'adminUser' => $adminUser,
			'roles' => $roles
		);
		return view('admin.show-existing-user')->with($data);
	}

	public function update(Request $request){
		$id = $request->id;

		DB::table('admin_users')
			->where('id',$id)
			->update(array(
				'name' => $request->name,
				'password' => $request->password,
				'role_id' => $request->role_id,
				'email' => $request->email
			));

		Session::flash('user_updated','User updated.');
		return redirect('/admin/home');
	}

	public function manageApplicants(Request $request){

    	$data = array();

    	if($request->maximize){


    		//Applicants

			$applicants = DB::table('students')
								->select('students.student_name','students.student_id')
								->orderBy('student_name','ASC')
								->get();

    		$data = array(
    			'maximize' => 'maximize',
    			'emailExist' => isset($request->email_exist)?$request->email_exist:null,
    			'applicants' => $applicants
			);
	    	
    	}else{
    		$data = array(
    			'maximize' => 'minimize'
			);
    	}

    	return view('admin.sub-manage-applicants')->with($data);

    	
    }

    public function editApplicant(Request $request){
    	$applicant = DB::table('students')
    					->select('students.student_name','students.student_id','students.email','students.last_login','students.linkedin','students.title')
    					->where('student_id',$request->id)
    					->first();

		$searchHistory = DB::table('user_history')
							->select('*')
							->where('user_id',$request->id)
							->take(4)
							->get();

		$data = array(
			'applicant' => $applicant,
			'searchHistory' => $searchHistory,
			'historySize' => sizeof($searchHistory)
		);

		return view('admin.show-applicant')->with($data);
    }

    public function resetPassword(Request $request){
    	$newPassword = md5( rand(0,1000) );

    	DB::table('students')
    		->where('student_id',$request->id)
    		->update(array(
    			'password' => $newPassword,
    			'passwordReset' => $newPassword
			));


		$email  = DB::table('students')->select('email')->where('student_id',$request->id)->first()->email;
		//Send the Email 

		$emailer = new EmailController();
        $emailer->adminPasswordReset($email,$newPassword);
    }

    public function deleteApplicant(Request $request){
    	DB::table('students')
    		->where('student_id',$request->id)
    		->delete();

		Session::flash('applicant_delete','Applicant has been deleted');
    }

    public function updateApplicant(Request $request){
    	$id = $request->id;

    	// ->select('students.student_name','students.student_id','students.email','students.last_login','students.linkedin','students.title')
    	DB::table('students')
    		->where('student_id',$id)
    		->update(array(
    			'student_name' => $request->student_name,
    			'email' => $request->email,
    			'linkedin' => $request->linkedin,
    			'title' => $request->title,
			));

		Session::flash('applicant_updated','Applicant has been updated.');
		return redirect('/admin/home');
    }

    // Manage Companies Functions

    public function manageCompanies(Request $request){

    	$data = array();

    	if($request->maximize){


    		//Applicants

			$companies = DB::table('companies')
								->select('companies.company_name','companies.id')
								->orderBy('company_name','ASC')
								->get();

    		$data = array(
    			'maximize' => 'maximize',
    			'emailExist' => isset($request->email_exist)?$request->email_exist:null,
    			'companies' => $companies
			);
	    	
    	}else{
    		$data = array(
    			'maximize' => 'minimize'
			);
    	}

    	return view('admin.sub-manage-companies')->with($data);

    	
    }

    public function editCompany(Request $request){
    	$company = DB::table('companies')
    					->select('companies.company_name','companies.company_email','companies.contact','companies.company_phone','companies.company_location','companies.id','companies.company_overview')
    					->where('id',$request->id)
    					->first();

		$data = array(
			'company' => $company
		);

		return view('admin.show-company')->with($data);
    }

    public function sendCompanyPassword(Request $request){

    	$id = $request->id;

    	DB::table('companies')
    		->where('id',$id)
    		->update(array(
    			'password' => md5($request->password)
			));


    	$emailer = new EmailController();
        $emailer->sendEmployerPassword($request,$request->password);
    }

    public function deleteCompany(Request $request){
    	DB::table('companies')
    		->where('id',$request->id)
    		->delete();

		Session::flash('company_delete','Company has been deleted');
    }

    public function selectedPricing(Request $request){
    	DB::table('companies')
    		->where('id',$request->id)
    		->update(array(
    			'pricing' => $request->title
			));

		return 'Pricing Info Confirmed.';
    }

    public function updateCompany(Request $request){

    	foreach($request->except('_token','id') as $key=>$value){
    			DB::table('companies')
    				->where('id',$request->id)
    				->update(array(
    					"$key" => $value
					));
    	}

		Session::flash('company_updated','Company Profile Updated!');
		return redirect('/admin/home');
    }

    //Manage Resources Functions

    public function manageResources(Request $request){
    	$data = array();

    	if($request->maximize){


    		//Resources

    		$data = array(
    			'maximize' => 'maximize',
    			'emailExist' => isset($request->email_exist)?$request->email_exist:null
			);
	    	
    	}else{
    		$data = array(
    			'maximize' => 'minimize'
			);
    	}

    	return view('admin.sub-manage-resources')->with($data);
    }

    public function createResource(Request $request){

    	$path = null;

    	//If image was uploaded and is a valid image 
    	if($request->file('user_file')){
    		$fileType = $request->file('user_file')->getMimeType();

    		if($fileType == 'image/jpeg' || $fileType = 'image/png'){

    			//Upload so the image will be available via public 
    			$path = $request->file('user_file')->store('resources','public');
    		}else{
    			Session::flash('res_image','Not a valid image type');
    			return redirect('/admin/home');
    		}
    	}

    	//If image was uploaded, upload the rest by id
    	if($path != null){
    		DB::table('resources')
    		->insert(array(
    			'res_title' => $request->res_title,
    			'sub_title' => $request->sub_title,
    			'quote' => $request->quote,
    			'res_image' => $path
			));
    	}else{
    		DB::table('resources')
    		->insert(array(
    			'res_title' => $request->res_title,
    			'sub_title' => $request->sub_title,
    			'quote' => $request->quote
			));
    	}

    	

		Session::flash('res_created','Resource: "' . $request->res_title . '" created.');
		return redirect('/admin/home');
    }

    public function editResource(Request $request){

    }

    public function deleteResource(Request $request){

    }

    public function updateResource(Request $request){

    }
}
