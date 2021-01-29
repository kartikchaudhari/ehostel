<?php 
  session_start();
  require '../includes/functions.php';
  is_logged_in('warden');
  $css=array(base_url('assets/richtext/richtext.min.css'));
  put_head("Notice Board Management :: Warden",$css,true);
?>

<div id="wrapper">
    
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->

    <!-- page content-->
    <div id="page-wrapper">

        <!--breadcrumbs-->
        <?php 
            $root=array('url'=>base_url('warden/dashboard.php'),'text'=>'Dashboard');
            $child="Notice Board";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Notice Board Management</h3>
            </div>
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#add" aria-controls="add" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> <strong>Create New Notice</strong></a>
                        </li>
                        <li role="presentation">
                            <a href="#manage" aria-controls="manage" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> <strong>Manage Notices</strong></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- create notice -->
                        <div role="tabpanel" class="tab-pane active" id="add">
                            <br>
                            <div class="col-md-12">
                                <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="notice_title" placeholder="Enter Notice Title" required="required">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control editor" name="notice_desc" required="required" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <?php 
                                            if (isset($_SESSION['w_id'])) {
                                        ?>
                                            <input type="hidden" name="created_by_id" value="<?=$_SESSION['w_id'];?>">
                                            <input type="hidden" name="created_by" value="2">
                                            <input type="hidden" name="created_for" value="1">
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-success" name="btnSubmit">Submit</button>
                                    <span>&middot;</span>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </form>
                                <br>
                                <br>
                                <?php 
                                    if (isset($_POST['btnSubmit'])) {
                                        $title=clean($_POST['notice_title']);
                                        $desc=html_encoder($_POST['notice_desc']);
                                        
                                        $sql="INSERT INTO eh_notice_board(  notice_title,notice_desc,created_by,created_by_id,created_for) 
                                            VALUES('$title','$desc',".$_POST['created_by'].",".$_POST['created_by_id'].",".$_POST['created_for'].")";
                                        if (mysqli_query(Database::getConnection(),$sql)) {
                                            echo alert_style('success','<strong>Success ! </strong> notice created successfully.');

                                            //notify students

                                            prevent_resubmission();
                                        }
                                        else{
                                            echo alert_style('danger','<strong>Error Occured: </strong>'.mysqli_error(Database::getConnection()));
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <!--./create notice-->

                        <!--./manage notice-->
                        <div role="tabpanel" class="tab-pane" id="manage">
                            <div class="table-responsive"><br>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr. No</th>
                                            <th class="col-md-5">Notice Title</th>
                                            <th>Created By</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                            $sql="SELECT * FROM eh_notice_board WHERE created_by=2 ORDER BY notice_creation_date DESC";
                                            $query=mysqli_query(Database::getConnection(),$sql);

                                            if ($query->num_rows>0) {
                                                $i=1;
                                                while ($row=mysqli_fetch_assoc($query)) {
                                        ?>
                                                    <tr>
                                                        <td><?=$i;?></td>
                                                        <td><?=$row['notice_title']?></td>
                                                        <td><?php 
                                                                $info=pull_warden_by_id($row['created_by_id']);
                                                                echo $info['first_name']." ".$info['last_name'];
                                                            ?></td>
                                                        <td><?=$row['notice_creation_date']?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php 
                                                                    $view_url=base_url('warden/notice/single.php?notice_id='.base64_encode($row['notice_id']));
                                                                ?>
                                                                <button type="button" class="btn btn-primary" onclick="openWindow('<?=$view_url;?>')">View</button>
                                                                <?php 
                                                                    if ($row['created_by_id']==$_SESSION['w_id']) {
                                                                    $edit_url=base_url('warden/notice/edit.php?notice_id='.base64_encode($row['notice_id']));
                                                                ?>
                                                                    <button type="button" class="btn btn-success" onclick="openWindow('<?=$edit_url;?>')">Update</button>
                                                                    <button type="button" class="btn btn-danger">Delete</button>
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
                                                    <tr><td colspan="5"><h4 align="center">No Notice Found</h4></td></tr>
                                        <?php
                                            }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ./manage notice-->
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
