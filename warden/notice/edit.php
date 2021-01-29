<?php 
  	require __DIR__.'../../../includes/functions.php';
	$css=array(base_url('assets/richtext/richtext.min.css'));
  	put_head("Notice Board Management :: Warden",$css,false);
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
			<h3 align="center">Update Notice</h3>
			<hr>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-success">
					<div class="panel-body">
						<form action="" method="POST" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="notice_title" placeholder="Enter Notice Title" required="required" value="<?=$row['notice_title'];?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control editor" name="notice_desc" required="required" rows="5">
                                	<?=html_decoder($row['notice_desc']);?>
                                </textarea>
                            </div>
                            <center>
                            	<button type="submit" class="btn btn-success" name="btnSubmit">Submit</button>
	                            <span>&middot;</span>
	                            <button type="reset" class="btn btn-danger">Reset</button>
	                            <span>&middot;</span>
	                            <button type="button" class="btn btn-primary" onclick="window.close();">Close</button>
                            </center>
                            <br>
                            <?php 
                            	if (isset($_POST['notice_title']) && isset($_POST['notice_desc'])) {
                            		$notice_title=clean($_POST['notice_title']);
                            		$notice_desc=html_encoder($_POST['notice_desc']);

                            		$sql="UPDATE eh_notice_board SET notice_title='$notice_title', notice_desc='$notice_desc' WHERE notice_id=$notice_id";
                            		if (mysqli_query(Database::getConnection(),$sql)) {
                                        echo alert_style('success','<strong>Success ! </strong> notice updated successfully.');
                                        prevent_resubmission();
                                    }
                                    else{
                                    	echo alert_style('danger','<strong>Error Occured: </strong> An occured while updating notice.');
                                    }	
                            	}
                            ?>
                        </form>
					</div>
				</div>
				<br>
			</div>
	<?php
			}
		}
	?>
</div>
<!-- the footer -->
<?php
    $js="<script src='".base_url('assets/richtext/jquery.richtext.min.js')."'></script>";
    $js.="<script type='text/javascript'>
            $(document).ready(function() {
            $('.editor').richText();
        });
    </script>";
    put_footer(false,$js); 
?>
