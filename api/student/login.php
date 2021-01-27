<?php 
	
	include "../Database.php";
	if (isset($_POST['enrollment']) && isset($_POST['password'])) {


		$enrollment=$_POST['enrollment'];
		$password=md5($_POST['password']);

		$sql="SELECT fname,lname,enrollment FROM eh_students WHERE enrollment='$enrollment' AND password='$password'";
		$result=mysqli_query(Database::getConnection(),$sql);
		if(mysqli_num_rows($result)>0){
			$rows=mysqli_fetch_assoc($result);
			$error=false;
			$message="Welcome Student";
			$success=array('fname'=>$rows['fname'],'lname'=>$rows['lname'],'enrollment'=>$rows['enrollment']);
			

			echo json_encode(array('error'=>$error,'message'=>$message,'data'=>$success));

		}else{
			$error=true;
			$message="Sorry No user found with Enrollment No./Merit No.".$enrollment;
			echo json_encode(array('error'=>$error,'message'=>$message));
		}
		
	}
	else{
		forbidden();
	}
?>