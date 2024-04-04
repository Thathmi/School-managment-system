<?php

require "connection.php";//connecting dtabase connection file

$f = $_POST["f"]; // assign the value coming from js file to a variable
$l = $_POST["l"]; // assign the value coming from js file to a variable
$e = $_POST["e"]; // assign the value coming from js file to a variable
$m = $_POST["m"]; // assign the value coming from js file to a variable
$u = $_POST["u"]; // assign the value coming from js file to a variable
$g = $_POST["g"]; // assign the value coming from js file to a variable

if (empty($f)) { //check first name is empty
    echo "please enter your first name.";
} else if (strlen($f) >= 15) { //check first name is more than 15 characters
    echo "first name is not valid";
} else if (empty($l)) { //check lat name is empty
    echo "please enter your last name.";
} else if (strlen($l) >= 25) { //check last name is more than 25 characters
    echo "last name is not valid";
} else if (empty($e)) { //check email is empty
    echo "please enter your email";
} else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) { //check email is in correct format 
    echo "email is not valid";
} else if (empty($m)) { //check mobile is empty
    echo "please enter your mobile";
} else if (strlen($m) != 10) { //check mobile is not equal to 10 integers
    echo "Please enter valid mobile";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $m) == 0) { //check mobile format is correct
    echo "Invalid mobile";
} else { // no errors

    // search whether the entered email is in reg_email table
    $s1 = Database::search("SELECT * FROM `reg_email` WHERE `email`='" . $e . "' AND `uname` = '" . $u . "'");
    if ($s1->num_rows == 1) {
        $r1 = $s1->fetch_assoc();
        $un = $r1["uname"]; //take the username value of given email from the table 
        $p = $r1["password"]; //take the password value of given email from the table 
        $c = $r1["code"]; //take the verificationcode value of given email from the table 
        if ($u == $un) { //is types username is equals to the usename in database

            // insert the records to teacher table and set the status as non- verified until user logging for the 1st time
            $s = Database::iud("INSERT INTO `teacher`(`fname`,`lname`,`email`,`mobile`,`password`,`uname`,`gender_id`,`status_id`,`code`) VALUES('" . $f . "','" . $l . "','" . $e . "','" . $m . "','" . $p . "','" . $u . "','" . $g . "','2','" . $c . "')");
            echo "1";
        } else {
            echo "username doesn't match";
        }
    } else {
        echo "invalid details";
    }
}
