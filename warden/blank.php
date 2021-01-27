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

        <!--breadcrumbs-->
        <?php 
            $root=array('url'=>base_url('admin/dashboard.php'),'text'=>'Dashboard');
            $child="Settings";
            put_breadcrumbs($root,$child);
        ?>
        <!--./breadcrumbs-->

        <!--content-->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">System Settings</h3>
            </div>
            <div class="panel-body">
                       
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
