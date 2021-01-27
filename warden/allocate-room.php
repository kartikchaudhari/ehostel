<?php 
  session_start();
  include '../includes/functions.php';
  is_logged_in('warden');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Room Allocation</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/sb-admin.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>">
    </head>
<body>
<div id="wrapper">
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Allocate Room to Student</h3>
                  </div>
                  <div class="panel-body">
                    <?php
                      require '../includes/db.php';
                      if ($_GET['student_id']) {
                        $st_id=$_GET['student_id'];
                        $sql="SELECT fname,lname,enrollment FROM eh_students WHERE st_id=$st_id";
                        $result=mysqli_query($conn,$sql);
                        $row=mysqli_fetch_assoc($result);
                      }
                    ?>
                    <table cellspacing="8" border="1">
                        <tr>
                          <td><strong>Name: </strong> <span><?=$row['fname']." ".$row['lname'];?></span></td>
                        </tr>
                        <tr>
                          <td><strong>Enrollment No.: </strong> <span><?=$row['enrollment'];?></span></td>
                        </tr>
                        <tr><td><input type="hidden" id="st_id" value="<?=$_GET['student_id'];?>"></td></tr>
                        <tr>
                          <td>
                            <strong>Select Room: </strong>
                            <select id="room_name">
                            <option value="">-- Room No. -- (Seat Left)</option>
                            <?php
                              require '../includes/db.php';
                              $sql="SELECT * FROM eh_rooms WHERE occupied_seat=0 OR occupied_seat=1 or occupied_seat=2";
                              $result=mysqli_query($conn,$sql);
                              while($row=mysqli_fetch_assoc($result)):
                            ?>
                              <option value="<?=$row['room_name']?>"><?=$row['room_name']?> (<?=($row['total_seat']-$row['occupied_seat'])?>)</option>
                            <?php 
                              endwhile;
                            ?>

                          </select>
                          </td>
                        </tr>
                        <tr><td>&nbsp;</td>></tr>
                        <tr>
                          <td>
                            <input type="hidden" name="student_id" value="<?=$_GET['student_id'];?>">
                          </td>
                        </tr>
                        <tr>
                          <td><button type="button" class="btn btn-primary" onclick="doAllocate();">Submit</button>&nbsp;<span id="msg"></span></td>
                        </tr>
                      </table>
                      
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- JavaScript -->
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript">
  function doAllocate(){
    var room = $('#room_name').find(":selected").val();
    var student_id=$("#st_id").val();
    $.ajax({
      url: '<?=base_url('includes/ajax.php');?>',
      type: 'POST',
      dataType: 'html',
      data: {'st_id': student_id,'room_name':room},
      success:function(data,status){
          alert(data);
      }
    })
    
  }
</script>

</body>
</html>
