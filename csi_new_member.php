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
?>
<?php
    
    if(isset($_POST['submit']))
    {
      $board_member =$current_username;
      $name = $_POST['name'];
      $roll=$_POST['roll_no'];
      $branch=$_POST['div'];
      $mobile_no=$_POST['mob'];
      $email_id=$_POST['email_id'];
      $receipt_no=$_POST['receipt_no'];
        $query = "INSERT INTO `registrations`(`name`, `roll_no`, `div`, `mob`, `email_id`, `receipt_no`, `board_mem`) 
        VALUES ('$name', '$roll', '$branch', '$mobile_no', '$email_id', '$receipt_no', '$board_member')";
        mysqli_query($connection, $query);
    }
    if(isset($_POST['reset']))
        header("Location: csi-new_member.php"); 
    
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
          <form role="form" method="POST">
              <div class="form-group">
                  <label>Name of new member</label>
                  <input class="form-control" type="text" id="name" name="name" placeholder="Name" required autofocus>
              </div>
              <div class="form-group">
                  <label>Roll no</label>
                  <input class="form-control" type="text" id="roll_no" name="roll_no" placeholder="Roll No." required>
              </div>
              <div class="form-group">
                  <label>Branch</label>
                  <select class="form-control" name="div" id="div">
                      <option value="COE">COE</option>
                      <option value="ECE">ECE</option>
                      <option value="IT">IT</option>
                      <option value="ICE">ICE</option>
                      <option value="MPAE">MPAE</option>
                      <option value="ME">ME</option>
                      <option value="BT">BT</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Contact No</label>
                  <input class="form-control" type="number" id="mob" name="mob" placeholder="Contact No." required>
              </div>
              <div class="form-group">
                  <label>Mail Id</label>
                  <input class="form-control" type="email" id="email_id" name="email_id" placeholder="Email-Id" required>
              </div>
              <div class="form-group">
                  <label>Receipt No</label>
                  <input class="form-control" type="number" id="receipt_no" name="receipt_no" placeholder="Receipt No." required>
              </div>
              
              <button type="submit" name="submit" class="btn btn-default">Submit</button>
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
