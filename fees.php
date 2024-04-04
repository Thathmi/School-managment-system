<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php";//connecting database connection file

if (isset($_SESSION["a"])) {//check admin is signed in

    $gid = $_POST["gid"];//assign the grade coming from home page to a variable
    $fee = $_POST["fee"];//assign the grade coming from home page to a variable
                   
    $newGrade = $gid + 1; //new grade 

    if (!empty($_POST["fee"])) { //if fee is not empty

        
        $stu = Database::search("SELECT * FROM `grade_upgrade` WHERE `grade` = '" . $gid . "' ");
        $stn = $stu->num_rows;

        for ($w = 0; $w < $stn; $w++) {
            $stur = $stu->fetch_assoc();

            $ss = Database::search("SELECT * FROM `student` WHERE `id` = '" . $stur["student_id"] . "' ");
            $ssr = $ss->fetch_assoc();

            if ($stur["upgrade_id"] == 1) {

                // send email
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
                $mail->addAddress($ssr["email"]); //address of reciever
                $mail->isHTML(true);
                $mail->Subject = 'Next grade enrollment'; // subject
                $bodyContent = '<h3>Dear student,we are proudly announcing you that you have pass to next grade
                .   You have to enroll for next grade within a month. you can do payments when you log into your 
                   account. your report card will be on home page.</h3> <br>
                   <h2>Your next grade fee is Rs. '.$fee.'</h2>
                   <h3> thank you</h3>';
                $mail->Body    = $bodyContent;

                // report card 
                   // send email
                   $mail1 = new PHPMailer;
                   $mail1->IsSMTP();
                   $mail1->Host = 'smtp.gmail.com';
                   $mail1->SMTPAuth = true;
                   $mail1->Username = 'my.javatesting.tt@gmail.com'; //type my mail
                   $mail1->Password = 'CATSnebula21?'; //type my password
                   $mail1->SMTPSecure = 'ssl';
                   $mail1->Port = 465;
                   $mail1->setFrom('my.javatesting.tt@gmail.com', 'school management system'); //my email & name
                   $mail1->addReplyTo('my.javatesting.tt@gmail.com', 'school management system'); //my mail & name
                   $mail1->addAddress($ssr["email"]); //address of reciever
                   $mail1->isHTML(true);
                   $mail1->Subject = 'Report card - Grade'; // subject
                   $bodyContent1 = '<h3>Dear student,this is your report card of grade '.$gid.'</h3>';
                   $mail1->Body    = $bodyContent1;
                
                if (!$mail->send()) {
                    echo 'Message could not be sent. Mailer Error: ';
                } else {
                    $da = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $da->setTimezone($tz);
                    $date = $da->format("Y-m-d ");
                    $year = $da->format("Y ");
                    $nextmonth = date('Y-m-d', strtotime('+1 month'));
                       
                        // insert into payment
                        Database::iud("INSERT INTO `payment`(`student_id`,`new_grade`,`amount`,`year`,`start_date`,`end_date`) VALUES('" . $ssr["id"] . "','" . $newGrade . "','" . $fee . "','" . $year . "','" . $date . "','" . $nextmonth . "')");
                        // echo "1";
                }
            }else{
                 // send email
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
                 $mail->addAddress($ssr["email"]); //address of reciever
                 $mail->isHTML(true);
                 $mail->Subject = 'upgrade for next grade faied'; // subject
                 $bodyContent = '<h3>Dear student,you have failed your assigments that need to upgrade your grade
                 .unfortunatlly you have to remain in the same grade until you pass your nect exam.thank you.</h3>';
    
                 $mail->Body    = $bodyContent;
                 if (!$mail->send()) {
                    echo 'Message could not be sent. Mailer Error: ';
                } else {}
            }
        }
    } else {
        echo "please enter fee amount";
    }
}
