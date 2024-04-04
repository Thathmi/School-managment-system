<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["s"])) { // check user is logged in 

    $id = $_SESSION["s"]["id"]; // take the id inside session
    $fname = $_POST["fn"]; // assign data coming from js through POST method
    $lname = $_POST["ln"]; // assign data coming from js through POST method
    $mobile = $_POST["m"]; // assign data coming from js through POST method
    $newmail = $_POST["ne"]; // assign data coming from js through POST method



    if (isset($_FILES["img"])) { //check an image is slected
        $image = $_FILES["img"]; // assign image coming from js through POST method
        $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
        $file_extention = $image["type"];

        if (!in_array($file_extention, $allowed_image_extention)) {
            echo "Please Select a valid image.";
        } else {
            // echo $imageFile["name"];

            $newimgextention;
            if ($file_extention = "image/jpeg") {
                $newimgextention = ".jpeg";
            } elseif ($file_extention = "image/jpg") {
                $newimgextention = ".jpg";
            } elseif ($file_extention = "image/png") {
                $newimgextention = ".png";
            } elseif ($file_extention = "image/svg") {
                $newimgextention = ".svg";
            }

            $filename = "images//student//" . uniqid() . $newimgextention; //give image a new location

            move_uploaded_file($image["tmp_name"], $filename); //move file to new location
            $resultProfileImg = Database::search("SELECT * FROM `student_profile` WHERE `st_id`='" . $id . "'  ");
            $pror = $resultProfileImg->num_rows;

            if ($pror == 1) { //change existing profile image
                Database::iud("UPDATE `student_profile` SET `code`='" . $filename . "' WHERE `st_id`='" . $id . "'   ");

                echo "Image Saved Successfully.";
            } else { // inssert new profile image for 1st time
                Database::iud("INSERT INTO `student_profile` (`code`,`st_id`) VALUES ('" . $filename . "','" . $id . "') ");
                echo "Image Saved Successfully.";
            }
        }
    }
    if (!empty($fname)) { // check first name is empty
        // update student table  with new first name in database
        Database::iud("UPDATE `student` SET 
    `fname` = '" . $fname . "' WHERE `id`='" . $id . "'  ");
    }
    if (!empty($lname)) { // check last name is empt
        // update student table  with new last name in database
        Database::iud("UPDATE `student` SET 
    `lname` = '" . $lname . "' WHERE `id`='" . $id . "'  ");
    }
    if (!empty($mobile)) { // check mobile is empty
        if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) { //validate mobile
            echo "Invalid mobile";
        } else {
            // update student table  with new mobile in database
            Database::iud("UPDATE `student` SET 
    `mobile` = '" . $mobile . "' WHERE `id`='" . $id . "'  ");
        }
    }
    if (!empty($newmail)) { // check email is empty
        if (!filter_var($e, FILTER_VALIDATE_EMAIL)) { //validate email
            echo "Invalid email";
        } else {
            // update student table  with new email in database
            Database::iud("UPDATE `student` SET 
    `email` = '" . $newmail . "' WHERE `id`='" . $id . "'  ");
        }
    }
    $sss = Database::search("SELECT * FROM `student` WHERE `id`='" . $id . "' ");
    $res = $sss->fetch_assoc();
    $_SESSION["s"] = $res; //insert new informaion about user to session

} else {
    echo "invalid User";
}
