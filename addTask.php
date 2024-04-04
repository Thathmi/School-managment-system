<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { //check admin is logged in

    $task = $_POST["task"]; //assign the value coming from admin.js file through POST method to a variable

    //search in the ac_task table whether the new task is alredy exist or not
    $t = Database::search("SELECT * FROM `ac_task` WHERE `task` ='" . $task . "'");
    $r = $t->num_rows; //no. of rows

    if ($r == 0) { // no such task exist

        // insert the new task into ac_task table
        Database::iud("INSERT INTO `ac_task`(`task`) VALUES ('" . $task . "')");

        echo "1";
    } else { // task is already exist
        echo "Task with same name exists";
    }
} else {
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?php
}
