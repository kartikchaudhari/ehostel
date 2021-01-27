<?php 
include __DIR__ . "/../libs/FCM.php";
include "Database.php";
function alert_style($type,$message){
		$msg='';
		switch ($type) {
			case 'success':
				$msg.='<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    .$message.
                    '</div>';
			break;

			case 'info':
				$msg.='<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    .$message.
                    '</div>';
			break;

			case 'warning':
				$msg.='<div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    .$message.
                    '</div>';
			break;
			
			case 'danger':
				$msg.='<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    .$message.
                    '</div>';
			break;
			
			
			default:
				$msg.='<div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    .$message.
                    '</div>';
			break;

		}
		return $msg;
}

function object_status($status){
	$html='';
	switch ($status) {
		case 0: //deactive
		{
			$html='<span class="label label-danger">Deactive</span>';
		}
		break;
		case '1'://active
			$html.='<span class="label label-success">Active</span>';
		break;	
	}
	return $html;
}

function request_status($status){
	switch ($status) {
		case 0:
			echo '<span class="label label-info">Not Accepted</span>';	
		break;
		
		case 1:
			echo '<span class="label label-success">Approved</span>';
		break;

		case 2:
			
		break;

		case 3:
			echo '<span class="label label-warning">Request blocked</span>';
		break;

		case 4:
			echo '<span class="label label-danger">Request Rejected</span>';
		break;
	}
}

function title($title){
	return "<title>".$title."</title>";
}

function DocRoot($str){
	$data=explode('/',$str);
	return $data[1];
}

function base_url($str){
	return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".DocRoot($_SERVER['REQUEST_URI'])."/".$str;
}

function is_logged_in($user_type){
	switch ($user_type) {
		case 'admin':
			if (!isset($_SESSION['id'])) {
				header("Location:".base_url('admin/login.php'));
			}
		break;
		
		case 'warden':
			if (!isset($_SESSION['w_id'])) {
				header("Location:".base_url('warden/login.php'));
			}
		break;

		case 'student':
			if (!isset($_SESSION['st_id'])) {
				header("Location:".base_url('students/login.php'));
			}
		break;
		default:
			# code...
			break;
	}
}



function pull_hostel_by_id($info_id){
    $sql="SELECT * FROM `eh_hostel_info` WHERE info_id=$info_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data['hostel_name'];
    }
}

function pull_hostel_block_by_id($block_id){
    $sql="SELECT * FROM `eh_blocks` WHERE block_id=$block_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data['block_name'];
    }
}


function pull_cast_by_id($cast_id){
    $sql="SELECT * FROM eh_student_cast WHERE cast_id=$cast_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data['cast_name'];
    }
}

function pull_dept_by_id($dept_id){
    $sql="SELECT * FROM eh_departments WHERE dept_id=$dept_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data['dept_name'];
    }
}

function has_dept_set($dept_id){
    $sql="SELECT * FROM eh_departments";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    $a=array();
    
    if(@mysqli_num_rows($query_result)>0){
        while($row=mysqli_fetch_assoc($query_result)){
        	$a[$row['dept_id']]=$row['dept_name'];
        
        }
    }
	echo "<select class='form-control' name='dept' required='required'>";
	foreach ($a as $key => $value) {
		$bit='';
		if ($key==$dept_id) {
			$bit='selected';
		}
		echo "<option value='".$key."' ".$bit.">".$value."</option>";
	}
	echo "</select>";
}
	
function pull_role_by_id($role_id){
	$sql="SELECT * FROM eh_roles WHERE role_id=$role_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data['role_name'];
    }
}

function pull_warden_by_id($warden_id){
	$sql="SELECT * FROM eh_wardens WHERE warden_id=$warden_id";
    $query_result=mysqli_query(Database::getConnection(),$sql);
    if(@mysqli_num_rows($query_result)>0){
        $data=mysqli_fetch_assoc($query_result);
        return $data;
    }
}

function random_token(){
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    return substr(str_shuffle($str_result),0, 5); 
}


/*html content encoder*/
function html_encoder($str){
	return htmlspecialchars(htmlentities($str),ENT_QUOTES);
}

/*html content decoder*/
function html_decoder($str){
	return htmlspecialchars_decode(html_entity_decode($str));
}


/*html head content*/
function put_head($title,$css=null,$isDashboard){
echo '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>'.$title.'</title>
        <link rel="stylesheet" href="'.base_url('assets/css/css/bootstrap.css').'">
        <link rel="stylesheet" href="'.base_url('assets/css/sb-admin.css').'">
        
        <link rel="stylesheet" href="'.base_url('assets/font-awesome/css/font-awesome.min.css').'">';
	    if(is_array($css)){
	    	foreach ($css as $key => $value) {
	    		echo '<link rel="stylesheet" href="'.$value.'">';	    		
	    	}
	    }
	    else{
	    	echo '<style type="text/css">'.$css.'</style>';	
	    }

	    echo '</head>';
	    if($isDashboard==true){
	    	echo '<body style="margin-top:50px;">';
	    }
	    else{
	    	echo '<body>';
	    }
}

/*html footer content*/
function put_footer($isDashboard,$js=null){
	
	if($isDashboard==true){
		echo '<div class="navbar navbar-inverse navbar-bottom" style="margin-bottom: 0px;">
    		<div class="container-fluid">
        		<p class="navbar-text text-center" style="width:100%;">
        			<strong>eHostel Management System - Vishwakarma Government Engineering Collage, Chandkheda</strong>
        			<br>
        			<span>Last Updated at '.date("d/m/Y").'</span>
        		</p>
    		</div>
		</div>';
	}
	echo'
		<script src="'.base_url('assets/js/jquery.min.js').'"></script>
		<script src="'.base_url('assets/js/bootstrap.min.js').'"></script>
		<script src="'.base_url('assets/js/custom.js').'"></script>
		';
		
		if(is_array($js)){
	    	foreach ($js as $key => $value) {
	    		echo '<script src="'.$value.'"></script>';	    		
	    	}
	    }
	    else{
	    	echo $js;
	    }
	echo '</body>
	</html>';
}

function put_js(){
	echo'
		<script src="'.base_url('assets/js/jquery.min.js').'"></script>
		<script src="'.base_url('assets/js/bootstrap.min.js').'"></script>
		<script src="'.base_url('assets/js/custom.js').'"></script>
		';
}

/*draw breadrumb*/
function put_breadcrumbs($root,$child){
	$bc='<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="'.$root['url'].'">'.$root['text'].'</a></li>';
    if (is_array($child)) {
    	for($i=0;$i<count($child);$i++){
    		$bc.='<li class="breadcrumb-item"><a href="'.$child[$i]['url'].'">'.$child[$i]['text'].'</a></li>';
    	}
    }
    else{
    	$bc.='<li class="breadcrumb-item active" aria-current="page">'.$child.'</li>';
    }
            
        $bc.='</ol>
    </nav>';

    echo $bc;
}

/*create student's directories in uploads*/
function make_student_dir($enrollment){
	require "constants.php";
	try{
		if(mkdir($student_avatar_dir."/$enrollment",2) 
			&& mkdir($student_docs_dir."/$enrollment",2)
			&& mkdir($student_receipts_dir."/$enrollment",2)){
				
				echo "directory created";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
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


/* form resubmission preventer*/
function prevent_resubmission(){
	 echo "<script>
				if ( window.history.replaceState ) {
					window.history.replaceState( null, null, window.location.href );
				}
			</script>";
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

/****************** firebase notifications ***********************/

?>