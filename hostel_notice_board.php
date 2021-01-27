<?php 
  	require 'includes/functions.php';
	put_head("eHostel :: Notice Board",null,false);
	include 'includes/nav.php';
?>  
<div class="container-fluid" style="min-height: 502px;">
	<h1 align="center">Hostel Notice Board</h1>
	<hr>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-success">
			<div class="panel-body">
				<!-- notice list -->
				<div class="list-group">
					<?php 
						$sql="SELECT * FROM eh_notice_board WHERE created_for=1 ORDER BY notice_creation_date DESC";
						$query=mysqli_query(Database::getConnection(),$sql);
						if ($query->num_rows>0) {
							while ($row=mysqli_fetch_assoc($query)) {
					?>
							  <a href="<?=base_url('students/notice/single.php?notice_id='.base64_encode($row['notice_id']));?>" class="list-group-item"><?=$row['notice_title'];?> (<strong>From:</strong>
							  	<?php 
							  		if($row['created_by']==2){
							  			$warden_info=pull_warden_by_id($row['created_by_id']);
							  			echo $warden_info['first_name']." ".$warden_info['last_name'];
							  		}
							  		else{
							  			//admin
							  		}
							  	?>, <strong>On:</strong> <?=$row['notice_creation_date']?>)</a>
					<?php
							} 
						}
						else{
					?>
						<h4 align="center">No Notice Found.</h4>
					<?php 
						}
					?>
				</div> 
				<!--./notice list-->
			</div>
		</div>
	</div>
</div>
<!-- the footer -->
<?php 
	put_footer(true,null);
?>