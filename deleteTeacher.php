<?php
session_start();

require "connection.php";//connecting database connection file

if (isset($_SESSION["a"])) {//check admin is logged in

    $sid = $_POST["id"]; //assign the value coming from admin.js file through POST method to a variable

    // update the activation of teacher with given id into deactivate status in db
    Database::iud("UPDATE `teacher` SET `activation_id` ='2' WHERE `id` = '".$sid."'");

    echo "ok";

}