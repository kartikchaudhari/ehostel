<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('warden');
  $css=array(base_url('assets/richtext/richtext.min.css'));
  put_head("Settings :: Warden",$css,true);
?>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->

    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                      <a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">Room Allocation Request</a>
                    </li>
                    <li role="presentation">
                      <a href="#tab2" aria-controls="tab" role="tab" data-toggle="tab">Students</a>
                    </li>
                  </ul>
                
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- room allocation request -->
                    <div role="tabpanel" class="tab-pane active" id="tab1">
                      <br>
                      <table id="request_table" class="table table-responsive table-bordered">
                          <thead>
                            <tr class="active">
                              <th>Sr. No.</th>
                              <th>Name</th>
                              <th>Enrollment No.</th>
                              <th>Department</th>
                              <th>Contact No.</th>
                              <th>Action</th>   
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                              require '../includes/db.php';
                              $sql="SELECT * FROM eh_students WHERE room_no IS NULL";
                              $result=mysqli_query($conn,$sql);
                              
                              while($row=mysqli_fetch_assoc($result)):
                          ?>
                          <tr>
                            <td>1</td>
                            <td><?=$row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                            <td><?=$row['enrollment']?></td>
                            <td><?=$row['dept_id']?></td>
                            <td><?=$row['contact']?></td>
<td><button onclick="window.open('allocate-room.php?student_id=<?=$row["st_id"];?>','_blank','toolbar=no, location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=500')">Allocate</button></a></td>
                          </tr>
                          <?php
                            endwhile;
                          ?>
                          </tbody>
                      </table>
                    </div>
                    <!--./room allocation request -->
                    
                    <!-- students list -->
                    <div role="tabpanel" class="tab-pane" id="tab2">
                      <br>
                      <table id="student_table" class="table table-responsive table-bordered">
                          <thead>
                            <tr class="active">
                              <th>Sr. No.</th>
                              <th>Name</th>
                              <th>Enrollment No.</th>
                              <th>Department</th>
                              <th>Contact No.</th>
                              <th>Room No.</th>
                              <th>Action</th>   
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                              require '../includes/db.php';
                              $sql="SELECT * FROM eh_students";
                              $result=mysqli_query($conn,$sql);
                              
                              while($row=mysqli_fetch_assoc($result)):
                          ?>
                          <tr>
                            <td>1</td>
                            <td><?=$row['fname']." ".$row['mname']." ".$row['lname'];?></td>
                            <td><?=$row['enrollment']?></td>
                            <td><?=$row['dept_id']?></td>
                            <td><?=$row['contact']?></td>
                            <td><?=$row['room_no']?></td>
                            <td><?=$row['st_id'];?></td>
                          </tr>
                          <?php
                            endwhile;
                          ?>
                          </tbody>
                      </table>
                    </div>
                    <!--./students list-->
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- footer -->
<?php
    $js="<script src='".base_url('assets/richtext/jquery.richtext.min.js')."'></script>";
    $js.="<script type='text/javascript'>
            $(document).ready(function() {
            $('.editor').richText();
        });
    </script>";
    put_footer(false,$js); 
?>
