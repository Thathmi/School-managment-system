<?php
session_start();

require "connection.php"; //connecting the database connection file

if (isset($_SESSION["t"])) { //check teacher is loggin

    $aid = $_POST["aid"]; //assign the assignment id coming from teacher.js file through POST method to a variable

    // search whether the assignment is in mark status table. that means assignment is alredy sent or not to an officer
    $s = Database::search("SELECT * FROM `marks_status` WHERE `assigment_id` ='" . $aid . "'");
    $n = $s->num_rows; //no. of rows of the resultset

    // assignment marks are sending for 1st time to acdemic officer
    if ($n == 0) {

        // insert into `marks_status` table with relevant assignment id. then marks will be finalized
        Database::iud("INSERT INTO `marks_status`(`assigment_id`) VALUES('" . $aid . "')");

        // select the students which has assigned to do the assignment but didn,t send answers. these are not submitted students

        $sa =  Database::search("SELECT * FROM  `student_has_assigments` WHERE `assigments_id`= '" . $aid . "'");
        $san = $sa->num_rows;
        for ($e = 0; $e < $san; $e++) {
            $sar = $sa->fetch_assoc();

            $ma = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $aid . "' AND `student_id`='" . $sar["student_id"] . "'");
            $man = $ma->num_rows;

            if ($man == 0) {
                $sg = Database::search("SELECT * FROM `student` WHERE `id`='" . $sar["student_id"] . "'");
                $sgr = $sg->fetch_assoc();
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $year = $d->format("Y ");
                Database::iud("INSERT INTO `marks`(`student_id`,`assigments_id`,`marks`,`marks_year`,`grade_id`) VALUES('" . $sar["student_id"] . "','" . $aid . "','0','" . $year . "','" . $sgr["grade_id"] . "')");
            }
        }
        echo "Assigment Marks sent successfuly";

        // assignment marks alredy sent to academic officer
    } else {
        echo "Assigment Marks alresdy sent ";
    }
} else {
?>
    <script>
        window.location = "teacher_login.php";
    </script>
<?Php
}
?>