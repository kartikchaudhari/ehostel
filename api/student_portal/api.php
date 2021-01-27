<?php 
	include "db.php";
	header("Content-Type:application/json");
	if(isset($_POST['enrollment'])){
		$enrollment=$_POST['enrollment'];
		$sql="SELECT * FROM students WHERE enrollment=".$enrollment;
		$query=mysqli_query($conn,$sql);
		
		$response=array();
		if ($query->num_rows>0) {
			$result=mysqli_fetch_assoc($query);
			$response['status']=true;
			$response['message']="Student Found";
			$response['student']=$result;
		}		
		echo json_encode($response);
	}
	else{
		echo json_encode(array('status'=>false,'message'=>'You are not allowed to access this section.'));
	}
	
?>