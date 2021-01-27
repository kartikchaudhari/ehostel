<?php 
	require "../includes/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Warden</title>
</head>
<body>
	<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
		<table border="1" width="30%">
			<tr>
				<td><label>Select Role:</label></td>
				<td>
					<select name="role">
						<option value="">--- Select Role ---</option>
						<?php 
							$sql="SELECT * FROM eh_roles";
							$query=mysqli_query(Database::getConnection(),$sql);
							if ($query->num_rows>0) {
								while ($row=mysqli_fetch_assoc($query)) {
									echo "<option value='".$row['role_id']."'>".$row['role_name']."</option>";
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Allocated To:</label></td>
				<td>
					<select name="allocated_to">
					<?php 
						$sql="SELECT info_id, hostel_name FROM eh_hostel_info";
						$query=mysqli_query(Database::getConnection(),$sql);
						while ($row=mysqli_fetch_assoc($query)):
					?>
						<option value="<?=$row['info_id']?>"><?=$row['hostel_name']?></option>
					<?php
						endwhile;
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="fname"></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lname"></td>
			</tr>
			<tr>
				<td>Department</td>
				<td>
					<select name="dept">
						<option value="">--- Select Department ---</option>
						<?php 
							$sql="SELECT * FROM eh_departments";
							$query=mysqli_query(Database::getConnection(),$sql);
							if ($query->num_rows>0) {
								while ($row=mysqli_fetch_assoc($query)) {
									echo "<option value='".$row['dept_id']."'>".$row['dept_name']."</option>";
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="email" name="email" value="xyz@gmail.com">
				</td>
			</tr>
			<tr>
				<td>Contact No.:</td>
				<td>
					<input type="phone" name="contact" value="8153976277">
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" value="<?=md5('kartik');?>"></td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" name="btnSubmit">Submit</button>
				</td>
			</tr>
		</table>
	</form>
	<?php 
		if (isset($_POST['btnSubmit'])) {
			$sql="INSERT INTO eh_wardens (role_id, allocated_to, first_name, last_name, dept_id, email, contact, password) VALUES (".$_POST['role'].",'".$_POST['allocated_to']."','".$_POST['fname']."','".$_POST['lname']."',".$_POST['dept'].",'".$_POST['email']."','".$_POST['contact']."','".$_POST['password']."');";
			$query=mysqli_query(Database::getConnection(),$sql);
			if ($query) {
				echo "<strong style='color:green;'>Warden Addedd.</strong>";
			}
			else{
				echo "Error:->".mysqli_error(Database::getConnection());
			}
		}
	?>
</body>
</html>