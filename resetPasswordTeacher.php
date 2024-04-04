<?php

require "connection.php"; //database connection file

$u = $_POST["u"]; //assign data coming from js through POST method to a variable
$np = $_POST["np"]; //assign data coming from js through POST method to a variable
$rnp = $_POST["rnp"]; //assign data coming from js through POST method to a variable
$vc = $_POST["vc"]; //assign data coming from js through POST method to a variable

if (empty($u)) { // check email is empty
    echo "Missing Username";
} else if (empty($np)) { // check new password is empty
    echo "Please enter your password";
} else if (strlen($np) < 5 || strlen($np) >= 20) {// check characters of new password is less than 5 or greater than 20
    echo "Password length must between 5 to 20";
} else if (empty($rnp)) {// check re-enter password is empty
    echo "Please Re-enter your password";
} else if ($np != $rnp) {// check new password and re-entered password is equal
    echo "Password and Re-type password does not match";
} else if (empty($vc)) {// check verification code is empty
    echo "Please enter your verification code";
} else { // no error so update database

       // serach from database whether there is a teacher with given username and erification code
    $rs = Database::search("SELECT * FROM `teacher` WHERE `uname`='".$u."' AND `code`='".$vc."'");
    if($rs->num_rows==1){

           // update password in user with given username in database
         Database::iud("UPDATE `teacher` SET `password`='".$np."' WHERE `uname`='".$u."'");
         echo "1";

    }else{//there is no user with given username nor incorect verification code
        echo "Password Reset Fail";
    }
}

?> 
