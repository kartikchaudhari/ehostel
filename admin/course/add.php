<!DOCTYPE html>
<html>
<head>
	<title>Add Course</title>
</head>
<body>
	<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
		<span>Course Name:</span>
		<input type="text" name="c_name" placeholder="Course Name (Ex. BE, ME)" style="width: 200px;">
		<br>
		<span>Coure Duration:</span>
		<select name="c_duration" style="width: 200px;">
			<?php for($i=1;$i<11;$i++): ?>
				<option value="<?=$i?>"><?=$i;?></option>
			<?php endfor; ?>
		</select>
		<br>
		<button type="submit" name="btnSubmit">Submit</button>
	</form>
	<?php 
		require "../../includes/functions.php";
		if (isset($_POST['btnSubmit'])) {
			$c_name=$_POST['c_name'];
			$c_duration=$_POST['c_duration'];

			$sql="INSERT INTO eh_courses (c_name,c_duration) VALUES ('$c_name', '$c_duration')";
			if(mysqli_query(Database::getConnection(),$sql)){
				echo "Course added Successfully";
			}
		}
	?>
</body>
</html>