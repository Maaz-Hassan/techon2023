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
                        <a class="nav-link active" aria-current="page" href="index_user.php">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="to_do_list.php">To-do List</a>
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
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="todo_wrapper">
        <div class="container-fluid p-3 mt-3 d-flex justify-content-center align-items-center">

            <div class="row w-75">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="my-4" style="color: #fff;">Create To-do Task</h1>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Group
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Group</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Group Name" name="group_name">
                                        <label for="floatingInput">Group Name</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="insertgroup" class="btn btn-primary">Add</button>
                                </div>
                                </form>
                                <?php
                                if (isset($_POST['insertgroup'])) {
                                    $group_name = $_POST['group_name'];
                                    $adminid = $_SESSION['admin'];
            
                                    include('connection.php');
                                    $query = "INSERT INTO group_list (group_name,admin_id) VALUES ('$group_name','$adminid')";
            
                                    $execute = mysqli_query($connect, $query);
            
                                    if ($execute) {
                                        echo "<script> alert('Group Created Successfully');
                                          window.location.href='index_user.php';
                                          </script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-6">
                                <div class="form-floating mb-5">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Task Name" name="task_name">
                                    <label for="floatingInput">Task Name</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-5">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="group">
                                        <option selected>Open this select menu</option>
                                        <?php
                                        $group = mysqli_query($connect, "Select * from group_list");
                                        foreach ($group as $group_row) {
                                        ?>
                                            <option value="<?php echo $group_row['group_id'] ?>"><?php echo $group_row['group_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Works with selects</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-5">
                                    <input type="date" class="form-control" id="floatingInput" name="due_date">
                                    <label for="floatingInput">Due Date</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-5">
                                    <input type="time" class="form-control" id="floatingInput" name="due_time">
                                    <label for="floatingInput">Due Time</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-5 form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="description"></textarea>
                                    <label for="floatingTextarea">Description</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-5">
                                    <label for="formFileMultiple" class="form-label fs-4" style="color: #fff;">Attachment</label>
                                    <input class="form-control form-control-lg" type="file" id="formFileMultiple" name="attachment">
                                </div>
                            </div>
                            <button class="btn btn-outline-warning w-25" type="submit" name="btninsert">Add Task</button>
                        </div>
                    </form>
                    <?php

                    if (isset($_POST['btninsert'])) {
                        $task_name = $_POST['task_name'];
                        $group =  $_POST['group'];
                        $task_group = $_POST['task_group'];
                        $due_date = $_POST['due_date'];
                        $due_time = $_POST['due_time'];
                        $description = $_POST['description'];
                        $attachment = $_FILES['attachment']['name'];
                        $type = $_FILES['attachment']['type'];
                        $temp_name = $_FILES['attachment']['tmp_name'];
                        $size = $_FILES['attachment']['size'];
                        $folder = "attachment/" . "$attachment";
                        move_uploaded_file($temp_name, $folder);
                        $adminid = $_SESSION['admin'];

                        include('connection.php');
                        $query = "INSERT INTO task_list (task_name,due_date,due_time,description,attachment,admin_id,group_id) VALUES ('$task_name','$due_date','$due_time','$description','$folder','$adminid','$group')";

                        $execute = mysqli_query($connect, $query);

                        if ($execute) {
                            echo "<script> alert('Task Created Successfully');
                              window.location.href='index_user.php';
                              </script>";
                        }
                    }


                    ?>
                </div>
            </div>

            <!-- <div class="row d-flex justify-content-center align-items-center">
                <div class="list_wrapper">
                    <div class="list_input">
                        <form method="POST" autocomplete="off">
                            <input type="text" class="form-control rounded-0" placeholder="Enter Task" id="txttask" required pattern="[A-Za-z]{3}">


                            <button type="button" id="btninsert" class="btn"><i class="bi bi-plus-lg"></i></button>
                        </form>
                    </div>
                    <?php
                    if (!isset($_SESSION['admin'])) {
                        echo "
                            <div class='list-items'>
                            <img src='images/To do list-amico.svg' class='img-fluid p-4' alt=''>
                            </div>
                            ";
                    }
                    ?>
                    <div class="list_items" id="list_items">

                    </div>
                </div>
            </div> -->
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