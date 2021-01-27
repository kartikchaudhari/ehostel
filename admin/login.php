<?php 
  	session_start();
	include '../includes/functions.php';
	put_head("eHostel :: Adminisrator Login",null,false);
	include '../includes/nav.php';
?>
<div class="container" style="min-height: 502px;">
	<h3 align="center">Adminisrator Login</h3>
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
					    	<input type="email" name="email" value="" class="form-control" placeholder="Enter Email Address" autocomplete="off" autosave="off" required="required">
					  	</div>
		 				<div class="form-group">
					    	<input type="password" name="pass" value="" class="form-control" placeholder="Enter Password" autocomplete="off" autosave="off" required="required">
					  	</div>
					  	<div class="g-recaptcha" data-sitekey="6Lesh_sZAAAAAP8qJ1IwffE-RBN_jYxccRVR__lM">Loading Captcha...</div><br>
					  	<button name="btnLogin" type="submit" class="btn btn-success">Submit</button>
					  	&nbsp;<strong>·</strong>&nbsp;
					  	<button type="reset" class="btn btn-danger">Reset</button>
					</form> 
					<br>
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
									$sql="SELECT id,name FROM eh_admin WHERE email='$email' AND password='$pass'";
									$result=mysqli_query($conn,$sql);
									if (@mysqli_num_rows($result)>0) {
										$row=mysqli_fetch_assoc($result);

										$_SESSION['id']=$row['id'];
										$_SESSION['name']=$row['name'];
										$_SESSION['user_type']="admin";
										header("location:dashboard.php");
									}
									else{
										echo alert_style('warning','<strong>Warning !</strong> Check your email address, No Such record found.');
									}
						        }
						        else
						        {
						           echo alert_style('danger','<strong>Error !</strong> Robot Verification failed please try again.');
						        }
   							}
						}
					?>
		  		</div>
			</div>
  		</div>
	</div>
</div>
<?php 
	$js="<script type='text/javascript' src='https://www.google.com/recaptcha/api.js'></script>";
	put_footer(false,$js);
?>