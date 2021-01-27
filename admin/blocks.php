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
            $child="Blocks";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->
    	
        <!--content-->
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="text-center text-strong panel-title">Block Management</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                   <!-- Nav tabs -->
                   <ul class="nav nav-tabs" role="tablist">
                       <li role="presentation" class="active">
                           <a href="#add" aria-controls="add" role="tab" data-toggle="tab">
                            <i class="fa fa-plus"></i> Add Block</a>
                       </li>
                       <li role="presentation">
                           <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> Manage Block</a>
                       </li>
                   </ul>
               
                   <!-- Tab panes -->
                   <div class="tab-content">
                        <!--add hostel panel start -->
                       <div id="add" role="tabpanel" class="tab-pane active" style="padding: 20px;">
                           <!--the form-->
                           <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="block_name" placeholder="Block Name (Ex. Boys Hostel Block 1)"  tabindex="1" required="required">
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <select class="form-control" name="hostel_id" required="required" tabindex="3">
                                                <option value="">-- Select Hostel--</option>
                                                <?php 
                                                    $sql="SELECT * FROM eh_hostel_info";
                                                    $query=mysqli_query(Database::getConnection(),$sql);
                                                    if($query->num_rows>0){
                                                      while($row=mysqli_fetch_assoc($query)){
                                                        echo "<option value='".$row['info_id']."'>".$row['hostel_name']."</option>";
                                                      }
                                                    }
                                                    else{
                                                      echo "<option value=''> No Hostel Found </option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="col-md-6">
                                            <button type="submit" class="btn btn-success" name="btnAddBlock" tabindex="4">Submit</button>
                                            &nbsp;<strong>&middot;</strong>&nbsp;
                                            <button type="reset" class="btn btn-danger" tabindex="5">Reset</button>
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
                                        if (isset($_POST['btnAddBlock'])) {
                                            $sql = "INSERT INTO `eh_blocks` (`block_name`, `hostel_info_id`) VALUES ('".clean($_POST['block_name'])."', '".$_POST['hostel_id']."')";
                                            if(mysqli_query(Database::getConnection(),$sql)){
                                                echo alert_style('success','<strong>Success ! </strong> '.clean($_POST['block_name']).' is added successfully.');
                                                
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
                                  <th>Block Name</th>
                                  <th>Hostel Name</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $sql = "SELECT eh_blocks.block_id,eh_blocks.block_name,eh_hostel_info.hostel_name FROM eh_blocks LEFT JOIN eh_hostel_info ON eh_hostel_info.info_id=eh_blocks.hostel_info_id";
                                $query=mysqli_query(Database::getConnection(),$sql);

                                if ($query->num_rows>0) {
                                  $i=1;
                                  while ($row=mysqli_fetch_assoc($query)) {
                                    $editBlockUrl=base_url('admin/block/edit.php?block_id='.$row['block_id']);
                                    $deleteBlockUrl=base_url('admin/block/edit.php?block_id='.$row['block_id']);
                                    echo "<tr>
                                                <td align='center'>".$i.".</td>
                                                <td align='center'>".$row['block_name']."</td>
                                                <td align='center'>".$row['hostel_name']."</td>
                                                <td align='center'>
                                                    <div class='btn-group'>
                                                      <button type='button' class='btn btn-info' onclick='editSingleBlock(\"".$editBlockUrl."\")'><i class='fa fa-pencil'></i> Edit</button>
                                                    
                                                      <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteBlock' onclick='assignBlocklId(\"".$row['block_id']."\")'><i class='fa fa-trash-o' ></i> Delete</button>
                                                    </div>
                                                </td>
                                          </tr>";
                                    $i++;
                                  }
                                }
                                else{
                                    echo "<td align='center' colspan='4'>No Blocks Found, please goto <strong> Add Block</strong> Section to add one.</td>";
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
        <!-- edit block info-->
        <div id="deleteBlock" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">eHostel Management  System :: Delete Block</h4>
              </div>
              <div class="modal-body">
                <p id="model-body-content">Are you Sure you wanted to delete this block ? <br>
                  You can not restore the data of this particular block.<br>
                  Press <strong>Delete</strong> to delete record, Press <strong>Cancel</strong> to canel the operation.
                </p>
                <div id="model-progress" style="text-align: center;display: none;">
                  <h4 align="center">Proccesing Request</h4>
                  <img align="center" height="100px"  width="150px" src="<?=base_url('assets/images/big-loader.gif');?>">
                </div>
                <form><input type="hidden" id="block_id"></form>
              </div>
              <div id="modal-footer" class="modal-footer">
                <button id="btnDeleteBlock"  type="button" class="btn btn-danger" onclick="deleteBlock('<?=base_url("admin/block/ajax.php")?>')">Delete</button>
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