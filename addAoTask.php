<?php
session_start();

require "connection.php";//connecting database connection file

if (isset($_SESSION["a"])) {//check admin is logged in

    $n = $_POST["n"];//assign the value coming from admin.js file through POST method to a variable

// this file is calling in 2 different situtions. when adding a new task and changing the officer for existing task are the 2 occurences
// that this file calls. then to seperatly identify which occurence is running, it sends a different no. as "n" when calling this file.
// n=1 is adding new task, n=2 is change task officer

    if ($n == 1) { // add new task

        $task = $_POST["task"];//assign the value coming from admin.js file through POST method to a variable
        $ao = $_POST["ao"];//assign the value coming from admin.js file through POST method to a variable

        $t = Database::search("SELECT * FROM `ac_task` WHERE `task` = '" . $task . "' ");
        $r = $t->fetch_assoc();

        // select officr with given full name
        $t1 = Database::search("SELECT * FROM `ac_officer` WHERE  concat(`fname`, ' ', `lname`) = '" . $ao . "' ");
        $r1 = $t1->fetch_assoc();

        // insert task id and officer id
        Database::iud("INSERT INTO `ac_has_task`(`task_id`,`ac_id`) VALUES ('" . $r["id"] . "','" . $r1["id"] . "')");

    } else {

        $task = $_POST["task"];//assign the value coming from admin.js file through POST method to a variable
        $ao = $_POST["ao"];//assign the value coming from admin.js file through POST method to a variable

        $t = Database::search("SELECT * FROM `ac_task` WHERE `id` = '" . $task . "' ");
        $r = $t->fetch_assoc();

        // select officr with given full name
        $t1 = Database::search("SELECT * FROM `ac_officer` WHERE  concat(`fname`, ' ', `lname`) = '" . $ao . "' ");
        $r1 = $t1->fetch_assoc();

        Database::iud("UPDATE `ac_has_task` SET `ac_id` ='" . $r1["id"] . "' WHERE `task_id` = '" . $r["id"] . "'");

    }
}
