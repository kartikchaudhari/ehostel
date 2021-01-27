<?php
	include "Database.php";
	include "libs/FCM.php";
	
	/********************************* Common Functions ************************************/
	/*set application/json header*/
	function put_header_json(){
		return header("Content-Type:application/json");
	}

	/*convert date into mm-dd-YYYY format*/
	function format_date($date){	
		return date('Y-m-d',strtotime($date));
	}

	/*fetch hostel admission start and end date*/
	function pull_hostel_regisration_dates(){
		$sql="SELECT registration_start, registration_end FROM eh_settings";
		$query=mysqli_query(Database::getConnection(),$sql);
		$result=mysqli_fetch_assoc($query);

		return $result;
	}


	/*is record exist*/
	function isExist($column,$value,$table){
		$sql="SELECT $column FROM $table WHERE $column='$value'";
		$query=mysqli_query(Database::getConnection(),$sql);
		$count=mysqli_num_rows($query);
		if ($count>0) 
			return true; //record exist
		else
			return false; //new record

	}

	/*to pass forbidden message in json response*/
	function forbidden(){
		$status=false;
		$message="Forbidden ! you are not allowed to access this section.";
		echo json_encode(array('status'=>$status,'message'=>$message));
	}

	function DocRoot($str){
		$data=explode('/',$str);
		return $data[1];
	}

	function base_url($str){
		return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".DocRoot($_SERVER['REQUEST_URI'])."/".$str;
	}

	/*clean up the user data*/
	function clean($msg,$connection=null) {
		$msg = @trim($msg);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($msg);
			$str=strip_tags($str);
		}
		
		//if string is gonna insert into database
		if($connection!=null){
			return strip_tags(mysqli_real_escape_string($msg));
		}
		//else dont not use
		else{
			return strip_tags($msg);
		}
	}

	/*html content encoder*/
	function html_encoder($str){
		return htmlspecialchars(htmlentities($str),ENT_QUOTES);
	}

	/*html content decoder*/
	function html_decoder($str){
		return htmlspecialchars_decode(html_entity_decode($str));
	}

	/********************************* Common Functions Ends************************************/


	/********************************* Student Functions ************************************/
	function isStudentExist($enrollment,$email){
		$sql="SELECT email,enrollment FROM eh_students WHERE email='$email' AND enrollment='$enrollment'";
		$query=mysqli_query(Database::getConnection(),$sql);
		$count=mysqli_num_rows($query);
		if ($count>0) 
			return true; //record exist
		else
			return false; //new record

	}

	function isStudentAcountActivated($enrollment,$email){
		$sql="SELECT account_status FROM eh_students WHERE email='$email' AND enrollment='$enrollment'";
		$query=mysqli_query(Database::getConnection(),$sql);
		$result=mysqli_fetch_assoc($query);
		if($result['account_status']==1)
			return true; //account activated
		else
			return false; //account not activated

	}

	/*create student's directories in uploads*/
	function make_student_dir($enrollment){
		require "constants.php";
		try{
			if(mkdir($student_avatar_dir."/$enrollment",2) 
				&& mkdir($student_docs_dir."/$enrollment",2)
				&& mkdir($student_receipts_dir."/$enrollment",2)){
				return true;
			}
			else{
				return false;
			}
		}
		catch(Exception $e){
			return false;
			//echo $e->getMessage();
		}
	}

	/*************************************** security guard functions ******************************/
	function to_hotel_block_name($block_id){
		$sql="SELECT block_name FROM eh_blocks WHERE block_id=$block_id";
		$query=mysqli_query(Database::getConnection(),$sql);
		$result=mysqli_fetch_assoc($query);

		return $result['block_name'];
	}

	/****************** firebase notifications ***********************/

function pull_device_tokens($table){
	
	switch ($table) {
		case "student": //student
			$sql="SELECT device_token FROM eh_students";
		break;

		case "warden": //warden
			$sql="SELECT device_token FROM eh_wardens";	
		break;

		case "guard": //security guards
			$sql="SELECT device_token FROM eh_security_guards";
		break;

		case "admin": //security guards
			$sql="SELECT device_token FROM eh_admin";
		break;
	}

	$query=mysqli_query(Database::getConnection(),$sql);
	$tokens=array();
	
	while($devices=mysqli_fetch_assoc($query)){
		
		//take only valid tokens
		if(strlen($devices['device_token'])>100){
			array_push($tokens, $devices['device_token']);	
		}
	}
	return $tokens;
}

/*send firebse notification*/
function send_push($message,$title,$actor){
	$notification= array();			
	$notification["message"] =$message;
	$notification["title"] = $title;
	$notification["vibrate"]=1;
	$notification["sound"] = "default";
	$notification["type"] = 1;

	$fcm = new FCM();
	
	//send push
	$fcm->send_notification(pull_device_tokens($actor), $notification,"Android");

	/* for debugging purpose only
	$result = $fcm->send_notification(pull_student_device_tokens(), $notification,"Android");
	print_r($result);*/
}

/*send push to single device*/
function send_push_single($data){
	$notification= array();			
	$notification["message"] =$data['message'];
	$notification["title"] = $data['title'];
	$notification["vibrate"]=1;
	$notification["sound"] = "default";
	$notification["type"] = 1;

	$fcm = new FCM();
	
	//send push
	$fcm->send_notification($data['device_token'], $notification,"Android");
	// $result = $fcm->send_notification($data['device_token'], $notification,"Android");
	// echo json_encode($result);	
}

/****************** firebase notifications ***********************/