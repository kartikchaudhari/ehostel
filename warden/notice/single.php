<?php 
  	require __DIR__.'../../../includes/functions.php';
	put_head("eHostel :: Notice Board",null,false);
?>  
<div class="container-fluid" style="min-height: 502px;">
	<?php
		if (isset($_GET['notice_id']) && !empty($_GET['notice_id'])) {
			$notice_id=base64_decode($_GET['notice_id']);

			$sql="SELECT * FROM eh_notice_board WHERE notice_id=$notice_id";
			$query=mysqli_query(Database::getConnection(),$sql);
			if ($query->num_rows>0) {
				$row=mysqli_fetch_assoc($query);
	?>
			<h1 align="center"><?=$row['notice_title']?></h1>
			<hr>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-success">
					<div class="panel-body">
						<div class="alert alert-info">
							<div class="row">
								<div class="col-md-12">
									<span><strong>Created By: </strong> <span>
										<?php 
                                            $info=pull_warden_by_id($row['created_by_id']);
                                            echo $info['first_name']." ".$info['last_name'];
                                        ?>
									</span></span>
									<span class="pull-right"><strong>Created At: </strong> <span><?=$row['notice_creation_date']?></span></span>
								</div>
							</div>
						</div>

						<div class="panel panel-info">
							<div class="panel-body">
								<?=html_decoder($row['notice_desc']);?>
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