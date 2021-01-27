<?php 
  require '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>eHostel Management System :: Hostel Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/cssbootstrap-theme.min.css');?>">
  <style type="text/css">
  	p{text-align: justify-all;}
  	.col-md-4{border:1px solid red;}
  	h3{font-weight: bold;}
  </style>
</head>
<body>

<div class="container-fluid">
	<br>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<p>The institute provides excellent accommodation to its students. The students are provided with all the amenities so that their stay here becomes a worthwhile experience.</p>
			<p>The institute has a boys hostel with capacity of 540 students and a girls hostel with capacity of 180 students. There are messes in the both hostel campus. Many newspapers and magazines are subscribed for the hostel library. Entertainment facilities like TV room, badminton room, gymnasium are also available in hostel. Outdoor and indoor games are also provided for the hostilities. University health centre has extended its services to the students of our hostel. The hostel is administered by the rector and four wardens.</p>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<?php 
				$sql="SELECT * FROM eh_hostel_info";
				$query=mysqli_query(Database::getConnection(),$sql);
				while($row=mysqli_fetch_assoc($query)):
			?>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$row['hostel_name'];?></h3>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-hover">
							
								<tr>
									<td>1</td>
									<td>No. of Rooms</td>
									<td><?=$row['total_rooms'];?></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Capacity</td>
									<td><?=$row['capacity'];?></td>
								</tr>
								<tr>
									<td>3</td>
									<td>Guest Rooms</td>
									<td><?=$row['guest_rooms'];?></td>
								</tr>
								<tr>
									<td>4</td>
									<td>T.V. Room</td>
									<td><?=$row['tv_rooms'];?></td>
								</tr>
								<tr>
									<td>5</td>
									<td>Mess</td>
									<td><?=$row['mess_count'];?></td>
								</tr>
								<tr>
									<td>6</td>
									<td>Reading Room</td>
									<td><?=$row['reading_rooms'];?></td>
								</tr>
								<tr>
									<td>7</td>
									<td>Hostel Office</td>
									<td><?=$row['office_rooms'];?></td>
								</tr>
							<?php
							?>	
						</table>
					</div>
				</div>
			</div>
			<?php 
				endwhile;
			?>
		</div>
	</div>	
</div>
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>
