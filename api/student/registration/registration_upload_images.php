<?php 
	/*
		Document Type Reference
		-----------------------
		1 => Admission Letter
		2 => Residence Proof
		3 => User profile picture
		4 => SBI Collect Receipt
	*/
	include '../../constants.php';
	require "../../functions.php";	
	put_header_json();

	if(isset($_POST['doc_type'])){
		$st_id=$_POST['st_id'];
		$merit_no=$_POST['merit_no'];
		$doc_type=$_POST['doc_type'];
		$document=$_POST['document'];

		switch ($doc_type) {
			case 1:{
				handle_admission_letter($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db);
			}			
			break;
			
			case 2:{
				handle_residence_proof($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db);		
			}
			break;

			case 3:{
				handle_avatar($merit_no,$document,$st_id,$student_avatar_dir,$student_avatar_dir_db);
			}
			break;

			case 4:{
				handle_fee_receipt($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db);
			}
			break;
		}		
	}
	else{
		forbidden();
	}


	function hasRecordCreated($st_id){
		$sql="SELECT * FROM eh_registration_docs WHERE st_id=".$st_id;
		$query=mysqli_query(Database::getConnection(),$sql);
		if($query->num_rows>0){
			return true;
		}
		else{
			return false;
		}
	}

	function handle_admission_letter($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db){
		$file_name=$merit_no."_admletter_".time().".jpg";
		$upload_path=$student_docs_dir."/".$merit_no."/".$file_name;
		$db_file_path=$student_docs_dir_db.$merit_no."/".$file_name;

		if(hasRecordCreated($st_id)){

			//if record  exist then update it
			$sql="UPDATE eh_registration_docs SET admission_letter_path='$db_file_path' WHERE st_id=$st_id";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'Admission Letter Uploaded Successfully.'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
		else{
			//insert data
			$sql="INSERT INTO eh_registration_docs(st_id,admission_letter_path) VALUES($st_id,'$db_file_path')";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'Admission Letter Uploaded Successfully.'));
			}
			else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
	}

	function handle_residence_proof($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db){
		$file_name=$merit_no."_resiproof_".time().".jpg";
		$upload_path=$student_docs_dir."/".$merit_no."/".$file_name;
		$db_file_path=$student_docs_dir_db.$merit_no."/".$file_name;

		if(hasRecordCreated($st_id)){

			//if record  exist then update it
			$sql="UPDATE eh_registration_docs SET  residence_proof_path='$db_file_path' WHERE st_id=$st_id";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'Residence Proof Uploaded Successfully.'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
		else{
			//insert data
			$sql="INSERT INTO eh_registration_docs(st_id, residence_proof_path) VALUES($st_id,'$db_file_path')";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'Residence Proof Uploaded Successfully.'));
			}
			else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
	}

	function handle_avatar($merit_no,$document,$st_id,$student_avatar_dir,$student_avatar_dir_db){
		$file_name=$merit_no."_avatar_".time().".jpg";
		
		$upload_path=$student_avatar_dir."/".$merit_no."/".$file_name;
		
		$db_file_path=$student_avatar_dir_db.$merit_no."/".$file_name;

		$sql="UPDATE eh_students SET  avatar='$db_file_path' WHERE st_id=$st_id";
		if(mysqli_query(Database::getConnection(),$sql)){
			//upload file 
			file_put_contents($upload_path, base64_decode($document));
			echo json_encode(array('status'=>true,'message'=>'Passport Size image uploaded Successfully.'));
		}else{
			echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
		}
	}

	function handle_fee_receipt($merit_no,$document,$st_id,$student_docs_dir,$student_docs_dir_db){
		$file_name=$merit_no."_feereceipt_".time().".jpg";
		$upload_path=$student_docs_dir."/".$merit_no."/".$file_name;
		$db_file_path=$student_docs_dir_db.$merit_no."/".$file_name;

		if(hasRecordCreated($st_id)){

			//if record  exist then update it
			$sql="UPDATE eh_registration_docs SET  payment_receipt_path='$db_file_path' WHERE st_id=$st_id";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'SBI Collect Fee Receipt Uploaded Successfully.'));
			}else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
		else{
			//insert data
			$sql="INSERT INTO eh_registration_docs(st_id, payment_receipt_path) VALUES($st_id,'$db_file_path')";
			if(mysqli_query(Database::getConnection(),$sql)){
				//upload file 
				file_put_contents($upload_path, base64_decode($document));
				echo json_encode(array('status'=>true,'message'=>'SBI Collect Fee Receipt Uploaded Successfully.'));
			}
			else{
				echo json_encode(array('status'=>false,'message'=>'An error occured during file upload.'));
			}
		}
	}
?>