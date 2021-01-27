<?php 
  session_start();
  include '../includes/functions.php';
  is_logged_in('admin');
  $js="";
  put_head("Dashboard :: Administrator",null,true);
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
                <!-- student request -->
                <div class="col-lg-3">
                   <div class="panel panel-info">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">456</p>
                               <p class="announcement-text">Room Allocation</p>
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
                <!--./student request-->

                <!-- rooms -->
                <div class="col-lg-3">
                   <div class="panel panel-warning">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-check fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">12</p>
                               <p class="announcement-text">Rooms</p>
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
                <!--./rooms-->

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
                               <p class="announcement-text">Total Visitors</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  View Today's Visitors
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

                <!--./fee receipts-->
                <div class="col-lg-3">
                   <div class="panel panel-success">
                      <div class="panel-heading">
                         <div class="row">
                            <div class="col-xs-6">
                               <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                               <p class="announcement-heading">56</p>
                               <p class="announcement-text">New Receipts</p>
                            </div>
                         </div>
                      </div>
                      <a href="#">
                         <div class="panel-footer announcement-bottom">
                            <div class="row">
                               <div class="col-xs-6">
                                  Verify Fee Receipts
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
      <!--./stat tiles -->

      <!-- request lists -->
      <!--./request lists -->
    </div>
    <!--./page content-->
</div>
<?php 
    put_footer(null,false);
?>