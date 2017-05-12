<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Session;
use Dompdf\Dompdf;
use Faker\Factory as Faker;
use DateTime;

class SeedController extends Controller
{
    //seed students
    public function seedStudents(){
    	$faker = Faker::create();
    	$date = new DateTime();
    	foreach(range(1,20) as $index){
    		DB::table('students')->insert(array(
    			'email' => $faker->email,
    			'password' => md5("sample"),
    			'student_name' => $faker->name,
    			'last_login' => $date->format('Y-m-d H:i:s')
			));
    	}
    	echo "Complete";
    }

    public function seedCompanies(){
    	$faker = Faker::create();
    	foreach(range(1,20) as $index){
    		DB::table('companies')->insert(array(
    			'company_name' => $faker->company . $faker->companySuffix,
    			'company_overview' => $faker->text($maxNbChars = 200),
    			'company_email' => $faker->companyEmail ,
    			'company_location' => $faker->city,
    			'verified' =>  $faker->randomElement($array = array ('Yes','No')),
    			'company_phone' => $faker->phoneNumber,
    			'contact' => $faker->name,
    			'followers' => $faker->numberBetween($min = 1000, $max = 1000000),
    			'employees' => $faker->numberBetween($min = 1, $max = 400) ,
    			'jobs_avaliable' => $faker->numberBetween($min = 1, $max = 30) ,
			));
    	}
    	echo "Complete";
    }


    public function seedEducation(){
    	$faker = Faker::create();
    	$url = 'https://code.org/schools.json';

    	$json = json_decode(file_get_contents($url),true);
        $postSecondary = array();
    	foreach($json['schools'] as $school ){
    		if(in_array('College',$school['levels'])){
    			array_push($postSecondary, $school);
    		}
    	}

    	$temp = array_slice($postSecondary,0,10);

    	$ids = DB::table('students')->select('student_id')->get();


    	foreach($ids as $id){
    		$randonNumber = $faker->numberBetween($min = 0, $max = 9);
    		$school = $temp[$randonNumber];
    		DB::table('education')->insert(array(
    			'school' => $school['name'],
    			'start' =>$faker->numberBetween($min = 2000, $max = 2017) , 
    			'completed' => $faker->numberBetween($min = 2000, $max = 2017),
    			'user_id' => $id->student_id,
    			'program' => ''
			));
    	}
    	echo "Completed";
    	
    }

    public function seedPostings(){
    	$faker = Faker::create();

    	$ids = DB::table('companies')->select('id')->get();

    	foreach($ids as $id){
    		DB::table('postings')->insert(array(
    			'title' => $faker->jobTitle,
    			'company_id' => $id->id,
    			'description' => $faker->text($maxNbChars = 200),
    			'keywords' => implode(',',$faker->words($nb = 3, $asText = false)),
    			'posted_date' => '2017-04-28',
    			'required_experience' => $faker->numberBetween($min = 1, $max = 3),
    			'location' => $faker->city
			));
    	}

    	echo "completed postings";
    }
}
