<?php
	
	require "../functions.php";	
	put_header_json();

	if(isset($_POST['enrollment']) && isset($_POST['email'])){
		$enrollment=$_POST['enrollment'];
		$email=$_POST['email'];
		$tbl_name='eh_students';

		if(isExist('enrollment',$enrollment,$tbl_name)){
			$error=true;
			$message="Given enrollment/merit no. is already exist";
			echo json_encode(array('error'=>$error,'message'=>$message));
		}
		else{
			
			$fname=$_POST['first_name'];
			$lname=$_POST['last_name'];
			$pass=md5($_POST['password']);
			$contact=$_POST['contact_no'];
			$token=$_POST['token'];
			$sql="INSERT INTO eh_students(fname,lname,enrollment,contact,email,password,device_token) VALUES('$fname','$lname','$enrollment','$contact','$email','$pass','$token')";
			if(mysqli_query(Database::getConnection(),$sql)){
				$error=false;
				$st_id=Database::getConnection()->insert_id;
				$message="Student Registered Successfylly.";
				$success=array('st_id'=>$st_id,'fname'=>$fname,'lname'=>$lname,'email'=>$email,'enrollment'=>$enrollment);

				echo json_encode(array('error'=>$error,'message'=>$message,'data'=>$success));
			}
			else{
				$error=true;
				$message="An Error occured while registration.";
				echo json_encode(array('error'=>$error,'message'=>$message));
			}
		}
	}
	else{
		forbidden();
	}

?>