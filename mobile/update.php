<?php 
	include "../includes/functions.php";
	put_head("eHostel :: News and Updates",null,false);
?>  
<div class="container-fluid" style="min-height: 502px;">
<!-- 	<h1 align="center">News and Updates</h1> -->
	<hr>
	<div class="col-md-10 col-md-offset-1">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-success">
					<div class="panel-body">
						<?php 
							if (isset($_GET['update_id'])) {
								if (is_numeric($_GET['update_id'])) {
									$sql="SELECT * FROM `eh_updates` WHERE update_id=".$_GET['update_id'];
									$query=mysqli_query(Database::getConnection(),$sql);
									while($row=mysqli_fetch_assoc($query)){
										echo "<h4 align='center'>".$row['title']."</h4><hr>";
										echo '
												<table class="table table-hover table-striped">
													<tbody>
														<tr>
															<td><strong>Update Date: </strong></td>
															<td>'.$row['creation_date'].'</td>
														</tr>
														<tr>
															<td><strong>Description: </strong></td>
															<td><span style="text-align:justify;">'.$row['content'].'</span></td>
														</tr>
														<tr>
															<td><strong>Attachment(s): </strong></td>
															<td><span style="text-align:justify;"><a class="btb btn-sm btn-success" href="'.$row['hyperlink'].'"><i class="fa fa-eye"></i> View</a></span></td>
														</tr>
													</tbody>
												</table>
										';
									}
								}
								else{
									echo "<h3 align='center'>No Record Found</h3>";
								}	
							}
							else{
								echo "<h3 align='center'>No Record Found</h3>";

							}
						?>

						<h3></h3>
					</div>
				</div>
			</div>
		</div>
</div>
<!-- the footer -->
<?php 
	put_footer(false,null);
?>