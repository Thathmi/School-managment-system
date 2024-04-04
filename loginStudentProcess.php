<?php
session_start();

require "connection.php"; // connecting database connection file

$u = $_POST["u"]; //store the value coming from student.js through POST method
$p = $_POST["p"]; //store the value coming from student.js through POST method
$ra = $_POST["r"]; //store the value coming from student.js through POST method

// vallidations
if (empty($u)) { // check email is empty
    echo "please enter your username.";
} else if (empty($p)) { // email not empty then check password empty.
    echo "please enter password";
} else { // fields are not empty

    // search for records with given email & password
    $s = Database::search("SELECT * FROM `student` WHERE `id`='" . $u . "' AND `password`='" . $p . "' AND `activation_id`='1'");

    if ($s->num_rows == 1) { // if there is only one record
        $r = $s->fetch_assoc(); //take the row of data 
        $status = $r["status_id"];
        $gr = $r["grade_id"];
        $gnew = $gr + 1;

        // 1st login
        if ($status == 2) {
            echo "3";

            $_SESSION["s"] = $r; // insert data of the result row from database to session and give a name to it

            if ($ra == "true") { // if remember me option clicked
                setcookie("es", $u, time() + (60 * 60 * 24)); //create new cookie named ea and value user email with time 24h
                setcookie("ps", $p, time() + (60 * 60 * 24)); //create new cookie named ep and value user password with time 24h
            } else { // remember me not selected, no cokies will created
                setcookie("es", "", -1);
                setcookie("ps", "", -1);
            }
        } else { //not 1st login

            // select if student have to do payment for next grade or not
            $p1 = Database::search("SELECT * FROM `payment` WHERE `student_id`='" . $u . "' AND `new_grade`='" . $gnew . "'");
            $pn = $p1->num_rows;

            if ($pn == 0) { //student have no any payment
                echo "1";

                $sss = $_SESSION["s"] = $r; //insert student details to session

                if ($ra == "true") { // if remember me option clicked
                    setcookie("es", $u, time() + (60 * 60 * 24)); //create new cookie named ea and value user email with time 24h
                    setcookie("ps", $p, time() + (60 * 60 * 24)); //create new cookie named ep and value user password with time 24h
                } else { // remember me not selected, no cokies will created
                    setcookie("es", "", -1);
                    setcookie("ps", "", -1);
                }
            } else { //student have a payment to do
                $pr = $p1->fetch_assoc();
                $payid = $pr["pay_status_id"];

                if ($payid == 1) { //paid student - student have done the payment
                    echo "1";

                    $sss = $_SESSION["s"] = $r; //insert student details to session

                    if ($ra == "true") { // if remember me option clicked
                        setcookie("es", $u, time() + (60 * 60 * 24)); //create new cookie named ea and value user email with time 24h
                        setcookie("ps", $p, time() + (60 * 60 * 24)); //create new cookie named ep and value user password with time 24h
                    } else { // remember me not selected, no cokies will created
                        setcookie("es", "", -1);
                        setcookie("ps", "", -1);
                    }
                } else { // not paid - student have not done the payment yet
                    $da = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $da->setTimezone($tz);
                    $date = $da->format("Y-m-d ");
                    $year = $da->format("Y ");

                    $eday = $pr["end_date"]; //end date of the payment

                    if ($eday > $date) { //if end date is greater then today's date - student within the trial period
                        echo "4";

                        $sss = $_SESSION["s"] = $r; //insert student details to session

                        if ($ra == "true") { // if remember me option clicked
                            setcookie("es", $u, time() + (60 * 60 * 24)); //create new cookie named ea and value user email with time 24h
                            setcookie("ps", $p, time() + (60 * 60 * 24)); //create new cookie named ep and value user password with time 24h
                        } else { // remember me not selected, no cokies will created
                            setcookie("es", "", -1);
                            setcookie("ps", "", -1);
                        }
                    } else {
                        // end date is less than today's date . studendt haven't done the payment so cant access the account
                        echo "5";
                    }
                }
            }
        }
    } else { // if there are no records with given email and password
        echo "Invalid details";
    }
}
