<?php

require "connection.php";//connecting database connection file

$vc=$_POST["c"];//assign typed email to variable coming from js file
$u=$_POST["u"];//assign typed email to variable coming from js file

$s=Database::search("SELECT * FROM `ac_officer` WHERE `uname`='".$u."' AND `code` ='".$vc."'");//search ac.officer with given username.

if($s->num_rows==1){
    $ss=Database::iud("UPDATE `ac_officer` SET `code` = Null WHERE `uname`='".$u."'"); //verification code deleted by single use
    Database::iud("UPDATE `ac_officer` SET `status_id`='1' WHERE `uname`='".$u."'" ); //ac.oficer status change to verified student
echo "1";
}else{
echo "2";
}
?>