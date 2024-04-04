<?php
session_start();

require "connection.php"; //connecting the database connection file

if (isset($_SESSION["ac"])) { //check officer os logged in

    $id = $_POST["i"]; //assign the id coming from js file through POST method
    if ($id == 1) { //if id =1, that means notice fro teacher

        if (isset($_POST["n"])) { //check notice is empty

            $n = $_POST["n"]; //assin notice to a variable

            $da = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $da->setTimezone($tz);
            $date = $da->format("Y-m-d) H:i:s");

            // insert into the notice table with data notice ,date and the time, and person as t to identify its a teacher notice
            Database::iud("INSERT INTO `notice`(`notice`,`date_time`,`person`) VALUES('" . $n . "','" . $date . "','t')");
            echo "Notice added successfuly";
        } else {
            echo "please enter notice";
        }
    } else { //if id =2, that means notice fro student

        if (isset($_POST["n"])) { //check notice is empty

            $n = $_POST["n"]; //assign notice to a variable
            $g = $_POST["g"]; //assign grade to a variable

            $da = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $da->setTimezone($tz);
            $date = $da->format("Y-m-d) H:i:s");

            // insert into the notice table with data notice ,date and the time,grade and person as s to identify its a student notice
            Database::iud("INSERT INTO `notice`(`notice`,`date_time`,`person`,`grade`) VALUES('" . $n . "','" . $date . "','s','" . $g . "')");
            echo "Notice added successfuly";
        } else {
            echo "please enter notice";
        }
    }
} else {
}
