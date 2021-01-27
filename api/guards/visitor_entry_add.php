<?php 
include "../functions.php";
if (isset($_POST['guard_id'])) {
	$visitor_type=$_POST['visitor_type'];
	$visitor_uid=$_POST['visitor_uid'];
	$visitor_name=clean($_POST['visitor_name']);
	$visitor_contact_no=$_POST['visitor_contact_no'];
	$visitor_address=clean($_POST['visitor_address']);
	$visited_person_name=clean($_POST['visited_person_name']);
	$visited_room=$_POST['room_no'];
	$in_time=$_POST['in_time'];
	$entry_date=$_POST['visit_date'];
	$guard_id=$_POST['guard_id'];

	$sql="INSERT INTO eh_visitors (visitor_type, visitor_uid, visitor_name, visitor_contact_no, visitor_address, visited_person_name, room_no, in_time,visit_date, guard_id) VALUES ($visitor_type, '$visitor_uid', '$visitor_name', '$visitor_contact_no', '$visitor_address', '$visited_person_name', '$visited_room', '$in_time','$entry_date', $guard_id);";

	
	$result=mysqli_query(Database::getConnection(),$sql);
	if($result){
		$status=true;
		$message="Visitor Entry Added.";
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