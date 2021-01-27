<?php 
include "../functions.php";
if (isset($_POST['guard_id'])) {
	$guard_id=$_POST['guard_id'];
	$enrollment=$_POST['enrollment'];
	$room_no=$_POST['room_no'];
	$purpose=clean($_POST['purpose']);
	$entry_date=$_POST['entry_date'];
	$out_time=$_POST['out_time'];

	$sql="INSERT INTO eh_student_entry(enrollment, room_no, purpose, entry_date, out_time, guard_id) VALUES ( '$enrollment', '$room_no', '$purpose', '$entry_date', '$out_time', $guard_id)";
	
	$result=mysqli_query(Database::getConnection(),$sql);
	if($result){
		$status=true;
		$message="Student Entry Added.";
	}
	else{
		$status=false;
		$message="An Error occured while adding Entry.";	
	}
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>