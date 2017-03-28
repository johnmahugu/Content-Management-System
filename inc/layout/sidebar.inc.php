<?php
  require_once 'inc/connection.inc.php';
  require_once 'inc/function.inc.php';
  require_once 'inc/session.php';
  $current_user_id = (int)$_SESSION['user_id'];
  
  $query  = "SELECT * FROM `team` WHERE `user_id`='$current_user_id'";
  $row  = mysqli_fetch_assoc(mysqli_query($connection,$query));

  $current_fullname = $row['full_name'];
  $current_photo    = "images/team_photo/".$row['photo'];
  $current_designation  = $row['designation'];
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CSI</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CSI </b>NSIT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div id="user_profile_nav">
              <?php echo '<img src="'.$current_photo.'" class="user-image" alt="User Image"><span class="hidden-xs">'.$current_fullname.'</span>'; ?>           
            </div>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php 
                  echo'<img src="'.$current_photo.'" class="img-circle" alt="User Image"><p>' . $current_fullname .'<small>'.$current_designation.'</small></p>';
                ?>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="user_profile.php" class="btn btn-default btn-flat">Edit Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <?php
          echo '<div class="pull-left image"><img src="'.$current_photo.'" class="img-circle" alt="User Image"></div><div class="pull-left info">
          <p>'.$current_fullname.'</p></div></div>';
        ?>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>        
        <li class="treeview">
          <a href="user_profile.php">
            <i class="fa fa-edit"></i> <span>View Profile</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="csi_new_member.php">
            <i class="fa fa-table"></i> <span>Add Member Registration</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="view_registrations.php">
            <i class="fa fa-table"></i> <span>View All Members</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>