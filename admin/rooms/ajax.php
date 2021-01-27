<?php 
	require '../../includes/functions.php';

	//update room
	if (isset($_POST['update_action']) && isset($_POST['hostel_info_id'])) {
		$room_id=$_POST['room_id'];
		$room_no=$_POST['room_no'];
		$total_seats=$_POST['total_seats'];
		$hostel_info_id=$_POST['hostel_info_id'];
		$hostel_block=$_POST['hostel_block'];

		$sql="UPDATE `eh_rooms` SET `room_no` = '$room_no', `total_seat` = $total_seats, `block_id` = $hostel_block, `hostel_info_id` = $hostel_info_id WHERE `eh_rooms`.`room_id` = $room_id;";
		if(mysqli_query(Database::getConnection(),$sql)){
			echo true;
		}
		else{
			echo false;
		}
	}

	//fetch bloks based on hostel id
	if (isset($_POST['hostel_info_id']) && isset($_POST['fetch_action'])) {
		$hostel_info_id=$_POST['hostel_info_id'];
		$sql="SELECT * FROM eh_blocks WHERE hostel_info_id=".$hostel_info_id;
		$query=mysqli_query(Database::getConnection(),$sql);
		while ($result=mysqli_fetch_assoc($query)) {
			echo '<option value="'.$result['block_id'].'">'.$result['block_name'].'</option>';
		}		
	}

	//delete room
	if (isset($_POST['delete_action']) && isset($_POST['room_id'])) {
		$room_id=$_POST['room_id'];

		$sql="DELETE FROM eh_rooms WHERE room_id = $room_id";
		if(mysqli_query(Database::getConnection(),$sql)){
			echo true;
		}
		else{
			echo false;
		}
	}

	
?>