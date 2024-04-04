<?php

use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php";

$vc=$_POST["c"];
$u=$_POST["u"];

$s=Database::search("SELECT * FROM `student` WHERE `id`='".$u."' AND `code` ='".$vc."'"); //search student with given index no.

if($s->num_rows==1){
    $ss=Database::iud("UPDATE `student` SET `code` = Null WHERE `id`='".$u."'"); //verification code deleted by single use
    Database::iud("UPDATE `student` SET `status_id`='1' WHERE `id`='".$u."'" ); //student status change to verified student
echo "1";
}else{
echo "Invalid Verification code";
}
?>