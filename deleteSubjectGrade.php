<?php
session_start();

require "connection.php";//connecting database connection file

if (isset($_SESSION["a"])) {//check admin logged in

    $sid = $_POST["id"];//assign the value comming from admin.js file through POST method to a variable.

    // delete the subject with relevant grade 
    Database::iud("DELETE FROM `subject_has_teacher` WHERE `id` ='".$sid."'");

    echo "ok";
}