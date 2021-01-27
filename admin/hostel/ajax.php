<?php
	session_start();
  	require '../../includes/functions.php';
  	is_logged_in('admin');
	
	/*update hostel info*/
	if(isset($_POST['btnUpdateHostel'])){
		$sql="UPDATE `eh_hostel_info` SET `hostel_name` = '".clean($_POST['hostel_name'])."', `total_rooms` = '".$_POST['total_rooms']."', `capacity` = '".$_POST['capacity']."', `guest_rooms` = '".$_POST['guest_rooms']."', `tv_rooms` = '".$_POST['tv_rooms']."', `mess_count` = '".$_POST['mess_count']."', `reading_rooms` = '".$_POST['reading_rooms']."', `office_rooms` = '".$_POST['office_rooms']."', `hostel_status` = '".$_POST['hostel_status']."' WHERE `eh_hostel_info`.`info_id` = ".$_POST['info_id'];
		
		if(mysqli_query(Database::getConnection(),$sql)){
			echo true;
		}
		else{
			echo false;
		}
	}
	

	/*delete hostel*/
	if (isset($_POST['hostel_id'])) {
		$hostel_id=$_POST['hostel_id'];

		$sql="DELETE FROM eh_hostel_info WHERE info_id=".$hostel_id;
		if (mysqli_query(Database::getConnection(),$sql)) {
			echo true;
		}
		else{
			echo false;
		}
	}
	
?>