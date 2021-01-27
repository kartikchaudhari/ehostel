<?php 
  session_start();
  include '../includes/functions.php';
  put_head("eHostel :: Student Registration",null,false);
?>
<?php 
  include '../includes/nav.php';
?>
<div class="container" style="min-height: 502px;">
	<h3 align="center">Student Login</h3>
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
					    	<input type="text" name="enrollment" value="" class="form-control" placeholder="Enter Enrollment No. or ACPC Merit No." autocomplete="off" autosave="off" required="required">
					  	</div>
		 				<div class="form-group">
					    	<input type="password" name="pass" value="" class="form-control" placeholder="Enter Password" autocomplete="off" autosave="off" required="required">
					  	</div>
					  	<button name="btnLogin" type="submit" class="btn btn-success">Submit</button>
					  	&nbsp;<strong>·</strong>&nbsp;
					  	<button type="reset" class="btn btn-danger">Reset</button>
					</form> 
		  		</div>
			</div>
  		</div>
	</div>
</div>
<?php
	if (isset($_POST['btnLogin'])) {
		$enrollment=$_POST['enrollment'];
		$pass=md5($_POST['pass']);
		$sql="SELECT st_id,enrollment FROM eh_students WHERE enrollment='$enrollment' AND password='$pass'";
		$result=mysqli_query(Database::getConnection(),$sql);
		if (@mysqli_num_rows($result)>0) {
			$row=mysqli_fetch_assoc($result);

			$_SESSION['st_id']=$row['st_id'];
			$_SESSION['enrollment']=$row['enrollment'];
			header("location:dashboard.php");
		}
		else{
			echo alert_style('warning','<strong>Warning !</strong> Check your enrollment No./Admisson No., No Such student found.');
		}

	}

	put_footer(null,true); 
?>