<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('warden');
  put_head("News & Updates :: Warden",null,true);
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
            $child="News & Updates";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!-- content start-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">News & Updates Management</h3>
            </div>
            <div class="panel-body">
                <!-- message -->
                <div id="message"></div>
                <!--./message -->

                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#add" aria-controls="add" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> <strong>Create News</strong></a>
                        </li>
                        <li role="presentation">
                            <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> <strong>Manage News</strong></a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="add" style="padding: 20px;">
                        
                        <!--the form-->
                           <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="title" placeholder="News Title"  tabindex="1" required="required">
                                        </div>
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <textarea name="content" id="input" class="form-control" rows="3" required="required" placeholder="News Description" tabindex="2"></textarea>
                                        </div>
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input type="url" name="hyperlink" id="inputHyperlink" class="form-control" tabindex="3" required="required" placeholder="Attachment Hyperlink">
                                        </div>
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input type="hidden" name="created_by" class="form-control" value="<?=$_SESSION['w_id'];?>">
                                            <input type="hidden" name="created_by_role" class="form-control" value="1">
                                        </div>
                                   </div>
                                </div>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="col-md-6">
                                            <button type="submit" class="btn btn-success" name="btnAddUpdate" tabindex="4" >Submit</button>
                                            &nbsp;<strong>&middot;</strong>&nbsp;
                                            <button type="reset" class="btn btn-danger" tabindex="5">Reset</button>
                                        </div>
                                   </div>
                               </div>
                           </form>
                           <!--./the form-->
                           
                           <br>
                           <!--alert-->
                           <div class="row">
                               <div class="col-md-12">
                                   <?php 
                                        if (isset($_POST['btnAddUpdate'])){ 
                                            $sql = "INSERT INTO `eh_updates` (`title`, `content`, `hyperlink`, `created_by`, `created_by_role`) VALUES ('".clean($_POST['title'])."', '".clean($_POST['content'])."','".$_POST['hyperlink']."','".$_POST['created_by']."', '".$_POST['created_by_role']."')";
                                            if(mysqli_query(Database::getConnection(),$sql)){
                                                send_push("Please Check latest news and updates secction.","Important","student");

                                                echo alert_style('success','<strong>Success ! </strong> Update is added and published on homepage.');
                                                
                                                prevent_resubmission();
                                            }
                                            else{
                                                echo alert_style('danger','<strong>Error Occured: </strong>'.mysqli_error(Database::getConnection()));
                                            }
                                        }
                                   ?>
                               </div>
                           </div>
                           <!--./alert-->
                        </div>

                        <!-- manage updates -->
                        <div role="tabpanel" class="tab-pane" id="manage">
                            <br>

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="active">
                                            <th>Sr. No.</th>
                                            <th style="width: 440px;">News Title</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT * FROM `eh_updates` ORDER BY `creation_date` DESC";
                                            $query=mysqli_query(Database::getConnection(),$sql);
                                            if ($query->num_rows>0) {
                                                $i=1;
                                                while ($row=mysqli_fetch_assoc($query)) {

                                        ?>
                                            <tr id="<?=$row['update_id'];?>">
                                                <td><?=$i;?></td>
                                                <td><?=$row['title']?></td>
                                                <td>
                                                    <?php 
                                                                $info=pull_warden_by_id($row['created_by']);
                                                                echo $info['first_name']." ".$info['last_name'];
                                                            ?>
                                                </td>
                                                <td><?=$row['creation_date']?></td>
                                                <td>
                                                            <div class="btn-group">
                                                                <?php 
                                                                    $view_url=base_url('warden/updates/single.php?update_id='.base64_encode($row['update_id']));
                                                                ?>
                                                                <button type="button" class="btn btn-primary" onclick="openWindow('<?=$view_url;?>')">View</button>
                                                                <?php 
                                                                    if ($row['created_by']==$_SESSION['w_id']) {
                                                                    $edit_url=base_url('warden/updates/edit.php?update_id='.base64_encode($row['update_id']));
                                                                ?>
                                                                    <button type="button" class="btn btn-success" onclick="openWindow('<?=$edit_url;?>')">Update</button>
                                                                    <button type="button" class="btn btn-danger" onclick="deleteNewsUpdate(<?=$row['update_id'];?>)">Delete</button>
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </div>
                                                        </td>
                                            </tr>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                            else{
                                        ?>
                                            <tr>
                                                <td colspan="5"><h4 align="center"> No News and Updates found.</h4></td>
                                            </tr>
                                        <?php  

                                            } 
                                        ?>
                                    </tbody>
                                </table>
                        </div>
                        <!--./manage updates-->
                    </div>
                </div>                
            </div>
        </div>
        <!--./content ends-- >

        
    </div>
    <!--./page content-->
</div>
<!-- footer -->
<?php
    $js='<script type="text/javascript">';
    $js.=" function deleteNewsUpdate(update_id){
        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
                url: '".base_url('warden/updates/ajax.php')."',
                type: 'POST',
                data: {update_id:update_id,delete_action:''},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    $('#'+update_id).remove();
                        alert('Record removed successfully');  
                   }
            });
        }
    }";
    $js.="</script>";
   put_footer(false,$js); 
?>
