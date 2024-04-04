<?php 

use PHPMailer\PHPMailer\PHPMailer;
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php"; //database connection file

if (isset($_GET["u"])) { // is there an email typed?
    $u = $_GET["u"]; //assign typed email to variable coming from js 

    if (empty($u)) {
        echo "Please enter your Email .";
    } else {

        // search admin with given email
        $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $u . "' ");

        if ($rs->num_rows == 1) { // if there is an admin with given email
            $re=$rs->fetch_assoc(); //take the data row
            $e=$re["email"]; 
            $code = uniqid(); //generate an unique code and assign to variable $code

            // update admin with given email in database - set value $code in code column
            Database::iud("UPDATE `admin` SET `code`='" . $code . "' WHERE `email`='" . $u . "' ");

            // email send to user email including the verification code.
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'my.javatesting.tt@gmail.com'; 
            $mail->Password = 'CATSnebula21?'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('my.javatesting.tt@gmail.com', 'School Managment Stystem'); //my email & name
            $mail->addReplyTo('my.javatesting.tt@gmail.com', 'School Managment Stystem'); //my mail & name
            $mail->addAddress($e); //address of reciever
            $mail->isHTML(true);
            $mail->Subject = 'Admin reset password verification code'; // subject
            $bodyContent = '<h5>Please use the belove verification code to reset your password</h5>
            <br/><span style="fonr-weight:bold;">verification code = ' . $code . '</span>' ; //content
            // $bodyContent .= '<p>pis</p>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) { //if email didnt send
                echo 'Message could not be sent. Mailer Error: ' ;
            } else { //email sent
                echo "1";
            }

        } else { // there is no admin with given email
            echo " email address not found!";
        }
    }
} else {
    echo "Please enter your Email.";
}
