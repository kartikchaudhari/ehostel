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
    <div id="page-wrapper" style="border:1px solid red;">

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
                                            <input type="hidden" name="created_by" class="form-control" value="<?=$_SESSION['id'];?>">
                                            <input type="hidden" name="created_by_role" class="form-control" value="1">
                                        </div>
                                   </div>
                                </div>
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="col-md-6">
                                            <button type="submit" class="btn btn-success" name="btnAddUpdate" tabindex="4">Submit</button>
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
                                                echo alert_style('success','<strong>Success ! </strong> Update is added and published on homepage.');
                                                unset($_POST);


                                                notifyStudents("Please Check latest news and updates secction.","Important");
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
                        <div role="tabpanel" class="tab-pane" id="manage">...</div>
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
   put_footer(false); 
?>