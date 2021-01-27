<?php 
	require '../../constants.php';
	require "../../functions.php";	
	put_header_json();
	
	if (isset($_POST['merit_no'])) {
		
		$merit_no=clean($_POST['merit_no']);
		$student_email=$_POST['student_email'];

		if(!isStudentExist($merit_no,$student_email)){
			$db=Database::getConnection();
			$dept_id=$_POST['dept_id'];
			$fname=ucfirst(clean($_POST['fname']));
			$mname=ucfirst(clean($_POST['mname']));	
			$lname=ucfirst(clean($_POST['lname']));
			$gender=$_POST['gender'];
			$cast_id=$_POST['cast_id'];
			$student_contact=$_POST['student_contact'];
			$parent_contact=$_POST['parent_contact'];
			$pr_address=clean($_POST['pr_address']);
			$pr_state=$_POST['pr_state'];
			$pr_district=$_POST['pr_district'];
			$pr_city=clean($_POST['pr_city']);
			$pr_pincode=$_POST['pr_pincode'];
			$distance=$_POST['distance'];
			$b_acc_no=$_POST['bank_acc_no'];
			$b_acc_name=$_POST['bank_acc_name'];
			$b_name=$_POST['bank_name'];
			$b_ifsc=$_POST['bank_ifsc'];

			$hostel_entry_date=date("d-m-Y");

			$sql="INSERT INTO eh_students 
				(fname,mname,lname,avatar,gender,cast_id,dept_id,enrollment,contact,email,
				p_contact,pr_address,pr_city,pr_district,pr_state,pr_country,pr_pincode,
				distance,bank_ac_no,bank_ac_name,bank_name,bank_ifsc,admission_date)
				VALUES
				('$fname','$mname','$lname','$default_avatar','$gender',$cast_id,$dept_id,'$merit_no','$student_contact',
				'$student_email','$parent_contact','$pr_address','$pr_city','$pr_district','$pr_state','India','$pr_pincode',
				$distance,'$b_acc_no','$b_acc_name','$b_name','$b_ifsc','$hostel_entry_date')";
				if(mysqli_query($db,$sql)){
					if(make_student_dir($merit_no)){

						$student=array('st_id'=>$db->insert_id,'enrollment'=>$merit_no,'contact'=>$student_contact,'email'=>$student_email);

						$_SESSION['st_id']=$db->insert_id;
						$_SESSION['enrollment']=$merit_no;
						$_SESSION['contact']=$student_contact;
						$_SESSION['email']=$student_email;
						echo json_encode(array('status'=>true,'message'=>'Registration Step 1 Completed.','student'=>$student));
					}
				}
				else{
					echo json_encode(array('status'=>false, 'message'=>mysqli_error($db)));
				}
		}
		else{
			echo json_encode(array('status'=>false,'message'=>'Student with Merit No.-> '.$merit_no.' or  Email ID-> '. $student_email .' is already exist, please check the details and retry.'));
		}
			
	}
	else{
		forbidden();
	}	
?>