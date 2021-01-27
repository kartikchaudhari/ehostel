<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>
<!-- page content-->
    <div id="page-wrapper">
        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-body">
            	<?php 
            		if (isset($_GET['guard_id'])) {
            			if (is_numeric($_GET['guard_id'])) {
            				$sql="SELECT * FROM eh_security_guards WHERE guard_id=".$_GET['guard_id'];
            				$query=mysqli_query(Database::getConnection(),$sql);
            				$result=mysqli_fetch_assoc($query);
            			}
            			?>
            			<div class="table-responsive">
    						<table class="table table-hover">
    							<tbody>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <img src="<?=base_url($result['avatar']);?>" class="img-responsive" alt="Profile Picture of <?=$result['fname']." ".$result['lname']?>">
                                        </td>
                                    </tr>
    								<tr>
    									<td><strong>Full Name</strong></td>
    									<td><?=$result['fname']." ".$result['lname']?></td>
    								</tr>
                                    <tr>
                                        <td><strong>Contact No.</strong></td>
                                        <td><?=$result['contact']?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Password</strong></td>
                                        <td><button type="button" class="btn btn-sm btn-danger" onclick="resetGuardPassword();">Reset Password</button>&nbsp;<span id="message"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Account Status</strong></td>
                                        <td><?=object_status($result['account_status']);?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Joined On</strong></td>
                                        <td><?=$result['created_at']?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><br></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button type="button" class="btn btn-info" onclick="closeAndRefresh();">Close</button> </td>
                                    </tr>
    						</table>
    					</div>		
				<?php
            		}
            	?>
            </div>
        </div>        
        <!--content-->
    </div>
    <!--./page content-->
<!-- footer -->
<script type="text/javascript">
    base_url='<?=base_url('');?>';
</script>
<?php
    put_footer(false,null); 
?>