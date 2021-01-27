<?php 
include "../functions.php";
if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
	$guard_id=$_POST['guard_id'];
	$contact=$_POST['contact'];
	$token=$_POST['device_token'];
	$sql="UPDATE eh_security_guards SET device_token='".$token."' WHERE contact='$contact' AND guard_id=".$guard_id;
	$result=mysqli_query(Database::getConnection(),$sql);
	if($result){
		$status=true;
		$message="Security Guard device token Updated";

		$payload=array('message'=>"Your device token is updated Successfully.",'title'=>"eHostel Device Registration",'device_token'=>$token);
		send_push_single($payload);
	}
	else{
		$status=false;
		$message="Error occured while updating token";	
	}
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>