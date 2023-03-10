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
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">To-do List</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
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
                        <?php
                        if (!isset($_SESSION['admin'])) {
                            echo "
                            <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#exampleModal'><i
                            class='bi bi-person-lines-fill'></i></button>
                    <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel'
                        aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content' style='background-color: #023047;'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' style='color: #ffb703;' id='exampleModalLabel'>Login
                                    </h1>
                                    <button type='button' class='btn-close' style='background-color: #ffb703;'
                                        data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <form method='POST' autocomplete='off'>
                                        <div class='mb-3'>
                                            <label for='exampleInputEmail1' class='form-label'>Email address</label>
                                            <input type='email' class='form-control' id='exampleInputEmail1'
                                                aria-describedby='emailHelp' required name='logemail'>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Password</label>
                                            <input type='password' class='form-control' id='exampleInputPassword1'
                                                required name='logpass'>
                                        </div>
                                        <button type='submit' class='btn w-100'
                                            style='background-color: #ffb703;' name='btnlogin'>Login</button>
                                        <div class='form-text my-2'>Don't Have An Account? <span><button
                                                    style='color: #ffb703;' type='button' class='btn'
                                                    data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Sign
                                                    Up</button></span></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false'
                        tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content' style='background-color: #023047;'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='staticBackdropLabel' style='color: #ffb703;'>Sign
                                        Up</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'
                                        style='background-color: #ffb703;'></button>
                                </div>
                                <div class='modal-body'>
                                    <form method='POST' autocomplete='off'>
                                        <div class='mb-3'>
                                            <label for='exampleInputEmail1' class='form-label'>Full Name</label>
                                            <input type='text' class='form-control' id='exampleInputEmail1'
                                                aria-describedby='emailHelp' required name='regusername'>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputEmail2' class='form-label'>Email address</label>
                                            <input type='email' class='form-control' name='regemail' id='exampleInputEmail2'
                                                aria-describedby='emailHelp' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='exampleInputPassword1' class='form-label'>Password</label>
                                            <input type='password' class='form-control' name='regpass' id='exampleInputPassword1'
                                                required>
                                        </div>
                                        <button type='submit' class='btn w-100'
                                            style='background-color: #ffb703;' name='btnregister'>Register</button>
                                        <div class='form-text my-2'>Have An Account? <span><button
                                                    style='color: #ffb703;' type='button' class='btn'
                                                    data-bs-toggle='modal'
                                                    data-bs-target='#exampleModal'>Login</button></span></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            ";
                        } else {
                            echo "<a href='logout.php'><i class='bi bi-box-arrow-right'></i></a>";
                        }
                        ?>
                    </div>
                </div> -->
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="todo_wrapper">
        <div class="container-fluid p-3 mt-3 d-flex justify-content-center align-items-center">

            <div class="row w-75">
                <h1 class="text-center my-4" style="color: #fff;">Create To-do Task</h1>
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
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <?php
                                    $group = mysqli_query($connect,"Select * from group_list");
                                        foreach($group as $group_row){
                                            ?>
                                            <option value="<?php echo $row['group_id'] ?>"><?php echo $row['group_name'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
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
                        $query = "INSERT INTO task_list (task_name,due_date,due_time,description,attachment,admin_id) VALUES ('$task_name','$due_date','$due_time','$description','$folder','$adminid')";

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