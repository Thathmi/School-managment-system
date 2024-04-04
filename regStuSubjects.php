<?php

// assigning subjects to students according to their grade

require "connection.php";

// $g = $_POST["gr"];
$e = $_POST["e"];

$d = Database::search("SELECT * FROM `student` WHERE `email`='".$e."'");
$dr=$d->fetch_assoc();

$g = $dr["grade_id"];

if(12>$g && $g>5){

    for($i=1;$i<11;$i++){
    //    adding subjects to students from grade 6 to 11
        Database::iud("INSERT INTO `subject_has_student`(`subject_id`,`student_id`) VALUES('".$i."','".$dr["id"]."')");
    }

echo "1";
}else{
    for($i=1;$i<5;$i++){
    //    adding subjects to students from grade 1 to 6
        Database::iud("INSERT INTO `subject_has_student`(`subject_id`,`student_id`) VALUES('".$i."','".$dr["id"]."')");
    }
    echo "1";
}