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
            		if (isset($_GET['hostel_id'])) {
            			if (is_numeric($_GET['hostel_id'])) {
            				$sql="SELECT * FROM eh_hostel_info WHERE info_id=".$_GET['hostel_id'];
            				$query=mysqli_query(Database::getConnection(),$sql);
            				$result=mysqli_fetch_assoc($query);
            			}
            			?>
            			<div class="table-responsive">
    						<table class="table table-hover">
    							<tbody>
    								<tr>
    									<td><strong>Hostel Name</strong></td>
    									<td><?=$result['hostel_name']?></td>
    								</tr>
    								<tr>
    									<td><strong>Total Rooms</strong></td>
    									<td><?=$result['total_rooms']?></td>
    								</tr>
    								<tr>
    									<td><strong>Capacity</strong></td>
    									<td><?=$result['capacity']?></td>
    								</tr>
    								<tr>
    									<td><strong>Guest Rooms</strong></td>
    									<td><?=$result['guest_rooms']?></td>
    								</tr>
    								<tr>
    									<td><strong>T.V Rooms</strong></td>
    									<td><?=$result['tv_rooms']?></td>
    								</tr>
    								<tr>
    									<td><strong>Mess</strong></td>
    									<td><?=$result['mess_count']?></td>
    								</tr>
    								<tr>
    									<td><strong>Reading Rooms</strong></td>
    									<td><?=$result['reading_rooms']?></td>
    								</tr>
    								<tr>
    									<td><strong>Office Rooms</strong></td>
    									<td><?=$result['office_rooms']?></td>
    								</tr>
    								<tr>
    									<td><strong>Hostel Status</strong></td>
    									<td><?=object_status($result['hostel_status']);?></td>
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
<?php
    put_footer(false,null); 
?>