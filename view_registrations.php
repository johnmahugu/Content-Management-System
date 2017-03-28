<?php
  require_once 'inc/connection.inc.php';
  require_once 'inc/function.inc.php';
  require_once 'inc/session.php';
  include 'inc/layout/header.inc.php';
  include 'inc/layout/sidebar.inc.php';
  if(!isLoggedin()){
    header("Location: index.php");
  }
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
        <div class="col-lg-12 col-xs-6">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="testTable" summary="Code page support in different versions of MS Windows." rules="groups">
            <form role="form" method="POST">
              <div class="form-group">
                  <label>Filter by year</label>
                  <input class="form-control" value=<?php echo date("Y");?> type="number" id="year" name="year" placeholder="Year">
              </div>
              <div class="form-group">
                  <label>Filter by board member</label>
                  <input class="form-control" type="text" id="board" name="board" placeholder="Enter Full Name">
              </div>
              <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
            <?php 
              $year=date("Y");
              $board_member = 'all';
              if(isset($_POST['submit']))
              {
                if(isset($_POST['year']))
                  $year=$_POST['year'];
                if(isset($_POST['board']))
                  $board_member=$_POST['board'];
              }        
            ?>
            <thead>
              <tr>
                <td>Receipt No</td>
                <td>Name</td>
                <td>Roll No</td>
                <td>Branch</td>
                <td>Contact</td>
                <td>Mail Id</td>
                <td>Registered By</td>
              </tr>
            <thead>
            <tbody>
              <?php
              if($board_member =='all')
              {
                $query="SELECT * FROM `registrations` WHERE YEAR(CAST(`timestamp` AS DATE))='".$year."' ORDER BY `receipt_no`";
                $result = mysqli_query($connection,$query);
                echo "<hr><p align ='center'>Total number of registrations for year ". $year. " = ".mysqli_num_rows($result);
                while($row=mysqli_fetch_assoc($result))
                  echo "<tr><td>".$row['receipt_no']."</td><td>".$row['name']."</td><td>".$row['roll_no']."</td><td>".$row['div']."</td><td>".$row['mob']."</td><td>".$row['email_id']."</td><td>".$row['board_mem']."</td></tr>";
              }
              else
              {
                $query="SELECT * FROM `registrations` WHERE `board_mem`='".$board_member."' AND YEAR(CAST(`timestamp` AS DATE))='".$year."' ORDER BY `receipt_no`";
                $result = mysqli_query($connection,$query);
                echo "<hr><p align ='center'>Total number of registrations for year ". $year. " by ".$board_member." = ".mysqli_num_rows($result);
                while($row=mysqli_fetch_assoc($result))
                  echo "<tr><td>".$row['receipt_no']."</td><td>".$row['name']."</td><td>".$row['roll_no']."</td><td>".$row['div']."</td><td>".$row['mob']."</td><td>".$row['email_id']."</td><td>".$row['board_mem']."</td></tr>";
              }  
              ?>
            </tbody>
            </table>
          </div>
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
