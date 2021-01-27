<?php 
/*
	reset the password
*/	
	require "../functions.php";
	if (isset($_POST['email']) && isset($_POST['enrollment'])) {
		if(isset($_POST['password'])){
			$password=md5($_POST['password']);
			$email=$_POST['email'];
			$enrollment=$_POST['enrollment'];

			$sql="UPDATE eh_students SET password='$password' WHERE enrollment='$enrollment' AND email='$email'";
			$query=mysqli_query(Database::getConnection(),$sql);
			if ($query==1) {
				$error=false;
				$message="Password updated Successfully";
				echo json_encode(array('error'=>$error,'message'=>$message));	
			}
			else{
				$message="An error occured while updating password";
				echo json_encode(array('error'=>$error,'message'=>$message));	
			}
		}
	}
	else{
		forbidden();
	}
?>