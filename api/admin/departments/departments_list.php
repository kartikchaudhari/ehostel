<?php 
	require "../../functions.php";
	put_header_json();

	$sql="SELECT * FROM `eh_departments`";
	$query=mysqli_query(Database::getConnection(),$sql);
	if($query->num_rows>0){
		$departments=array();
		while($row=mysqli_fetch_assoc($query)){
			array_push($departments, $row);
		}

		echo json_encode(array('status' =>true,'message'=>'Departments Fetched.','departments'=>$departments));
	}
	else{
		echo json_encode(array('status'=>false,'message'=>'No Departments Found'));
	} 

?>