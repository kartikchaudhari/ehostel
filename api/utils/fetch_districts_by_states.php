<?php 
	require "../functions.php";	
	put_header_json();

	if (isset($_POST['state_id'])) {
		$state_id=$_POST['state_id'];
		$sql="SELECT * FROM districts WHERE state_id=".$state_id;
		$query=mysqli_query(Database::getConnection(),$sql);
		if ($query->num_rows>0) {
			$districts=array();
			while($row=mysqli_fetch_assoc($query)){
				array_push($districts, $row);
			}
			echo json_encode(array('status'=>true,'message'=>'Districts Found','districts'=>$districts));
		}
		else{
			echo json_encode(array('status' =>false,'message'=>'No Districts Found'));
		}	
	}
	else{
		forbidden();
	}
	
?>