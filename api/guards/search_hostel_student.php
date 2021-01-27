<?php 
include "../functions.php";
put_header_json();
if (isset($_POST['guard_id']) && isset($_POST['contact'])) {
	$guard_id=$_POST['guard_id'];
	$contact=$_POST['contact'];
	$enrollment=$_POST['enrollment'];

	//search for student first
	$sql="SELECT enrollment,room_no FROM eh_students WHERE enrollment=".$enrollment;
	$query=mysqli_query(Database::getConnection(),$sql);
	if (mysqli_num_rows($query)>0) {
		$row=mysqli_fetch_assoc($query);
		$status=true;
		$message="Student found with enrollment no. ".$enrollment;
		echo json_encode(array('status'=>$status,'message'=>$message,'student'=>$row));	
	}
	else{
		$status=false;
		$message="No Student Record found with enrollment No. ".$enrollment;
		echo json_encode(array('status'=>$status,'message'=>$message));	
	}
}
else{
	put_header_json();
	forbidden();
}
?>