<?php
session_start();

require "connection.php";//connecting the database connection file

if (isset($_SESSION["t"])) {//check teacher is loggin

    $aid = $_POST["a"];//assign the assignment id coming from teacher.js file through POST method to a variable

    // select the answers related to given assignment
    $up = Database::search("SELECT * FROM `answer` WHERE `assigments_id`= '" . $aid . "'");
    $pn = $up->num_rows;//no. of rows of the resultset

    for ($i = 0; $i < $pn; $i++) { //want to take rows seperatly. therefore used a for loop.
        $pr = $up->fetch_assoc();

        // select the marks of the student who sent the answers to relevant assignment
        $m = Database::search("SELECT * FROM `marks` WHERE `student_id`='" . $pr["student_id"] . "' AND `assigments_id`='" . $aid . "'");
        $mn = $m->num_rows;//no. of rows of the resultset

        // check all the students who has sent answers are assigned marks befor submitting the marks to officer
        if ($mn == 1) {
            //all the students have assigend marks that sent the answer. no response text
        } else {
            //all the students that send answers didnt assigned marks by teacher
            echo "please assign marks to student with Id" . " " . $pr["student_id"];
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