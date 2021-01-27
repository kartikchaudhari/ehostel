<?php
	session_start();
  	require '../../includes/functions.php';
  	is_logged_in('admin');
	
	/*update block info*/
	if(isset($_POST['btnUpdateBlock'])){
		$sql="UPDATE `eh_blocks` SET `block_name` = '".clean($_POST['block_name'])."', `hostel_info_id` = '".$_POST['hostel_id']."' WHERE `block_id` = ".$_POST['block_id'];
		
		if(mysqli_query(Database::getConnection(),$sql)){
			echo true;
		}
		else{
			echo false;
		}
	}
	

	/*delete block*/
	if (isset($_POST['btnDeleteBlock'])) {
		$block_id=$_POST['block_id'];

		$sql="DELETE FROM eh_blocks WHERE block_id=".$block_id;
		if (mysqli_query(Database::getConnection(),$sql)) {
			echo true;
		}
		else{
			echo false;
		}
	}
	
?>