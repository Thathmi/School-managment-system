<?php 

use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php"; //database connection file

if (isset($_GET["u"])) { // is there an email typed?
    $u = $_GET["u"]; //assign typed email to variable coming from js

    if (empty($u)) {
        echo "Please enter your Index Number.";
    } else {

         // search student with given email
        $rs = Database::search("SELECT * FROM `student` WHERE `id`='" . $u . "' AND `activation_id`='1'");

        if ($rs->num_rows == 1) { // if there is an  student  with given email
            $re=$rs->fetch_assoc(); //take the data row
            $e=$re["email"];
            $code = uniqid(); //generate an unique code and assign to variable $code

               // update  student  with given email in database - set value $code in code column
            Database::iud("UPDATE `student` SET `code`='" . $code . "' WHERE `id`='" . $u . "' ");

             // email send to user email including the verification code.
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'my.javatesting.tt@gmail.com'; //type my mail
            $mail->Password = 'CATSnebula21?'; //type my password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('my.javatesting.tt@gmail.com', 'School Managment Stystem'); //my email & name
            $mail->addReplyTo('my.javatesting.tt@gmail.com', 'School Managment Stystem'); //my mail & name
            $mail->addAddress($e); //address of reciever
            $mail->isHTML(true);
            $mail->Subject = 'Student forgot password verification code'; // subject
            $bodyContent = '<span>Please use the belove verification code to reset your password</span>
            <br/><span style="fonr-weight:bold;">verification code = ' . $code . '</span>' ; //content
            $mail->Body    = $bodyContent;

            if (!$mail->send()) { //if email didnt send
                echo 'Message could not be sent. Mailer Error: ' ;
            } else { //email sent
                echo "1";
            }

        } else { // there is no student with given email
            echo " Invalid User";
        }
    }
} else {
    echo "Please enter your Index Number.";
}
