<?php 
  session_start();
  include '../includes/functions.php';
  is_logged_in('warden');
  $css=".student-request {
        border-collapse: separate;
        border-spacing: 5px;
    }";
  put_head("Dashboard :: Warden",$css,true);

  $prev_date=date('d-m-Y', strtotime('-3 days'));
  $cur_date=date('d-m-Y');            
?>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->
    
    <!-- page content-->
    <div id="page-wrapper">
      
      <!-- stat tiles -->
        <div class="row">
            <div class="col-lg-12">
                <!-- total students -->
                <div class="col-lg-3">
                   <div class="panel panel-info">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">456</p>
                               <p class="announcement-text">Total Students</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  View Requests
                               </div>
                               <div class="col-xs-6 text-right">
                                  <i class="fa fa-arrow-circle-right"></i>
                               </div>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>
                <!--./total students-->

                <!-- total alloted rooms -->
                <div class="col-lg-3">
                   <div class="panel panel-warning">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-check fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">12</p>
                               <p class="announcement-text">Total Alloted Rooms</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  View Room Details
                               </div>
                               <div class="col-xs-6 text-right">
                                  <i class="fa fa-arrow-circle-right"></i>
                               </div>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>
                <!--./total alloted rooms-->

                <!-- visiter book -->
                <div class="col-lg-3">
                   <div class="panel panel-danger">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">18</p>
                               <p class="announcement-text">Total Visitors Today</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  View Total Visitors
                               </div>
                               <div class="col-xs-6 text-right">
                                  <i class="fa fa-arrow-circle-right"></i>
                               </div>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>
                <!--./visitor book -->

                <!--fee receipts-->
                <div class="col-lg-3">
                   <div class="panel panel-success">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">56</p>
                               <p class="announcement-text">Total Fee Receipts</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  View Fee Receipts
                               </div>
                               <div class="col-xs-6 text-right">
                                  <i class="fa fa-arrow-circle-right"></i>
                               </div>
                            </div>
                         </div>
                      </a>
                   </div>
                </div>
                <!--./fee receipts-->
            </div>
        </div>
      <!--./stat tiles-->

      <!-- request lists -->
      <div class="row">
          <!-- recent student request -->
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Recent Registration Request</h3>
              </div>
              <div class="panel-body">
               
                <div class="list-group">
                <?php 
                  $sql="SELECT * FROM eh_students WHERE admission_date BETWEEN '$prev_date' AND '$cur_date' AND account_status=0 ORDER BY admission_date DESC";
                  $query=mysqli_query(Database::getConnection(),$sql);
                  if($query->num_rows>0){
                    while($result=mysqli_fetch_assoc($query)){
                ?>
                  <a href="<?=base_url('warden/students/single-request.php?st_id='.$result['st_id']);?>" class="list-group-item" style="padding: 5px;">
                    <table class="student-request" width="100%">
                      <tr>
                        <td rowspan="2">
                          <img class="img-thumbnail" alt="<?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname'])?>" title="<?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname'])?>" src="<?=base_url($result['avatar']);?>" style="height: 50px;width: 50px;">
                        </td>
                        <td colspan="2"><strong><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname'])?></strong></td>
                      </tr>
                      <tr>
                        <td class="text-right"><i class="fa fa-clock-o"></i>&nbsp;<?=date_format(date_create($result['date_creation']),'d-m-Y H:i:s A');?></td>
                      </tr>
                    </table>
                  </a>
                <?php 
                      }
                    }
                    else{
                      echo "<span class='text-muted text-center'>No Registration Request<span>";
                    }
                ?>
                </div>
                
                <div class="text-right">
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <!--./recent student request -->
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Hostel Visitors</h3>
              </div>
              <div class="panel-body">
                <div class="list-group">
                  <a href="#" class="list-group-item">
                    <span class="badge">just now</span>
                    <i class="fa fa-calendar"></i> Calendar updated
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">4 minutes ago</span>
                    <i class="fa fa-comment"></i> Commented on a post
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">23 minutes ago</span>
                    <i class="fa fa-truck"></i> Order 392 shipped
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">46 minutes ago</span>
                    <i class="fa fa-money"></i> Invoice 653 has been paid
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">1 hour ago</span>
                    <i class="fa fa-user"></i> A new user has been added
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">2 hours ago</span>
                    <i class="fa fa-check"></i> Completed task: "pick up dry cleaning"
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">yesterday</span>
                    <i class="fa fa-globe"></i> Saved the world
                  </a>
                  <a href="#" class="list-group-item">
                    <span class="badge">two days ago</span>
                    <i class="fa fa-check"></i> Completed task: "fix error on sales page"
                  </a>
                </div>
                <div class="text-right">
                  <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Recently Uploaded Fee Receipts</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th class="header">Order # <i class="fa fa-sort"></i></th>
                        <th class="header">Order Date <i class="fa fa-sort"></i></th>
                        <th class="header">Order Time <i class="fa fa-sort"></i></th>
                        <th class="header">Amount (USD) <i class="fa fa-sort"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>3326</td>
                        <td>10/21/2013</td>
                        <td>3:29 PM</td>
                        <td>$321.33</td>
                      </tr>
                      <tr>
                        <td>3325</td>
                        <td>10/21/2013</td>
                        <td>3:20 PM</td>
                        <td>$234.34</td>
                      </tr>
                      <tr>
                        <td>3324</td>
                        <td>10/21/2013</td>
                        <td>3:03 PM</td>
                        <td>$724.17</td>
                      </tr>
                      <tr>
                        <td>3323</td>
                        <td>10/21/2013</td>
                        <td>3:00 PM</td>
                        <td>$23.71</td>
                      </tr>
                      <tr>
                        <td>3322</td>
                        <td>10/21/2013</td>
                        <td>2:49 PM</td>
                        <td>$8345.23</td>
                      </tr>
                      <tr>
                        <td>3321</td>
                        <td>10/21/2013</td>
                        <td>2:23 PM</td>
                        <td>$245.12</td>
                      </tr>
                      <tr>
                        <td>3320</td>
                        <td>10/21/2013</td>
                        <td>2:15 PM</td>
                        <td>$5663.54</td>
                      </tr>
                      <tr>
                        <td>3319</td>
                        <td>10/21/2013</td>
                        <td>2:13 PM</td>
                        <td>$943.45</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="text-right">
                  <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!--./request lists-->

    </div>
    <!--./page content-->
</div>
<?php 
    put_footer(null,false);
?>