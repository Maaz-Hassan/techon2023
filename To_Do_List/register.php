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
        echo "<script>window.location.href='index_user.php'</script>";
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
    <div class="todo_wrapper">
        <div class="container-fluid p-3">

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-6 list_wrapper border rounded-2 p-4" style="color: #fff;">
                    <form method='POST' autocomplete='off'>
                        <div class='mb-3'>
                            <label for='exampleInputEmail1' class='form-label'>Full Name</label>
                            <input type='text' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' required name='regusername'>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputEmail2' class='form-label'>Email address</label>
                            <input type='email' class='form-control' name='regemail' id='exampleInputEmail2' aria-describedby='emailHelp' required>
                        </div>
                        <div class='mb-3'>
                            <label for='exampleInputPassword1' class='form-label'>Password</label>
                            <input type='password' class='form-control' name='regpass' id='exampleInputPassword1' required>
                        </div>
                        <button type='submit' class='btn w-100' style='background-color: #ffb703;' name='btnregister'>Register</button>
                        <div class='form-text my-2'>Have An Account? <span>
                                <a href="index.php" class="btn" style="color: #ffb703;">Log in</a></span></div>
                    </form>

                </div>
                <div class='col-6 list_wrapper'>
                    <div class="list_wrapper">
                        <img src='images/To do list-amico.svg' class='main_img img-fluid p-4' alt=''>

                    </div>
                </div>
            </div>
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

            $("#btninsert").on("click", function() {
                var txttask = $("#txttask").val();
                datetime;
                $.ajax({
                    url: 'task_insert.php',
                    type: 'POST',
                    data: {
                        txttask: txttask,
                        datetime: datetime
                    },
                    success: function(mydata) {
                        if (mydata == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login First!',
                            });
                            $("#txttask").val("");
                        } else {
                            $("#txttask").val("");
                            loadtasks();
                        }
                    }
                })
            })

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