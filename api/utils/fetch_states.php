<?php 
	require "../functions.php";	
	put_header_json();

	$sql="SELECT * FROM states";
	$query=mysqli_query(Database::getConnection(),$sql);
	if ($query->num_rows>0) {
		$states=array();
		while($row=mysqli_fetch_assoc($query)){
			array_push($states, $row);
		}
		echo json_encode(array('status'=>true,'message'=>'States Found','states'=>$states));
	}
	else{
		echo json_encode(array('status' =>false,'message'=>'No States Found'));
	}	
?>