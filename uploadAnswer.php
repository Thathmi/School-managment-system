<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["s"])) { //check student is signed in

    $id = $_SESSION["s"]["id"]; //store the index number taken from session in a variable

    $sid = $_POST["sid"]; //assign the asignment id coming from js file throught POST method to a variable

    if (isset($_FILES["img"])) { //if file is selected
        $image = $_FILES["img"]; //asiign the file to a variable
        $file_name1 = $_FILES['img']['name']; //assign the file name to a variable

        $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
        $file_extention = $image["type"];

        if (in_array($file_extention, $allowed_image_extention)) {
            echo "Please Select a valid image.";
        } else {
            // echo $imageFile["name"];

            $newimgextention;
            if ($file_extention = "image/pdf") {
                $newimgextention = ".pdf";
            } elseif ($file_extention = "image/docx") {
                $newimgextention = ".docx";
            } elseif ($file_extention = "image/txt") {
                $newimgextention = ".txt";
            }

            $filename = "answer//" . $file_name1; //give new file name

            move_uploaded_file($image["tmp_name"], $filename); //move the file to new place

            $da = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $da->setTimezone($tz);
            $date = $da->format("Y-m-d ");

            // search if the student has already apload an answer before
            $u = Database::search("SELECT * FROM `answer` WHERE `assigments_id`='" . $sid . "' AND `student_id`='" . $id . "'");
            $un = $u->num_rows;

            if ($un == 0) { //1st time uploading answer
                // insert the data into answer table
                Database::iud("INSERT INTO `answer`(`assigments_id`,`answer`,`student_id`,`date`) VALUES('" . $sid . "','" . $filename . "','" . $id . "','".$date."')");
            } else { //reupload the answer.
                // update the answer file in answer table
                Database::iud("UPDATE `answer` SET  `answer`='" . $filename . "',`date`='".$date."' WHERE `student_id`='" . $id . "' AND `assigments_id`='" . $sid . "'");
            }
            echo "1";
        }
    }
} else {
    echo "invalid User";
}
