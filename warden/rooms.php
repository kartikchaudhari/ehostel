<?php 
  session_start();
  require '../includes/functions.php';
  $css=array(   
                base_url('assets/datatable/datatables/css/jquery.dataTables.min.css'),
                "https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
                "https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"
            );

  is_logged_in('warden');
  put_head("Dashboard :: Warden - Rooms",$css,true);
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
            $child="Security Guards";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Manage Security Guards</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                   <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#add" aria-controls="add" role="tab" data-toggle="tab"> <i class="fa fa-plus"></i> Add New Security Guard</a>
                        </li>
                        <li role="presentation">
                            <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">
                                <i class="fa fa-cog"></i> Manage
                            </a>
                        </li>
                    </ul>
               
                   <!-- Tab panes -->
                    <div class="tab-content">
                        
                        <!-- add new security guard-->
                        <div role="tabpanel" class="tab-pane active" id="add">
                            <!--the form-->
                            <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input name="first_name" type="text" class="form-control" placeholder="First Name" pattern="[A-Za-z]{1,20}" title="First Name Contains Only Alphabates" tabindex="1" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" pattern="[A-Za-z]{1,20}" title="Last Name Contains Only Alphabates"  tabindex="2" required="required">
                                        </div>
                                   </div>
                               </div>
                               <br>
                               <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input name="contact_no" type="number" class="form-control" placeholder="Contact No." pattern="[0-9]{10}" title="Contact Number can only have numers and Must be of 10 length"  tabindex="3" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="allotted_hostel_block" required="required" tabindex="4">
                                                <option value="">-- Alloted to Hostel Block --</option>
                                                <?php 
                                                    $sql="SELECT * FROM eh_blocks";
                                                    $query=mysqli_query(Database::getConnection(),$sql);
                                                    if($query->num_rows>0){
                                                      while($row=mysqli_fetch_assoc($query)){
                                                        echo "<option value='".$row['block_id']."'>".$row['block_name']."</option>";
                                                      }
                                                    }
                                                    else{
                                                      echo "<option value=''> No Hostel Block Found </option>";
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
                                            <button type="submit" class="btn btn-success" name="btnAddSecurityGuard" tabindex="5">Submit</button>
                                            &nbsp;<strong>&middot;</strong>&nbsp;
                                            <button type="reset" class="btn btn-danger" tabindex="6">Reset</button>
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
                                        require_once "../includes/constants.php";

                                        if (isset($_POST['btnAddSecurityGuard'])) {
                                            $sql = "INSERT INTO eh_security_guards (fname,lname,avatar,contact,password,allotted_to_block) VALUES ('".clean($_POST['first_name'])."','".clean($_POST['last_name'])."','".$default_avatar."','".clean($_POST['contact_no'])."','".md5($default_pass)."','".$_POST['allotted_hostel_block']."')";
                                            if(mysqli_query(Database::getConnection(),$sql)){
                                                echo alert_style('success','<strong>Success ! </strong> Security guard is added successfully.');
                                                unset($_POST);
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
                        <!-- ./add new security guard -->

                        <!-- manage security guard -->
                        <div role="tabpanel" class="tab-pane" id="manage">
                            <br>
                            <table id="userTable" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="active">
                                        <th width="5%;">Sr. No.</th>
                                        <th>Name</th>
                                        <th   width="18%">Contact No.</th>
                                        <th>Allotted To</th>
                                        <th width="15%">Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql="SELECT * FROM eh_security_guards";
                                        $query=mysqli_query(Database::getConnection(),$sql);
                                        $i=1;
                                        if ($query->num_rows>0) :
                                            while ($row=mysqli_fetch_assoc($query)):
                                    ?>
                                        <tr>
                                            <td align="center"><?=$i;?></td>
                                            <td align="center"><?=$row['fname']." ".$row['lname'];?></td>
                                            <td align="center"><?=$row['contact'];?></td>
                                            <td align="center"><?=$row['allotted_to_block'];?></td>
                                            <td align="center"><?=object_status($row['account_status']);?></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary">Select</button>
                                                    <button type="button" class="btn btn-success" onclick='openWindow("<?=base_url('admin/guards/single.php?guard_id='.$row['guard_id']);?>","Security Guard Info");'>View</button>
                                                    <button type="button" class="btn btn-info" onclick='openWindow("<?=base_url('admin/guards/edit.php?guard_id='.$row['guard_id']);?>","Edit Security Guard Info");'>Edit</button>
                                                    <button type="button" class="btn btn-danger">Delete</button>
                                                </div> 
                                            </td>
                                        </tr>
                                    <?php
                                            $i++;
                                            endwhile;
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                       <!--./manage security guard-->
                    </div>
               </div>       
            </div>
        </div>
        <!--./content-->

    </div>
    <!--./page content-->
</div>
<!-- footer -->
<?php
    $js="<script src='".base_url('assets/datatable/datatables/js/jquery.dataTables.min.js')."'></script>";
    $js.="<script src='https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js'></script>
        <script src='https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js'></script>";
    
    $js.="<script>
        $(document).ready(function(){
            $('#userTable').DataTable({
                mark: true,
                dom: 'lBfrtip',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print selected'
                    }
                ],
                select: true

            });
            $('#userTable_filter input').addClass('form-control');
            // $('#userTable_length select').addClass('form-control');
        });
        </script>";
    put_footer(false,$js); 
?>
