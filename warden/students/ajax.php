<?php 
	require '../../includes/functions.php';
	require_once '../../libs/mailer.php';
	/*fetch block by hostel_id*/
	if (isset($_POST['hostel_id']) && isset($_POST['block_fetch_action'])) {
		$hostel_id=$_POST['hostel_id'];
		$sql="SELECT block_id, block_name FROM eh_blocks WHERE hostel_info_id=".$hostel_id;
		$query=mysqli_query(Database::getConnection(),$sql);
		while($result=mysqli_fetch_assoc($query)){
			echo '<option value="'.$result['block_id'].'">'.$result['block_name'].'</option>';
		}	
	}

	/*fetch room no. by hostel and block_id*/
	if (isset($_POST['hostel_id']) && isset($_POST['block_id']) && isset($_POST['room_fetch_action'])) {

		//check for available room
		$sql="SELECT room_id FROM eh_rooms WHERE total_seat!=occupied_seat";
		$query=mysqli_query(Database::getConnection(),$sql);
		if($query->num_rows>0){
			$hostel_id=$_POST['hostel_id'];
			$block_id=$_POST['block_id'];
			$sql="SELECT * FROM eh_rooms WHERE block_id=$block_id AND hostel_info_id=$hostel_id";
			$query=mysqli_query(Database::getConnection(),$sql);
			if($query->num_rows>0){
				while($result=mysqli_fetch_assoc($query)){
					echo '<option value="'.$result['room_id'].'">'.$result['room_no'].' (Occupied: '.$result['occupied_seat'].'), (Available: '.($result['total_seat']-$result['occupied_seat']).') </option>';
				}	
			}
			else{
					echo "<option value='0'>--- Room Not Available ---</option>";
			}	
		}
		else{
			echo "<option value='0'>--- All rooms are Full ---</option>";
		}
	}

	/*reject request*/
	if (isset($_POST['reject_request_action'])) {
		$st_id=$_POST['st_id'];
		$name=$_POST['fullname'];
		$merit_no=$_POST['stu_merit_no'];
		$email=$_POST['stu_email'];
		$reason=$_POST['reason'];

		$sql="UPDATE eh_students SET account_status=4 WHERE st_id=$st_id AND $merit_no='$merit_no'";
		if (mysqli_query(Database::getConnection(),$sql)) {
			$data=array();
			$data['name']=$name;
			$data['reason']=$reason;
			$data['email']=$email;
			$data['subject']="eHostel Registration Request rejected.";
			if(mail_registration_rejected($data)){
				echo 1;
			}
		}
	}
	else{
		echo 0;
	}

	/*accept request*/
	if (isset($_POST['accept_request_action'])) {
		# code...
	}

?>