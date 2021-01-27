<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=base_url('');?>">eHostel</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hostel Information <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url('details.php');?>">Hostel Details</a></li>
            <li><a href="<?=base_url('fees.php');?>">Fee Structure</a></li>
            <li><a href="<?=base_url('rules.php');?>">Hostel Rules</a></li>
            <li><a href="<?=base_url('glance.php');?>">At a Glance</a></li>
          </ul>
        </li>
        <li><a href="<?=base_url('hostel_notice_board.php');?>">Notice Board</a></li>
        <li><a href="<?=base_url('coordinaters.php');?>">Co-ordinaters</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Register <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url('students/register.php')?>">Student Registration</a></li>
          </ul>
        </li>
        <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url('warden/login.php');?>">Warden Login</a></li>
            <li><a href="<?=base_url('admin/login.php');?>">Administrator Login</a></li>
          </ul>
        </li>
        <?php

            @session_start();
            if (isset($_SESSION['user_type'])) {
                switch ($_SESSION['user_type']) {
                case 'admin':{
                    echo '
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> '.$_SESSION['name'].' <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="'.base_url('admin/dashboard.php').'"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li><a href="'.base_url('admin/profile.php').'"><i class="fa fa-user"></i> Profile </a></li>
                                <li><a href="'.base_url('admin/settings/settings.php').'"><i class="fa fa-cog"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="'.base_url('admin/logout.php').'"><i class="fa fa-sign-out"></i> Log out</a></li>
                            </ul>
                        </li>';
                }
                break;
                
                case 'warden':{
                      echo '
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> '.$_SESSION['name'].' <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="'.base_url('admin/dashboard.php').'"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li><a href="'.base_url('admin/profile.php').'"><i class="fa fa-user"></i> Profile </a></li>
                                <li><a href="'.base_url('admin/settings/settings.php').'"><i class="fa fa-cog"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="'.base_url('admin/logout.php').'"><i class="fa fa-sign-out"></i> Log out</a></li>
                            </ul>
                        </li>';
                }
              }
            }
        ?>
      </ul>
    </div>
  </div>
</nav>