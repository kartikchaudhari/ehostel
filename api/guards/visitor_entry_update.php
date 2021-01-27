<?php 
include "../functions.php";
if (isset($_POST['guard_id'])) {
	$visitor_uid=$_POST['visitor_uid'];
	$visit_date=$_POST['visit_date'];
	$out_time=$_POST['out_time'];
	$guard_id=$_POST['guard_id'];
	
	$sql="SELECT * FROM eh_visitors WHERE visitor_uid='$visitor_uid' AND visit_date='$visit_date' AND out_time IS NULL AND guard_id=".$guard_id;

	$result=mysqli_query(Database::getConnection(),$sql);
	if(mysqli_num_rows($result)>0){
		$sql="UPDATE eh_visitors SET out_time='$out_time' WHERE visitor_uid='$visitor_uid' AND visit_date='$visit_date' AND out_time IS NULL AND guard_id=".$guard_id;
		$result=mysqli_query(Database::getConnection(),$sql);
		if($result){
			$status=true;
			$message="Out Time updated.";
		}
		else{
			$status=false;
			$message="An Error occured while updating.";	
		}
	}
	else{
		$status=false;
		$message="No Entry found with the given Visitor UID and date.";
	}

	
	put_header_json();
	echo json_encode(array('status'=>$status,'message'=>$message));
}
else{
	put_header_json();
	forbidden();
}
?>