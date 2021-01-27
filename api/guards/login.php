<?php 	
	include "../functions.php";
	put_header_json();
	if (isset($_POST['contact']) && isset($_POST['password'])) {

		$contact=$_POST['contact'];
		$password=md5($_POST['password']);

		$sql="SELECT * FROM eh_security_guards WHERE contact='$contact' AND password='$password'";
		$result=mysqli_query(Database::getConnection(),$sql);
		if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_assoc($result);
			$error=false;
			$message="Welcome Security Guard";
			$success=array(
							'guard_id'=>$row['guard_id'],
							'fname'=>$row['fname'],
							'lname'=>$row['lname'],
							'avatar'=>$row['avatar'],
							'contact'=>$row['contact'],
							'allotted_to_block'=>$row['allotted_to_block'],
							'allotted_to_block_name'=>to_hotel_block_name($row['allotted_to_block']),
							'account_status'=>$row['account_status'],
							'device_token'=>$row['device_token'],
							'created_at'=>$row['created_at']
						);
			

			echo json_encode(array('error'=>$error,'message'=>$message,'guard'=>$success));

		}else{
			$error=true;
			$message="Sorry No Security Guard found with Given credentials.";
			echo json_encode(array('error'=>$error,'message'=>$message));
		}
		
	}
	else{
		forbidden();
	}
?>