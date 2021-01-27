<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="text-align: center;" href="#">Administrator's Dashboard</a>
  </div>

  <!-- sidebar -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Hostels &amp; Blocks  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li>
            <a href="<?=base_url('admin/hostels.php');?>">Hostels</a>
          </li>
          <li>
            <a href="<?=base_url('admin/blocks.php');?>">Blocks</a>
          </li>      
        </ul>
      </li>
      
      <li><a href="<?=base_url('admin/rooms.php');?>"><i class="fa fa-bar-chart-o"></i> Rooms</a></li>
      <li><a href="<?=base_url('admin/assets.php');?>"><i class="fa fa-bar-chart-o"></i> Assets</a></li>
      <li><a href="<?=base_url('admin/visitors.php');?>"><i class="fa fa-wrench"></i> Visitors Book</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Departments &amp; Courses  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url('admin/departments.php');?>">Departments</a></li>
          <li><a href="<?=base_url('admin/courses.php');?>">Courses</a></li>      
        </ul>
      </li>

      <li><a href="#"><i class="fa fa-table"></i> Students</a></li>
      <li><a href="<?=base_url('admin/wardens.php');?>"><i class="fa fa-edit"></i> Wardens</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Staff &amp; Security Guards  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url('admin/staff.php');?>">Staff</a></li>
          <li><a href="<?=base_url('admin/security_guards.php');?>">Security Guards</a></li>      
        </ul>
      </li>
      <li><a href="<?=base_url('admin/complaints.php')?>"><i class="fa fa-wrench"></i> Complaints</a></li>
      <li><a href="<?=base_url('admin/notice');?>"><i class="fa fa-wrench"></i> Notice Board</a></li>
      <li><a href="<?=base_url('admin/updates.php');?>"><i class="fa fa-wrench"></i> News & Updates</a></li>
      <li><a href="#"><i class="fa fa-wrench"></i> Forms</a></li>
      <li><a href="<?=base_url('admin/roles.php');?>"><i class="fa fa-user"></i> User Roles</a></li>
      <li><a href="<?=base_url('admin/settings.php');?>"><i class="fa fa-file"></i> System Settings</a></li>
      <li><br><br><br></li>
    </ul>
    <!--./sidebar-->

    <!-- top nav -->
    <?php 
      @session_start();
      if (isset($_SESSION['user_type'])):
    ?>
    <ul class="nav navbar-nav navbar-right navbar-user">
      <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['name'];?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url('admin/profile.php');?>"><i class="fa fa-user"></i> Profile</a></li>
          <li><a href="<?=base_url('admin/inbox.php');?>"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
          <li><a href="<?=base_url('admin/settings.php');?>"><i class="fa fa-gear"></i> Settings</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
    <?php
    endif;
    ?>
    <!--./top nav-->
  </div>
</nav>