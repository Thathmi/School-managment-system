<?php

session_start();
require "connection.php";// connecting database connection file

$pid =$_POST["pid"];//store the payment id value coming from student.js through POST method
$sid =$_POST["sid"];//store the index value coming from student.js through POST method
$email =$_POST["email"];//store the email value coming from student.js through POST method
$amount =$_POST["total"];//store the payed amout value coming from student.js through POST method

// select the student with the given index
$s =Database::search("SELECT * FROM `student` WHERE `id` = '".$sid."'");
$sn = $s->fetch_assoc();

$grade = $sn["grade_id"];//take student's grade
$newGrade = $grade+1; //new grade is one greate than current grade

// update payment table and set pay_status as payed where student id = index given and grade = new grade upgraded and amout = payed amout
Database::iud("UPDATE `payment` SET `pay_status_id` ='1' WHERE `student_id` = '".$sid."' AND `new_grade`='".$newGrade."' AND `amount`='".$amount."'");
// update the new grade of the given student n student table
Database::iud("UPDATE `student` SET `grade_id` ='".$newGrade."' WHERE `id` = '".$sid."' ");

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d ");
$year = $d->format("Y ");

// insert the data into the invoice table
Database::iud("INSERT INTO `invoice`(`payment_id`,`date`,`student_id`,`year`,`amount`,`new_grade`) VALUES ('".$pid."','".$date."','".$sid."','".$year."','".$amount."','".$newGrade."')");

echo "1";
?>