<?php
    include("connection.php");
    session_start();
    
    if(isset($_SESSION['admin']))
    {
        $admin_id = $_SESSION['admin'];
        $result = mysqli_query($connect,"SELECT * FROM tbl_todo WHERE adminid=$admin_id ORDER BY todo_id DESC");
        foreach($result as $row)
        {
            echo "
            <div class='list_item'>
            <form method='POST'>
                <div class='d-flex flex-column justify-content-center align-items-start'>
                    <div class='d-flex justify-content-center align-items-center'>
                        <input type='checkbox' class='form-check' id='task_$row[todo_id]'>
                        <label for='task_$row[todo_id]'><h3>$row[todo_task]</h3></label><br>
                    </div>
                    <p>$row[todo_time]</p>
                </div>
                <button class='btn' type='button' id='btndel' rowid='$row[todo_id]'><i class='bi bi-x-lg'></i></button>
            </form>
        </div>
            ";
        }
    }
    else
    {
        echo "";
    }

?>