<?php 
	/*root directory*/
	$root_dir=$_SERVER['DOCUMENT_ROOT'];
	
	/*full project directory*/
	$project_dir=$root_dir."/ehostel";
	
	/*stdent upload directory*/
	$student_upload_dir=$project_dir."/uploads/student";

	/*student's avtar upload directory*/
	$student_avatar_dir=$student_upload_dir."/avatar";

	/*student's document uploa directory*/
	$student_docs_dir=$student_upload_dir."/docs";

	/*student's fee receipt upload directory*/
	$student_receipts_dir=$student_upload_dir."/receipts";

	/*default password, used while creating account from admin or warden side*/
	$default_pass="!abc123#~";

	/*default avatar*/
	$default_avatar="assets/images/default.jpg";