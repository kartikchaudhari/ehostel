<?php 
  	include 'includes/functions.php';
	put_head("eHostel :: Hostel Co-ordinators",null,false);
	include 'includes/nav.php';
?>
<div class="container-fluid" style="min-height: 502px;">
	<h1 align="center">Hostel Co-ordinators</h1>
	<hr>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-body">
						<table class="table table-striped table-hover table-bordered">
							<thead>
								<tr class="active">
								<th>Name</th>
								<th>Department</th>
								<th>Designation</th>
							</tr>
							</thead>
							<?php 
								$sql="SELECT * FROM eh_wardens";
								$query=mysqli_query(Database::getConnection(),$sql);
								while ($row=mysqli_fetch_assoc($query)):
							?>
								<tr>
									<td><?=$row['first_name']." ".$row['last_name']?> </td>
									<td><?=pull_dept_by_id($row['dept_id']);?></td>
									<td>
										<?=pull_role_by_id($row['role_id'])?>
										(<?=pull_hostel_by_id($row['allocated_to'])?>)
									</td>
								</tr>
							<?php
								endwhile;
							?>	
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
</div>

<!-- the footer -->
<?php 
	put_footer(true,null);
?>
