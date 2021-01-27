
<?php 
  require '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>eHostel Management System :: Registration Instructions and Rules</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
  <style type="text/css">
  	p{text-align: justify-all;}
  	.col-md-4{border:1px solid red;}
  	h3{font-weight: bold;}
  </style>
</head>
<body>
  
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-8 col-md-offset-2">
				<br>
				<div class="panel panel-primary">
					<div class="panel-body">
						<?php
							$sql="SELECT admission_rule_instruction FROM eh_settings";
							$query=mysqli_query(Database::getConnection(),$sql);
							$result=mysqli_fetch_assoc($query);
							echo html_decoder($result['admission_rule_instruction']);
						?>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
</div>
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>
