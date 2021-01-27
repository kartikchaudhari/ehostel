<?php 
include "../functions.php";
if (isset($_POST['guard_id'])) {
	$guard_id=$_POST['guard_id'];
	$sql="SELECT * FROM eh_visitors WHERE guard_id=$guard_id ORDER BY visit_date ASC";
	
	$result=mysqli_query(Database::getConnection(),$sql);
	$json_entries=array();
	if($result->num_rows > 0){
		while ($entries=mysqli_fetch_assoc($result)) {
			array_push($json_entries, $entries);
		}
		

		$out=array('status'=>true,'message'=>'Data Fetched','VisitorEntry'=>$json_entries);
		echo json_encode($out);
	}
}
else{
	put_header_json();
	forbidden();
}
?>