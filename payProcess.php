<?php

session_start();

require "connection.php";// connecting database connection file

$sid = $_GET["id"];//store the value coming from student.js through POST method

$array; // array


// select the activated student with given index
$s = Database::search("SELECT * FROM `student` WHERE `id` = '" . $sid . "' AND `activation_id`='1'");
$sr = $s->fetch_assoc();
$g =$sr["grade_id"] ;
$gnew = $g+1; //new grade
$p = Database::search("SELECT * FROM `payment` WHERE `student_id` = '" . $sid . "' AND `new_grade`='" .$gnew. "'");
$pr = $p->fetch_assoc();

$amount = $pr["amount"];

// insert the data into array
$array['grade'] = $sr["grade_id"];
$array['amount'] =$amount ;
$array['email'] = $sr["email"];
$array['mobile'] = $sr["mobile"];
$array['fname'] = $sr["fname"];
$array['lname'] = $sr["lname"];

echo json_encode($array); // encode values in array to JSON format

