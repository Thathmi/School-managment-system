<?php
// register a new student
use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php";//connecting dtabase connection file

$f = $_POST["f"]; // assign the value coming from js file to a variable
$l = $_POST["l"]; // assign the value coming from js file to a variable
$e = $_POST["e"]; // assign the value coming from js file to a variable
$m = $_POST["m"]; // assign the value coming from js file to a variable
$pn = $_POST["pn"]; // assign the value coming from js file to a variable
$pm = $_POST["pm"]; // assign the value coming from js file to a variable
$gr = $_POST["gr"]; // assign the value coming from js file to a variable
$g = $_POST["g"]; // assign the value coming from js file to a variable
$as = $_POST["as"]; // assign the value coming from js file to a variable

// creating new id's

$p = uniqid(); //generate unique number for password
$c = uniqid();//generate unique number for verification code
$id  = mt_rand(1, 9999); //generate unique number  for index
// validation
if (empty($f)) { //check first name is empty
    echo "please enter student first name.";
} else if (strlen($f) >= 15) { //check first name is more than 15 characters
    echo "first name is not valid";
} else if (empty($l)) { //check lat name is empty
    echo "please enter student last name.";
} else if (strlen($l) >= 25) { //check last name is more than 25 characters
    echo "last name is not valid";
} else if (empty($e)) { //check email is empty
    echo "please enter student email";
} else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) { //check email is in correct format 
    echo "email is not valid";
} else if (empty($m)) { //check mobile is empty
    echo "please enter student mobile";
} else if (strlen($m) != 10) { //check mobile is not equal to 10 integers
    echo "Please enter valid mobile";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $m) == 0) { //check mobile format is correct
    echo "Invalid mobile";
} else if (empty($pn)) { //check parent name is empty
    echo "please enter parent name";
} else if (empty($pm)) { //check parent mobile is empty
    echo "please enter parent mobile";
} else if (strlen($pm) != 10) {//check parent mobile is not equal to 10 integers
    echo "Please enter valid mobile";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $pm) == 0) { //check parent mobile format is correct
    echo "Invalid mobile";
}else { // no errors

    // serach wether the student with same email exist or not
    $s = Database::search("SELECT * FROM `student` WHERE `email`='" . $e . "' ");
    if ($s->num_rows > 0) { //student with same email exists
        echo "User with same email address is alredy exist !";
    } else { //same email doesn;t exists

        // send email
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'my.javatesting.tt@gmail.com';
        $mail->Password = 'CATSnebula21?';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('my.javatesting.tt@gmail.com', 'school management system'); //my email & name
        $mail->addReplyTo('my.javatesting.tt@gmail.com', 'school management system'); //my mail & name
        $mail->addAddress($e); //address of reciever
        $mail->isHTML(true);
        $mail->Subject = 'student registration information'; // subject
        $bodyContent = '<h5>Dear student,we have regestered you as a student. please use the verification code,password and the index number goven below to access your account for the first time.
           </h5><h5>after login to your account, please change your password.</h5>
           <h5 >Your verification code is = ' . $c . '</h5>
           <h5>your index number is = ' . $id . '</h5>
           <h5>your password  is = ' . $p . '</h5>
           '; //content
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ';
        } else {
            //    if there is no error in sending email then student added to database
            Database::iud("INSERT INTO `student` (`id`,`fname`,`lname`,`email`,`password`,`mobile`,`status_id`,`code`,`grade_id`,`gender_id`,`pname`,`pmobile`) VALUES('" . $id . "','" . $f . "','" . $l . "','" . $e . "','" . $p . "','" . $m . "','2','" . $c . "','" . $gr . "','" . $g . "','" . $pn . "','" . $pm . "')");

            //   adding student aesthatic subject to database
            Database::iud("INSERT INTO `subject_has_student`(`subject_id`,`student_id`) VALUES('" . $as . "','" . $id . "')");
            echo "1";
        }
    }
}
