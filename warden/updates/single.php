<?php 
  	require __DIR__.'../../../includes/functions.php';
	put_head("eHostel :: News and Updates",null,false);
?>  
<div class="container-fluid" style="min-height: 502px;">
	<?php
		if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
			$update_id=base64_decode($_GET['update_id']);

			$sql="SELECT * FROM `eh_updates` WHERE update_id=$update_id";
			$query=mysqli_query(Database::getConnection(),$sql);
			if ($query->num_rows>0) {
				$row=mysqli_fetch_assoc($query);
	?>
			<h1 align="center"><?=$row['title']?></h1>
			<hr>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-success">
					<div class="panel-body">
						<div class="alert alert-info">
							<div class="row">
								<div class="col-md-12">
									<span><strong>Created By: </strong> <span>
										<?php 
                                            $info=pull_warden_by_id($row['created_by']);
                                            echo $info['first_name']." ".$info['last_name'];
                                        ?>
									</span></span>
									<span class="pull-right"><strong>Created At: </strong> <span><?=$row['creation_date']?></span></span>
								</div>
							</div>
						</div>

						<div class="panel panel-info">
							<div class="panel-body">
								<?=html_decoder($row['content']);?>
								<?php 
									if (!empty($row['hyperlink'])) {
								?>
									<hr>
									<center><a href="<?=$row['hyperlink']?>"><button type="button" class="btn btn-success">Click Here to View Attachment</button></a></center>
								<?php 
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<center><button type="button" class="btn btn-primary" onclick="window.close();">Close</button></center>
			</div>
	<?php
			}
		}
	?>
</div>
<!-- the footer -->
<?php 
	put_footer(false,null);
?>