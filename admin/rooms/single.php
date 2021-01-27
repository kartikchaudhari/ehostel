<?php 
  session_start();
  require '../../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>
<!-- page content-->
    <div id="page-wrapper">
        <!--content-->
        <?php 
            if (isset($_GET['room_id'])) {
                if (is_numeric($_GET['room_id'])) {
                    $sql="SELECT * FROM eh_rooms WHERE room_id=".$_GET['room_id'];
                    $query=mysqli_query(Database::getConnection(),$sql);
                    $result=mysqli_fetch_assoc($query);
                }
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Room Information : <?=$result['room_no'];?></h3>
                </div>
                <div class="panel-body">
        			<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td><strong>Room ID</strong></td>
									<td><?=$result['room_id']?></td>
								</tr>
                                <tr>
                                    <td><strong>Room No.</strong></td>
                                    <td><?=$result['room_no']?></td>
                                </tr>
                               <tr>
                                    <td><strong>Total Seats</strong></td>
                                    <td><?=$result['total_seat']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Occupied Seats</strong></td>
                                    <td><?=$result['occupied_seat']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Hostel Block</strong></td>
                                    <td><?= pull_hostel_block_by_id($result['block_id'])?></td>
                                </tr>
                                <tr>
                                    <td><strong>Hostel </strong></td>
                                    <td><?= pull_hostel_by_id($result['hostel_info_id'])?></td>
                                </tr>
						</table>
					</div>		
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Students of Room No. #<?=$result['room_no']?></h3>
                </div>
                <div class="panel-body">
                    <?php 
                        $sql="SELECT st_id, fname, mname, lname, dept_id, enrollment FROM eh_students WHERE room_no=".$result['room_no'];
                        $query=mysqli_query(Database::getConnection(),$sql);
                        if($query->num_rows>0){
                            while($result=mysqli_fetch_assoc($query)){
                    ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>Name</th>
                                            <th>Enrollment</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname'])?></td>
                                            <td><?=$result['enrollment'];?></td>
                                            <td><?=pull_dept_by_id($result['dept_id']);?></td>
                                            <td><button type="button" class="btn btn-success">View</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                    <?php
                        }
                    }
                    else{
                        echo "No Students";
                    } 
                    ?>
                </div>
            </div>  
        <?php
                    }
                ?>      
        <!--content-->
        <div class="row">
            <div class="col-md-2  col-md-offset-4">
                <button type="button" class="btn btn-info" onclick="closeAndRefresh();">Close</button>
            </div>
        </div>
    </div>
    <!--./page content-->
<!-- footer -->
<script type="text/javascript">
    base_url='<?=base_url('');?>';
</script>
<?php
    put_footer(false,null); 
?>