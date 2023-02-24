<?php
include("connection.php");
session_start();
extract($_POST);
if(isset($_SESSION['admin']))
{
    $query = mysqli_query($connect,"INSERT INTO tbl_todo(todo_id,todo_task,todo_time,adminid) VALUES('','$txttask','$datetime','$_SESSION[admin]')");
}
else
{
    echo 1;
}
?>