<?php 
  session_start();
  require __DIR__. '../../includes/functions.php';
  require __DIR__.'../../libs/mailer.php';
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
	<h3 align="center">Forgot Password</h3>
	<hr>
	<div class="row">
  		<div class="col-md-6 col-md-offset-3">
	  		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Enter Required details</h3>
			  	</div>
		  		<div class="panel-body">
		    		<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" accept-charset="utf-8">
		    			<div class="form-group">
					    	<input type="text" name="email" value="" class="form-control" placeholder="Enter Email Address" autocomplete="off" autosave="off" required="required">
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
					// require '../includes/db.php';
					$email=$_POST['email'];
					$sql="SELECT * FROM eh_wardens WHERE email='$email'";
					$result=mysqli_query(Database::getConnection(),$sql);
					if (@mysqli_num_rows($result)>0) {
						$row=mysqli_fetch_assoc($result);
						$_SESSION['w_id']=$row['warden_id'];
						$_SESSION['w_email']=$row['email'];
						$_SESSION['token']=md5(rand());
						$_SESSION['start'] = time();
						$_SESSION['expire'] = $_SESSION['start'] + (10 * 60);

						$link=base_url('warden/reset-password.php');

						$data=array('email'=>$row['email'],'name'=>$row['first_name']." ".$row['last_name'],'subject'=>'eHostel Account Password Reset','link'=>$link);

						if(mail_warden_password_reset($data)){
							echo alert_style('success','<strong>Success !</strong> Password reset link has beed sent to your registered email address, please check your inbox and spam/trash folder.');	
						}
						else{
							echo alert_style('danger','<strong>Error !</strong> An error occured while sending password resent link.');	
						}
						
					}
					else{
						echo alert_style('warning','<strong>Warning !</strong> Check your email address, No Such warden record found.');
					}
				}
			?>
  		</div>
	</div>
</div>

<?php 
	put_footer(false,null);
?>
