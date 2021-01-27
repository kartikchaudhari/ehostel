<?php 
	include "db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Portal</title>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="jquery-barcode.js"></script>
</head>
<body>
<h1 align="center">Welcome to Student Portal</h1>
<hr width="70%" align="center">
<br>
<table align="center" border="1" width="70%">
	<tr>
		<th>Sr. No.</th>
		<th>Enrollment No.</th>
		<th>Name</th>
		<th>Barcode</th>
	</tr>
	<?php 
		$i=1;
		$sql="SELECT * FROM students";
		$query=mysqli_query($conn,$sql);
		while ($row=mysqli_fetch_assoc($query)):
	?>
		<tr>
		<td align="center"><?=$i?></td>
		<td align="center"><?=$row['enrollment']?></td>
		<td align="center"><?=$row['first_name']." ".$row['last_name']?></td>
		<td align="center">
			<button onclick="makeBarcode('<?=$row['enrollment']?>');"><?=$row['enrollment']?></button>
			<div id="<?=$row['enrollment']?>"></div>
		</td>
	</tr>
	<?php
			$i++; 
		endwhile;
	?>
</table>
<div id="demo"></div>
<script type="text/javascript">
	function makeBarcode(enrollment){
		$("#"+enrollment).barcode(enrollment,"code39");
	}
</script>
</body>
</html>