<?php 
include "../functions.php";
if (isset($_POST['guard_id'])) {
	$guard_id=$_POST['guard_id'];
	$enrollment=$_POST['enrollment'];
	$entry_date=$_POST['entry_date'];
	$in_time=$_POST['in_time'];

	$sql="SELECT * FROM eh_student_entry WHERE enrollment='$enrollment' AND entry_date='$entry_date' AND in_time IS NULL AND guard_id=".$guard_id;

	$result=mysqli_query(Database::getConnection(),$sql);
	if(mysqli_num_rows($result)>0){
		$sql="UPDATE eh_student_entry SET in_time='$in_time' WHERE enrollment='$enrollment' AND entry_date='$entry_date' AND in_time IS NULL AND guard_id=".$guard_id;
		$result=mysqli_query(Database::getConnection(),$sql);
		if($result){
			$status=true;
			$message="In Time updated.";
		}
		else{
			$status=false;
			$message="An Error occured while updating.";	
		}
	}
	else{
		$status=false;
		$message="No Entry found with the given enrollment no. and date.";
	}

	
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>