<?php
include("../To_Do_List/connection.php");
session_start();
$admininfo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM tbl_admin"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ToDo Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/notepad.png" />
</head>

<body>
  <div class="container-scroller">
    <?php
    include("sidebar.php");
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <?php
      include("navbar.php");
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <h2 class="my-3">Update Admin Profile</h2>
            <form class="col-12 my-3" method="POST">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="text" class="form-control text-white" name="adname" value="<?php echo $admininfo['admin_fullname'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control text-white" name="ademail" value="<?php echo $admininfo['admin_email'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control text-white"  name="adpass"  value="<?php echo $admininfo['admin_password'] ?>" id="exampleInputPassword1" required>
              </div>
             <button type="submit" name="btnupdate" class="btn btn-success btn-block p-3 my-3">Update</button>
            </form>
            <?php
              if(isset($_POST['btnupdate']))
              {
                  $adname = $_POST['adname'];
                  $ademail = $_POST['ademail'];
                  $adpass = $_POST['adpass'];

                  $query = mysqli_query($connect,"UPDATE tbl_admin SET admin_fullname='$adname', admin_email='$ademail', admin_password='$adpass'");

                  if($query)
                  {
                      echo "<script>alert('Admin Profile Updated!')</script>";    
                      echo "<script>window.location.href='index.php'</script>";    
                  }
              }
            ?>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        include("footer.php");
        ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>