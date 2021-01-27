<?php 
  session_start();
  include '../../includes/functions.php';
  include '../functions.php';
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
    <?php include "../sidebar.php"; ?>
    <!--./sidebar-->
    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
                <h1>Welcome, <?=pull_information($_SESSION['st_id'],$_SESSION['enrollment'],"fname")?></h1>
                <hr>
                <?php 
                    if (isset($_SESSION['st_id']) && isset($_SESSION['enrollment'])) {
                        $user_id=$_SESSION['st_id'];
                        $enrollment=$_SESSION['enrollment'];

                        $sql="SELECT * FROM eh_students WHERE st_id=$user_id AND enrollment='$enrollment'";
                        $query_result=mysqli_query(Database::getConnection(),$sql);
                        if(@mysqli_num_rows($query_result)>0){
                            $data=mysqli_fetch_assoc($query_result);
                            profile_complete_progresbar($data);
                        }

                    }   
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
