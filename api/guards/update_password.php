<?php 
include "../functions.php";
if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
	$guard_id=$_POST['guard_id'];
	$contact=$_POST['contact'];
	$password=clean($_POST['password']);
	$cpassword=clean($_POST['cpassword']);
	if(strcmp($password,$cpassword)==0){
		$sql="UPDATE eh_security_guards SET password='".md5($password)."' WHERE contact='$contact' AND guard_id=".$guard_id;
	
		$result=mysqli_query(Database::getConnection(),$sql);
		if($result){
			$status=true;
			$message="Your password is updated Successfully.";
		}
		else{
			$status=false;
			$message="An Error occured while updating new password, please try again.";	
		}
	}
	else{
		$status=false;
		$message="Password does not match, please check.";
	}

	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));	
}
else{
	put_header_json();
	forbidden();
}
?>