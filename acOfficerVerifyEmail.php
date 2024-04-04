<?php
use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";
require("connection.php");//connecting database connection file

$e = $_POST["e"]; //assign the email value coming from verifyemail.js file through POST method to a variable

if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {//validate email
    echo "email is not valid";

}else{//email is correct

// generate random username
function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$u = generateRandomString(5);//random username

//generate random password
function generateRandomString1($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$p = generateRandomString(5);//random password

//generate  random verification code
$c= uniqid();

// insert the email,random username,randowm password,random code into reg_email table
 Database::iud("INSERT INTO `reg_email` (`email`,`uname`,`password`,`code`) VALUES('".$e."','".$u."','".$p."','".$c."')");
 
//  email
 $mail = new PHPMailer;
 $mail->IsSMTP();
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'my.javatesting.tt@gmail.com'; //type my mail
 $mail->Password = 'CATSnebula21?'; //type my password
 $mail->SMTPSecure = 'ssl';
 $mail->Port = 465;
 $mail->setFrom('my.javatesting.tt@gmail.com', 'school management system'); //my email & name
 $mail->addReplyTo('my.javatesting.tt@gmail.com', 'school management system'); //my mail & name
 $mail->addAddress($e); //address of reciever
 $mail->isHTML(true);
 $mail->Subject = 'Academic Officer registration information'; // subject
 $bodyContent = '<span>Dear Officer,in this email you can find the username, 
 password and the verification code which need to access your new 
 account in our system. Once you updated your details and logged in to
  your acount, please change the password for security informatio.</span>

    <h4 > verification code  = ' . $c . '</h4>
    <h4> username  = ' . $u . '</h4>
    <h4> password  = ' . $p . '</h4>
    '; //content

 $mail->Body    = $bodyContent;//insert the content to the email body

 if (!$mail->send()) { //if email didn't send
     echo 'Message could not be sent. Mailer Error: ';
 } else {
    echo "1";
 }
}