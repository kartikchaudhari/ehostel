<?php 
	$prev_date=date('d-m-Y', strtotime('-3 days'));
	$cur_date=date('d-m-Y');
	$sql="SELECT * FROM eh_students WHERE admission_date BETWEEN '$prev_date' AND '$cur_date'";
	echo $sql;
?>