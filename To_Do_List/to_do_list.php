<?php
include("connection.php");
session_start();


if (isset($_POST['btnlogin'])) {
    $logemail = $_POST['logemail'];
    $logpass = $_POST['logpass'];

    $logres = mysqli_query($connect, "SELECT * FROM tbl_todo_admin WHERE admin_email='$logemail' && admin_password='$logpass'");

    $logarr = mysqli_fetch_assoc($logres);

    $logcount = mysqli_num_rows($logres);


    if ($logcount == 1) {
        $_SESSION['admin'] = $logarr['admin_id'];
        echo "<script>alert('You are successfully login!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Email Or Password Is Incorrect!')</script>";
    }
}
if (isset($_SESSION['admin'])) {
    $admininfo = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM tbl_todo_admin WHERE admin_id=$_SESSION[admin]"));
} else {
    $admininfo = "";
}

if (isset($_POST['btnregister'])) {
    $regusername = $_POST['regusername'];
    $regemail = $_POST['regemail'];
    $regpass = $_POST['regpass'];

    $req_query = mysqli_query($connect, "INSERT INTO tbl_todo_admin VALUES(NULL,'$regusername','$regemail', '$regpass')");
    echo "<script>window.location.href='index.php'</script>";
    echo "<script>alert('Registration Successful Please Login!')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/cursor.css">
    <link rel="icon" href="images/notepad.png">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">To Do List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index_user.php">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="to_do_list.php">To-do List</a>
                    </li>

                </ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if (isset($_SESSION['admin'])) {
                            echo $admininfo['admin_fullname'];
                        } else {
                            echo "";
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <!-- <div class="row account">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        <p style="text-transform: capitalize;"></p>
                    </div>
                </div> -->
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="todo_wrapper">
        <div class="container-fluid p-3 mt-3">
            <h1 class="text-center">Task List</h1>
            <table class="table table-hover" style="color: #fff;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/cursor.js"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script>
        new kursor({
            type: 4,
            removeDefaultCursor: true,
            color: '#ffb703'
        });

        var currentdate = new Date();
        var datetime = " Date " + currentdate.getDay() + "/" + currentdate.getMonth() +
            "/" + currentdate.getFullYear() + " Time " +
            currentdate.getHours() + ":" +
            currentdate.getMinutes() + ":" + currentdate.getSeconds();

        $(document).ready(function() {

            function loadtasks() {
                $.ajax({
                    url: 'fetchtask.php',
                    type: 'POST',
                    success: function(mydata) {
                        $("#list_items").html(mydata);
                    }
                })
            }
            loadtasks();

            // $("#btninsert").on("click", function() {
            //     var txttask = $("#txttask").val();
            //     datetime;
            //     $.ajax({
            //         url: 'task_insert.php',
            //         type: 'POST',
            //         data: {
            //             txttask: txttask,
            //             datetime: datetime
            //         },
            //         success: function(mydata) {
            //             if (mydata == 1) {
            //                 Swal.fire({
            //                     icon: 'error',
            //                     title: 'Login First!',
            //                 });
            //                 $("#txttask").val("");
            //             } else {
            //                 $("#txttask").val("");
            //                 loadtasks();
            //             }
            //         }
            //     })
            // })

            $(document).on("click", "#btndel", function() {
                var rowid = $(this).attr("rowid");

                $.ajax({
                    url: "del.php",
                    type: "POST",
                    data: {
                        rowid: rowid
                    },
                    success: function(deldata) {
                        loadtasks();
                    }
                })
            })
        });
    </script>
</body>

</html>