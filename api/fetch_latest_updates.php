<?php 
	require "functions.php";
	put_header_json();
	$sql="SELECT * FROM `eh_updates` ORDER BY `creation_date` DESC";

	$query=mysqli_query(Database::getConnection(),$sql);
	
	if ($query->num_rows>0) {
		$json=array();
		while($row=mysqli_fetch_assoc($query)){
			array_push($json, $row);
		}
		echo json_encode(array("status"=>true,"message"=>"data found","Updates"=>$json));
	}
	else{
		echo json_encode(array("status"=>false,"message"=>"No Latest Updates available"));		
	}
?>