<?php
include("../To_Do_List/connection.php");
session_start();
$usernum = mysqli_query($connect, "SELECT * FROM tbl_todo_admin");
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
            <h2 class="my-3">Active Tasks</h2>
            <table class="table  table-striped-columns">
              <thead>
                <tr>
                  <th scope="col" class="text-light">Id</th>
                  <th scope="col" class="text-light">Task Name</th>
                  <th scope="col" class="text-light">Task group</th>
                  <th scope="col" class="text-light">Task Date</th>
                  <th scope="col" class="text-light">Task Time</th>
                  <th scope="col" class="text-light">Task Description</th>
                  <th scope="col" class="text-light">Task Attachment</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($usernum as $row)
                  {
                  ?>

                    <tr>
                      <td><?php echo $row['admin_id'] ?></td>
                      <td><?php echo $row['admin_fullname'] ?></td>
                      <td><?php echo $row['admin_email'] ?></td>
                      <td><?php echo $row['admin_password'] ?></td>
                    </tr>

                  <?php
                  }
                ?>
              </tbody>
            </table>
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