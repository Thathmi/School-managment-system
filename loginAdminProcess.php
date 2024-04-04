<?php
session_start();

require "connection.php"; // database connection file

$u = $_POST["u"]; //store the value coming from admin.js through POST method
$p = $_POST["p"]; //store the value coming from admin.js through POST method
$ra = $_POST["r"]; //store the value coming from admin.js through POST method

// vallidations
if (empty($u)) { // check email is empty
    echo "please enter your Email.";
} else if (empty($p)) { // email not empty then check password empty.
    echo "please enter password";
}else{ // fields are not empty

 // search for records with given email & password
$s=Database::search("SELECT * FROM `admin` WHERE `email`='".$u."' AND `password`='".$p."'");

if($s->num_rows==1){ // if there is only one record
   echo "1";

   $d = $s->fetch_assoc(); //take the row of data 
   $_SESSION["a"] = $d; // insert data of the result row from database to session and give a name to it

   if ($ra == "true") { // if remember me option clicked
       setcookie("ea", $u, time() + (60 * 60 * 24 )); //create new cookie named ea and value user email with time 24h
       setcookie("pa", $p, time() + (60 * 60 * 24 )); //create new cookie named ep and value user password with time 24h
   } else { // remember me not selected, no cokies will created
       setcookie("ea", "", -1);
       setcookie("pa", "", -1);
   }
    
}else{ // if there are no records with given email and password
    echo "Invalid details";
}
}
