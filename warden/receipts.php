<?php 
  session_start();
  include '../includes/functions.php';
  is_logged_in('warden');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard :: Warden</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/sb-admin.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/css/bootstrap-theme.min.css');?>">
        <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>">
    </head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>
    <!--./sidebar-->

    <!-- page content-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
              <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                  </li>
                  <li role="presentation">
                    <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">tab</a>
                  </li>
                </ul>
              
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">...</div>
                  <div role="tabpanel" class="tab-pane" id="tab">...</div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!--./page content-->
</div>
<!-- JavaScript -->
<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>


</body>
</html>