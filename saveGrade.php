<?php
session_start();

require "connection.php"; //connecting database connection file

if(isset($_SESSION["a"])){//check admin logged in

$s = $_POST["s"]; //assign the value comming from admin.js file through POST method to a variable.
$tid = $_POST["id"];  //assign the value comming from admin.js file through POST method to a variable.

if(isset($s)){ //check grade were selected

    // update the grade_id column in teacher table with given id in database
    Database::iud("UPDATE `teacher` SET `grade_id`='".$s."' WHERE `id` = '".$tid."'");

    echo "ok";
}else{
    echo " no grade were selected";
}

}