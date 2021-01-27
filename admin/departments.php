<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('admin');
  put_head("Dashboard :: Administrator",null,true);
?>

<div id="wrapper">
    


    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->
    
    <!-- page content-->
    <div id="page-wrapper">
        
        <!--breadcrumbs-->
        <?php 
            $root=array('url'=>base_url('admin/dashboard.php'),'text'=>'Dashboard');
            $child="Departments";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->
    	
        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center text-strong panel-title">Department Management</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                   <!-- Nav tabs -->
                   <ul class="nav nav-tabs" role="tablist">
                       <li role="presentation" class="active">
                           <a href="#add" aria-controls="add" role="tab" data-toggle="tab">
                            <i class="fa fa-plus"></i> Add Department</a>
                       </li>
                       <li role="presentation">
                           <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> Manage Departments</a>
                       </li>
                   </ul>
               
                   <!-- Tab panes -->
                   <div class="tab-content">
                        <!--add department panel start -->
                       <div id="add" role="tabpanel" class="tab-pane active" style="padding: 20px;">
                           <!--the form-->
                           <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="dept_name" placeholder="Department Name (Ex. Computer Enginnering)"  tabindex="1" required="required">
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="dept_status" required="required" tabindex="2">
                                                <option value="">-- Select Department Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">De-Active</option>
                                            </select>
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="col-md-4">
                                            <button type="submit" class="btn btn-success" name="btnAddDept" tabindex="3">Submit</button>
                                            &nbsp;<strong>&middot;</strong>&nbsp;
                                            <button type="reset" class="btn btn-danger" tabindex="4">Reset</button>
                                        </div>
                                   </div>
                               </div>
                           </form>
                           <!--./the form-->
                           <br>
                           <!--alert -->
                            <div class="row">
                                <div class="col-md-12">
                                    <?php 
                                        if (isset($_POST['btnAddDept'])) {
                                            $sql="INSERT INTO `eh_departments` (dept_name,dept_status) VALUES ('".clean($_POST['dept_name'])."',".$_POST['dept_status'].")";
                                            
                                            if(mysqli_query(Database::getConnection(),$sql)){
                                                $hostel_id= Database::getConnection()->insert_id;
                                                echo alert_style('success','<strong>Success ! </strong> '.clean($_POST['dept_name']).' is added successfully. click <a href="'.base_url('admin/hostel/single.php?hostel_id='.$hostel_id).'">here</a> to see details.');
                                                prevent_resubmission();
                                            }
                                            else{
                                                echo alert_style('danger','<strong>Error Occured: </strong>'.mysqli_error(Database::getConnection()));
                                            }

                                        }
                                    ?> 
                                </div>
                            </div>                          
                            
                           <!--./alert -->
                       </div>
                        <!--./add hostel panel ends-->

                        <!--manage hostel info start-->
                       <div id="manage" role="tabpanel" class="tab-pane" style="padding:20px; ">
                          <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                              <thead>
                                <tr class="active">
                                  <th>No.</th>
                                  <th>Department Name</th>
                                  <th>Hostel Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $sql="SELECT * FROM `eh_departments`";
                                $query=mysqli_query(Database::getConnection(),$sql);

                                if ($query->num_rows>0) {
                                  $i=1;
                                  while ($row=mysqli_fetch_assoc($query)) {
                                    $viewHostelUrl=base_url('admin/hostel/single.php?hostel_id='.$row['dept_id']);
                                    $editHostelUrl=base_url('admin/hostel/edit.php?hostel_id='.$row['dept_id']);
                                    $deleteHostelUrl=base_url('admin/hostel/edit.php?hostel_id='.$row['dept_id']);
                                    echo "<tr>
                                                <td align='center'>".$i.".</td>
                                                <td align='center'>".$row['dept_name']."</td>
                                                <td align='center'>".object_status($row['dept_status'])."</td>
                                                <td align='center'>
                                                    <div class='btn-group'>
                                                      <button type='button' class='btn btn-success' onclick='viewSingleHostel(\"".$viewHostelUrl."\")'><i class='fa fa-eye'></i> View</button>
                                                    
                                                      <button type='button' class='btn btn-info' onclick='editSingleHostel(\"".$editHostelUrl."\")'><i class='fa fa-pencil'></i> Edit</button>
                                                    
                                                      <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteHostel' onclick='assignHostelId(\"".$row['dept_id']."\")'><i class='fa fa-trash-o' ></i> Delete</button>
                                                    </div>
                                                </td>
                                          </tr>";
                                    $i++;
                                  }
                                }
                                else{
                                    echo "<td align='center' colspan='4'>No Hostels Found, please goto <strong> Add Hostel</strong> Section to add one.</td>";
                                }
                              ?>  
                               
                              </tbody>
                            </table>
                          </div>
                       </div>
                       <!--./manage hostel info ends-->
                   </div>
               </div>           
            </div>
        </div>        
        <!--content-->

       <!--models-->
       <!-- view hostel info-->
        <div id="viewHostel" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">eHostel Management  System :: View Hostel info</h4>
              </div>
              <div id="modal-body-view" class="modal-body">
                <p>Loading data...</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
       <!--./view hostel info-->

        <!-- edit hostel info-->
        <div id="deleteHostel" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">eHostel Management  System :: Delete Hostel</h4>
              </div>
              <div class="modal-body">
                <p id="model-body-content">Are you Sure you wated this hostel ? <br>
                  You can not restore the data of this particular hostel.<br>
                  Press <strong>Delete</strong> to delete record, Press <strong>Cancel</strong> to canel the operation.
                </p>
                <div id="model-progress" style="text-align: center;display: none;">
                  <h4 align="center">Proccesing Request</h4>
                  <img align="center" height="100px"  width="150px" src="<?=base_url('assets/images/big-loader.gif');?>">
                </div>
                <form><input type="hidden" id="hostel_id"></form>
              </div>
              <div id="modal-footer" class="modal-footer">
                <button id="btnDeleteHostel"  type="button" class="btn btn-danger" onclick="deleteHostel('<?=base_url("admin/hostel/ajax.php")?>')">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
       <!--./edit hostel info-->

       

    </div>
    <!--./page content-->
</div>
<!-- footer -->
<?php
   put_footer(false); 
?>