<?php
session_start(); //session start

require "connection.php"; //connecting the database connection file

if (isset($_SESSION["t"])) { //check teacher is loggin

    $id = $_SESSION["t"]["id"]; //assign the value in session to variable
    $a = $_POST["a"]; //assign the value coming from admin.js file through POST method to a variable
    $s = $_POST["s"]; //assign the value coming from admin.js file through POST method to a variable
    $g = $_POST["g"]; //assign the value coming from admin.js file through POST method to a variable
    $d = $_POST["d"]; //assign the value coming from admin.js file through POST method to a variable

    // search the loged teacher is teaching selcted subject to selected grade
    $check = Database::search("SELECT * FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "' AND `subject_id`='" . $s . "' AND `grade_id`='" . $g . "'");
    $checkrow = $check->num_rows; //no. of rows of the resultset

    if ($checkrow == 0) { //if rows are 0. teacher is not teaching selected subject for selected grade
        echo "Can't Add assigment. You don't teach selected subject for grade "  .  $g;
    } else { //teacher is teaching selected subject for selected grade
        if (isset($_FILES["af"])) { //check a file is selected
            if (!empty($a)) { //check name is typed
                if (!empty($s)) { //check subject is selected
                    if (!empty($g)) { //check grade is selected
                        if (!empty($d)) { //check date is selected
                            $image = $_FILES["af"]; //assign the file to a variable
                            $file_name1 = $_FILES['af']['name']; //take the file name
                            // img
                            $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                            $file_extention = $image["type"]; //take the file type

                            if (in_array($file_extention, $allowed_image_extention)) {
                                echo "Please Select a valid file.Only pdf and word documents are allow";
                            } else {
                
                                $newimgextention;
                                if ($file_extention = "image/pdf") {
                                    $newimgextention = ".pdf";
                                } elseif ($file_extention = "image/txt") {
                                    $newimgextention = ".txt";
                                } elseif ($file_extention = "image/docx") {
                                    $newimgextention = ".docx";
                                }
                                $filename = "assigment//"  . $file_name1; //new location to file

                                move_uploaded_file($image["tmp_name"], $filename); //move the file to new location in project

                                $da = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $da->setTimezone($tz);
                                $date = $da->format("Y-m-d ");
                                $year = $da->format("Y ");

                                $aid  = mt_rand(1, 19999); //generate randowm assigment id

                                // insert the assigment to assiggments table with the records
                                Database::iud("INSERT INTO `assigments` (`start_date`,`id`,`assigment`,`name`,`end_date`,`teacher_id`,`grade_id`,`subject_id`,`year`) VALUES ('" . $date . "','" . $aid . "','" . $filename . "','" . $a . "','" . $d . "','" . $id . "','" . $g . "','" . $s . "','" . $year . "') ");
                                echo "ok";

                                // select all the students which grade is relevant to assigment grade
                                $sg = Database::search("SELECT * FROM `student` WHERE `grade_id`='" . $g . "' AND `activation_id`='1'");
                                $sgn = $sg->num_rows; //no. of rows

                                for ($q = 0; $q < $sgn; $q++) {
                                    $sgr = $sg->fetch_assoc();
                                    // select the students that selected abouve which are doing the subject that relevant to the assigment
                                    $ss = Database::search("SELECT * FROM `subject_has_student` WHERE `student_id`='" . $sgr["id"] . "' AND `subject_id`='" . $s . "'");
                                    $ssn = $ss->num_rows;

                                    for ($w = 0; $w < $ssn; $w++) {
                                        $ssr = $ss->fetch_assoc();
                                        $ssid = $ssr["student_id"];
                                        // insert the relevant students into student_has_assigments table
                                        Database::iud("INSERT INTO `student_has_assigments`(`student_id`,`assigments_id`) VALUES('" . $ssid . "','" . $aid . "')");
                                    }
                                }
                            }
                        } else {
                            echo "please select date";
                        }
                    } else {
                        echo "please select grade";
                    }
                } else {
                    echo "please select subject";
                }
            } else {
                echo "please enter assigment name";
            }
        } else {
            echo "please upload assigment file";
        }
    }
} else {
?>
    <script>
        window.location = "teacher_login.php";
    </script>
<?Php
}
?>