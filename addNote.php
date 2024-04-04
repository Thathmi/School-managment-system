<?php
session_start(); //session start

require "connection.php"; //connecting the database connection file

if (isset($_SESSION["t"])) { //check teacher is loggin

    $id = $_SESSION["t"]["id"]; //assign the id of teacher from session
    $a = $_POST["a"]; //assign the value coming from teacher.js file through POST method to a variable
    $s = $_POST["s"]; //assign the value coming from teacher.js file through POST method to a variable
    $g = $_POST["g"]; //assign the value coming from teacher.js file through POST method to a variable

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

                        $image = $_FILES["af"]; //assign the file to a variable
                        $file_name1 = $_FILES['af']['name']; //take the file name
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

                            $filename = "notes//" . $file_name1; //new location to file

                            move_uploaded_file($image["tmp_name"], $filename); //move the file to new location in project

                            $da = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $da->setTimezone($tz);
                            $date = $da->format("Y-m-d ");

                            // insert the noe file and other rcords to notes table
                            Database::iud("INSERT INTO `notes`(`note`,`name`,`teacher_id`,`grade_id`,`subject_id`,`date`) VALUES ('" . $filename . "','" . $a . "','" . $id . "','" . $g . "','" . $s . "','" . $date . "') ");
                            echo "1";
                           
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