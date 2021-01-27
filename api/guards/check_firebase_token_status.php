<?php 
include "../functions.php";
if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
	$guard_id=$_POST['guard_id'];
	$contact=$_POST['contact'];
	//$device_token=$_POST['device_token'];
	$sql="SELECT device_token FROM eh_security_guards WHERE contact='".$contact."' AND guard_id=".$guard_id;

	$query=mysqli_query(Database::getConnection(),$sql);
	$row=mysqli_fetch_assoc($query);
	
	if($row['device_token']!=null){
		$status=true;
		$message="Congratulations ! Device is already Registred.";
	}
	else{
		$status=false;
		$message="Error ! Your device is not registered on portal, click below button to register.";	
	}
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>