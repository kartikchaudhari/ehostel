<?php 
  session_start();
  include '../includes/functions.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>eHostel Management System :: Warden Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
</head>
<body>

<?php 
  include '../includes/nav.php';
?>
<div class="container" style="min-height: 502px;">
	<h3 align="center">Warden Login</h3>
	<hr>
	<div class="row">
  		<div class="col-md-6 col-md-offset-3">
	  		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Enter Required details</h3>
			  	</div>
		  		<div class="panel-body">
		    		<form action="login.php" method="post" accept-charset="utf-8">
		    			<div class="form-group">
					    	<input type="text" name="email" value="" class="form-control" placeholder="Enter Email Address" autocomplete="off" autosave="off" required="required">
					  	</div>
		 				<div class="form-group">
					    	<input type="password" name="pass" value="" class="form-control" placeholder="Enter Password" autocomplete="off" autosave="off" required="required">
					  	</div>
					  	<div class="g-recaptcha" data-sitekey="6Lesh_sZAAAAAP8qJ1IwffE-RBN_jYxccRVR__lM"></div><br>
					  	<button name="btnLogin" type="submit" class="btn btn-success">Submit</button>
					  	&nbsp;<strong>·</strong>&nbsp;
					  	<button type="reset" class="btn btn-danger">Reset</button>
					</form> 
		  		</div>
		  		<div class="panel-footer text-center text-muted">
		  			<a href="<?=base_url('warden/forgot-password.php');?>" class="text-muted" title="Forgot Password ?">Forgot Password ?</a>
		  		</div>
			</div>
  		</div>
	</div>
</div>
<?php 
	if (isset($_POST['btnLogin'])) {
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
		{
			$secret = '6Lesh_sZAAAAAGJceFobmpG5ySffjgplcIf5a3Nv';
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
	        $responseData = json_decode($verifyResponse);
	        if($responseData->success)
	        {
				require '../includes/db.php';
				$email=$_POST['email'];
				$pass=md5($_POST['pass']);
				$sql="SELECT warden_id,first_name,last_name FROM eh_wardens WHERE email='$email' AND password='$pass'";
				$result=mysqli_query($conn,$sql);
				if (@mysqli_num_rows($result)>0) {
					$row=mysqli_fetch_assoc($result);

					$_SESSION['w_id']=$row['warden_id'];
					$_SESSION['w_name']=$row['first_name']." ".$row['last_name'];
					$_SESSION['user_type']='warden';
					
					header("location:dashboard.php");
				}
				else{
					echo alert_style('warning','<strong>Warning !</strong> Check your email address, No Such warden record found.');
				}
	        }
	        else
	        {
	           echo alert_style('danger','<strong>Error !</strong> Robot Verification failed please try again.');
	        }
		}
	}


?>
<?php 
	$js="<script type='text/javascript' src='https://www.google.com/recaptcha/api.js'></script>";
	put_footer(false,$js);
?>
</body>
</html>
