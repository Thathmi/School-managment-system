<?php
session_start();
require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { //check admin is logged in

    $s = $_POST["s"]; //assign the value coming from admin.js file through POST method to a variable

?>
    <!-- all  -->
    <div class="col-12 col-lg-11 mt-4" style="height: 50px;">
        <table class="table table-dark table-hover" style="overflow-y: scroll;">
            <thead>
                <tr>
                    <th scope="col">Grade</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Teacher</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // select teacher and subjects in grade given
                $check = Database::search("SELECT * FROM `subject_has_teacher` WHERE `grade_id` = '" . $s . "'");
                $c = $check->num_rows;

                for ($i = 0; $i < $c; $i++) {
                    $r = $check->fetch_assoc();

                    $t = Database::search("SELECT * FROM `teacher` WHERE `id` = '" . $r["teacher_id"] . "'");
                    $tr = $t->fetch_assoc();

                    $su = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $r["subject_id"] . "'");
                    $sr = $su->fetch_assoc();
                ?>
                    <tr>

                        <td><?php echo $s ?></td>
                        <td><?php echo $sr["name"] ?></td>
                        <td><?php echo $tr["fname"] . " " . $tr["lname"] ?></td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- al -->
<?php
} else {
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?Php
}
?>