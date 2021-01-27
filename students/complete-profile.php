
<?php 
  session_start();
  require '../includes/db.php';
  include '../includes/functions.php';
  include 'functions.php';
  is_logged_in('student');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard :: Student</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/sb-admin.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>">
    </head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
                <h1>Complete your profile</h1>
                <hr>
				<?php 
					if (isset($_GET['st_id']) && isset($_SESSION['st_id'])):
						if ($_GET['st_id']==$_SESSION['st_id']): 
							$st_id=$_SESSION['st_id'];
							$enrollment=$_SESSION['enrollment'];
							$sql="SELECT * FROM eh_students WHERE st_id=$st_id AND enrollment='$enrollment'";
							$result=mysqli_query($conn,$sql);
							$row=mysqli_fetch_assoc($result);
				?>
							<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
								<div class="row">
									<!-- room info -->
									<div class="col-md-4">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Room Info</h3>
											</div>
											<div class="panel-body">
												<div class="form-group">
											  		<input class="form-control" name="hosel_block" value="<?=$row['block_id'];?>" readonly="readonly" disabled="disabled">
											  	</div>
											  	<div class="form-group">
											  		<input type="number" name="room" class="form-control" readonly="readonly" placeholder="Room Number" value="<?=$row['room_no'];?>" disabled="disabled">
											  	</div>
											  	<div class="form-group">
											  		<input class="form-control" type="date" name="admission_date" placeholder="Admission Date" value="<?=$row['admission_date'];?>" disabled="disabled">
											  	</div>
											</div>
										</div>
									</div>
									<!--./room info -->

									<!--academic info -->
									<div class="col-md-4">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Academic Info</h3>
											</div>
											<div class="panel-body" style="padding-bottom: 30px;">
												<div class="form-group">
													<?php has_dept_set($row['dept_id']); ?>
											  	</div>
											  	<div class="form-group">
											  		<input type="number" name="enrollment" class="form-control" placeholder="Enter Enrollment/Admission No." required="required" value="<?=$row['enrollment'];?>">
											  	</div>
										  		<div class="row">
										  			<div class="col-md-6">
										  				<select class="form-control" name="course_type" required="required">
												  			<option value="">- Course Type -</option>
												  			<?=pull_course($row['c_id']);?>
												  		</select>
										  			</div>
										  			<div class="col-md-6">
										  				<select class="form-control" name="sem_id" required="required">
												  			<option value="" selected="selected">- Semester -</option>
												  			<?=pull_semester($row['sem']);?>
												  		</select>
										  			</div>
										  		</div>
											</div>
										</div>
									</div>
									<!--./academic info-->
									
									<!-- student image -->
									<div class="col-md-4">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Student Image</h3>
											</div>
											<div class="panel-body" style="padding-bottom: 0px;">
												<div class="form-group">
													<input type="file" name="avatar" class="form-control">
												</div>
												<div class="form-group">
													<img src="<?=base_url('assets/images/default.jpg');?>" class="img-responsive" style="height: 100px;width: 80px;">
												</div>
											</div>
										</div>
									</div>
									<!--./student image -->
								</div>

								<div class="row">
									<!-- personal info -->
									<div class="col-md-6">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">Personal Info</h3>
											</div>
											<div class="panel-body">
												<div class="form-group">
													<input class="form-control" type="text" name="fname" placeholder="First Name" value="<?=$row['fname'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="text" name="mname" placeholder="Middle Name" value="<?=$row['mname'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="text" name="lname" placeholder="Last Name" value="<?=$row['lname'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="tel" name="contact" placeholder="Contact Number" value="<?=$row['contact']?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="email" name="email" placeholder="Email Address" value="<?=$row['email']?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="tel" name="e_contact" placeholder="Emergency Contact Number" value="<?=$row['e_contact'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="text" name="gr_name" placeholder="Guardian Name" value="<?=$row['gr_name'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="text" name="gr_relation" placeholder="Guardian Relation with you" value="<?=$row['gr_relation'];?>">
												</div>
												<div class="form-group">
													<input class="form-control" type="tel" name="gr_contact" placeholder="Guardian Contact Number" value="<?=$row['gr_contact'];?>">
												</div>
											</div>
										</div>
									</div>
									<!--./personal info-->

									<!--address info -->
									<div class="col-md-6">
										<div class="row">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title">Correspondence Address</h3>
												</div>
												<div class="panel-body" style="padding-bottom: 0px;">
													<div class="form-group">
														<textarea class="form-control" name="c_address" required="required" placeholder="Correspondence Address" rows="1"><?=$row['cr_address'];?></textarea>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="c_city" placeholder="City" required="required" value="<?=$row['cr_city'];?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="c_state" placeholder="State" required="required" value="<?=$row['cr_state'];?>">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="c_country" placeholder="Country" required="required" value="<?=$row['cr_country'];?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="number" class="form-control" name="c_pincode" placeholder="Pincode" required="required" value="<?=$row['cr_pincode'];?>">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="checkbox">
												<label style="font-weight: bold;"><input type="checkbox" value="">Same As Correspondence Address ?</label>
											</div>
										</div>
										<div class="row">
											<div class="panel panel-primary">
												<div class="panel-heading">
													<h3 class="panel-title">Parmenant Address</h3>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<textarea class="form-control" name="p_address" required="required" placeholder="Correspondence Address" rows="1"><?=$row['pr_address']?></textarea>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="p_city" placeholder="City" value="<?=$row['pr_city'];?>" required="required">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="p_state" placeholder="State" required="required" value="<?=$row['pr_state'];?>">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<input type="text" class="form-control" name="p_country" placeholder="Country" required="required" value="<?=$row['pr_country'];?>">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<input type="number" class="form-control" name="p_pincode" placeholder="Pincode" required="required" value="<?=$row['pr_pincode'];?>">
															</div>
														</div>
														<input type="hidden" name="st_id" value="<?=$st_id;?>">
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--./address info-->
								</div>

								<!-- buttons-->
								<div class="row">
									<div class="col-md-4 col-md-offset-5">
										<button name="btnUpdate" type="submit" class="btn btn-success">Update</button>
										<button type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
								<!--./buttons-->
							</form>
							
					<?php 
							endif;
							else:
								if (isset($_POST['btnUpdate'])) {
									$sql="UPDATE eh_students 
										  SET fname='".$_POST['fname']."',
										      mname='".$_POST['mname']."',
										      lname='".$_POST['lname']."',
										      dept_id=".$_POST['dept'].",
										      sem=".$_POST['sem_id'].",
										      enrollment='".$_POST['enrollment']."',
										      contact='".$_POST['contact']."',
										      e_contact='".$_POST['e_contact']."',
										      gr_name='".$_POST['gr_name']."',
										      gr_relation='".$_POST['gr_relation']."',
										      gr_contact='".$_POST['gr_contact']."',
										      pr_address='".$_POST['p_address']."',
										      pr_city='".$_POST['p_city']."',
										      pr_state='".$_POST['p_state']."',
										      pr_country='".$_POST['p_country']."',
										      pr_pincode='".$_POST['p_pincode']."',
										      cr_address='".$_POST['c_address']."',
										      cr_city='".$_POST['c_city']."',
										      cr_state='".$_POST['c_state']."',
										      cr_country='".$_POST['c_country']."',
										      cr_pincode='".$_POST['c_pincode']."'
										   WHERE st_id=".$_POST['st_id'];
									$result=mysqli_query($conn,$sql);
									//echo $result;
									if ($result==1) {
										echo alert_style("success","Profile Information updated Successfully.");
									}
									else{
										echo alert_style("warning","Ann Error Occured : ".mysqli_error($conn));
									}
									
								}
						endif;
					?>
					
					
          </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- JavaScript -->
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>
