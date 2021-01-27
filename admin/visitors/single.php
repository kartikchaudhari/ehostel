<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>
<!-- page content-->
    <div id="page-wrapper" style="padding-left: 30px;padding-right: 30px;">
    	<?php 
    		if (isset($_GET['entry_id'])) {
    			if (is_numeric($_GET['entry_id'])) {
    				$sql="SELECT * FROM eh_visitors WHERE visitor_id=".$_GET['entry_id'];
    				$query=mysqli_query(Database::getConnection(),$sql);
    				$result=mysqli_fetch_assoc($query);
    			}
    			?>
                <h3 align="center">Entry ID: <?=$result['visitor_id']?></h3>
				<hr style="border:1px solid black;">
                <table  class="table-hover table-striped" width="100%">
					<tbody>
						<tr>
							<td><strong>Visitor Type</strong></td>
							<td>
                                <?php 
                                    if($result['visitor_type']==1){
                                        echo "Student";
                                    }
                                    else{
                                        echo "Non Student";
                                    }
                                ?>                     
                            </td>
						</tr>
                        <tr>
                            <td><strong>Visitor UID</strong></td>
                            <td><?=$result['visitor_uid']?></td>
                        </tr>
                        <tr>
                            <td><strong>Visitor Name</strong></td>
                            <td><?=$result['visitor_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Visitor Contact No.</strong></td>
                            <td><?=$result['visitor_contact_no']?></td>
                        </tr>
                         <tr>
                            <td><strong>Visitor Address</strong></td>
                            <td><?=$result['visitor_address']?></td>
                        </tr>
                         <tr>
                            <td><strong>Visited Person Name</strong></td>
                            <td><?=$result['visited_person_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Visited Room No.</strong></td>
                            <td><?=$result['room_no']?></td>
                        </tr>
                        <tr>
                            <td><strong>In Time</strong></td>
                            <td><?=$result['in_time']?></td>
                        </tr>
                        <tr>
                            <td><strong>Out Time</strong></td>
                            <td><?=$result['out_time']?></td>
                        </tr>
                        <tr>
                            <td><strong>On Duty Guard</strong></td>
                            <td><?=$result['guard_id']?></td>
                        </tr>
                        <tr>
                            <td><strong>Entry Timestamp</strong></td>
                            <td><?=$result['entry_timestamp']?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button type="button" class="btn btn-info" onclick="window.close();">Close</button>&nbsp;&nbsp;
                                <button type="button" class="btn btn-success" onclick="printx();">Print</button>
                            </td>
                        </tr>
				</table>
		<?php
    		}
    	?>
  
    </div>
    <!--./page content-->
<!-- footer -->
<script type="text/javascript">
    base_url='<?=base_url('');?>';
    function printx(){
        $("button").css('display', 'none');
        window.print();
        return false;
    }
</script>
<?php
    put_footer(false,null); 
?>