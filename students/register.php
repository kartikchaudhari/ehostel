<?php 
  session_start();
  include '../includes/functions.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>eHostel Management System :: Student Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
</head>
<body>

<?php 
  include '../includes/nav.php';
?>
<div class="container" style="min-height: 502px;">
	<h3 align="center">Student Registration</h3>
	<hr>
	<div class="row">
  		<div class="col-md-6 col-md-offset-3">
	  		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Enter Required details</h3>
			  	</div>
		  		<div class="panel-body">
		    		<h4 align="center">Registration are Now Open</h3>
		    		<hr>
		    		<p>Go to google play store and download android application of official eHostel management system.</p>
		  		</div>
			</div>
  		</div>
	</div>
</div>
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>
