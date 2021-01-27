<?php 
  include 'includes/functions.php';
	put_head("eHostel :: Hostel Rules",null,false);
	include 'includes/nav.php';
?>  
<div class="container-fluid" style="min-height: 502px;">
	<h1 align="center">Hostel Rules</h1>
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php 
				$sql="SELECT * FROM eh_settings";
				$query=mysqli_query(Database::getConnection(),$sql);
				$result=mysqli_fetch_assoc($query);
				echo html_decoder($result['hostel_rules_content']);
			?>	
		</div>
	</div>
	<br>
</div>
<!-- the footer -->
<?php 
	put_footer(true,null);
?>