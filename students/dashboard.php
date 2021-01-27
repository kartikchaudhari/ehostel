<?php 
  session_start();
  require '../includes/functions.php';
  require 'functions.php';
  is_logged_in('student');
  put_head("Dashboard :: Student",null,true);
?>

<div id="wrapper">
    
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
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
<?php
    put_footer(null,false); 
?>