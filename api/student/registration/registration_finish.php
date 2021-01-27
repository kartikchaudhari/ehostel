<?php 
	require __DIR__. "/../../functions.php";	
	require __DIR__. "/../../../libs/mailer.php";
	put_header_json();
	if(isset($_POST['st_id']) && isset($_POST['merit_no'])){
		$st_id=$_POST['st_id'];
		$merit_no=$_POST['merit_no'];

		$sql="SELECT fname,mname,lname,email,contact FROM eh_students WHERE st_id=$st_id AND enrollment='$merit_no'";
		$query=mysqli_query(Database::getConnection(),$sql);
		if($query->num_rows>0){
			$result=mysqli_fetch_assoc($query);

			$data=array($result['email']=>$result['fname']." ".$result['mname']." ".$result['lname']);
			
			if(send_email($data)){
				echo json_encode(array('status'=>true,'message'=>'Email sent successfully, Registration completed.'));
			}
			else{
				echo json_encode(array('status'=>false,'message'=>'Error occured while sending email, Registration completed.'));
			}	
		}
	}
	else{
		forbidden();
	}	
	
	
?>