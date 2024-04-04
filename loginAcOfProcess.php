<?php
session_start();

require "connection.php"; // database connection file

$u = $_POST["u"]; //store the value coming from acOfficer.js through POST method
$p = $_POST["p"]; //store the value coming from acOfficer.js through POST method
$ra = $_POST["r"]; //store the value coming from acOfficer.js through POST method

// vallidations
if (empty($u)) { // check email is empty
    echo "please enter your username.";
} else if (empty($p)) { // email not empty then check password empty.
    echo "please enter password";
}else{ // fields are not empty

 // search for records with given email & password
$s=Database::search("SELECT * FROM `ac_officer` WHERE `uname`='".$u."' AND `password`='".$p."' AND `activation_id`='1'");

if($s->num_rows==1){ // if there is only one record
    $r=$s->fetch_assoc(); //take the row of data 

    $status=$r["status_id"]; // take the status id of given user. to check a verified or non verified officer

    if($status==2){ //non verified officer - 1st login
        echo "3";

        $_SESSION["ac"] = $r; // insert data of the result row from database to session and give a name to it
     
        if ($ra == "true") { // if remember me option clicked
            setcookie("eac", $u, time() + (60 * 60 * 24 )); //create new cookie named eac and value user email with time 24h
            setcookie("pac", $p, time() + (60 * 60 * 24 )); //create new cookie named pac and value user password with time 24h
        } else { // remember me not selected, no cokies will created
            setcookie("eac", "", -1);
            setcookie("pac", "", -1);
        }
    }else{ // verified officer
        
        echo "1";

        $_SESSION["ac"] = $r;
     
        if ($ra == "true") { // if remember me option clicked
            setcookie("eac", $u, time() + (60 * 60 * 24 )); //create new cookie named eac and value user email with time 24h
            setcookie("pac", $p, time() + (60 * 60 * 24 )); //create new cookie named pac and value user password with time 24h
        } else { // remember me not selected, no cokies will created
            setcookie("eac", "", -1);
            setcookie("pac", "", -1);
        }
    }
   
}else{ // if there are no records with given email and password
    echo "Invalid details";
}
}
