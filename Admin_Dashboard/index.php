<?php
  include("../To_Do_List/connection.php");
  session_start();
  if(!isset($_SESSION['admin_login']))
  {
    header("location:login.php");
  }

  $usernum = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_todo_admin"));
  $todonum = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tbl_todo"));
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
              <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?php echo $usernum; ?></h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-account icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Website Users</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?php echo $todonum; ?></h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-clipboard-text icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Active Tasks</h6>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <img src="assets/images/Add tasks-pana.svg" style="background-color: #191c24 !important;" alt="">
              </div>
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