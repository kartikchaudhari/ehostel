<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('admin');
  $css=array(base_url('assets/richtext/richtext.min.css'));
  put_head("Manage User Roles :: Administrator",$css,true);
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
            $child="Roles";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Manage User Roles</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#add" aria-controls="add" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Add and List User Roles</a>
                        </li>

                        <li role="presentation">
                            <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> Manage Roles</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="add">
                            <br>
                            <!-- add role form -->
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-plus"></i> <strong>Add User Role</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" role="form">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="role_name" placeholder="Role Name">
                                            </div>
                                            <button type="submit" class="btn btn-success">Add</button>
                                            <span>&middot;</span>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                            <?php 
                                                if (isset($_POST['role_name'])) {
                                                    $role_name=clean($_POST['role_name']);
                                                    $sql="SELECT * FROM eh_roles WHERE role_name='$role_name'";
                                                    $query=mysqli_query(Database::getConnection(),$sql);
                                                    if (!$query->num_rows>0) {
                                                        $sql="INSERT INTO eh_roles(role_name)  VALUES('".$role_name."')";
                                                        if(mysqli_query(Database::getConnection(),$sql)){
                                                            echo "<br><br>".alert_style('success','<strong>Success !</strong> Role inserted succesfully.');
                                                            prevent_resubmission();
                                                        }
                                                        else{
                                                            echo "<br><br>".alert_style('danger','<strong>Error occured!</strong> An error occured while inserting role information.');
                                                        }
                                                    }
                                                    else{
                                                        echo "<br><br>".alert_style('warning','<strong>Warning !</strong> Role is already exist.');
                                                    }
                                                }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--./add role form-->
                            
                            <!-- list user roles-->
                            <div class="col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-list"></i> <strong>Roles List</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="active">
                                                    <th>Sr. No.</th>
                                                    <th>Role ID</th>
                                                    <th>Role Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $sql="SELECT * FROM eh_roles";
                                                    $query=mysqli_query(Database::getConnection(),$sql);
                                                    if ($query->num_rows>0) {
                                                        $i=1;
                                                        while($rows=mysqli_fetch_assoc($query)){
                                                            
                                                ?>
                                                    <tr>
                                                        <td><?=$i;?></td>
                                                        <td><?=$rows['role_id'];?></td>
                                                        <td><?=$rows['role_name'];?></td>
                                                    </tr>
                                                <?php 
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--./list user roles -->
                        </div>

                        <div role="tabpanel" class="tab-pane" id="manage">...</div>
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
    $js="<script src='".base_url('assets/richtext/jquery.richtext.min.js')."'></script>";
    $js.="<script type='text/javascript'>
            $(document).ready(function() {
            $('.editor').richText();
        });
    </script>";
    put_footer(false,$js); 
?>
