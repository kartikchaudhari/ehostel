<?php 
	session_start();
	require __DIR__. '../../includes/functions.php';
	if (!isset($_SESSION['token']) && !isset($_SESSION['start'])) {
        header("location:login.php");
    }
    else {
        $now = time();
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:login.php");
        }
        else { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>eHostel Management System :: Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
</head>
<body>

<?php 
  include '../includes/nav.php';
?>
<div class="container" style="min-height: 502px;">
	<h3 align="center">Password Reset</h3>
	<hr>
	<div class="row">
  		<div class="col-md-6 col-md-offset-3">
	  		<div class="panel panel-success">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Enter Required details</h3>
			  	</div>
		  		<div class="panel-body">
		    		<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" accept-charset="utf-8">
		    			<div class="form-group">
					    	<input type="password" name="password" value="" class="form-control" placeholder="Enter New Password" autocomplete="off" autosave="off" required="required">
					  	</div>
		 				<div class="form-group">
					    	<input type="text" name="cpassword" value="" class="form-control" placeholder="Confirm New Password" autocomplete="off" autosave="off" required="required">
					  	</div>
					  	<button name="btnSubmit" type="submit" class="btn btn-success">Submit</button>
					  	&nbsp;<strong>·</strong>&nbsp;
					  	<button type="reset" class="btn btn-danger">Reset</button>
					</form> 
		  		</div>
		  		<div class="panel-footer text-center text-muted">
		  			<a href="<?=base_url('warden/login.php');?>" class="text-muted" title="Back to Login">Back to Login</a>
		  			<span>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;&nbsp;</span>
		  			<a href="<?=base_url('index.php');?>" class="text-muted" title="Back to Home">Home</a>
		  		</div>
			</div>
			<?php 
				if (isset($_POST['btnSubmit'])) {		
					$password=$_POST['password'];
					$cpassword=$_POST['cpassword'];
					if ($password==$cpassword) {
						$warden_id=$_SESSION['w_id'];
						$email=$_SESSION['w_email'];
						$hased_pass=md5($password);
						$sql="UPDATE eh_wardens SET password='$hased_pass' WHERE warden_id=$warden_id AND email='$email'";

						if(mysqli_query(Database::getConnection(),$sql)){
							session_destroy();
							echo alert_style('success','<strong>Success !</strong> New password updated successfully.');
						}
						else{
							echo alert_style('danger','<strong>Error !</strong> An error occured while updating password.');
						}
					}
					else{
						echo alert_style('warning','<strong>Warning !</strong> Password and Confirm Password does not match, please try again.');
					}
				}
			?>
  		</div>
	</div>
</div>

<?php
        }
    }
?>
