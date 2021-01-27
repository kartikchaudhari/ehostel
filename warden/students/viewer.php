<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('warden');
  put_head("Dashboard :: Warden",null,false);
?>
<div class="container-fluid" style="padding-top: 20px;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php 
					if (is_numeric($_GET['st_id']) && is_numeric($_GET['record_id']) && is_numeric($_GET['doc_type'])) {
						$doc_type=$_GET['doc_type'];
						switch ($doc_type) {
							case 1:
								echo "ACPC Admission Letter";
							break;

							case 2:
								echo "Residence Proof";
							break;

							case 4:
								echo "SBI Collect Fee Receipt";
							break;
						}
					}
				?>	
			</h3>
		</div>
		<div class="panel-body">
			<?php 
				if (is_numeric($_GET['st_id']) && is_numeric($_GET['record_id']) && is_numeric($_GET['doc_type'])){
					$st_id=$_GET['st_id'];
					$record_id=$_GET['record_id'];
					$doc_type=$_GET['doc_type'];
					switch ($doc_type) {
						case 1:
							$sql="SELECT admission_letter_path FROM eh_registration_docs WHERE st_id=$st_id AND record_id=$record_id";
						break;

						case 2:
							$sql="SELECT residence_proof_path FROM eh_registration_docs WHERE st_id=$st_id AND record_id=$record_id";
						break;

						case 4:
							$sql="SELECT payment_receipt_path FROM eh_registration_docs WHERE st_id=$st_id AND record_id=$record_id";
						break;
					}

					$query=mysqli_query(Database::getConnection(),$sql);
					$result=mysqli_fetch_array($query);
					echo "<img class='img-responsive' src='".base_url($result[0])."' />";
				}
			?>
		</div>
	</div>	
</div>

<!-- footer -->
<?php
    put_footer(false,null); 
?>

    