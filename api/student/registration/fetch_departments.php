<?php 
/*
	this will fetch departments in Spinner of departments 
	in student registration form, so no validation is created.

	created at: 18-12-2020
*/
	require "../../functions.php";
	put_header_json();

	$sql="SELECT * FROM `eh_departments` WHERE dept_status=1";
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