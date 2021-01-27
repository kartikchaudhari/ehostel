<?php 

	require "functions.php";


	$sql="SELECT * FROM eh_banners";

	$query=mysqli_query(Database::getConnection(),$sql);

	$banners=array();
	while ($row=mysqli_fetch_assoc($query)) {
		$banner=array('banner_id'=>$row['banner_id'],'banner_caption'=>$row['banner_caption'],'banner_url'=>base_url($row['banner_url']));
		array_push($banners, $banner);		
	}
	put_header_json();
	echo json_encode($banners);


?>