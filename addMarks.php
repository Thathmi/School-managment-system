<?php
session_start();//session start

require "connection.php";//connecting the database connection file

if (isset($_SESSION["t"])) {//check teacher is loggin

    if (!empty($_POST["m"])) { //check marks are empty

        $aid = $_POST["a"]; //assign the value coming from admin.js file through POST method to a variable
        $marks = $_POST["m"]; //assign the value coming from admin.js file through POST method to a variable
        $s = $_POST["s"];//assign the value coming from admin.js file through POST method to a variable

        $da = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $da->setTimezone($tz);
        // $date = $da->format("Y-m-d ");
        $year = $da->format("Y ");

        // select the student with iven id
        $ss = Database::search("SELECT * FROM `student` WHERE `id`='" . $s . "' ");
        $sg = $ss->fetch_assoc();

        if ($marks < 101 && $marks>0) { //check marks are in between the range 0 and 100

            //search whether the student with givem assignment has marks alredy or not
            $ma = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $aid . "' AND `student_id`='" . $s . "'");
            $man = $ma->num_rows;//no. of rows of the resultset

            if ($man == 1) { //had assigned marks before. then change marks
                Database::iud("UPDATE `marks` SET `marks`='" . $marks . "' WHERE `assigments_id`='" . $aid . "' AND `student_id`='" . $s . "'");
               
            } else { // 1st time adding marks.
                Database::iud("INSERT INTO `marks`(`student_id`,`assigments_id`,`marks`,`marks_year`,`grade_id`) VALUES('" . $s . "','" . $aid . "','" . $marks . "','".$year."','".$sg["grade_id"]."')");
            }
            echo "1";
        } else {
            echo "invalid marks";
        }
    } else {
        echo "please enter marks";
    }
}
