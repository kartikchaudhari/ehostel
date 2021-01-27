<?php 
/*
	forgot passsword account applicable check
*/
	require "../functions.php";	
	put_header_json();
	if (isset($_POST['enrollment']) && isset($_POST['email'])) {
		
		$enrollment=$_POST['enrollment'];
		$email=$_POST['email'];

		/*is student exist*/
		if(isStudentExist($enrollment,$email)){

			/*is account activated*/
			if(isStudentAcountActivated($enrollment,$email)){
				$error=false;
				$message="Applicable for password recovery";
				echo json_encode(array('error'=>$error,'message'=>$message));		
			}
			else{
				/*account not activated*/
				$error=true;
				$message="Student is not activated yet";
				echo json_encode(array('error'=>$error,'message'=>$message));
			}
		}
		else{
			/*student does not exit*/
			$error=true;
			$message="Student is not exist.";
			echo json_encode(array('error'=>$error,'message'=>$message));
		}	
	}
	else{
		forbidden();
	}

?>