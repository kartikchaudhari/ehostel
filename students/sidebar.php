<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="text-align: center;" href="#">Student's Dashboard</a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
  <!-- sidebar -->
    <ul class="nav navbar-nav side-nav">
      <li class="active"><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="profile.php"><i class="fa fa-user"></i> My Profile</a></li>
      <li><a href="room_details.php"><i class="fa fa-info"></i> Room Info</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money"></i> Fee Receipt <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url('students/receipts/upload.php');?>">Upload New</a></li>
          <li><a href="<?=base_url('students/receipts/list.php');?>">List Receipts</a></li>
        </ul>
      </li>
    </ul>
  <!--./sidebar-->
  <!-- top bar-->
  <ul class="nav navbar-nav navbar-right navbar-user">
    <li class="dropdown user-dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
        <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
        <li class="divider"></li>
        <li><a href="<?=base_url('students/logout.php');?>"><i class="fa fa-power-off"></i> Log Out</a></li>
      </ul>
    </li>
  </ul>
  <!--./top bar-->
</div>
</nav>