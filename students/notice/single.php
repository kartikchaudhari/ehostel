<?php 
  	require __DIR__.'../../../includes/functions.php';
	put_head("eHostel :: Notice Board",null,false);
	include __DIR__.'../../../includes/nav.php';
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
									<div class="col-md-6">
										<strong>Created By: </strong> <span>K. A. Patel</span>
									</div>
									<div class="col-md-6 text-right">
										<strong>Created At: </strong> <span>12-12-3030 31:00:12</span>
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-info">
							<div class="panel-body">
								<?=$row['notice_desc']?>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php
			}
		}
	?>
</div>
<!-- the footer -->
<?php 
	put_footer(true,null);
?>