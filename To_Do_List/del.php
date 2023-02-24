<?php
include("connection.php");
extract($_POST);
$query = mysqli_query($connect,"DELETE FROM tbl_todo WHERE todo_id=$rowid");
?>