<?php
  include("../To_Do_List/connection.php");

  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
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

  <div class="login_wrapper" style="background: url(../Admin_Dashboard/assets/images/Untitled\ design.svg); background-size: cover;">
    <div class="container-fliud">
      <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-4 p-4" style="border-radius: 10px; background-color: #191c24; box-shadow: 0px 0px 10px #ffb80397 !important;">
          <a href="login.php" style="color: #fff !important; font-size: 20px; text-decoration: none;"><img src="assets/images/notepad.png" alt=""> <span class="ml-2">Admin Login</span></a>
          <form class="my-3" method="POST">
            <h4 class="my-3">Sign In To Your Account</h4>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" required name="adminemail" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" required name="adminpass" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-block p-3 my-2" style="background-color: #ffb703; color: #191c24;"  name="btnlogin">Login</button>
          </form>
          <?php 
            if(isset($_POST['btnlogin']))
            {
                $adminemail = $_POST['adminemail'];
                $adminpass = $_POST['adminpass'];

                $result = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_admin WHERE admin_email='$adminemail' && admin_password='$adminpass'"));

                if($result == 1)
                {
                  $_SESSION['admin_login'] = $adminemail;
                  header("location:index.php");  
                  echo "<script>alert('Login Successful!')</script>";
                }
                else
                {
                  echo "<script>alert('Email OR Password Incorrect!')</script>";
                }
            }
           ?>
        </div>
      </div>
    </div>
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