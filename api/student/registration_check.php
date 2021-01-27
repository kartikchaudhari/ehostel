<?php
	require "../functions.php";	
	put_header_json();

	if (isset($_POST['current_date'])) {
		$current_date=new DateTime($_POST['current_date']);

		/*pull start and end date of registration*/
		$start_date=new DateTime(pull_hostel_regisration_dates()['registration_start']);
		$end_date=new DateTime(pull_hostel_regisration_dates()['registration_end']);
		
		if($current_date<$start_date){
			$status=false;
			$message="Online hostel admissions are not started yet.";
		}
		else if($current_date>$end_date){
			$status=false;
			$message="Proccess for online admissions is end.";
		}
		else{
			$status=true;
			$message="Admissions for Boys and Girls hostel are open from ".$start_date->format('d-m-Y')." to ".$end_date->format('d-m-Y')." you can apply for hostel online by clicking on Student registration button below.";
		}

		echo json_encode(array('status'=>$status,'message'=>$message));
	}
	else{
		forbidden();
	}

?>