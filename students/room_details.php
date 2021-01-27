<?php 
  session_start();
  include '../includes/functions.php';
  include 'functions.php';
  put_head("Dashboard :: Student Profile",null,true);
  is_logged_in('student');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard :: Student</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/sb-admin.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>">
    </head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
                <h1>Room Information</h1>
                <hr>
                <?php 
                    if (isset($_SESSION['st_id']) && isset($_SESSION['enrollment'])):
                        $user_id=$_SESSION['st_id'];
                        $enrollment=$_SESSION['enrollment'];

                        $sql="SELECT eh_rooms.room_id,eh_rooms.room_name,eh_rooms.total_seat,eh_rooms.occupied_seat,eh_rooms.floor_id,eh_rooms.block_id FROM eh_students,eh_rooms WHERE eh_rooms.room_name=eh_students.room_no AND eh_students.st_id=$user_id AND eh_students.enrollment='$enrollment'";
                        $query_result=mysqli_query($conn,$sql);
                        if(@mysqli_num_rows($query_result)>0):
                            $data=mysqli_fetch_assoc($query_result);
                ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Room Details of <code>Kartik Chaudhari</code></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                      <tr>
                                        <td width="250px"><strong>Hostel Block</strong></td>
                                        <td><?=pull_hostel_block_name($data['block_id']);?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Floor:</strong></td>
                                        <td><?=pull_floor_name($data['floor_id']);?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Room No.:</strong></td>
                                        <td><?=$data['room_name'];?></td>
                                      </tr>
                                      <tr>
                                          <td><strong>Total Seat in Room: </strong></td>
                                          <td><?=$data['total_seat'];?></td>
                                      </tr>
                                      <tr>
                                          <td><strong>Occupied Seat in Room: </strong></td>
                                          <td><?=$data['occupied_seat'];?></td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php 
                        endif;
                    endif;
                ?>

                
          </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- JavaScript -->
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>


</body>
</html>
