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
							->get();

		$data = array(
			'applicant' => $applicant,
			'searchHistory' => $searchHistory,
			'historySize' => sizeof($searchHistory)
		);

		return view('admin.show-applicant')->with($data);
    }
}
