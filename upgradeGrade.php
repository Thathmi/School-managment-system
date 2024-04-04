<?php
session_start();

require "connection.php";//connecting database connection file

if (isset($_SESSION["a"])) {//check admin is signed in

    if (!empty($_POST["avg"])) {

        $avg = $_POST["avg"];//assign the avarage that admin enter coming from home page to a variable
        $gid = $_POST["gid"];//assign the grade coming from home page to a variable
       
        $da = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $da->setTimezone($tz);
        $year = $da->format("Y ");

        // select all students in selected grade
        $st = Database::search("SELECT * FROM `student` WHERE `grade_id` = '".$gid."'");
        $sn = $st->num_rows; // no. of rows in resultsets

        for($i=0;$i<$sn;$i++){
            $sr=$st->fetch_assoc();

            // select the avarage mark for each student
        $av = Database::search("SELECT AVG(marks.`marks`) FROM `marks` WHERE `student_id` ='" . $sr["id"] . "'  AND `marks_year`='" . $year . "'");
       $avgm = $av->fetch_assoc();

      $m =   $avgm["AVG(marks.`marks`)"]; //avarage mark

      if($avg < $m){ //if avarage mark of student is greater than the cuttoff mark - pass
        Database::iud("INSERT INTO `grade_upgrade`(`student_id`,`avg`,`year`,`upgrade_id`,`grade`) VALUES('".$sr["id"]."','".$m."','".$year."','1','".$gid."')");
      }else{ //avarage of student is greater than cutoff mark - fail
        Database::iud("INSERT INTO `grade_upgrade`(`student_id`,`avg`,`year`,`upgrade_id`,`grade`) VALUES('".$sr["id"]."','".$m."','".$year."','2','".$gid."')");
      }
        }
       echo "1";
    } else {
        echo "please enter Avarage amount";
    }
}
