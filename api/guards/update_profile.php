<?php 
include "../functions.php";
if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
	$guard_id=$_POST['guard_id'];
	$contact=$_POST['contact'];
	$fname=clean($_POST['fname']);
	$lname=clean($_POST['lname']);
	
	$sql="UPDATE eh_security_guards SET fname='$fname',lname='$lname' WHERE contact='$contact' AND guard_id=".$guard_id;
	
	$result=mysqli_query(Database::getConnection(),$sql);
	if($result){
		$status=true;
		$message="Your profile updated Successfully.";
	}
	else{
		$status=false;
		$message="An Error occured while updating profile, please try again.";	
	}
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>