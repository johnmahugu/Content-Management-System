<?php
  require_once 'inc/connection.inc.php';
  require_once 'inc/function.inc.php';
  require_once 'inc/session.php';
  include 'inc/layout/header.inc.php';
  include 'inc/layout/sidebar.inc.php';
  if(!isLoggedin()){
    header("Location: index.php");
  }
  $current_user_id = (int)$_SESSION['user_id'];
  
  $query  = "SELECT * FROM `team` WHERE `user_id`='$current_user_id'";
  $row  = mysqli_fetch_assoc(mysqli_query($connection,$query));

  $current_fullname = $row['full_name'];
  $current_username = $row['username'];
  $current_photo    = "images/team_photo/".$row['photo'];
  $current_fb_link  = $row['fb_link'];
?>
<?php
    
    if(isset($_POST['submit']))
    {
      if($_POST['full_name'])
        $entered_name     = $_POST['full_name'];
      else
        $entered_name     = $current_fullname;
      if($_POST['fb_link'])
        $entered_fb_link  = $_POST['fb_link'];
      else
        $entered_fb_link  = $current_fb_link;
      if(isset($_FILES['file']))
      {
        $errors= "";
          $error_trigger = 0;
          $file_name = $_FILES['file']['name'];
          $file_tmp =$_FILES['file']['tmp_name'];
            if(empty($errors)==true)
            {
              $filepath = "images/team_photo/" . $file_name;
              move_uploaded_file($file_tmp,$filepath);  
          } 
        $entered_photo = $_FILES['file']['name']; 
      }
      if($entered_photo == '')
        $entered_photo = $row['photo'];
      $query = "UPDATE `team` SET `full_name` ='".$entered_name."', `photo` = '".$entered_photo."', `fb_link` = '".$entered_fb_link."' WHERE `user_id`='".$current_user_id."'";
      if(mysqli_query($connection, $query))
        header("Location: user_profile.php");
      else
        echo "<script type='text/javascript'>alert('Technical Glitch! please try again');</script>";
    }
    if(isset($_POST['reset']))
        header("Location: user_profile.php"); 

    
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-6">
          <form role="form" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label>Profile picture
                    <div id="user_profile_nav">
                    <?php echo '<img src="'.$current_photo.'" class="user-image" alt="User Image">'; ?>           
                    </div>
                  </label>
                  <input type="file" name="file">
              </div>
              <div class="form-group">
                  <label>Full Name</label>
                  <input class="form-control" type="text" id="full_name" name="full_name" value =<?php echo $current_fullname;?>>
              </div>
              <div class="form-group">
                  <label>Facebook Profile Link</label>
                  <input class="form-control" type="url" id="fb_link" name="fb_link" value =<?php echo $current_fb_link;?>>
              </div>
              
              <button type="submit" name="submit" class="btn btn-default">Update</button>
              <button type="reset" name="reset" class="btn btn-default">Reset</button>

          </form>
        </div>
      </div>
      
      <br>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
    <?php include 'inc/layout/footer.inc.php';?>
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

</body>
</html>
