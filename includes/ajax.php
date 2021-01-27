<?php 
	include 'db.php';
	include 'functions.php';
	//search visitor
	if (isset($_POST['token'])) :
		$token=$_POST['token'];

		$sql="SELECT * FROM eh_visitors_book WHERE v_token='".$token."'";
		$result=mysqli_query($conn,$sql);
		if(@mysqli_num_rows($result)>0):
			$row=mysqli_fetch_assoc($result);
?>
			<div id="msg" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Data Found!</strong> Entry found with token <strong><?=$token;?></strong>
			</div>
			<br>
			<table class="table table-hover table-striped">
				<tbody>
					<tr>
						<td><strong>Vister Name: </strong></td>
						<td><?=$row['v_name']?></td>
					</tr>
					<tr>
						<td><strong>Vister Contact No.: </strong></td>
						<td><?=$row['v_c_no']?></td>
					</tr>
					<tr>
						<td><strong>Visted Person Name: </strong></td>
						<td><?=$row['t_p_name']?></td>
					</tr>
					<tr>
						<td><strong>Room No.: </strong></td>
						<td><?=$row['room_no']?></td>
					</tr>
					<tr>
						<td><strong>In Time: </strong></td>
						<td><?=$row['in_time']?></td>
					</tr>
					<?php
						if($row['out_time']=="00:00"):

					?>
					<tr>
						<td><strong>Out Time: </strong></td>
						<td><input id="out_time" class="form-control" type="time"></td>
					</tr>
					<tr><input id="token" type="hidden" value="<?=$token?>"></tr>
					<tr>
						<td colspan="2">
							<button type="button" class="btn btn-success" onclick="doUpdateOutTime()">Update</button>
						</td>
					</tr>
					<?php 
						else:
					?>
					<tr>
						<td><strong>Out Time: </strong></td>
						<td><?=$row['out_time'];?></td>
					</tr>
					<?php 
						endif;
					?>
				</tbody>
			</table>
<?php 
	else:
?>
		<div id="msg" class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>No data Found!</strong> No entry found with token <strong><?=$token;?></strong>
		</div>

<?php 
	endif;
endif;
?>





<?php 
	//update out time
	if (isset($_POST['out_time'])):
		$token=$_POST['token'];
		$time=$_POST['out_time'];
		$sql="UPDATE eh_visitors_book SET out_time='".$time."'  WHERE v_token='".$token."'";
		if(mysqli_query($conn,$sql)):
?>
	<div id="msg" class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Success !!</strong> <span>Out time updated.</span>
</div>	
<?php 
	endif;
endif;
?>



<?php 
	if (isset($_POST['st_id']) && isset($_POST['room_name'])) {
		//update student info
		$sql="UPDATE eh_students SET room_no = '".$_POST['room_name']."' WHERE st_id = ".$_POST['st_id'];
		$result=mysqli_query($conn,$sql);
		if($result){
			$sql="SELECT occupied_seat FROM eh_rooms WHERE room_name='".$_POST['room_name']."'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);

			$tos=(int)$row['occupied_seat']+1;

			$sql="UPDATE eh_rooms SET occupied_seat = '".$tos."' WHERE room_name = '".$_POST['room_name']."'";

			$result=mysqli_query($conn,$sql);
			if ($result) {
				echo "<span class='text-success'><strong>Room Alloted.</strong></span>";
			}

		}
	}
?>




