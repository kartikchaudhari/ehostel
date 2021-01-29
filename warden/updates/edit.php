<?php 
  	require __DIR__.'../../../includes/functions.php';
  	put_head("Notice Board Management :: Warden",null,false);
?>  
<div class="container-fluid" style="min-height: 502px;">
	<?php
		if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
			$update_id=base64_decode($_GET['update_id']);

			$sql="SELECT * FROM eh_updates WHERE update_id=$update_id";
			$query=mysqli_query(Database::getConnection(),$sql);
			if ($query->num_rows>0) {
				$row=mysqli_fetch_assoc($query);
	?>
			<h3 align="center">Update News</h3>
			<hr>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-success">
					<div class="panel-body">
						<form action="" method="POST" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Enter News Title" required="required" value="<?=$row['title'];?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" required="required" rows="5">
                                	<?=html_decoder($row['content']);?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <input type="website" class="form-control" name="hyperlink" placeholder="Attachment hyperlink" required="required" value="<?=$row['hyperlink'];?>">
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
                            	if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['hyperlink'])) {
                            		
                                    $title=clean($_POST['title']);
                                    $content=clean($_POST['content']);
                                    $hyperlink=$_POST['hyperlink'];

                            		$sql="UPDATE eh_updates SET title='$title', content='$content',hyperlink='$hyperlink' WHERE update_id=$update_id";
                            		if (mysqli_query(Database::getConnection(),$sql)) {
                                        echo alert_style('success','<strong>Success ! </strong> News updated successfully.');
                                        prevent_resubmission();
                                    }
                                    else{
                                    	echo alert_style('danger','<strong>Error Occured: </strong> An occured while updating news.');
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
    put_footer(false,null); 
?>
