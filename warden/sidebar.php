<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="text-align: center;" href="#">Warden's Dashboard</a>
  </div>

<div class="collapse navbar-collapse navbar-ex1-collapse">
  <!-- left sidebar -->
  <ul class="nav navbar-nav side-nav">
    <li><a href="<?=base_url('warden/dashboard.php');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?=base_url('warden/rooms.php');?>"><i class="fa fa-table"></i> Rooms</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Students  <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url('warden/students/registration_requests.php');?>">Registration Requests</a></li>
          <li><a href="<?=base_url('warden/students.php');?>">Manage Students</a></li>
          <li><a href="<?=base_url('warden/student-hostel-entry.php');?>">Student Hostel Entry</a></li>       
        </ul>
    </li>
    <li><a href="<?=base_url('warden/receipts.php');?>"><i class="fa fa-edit"></i> Fee Receipts</a></li>
    <li><a href="<?=base_url('warden/leave_requests.php');?>"><i class="fa fa-edit"></i> Leave Management</a></li>
    <li><a href="<?=base_url('warden/complaints.php');?>"><i class="fa fa-edit"></i> Complaint Box</a></li>
    <li><a href="<?=base_url('warden/assets.php');?>"><i class="fa fa-font"></i> Assets</a></li>

    <li><a href="<?=base_url('warden/guards.php');?>"><i class="fa fa-user"></i> Security Guards</a></li>
    <li><a href="<?=base_url('warden/visitor-book.php');?>"><i class="fa fa-font"></i> Visitors Book</a></li>
        
    <li><a href="<?=base_url('warden/forms.php');?>"><i class="fa fa-font"></i> Forms</a></li>
    <li><a href="<?=base_url('warden/notice.php');?>"><i class="fa fa-font"></i> Notice Board</a></li>
    <li><a href="<?=base_url('warden/updates.php');?>"><i class="fa fa-font"></i> News & Updates</a></li>
     <li><br><br><br></li>
  </ul>
  <!--./left sidebar -->

  <!-- topbar -->
  <ul class="nav navbar-nav navbar-right navbar-user">
    <li class="dropdown user-dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="<?=base_url('warden/profile.php');?>"><i class="fa fa-user"></i> Profile</a></li>
        <li><a href="<?=base_url('warden/inbox.php');?>"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
        <li><a href="<?=base_url('warden/settings.php');?>"><i class="fa fa-gear"></i> Settings</a></li>
        <li class="divider"></li>
        <li><a href="<?=base_url('warden/logout.php');?>"><i class="fa fa-power-off"></i> Log Out</a></li>
      </ul>
    </li>
  </ul>
  <!--./topbar-->
</div>
</nav>