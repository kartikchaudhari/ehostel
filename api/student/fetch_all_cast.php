<?php 
	require "../functions.php";	
	put_header_json();
	
	$sql="SELECT * FROM `eh_student_cast`";
	$query=mysqli_query(Database::getConnection(),$sql);
	if($query->num_rows>0){
		$casts=array();
		while ($row=mysqli_fetch_assoc($query)) {
			array_push($casts,$row);
		}
		echo json_encode(array('status'=>true,'message'=>'Cast Fetched','casts'=>$casts));

	}
	else{
		echo json_encode(array('status'=>false,'message'=>'No Cast found.'));
	}
?>