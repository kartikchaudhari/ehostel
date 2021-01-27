<?php 
	include "../../includes/constants.php";
	include "../functions.php";
	if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
		$guard_id=$_POST['guard_id'];
		$contact=$_POST['contact'];
		$sql="SELECT password FROM eh_security_guards WHERE contact='".$contact."' AND guard_id=".$guard_id;

		$query=mysqli_query(Database::getConnection(),$sql);
		$row=mysqli_fetch_assoc($query);
		
		if($row['password']==md5($default_pass)){
			$status=false;
			$message="Warning ! You've not changed your default password, Goto My Profile to update it.";
		}
		else{
			$status=true;
			$message="Congratulations ! Your password is up-to-date.";
		}
		put_header_json();
		echo json_encode(array('status'=>$status,'message'=>$message));
	}
	else{
		put_header_json();
		forbidden();
	}
?>