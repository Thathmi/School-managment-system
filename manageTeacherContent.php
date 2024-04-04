<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { //check admin logged in

    $tid = $_GET["id"]; //assign the value comming from manageTeacher.php file through GET method to a variable.
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>manage teacher page</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <!-- <link rel="stylesheet" href="mainPage.css" /> -->
        <link rel="stylesheet" href="icofont.css" />
        <link rel="stylesheet" href="icofont.min.css">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

        <style>
            .button {

                border: none;
                /* font-weight: bold; */
                color: whitesmoke;

                text-align: center;
                font-size: 19px;
                padding: 8px;

                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
                border-radius: 6px;
            }

            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .button span:after {
                content: '\00bb';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .button:hover span {
                padding-right: 25px;
            }

            .button:hover span:after {
                opacity: 1;
                right: 0;
            }
        </style>
    </head>

    <?php
    // select the teacher with given id from db
    $t = Database::search("SELECT * FROM `teacher` WHERE `id` = '" . $tid . "'");
    $tr = $t->fetch_assoc(); //take the row of resultset
    ?>

    <body style="overflow-x:hidden;background-color:#e5e4e2;">
        <div id="wish"></div>
        <!-- main div -->
        <div class="row">
            <div class="col-12" style=" background-image: linear-gradient(to right,#b17179 ,#4a304d);height:30px;width:100%">
                <i onclick="window.location='manageTeacher.php';" class="bi bi-arrow-left-circle" style="font-size: 23px;"></i>
            </div>
            <div class="col-12 mt-4 " style="background-color:#e5e4e2;width: 100%;height:auto;display: flex;align-items: center;justify-content: center;">
                <div class="bg-light" style="width: 95%;height:auto;border-radius:10px">

                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label mt-2">Teacher Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label mt-2"><?php echo $tid ?></label><br>

                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label ">Teacher Name &nbsp;&nbsp;:</label>
                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label "><?php echo $tr["fname"] . " " . $tr["lname"]; ?></label><br>

                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label ">Class Incharge &nbsp;&nbsp;:</label>
                    <label id="g1" style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label ">Grade : &nbsp; <?php echo $tr["grade_id"] ?></label><br>

                </div>
            </div>

            <!-- select grade -->
            <div class="col-12 mt-4 " style="background-color:#e5e4e2;width: 100%;height:auto;display: flex;align-items: center;justify-content: center;">
                <div class="bg-light" style="width: 95%;height:auto;border-radius:10px;">
                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label mt-2">Select new Class Incharge</label>
                    <div class="row">
                        <div class="col-11 col-lg-5">
                            <select id="s" style="margin-left:20px" class="form-select mb-4 mt-2" aria-label="Default select example">

                                <?php
                                // select the grades that there is no teacher in charge assigned yet.
                                $c = Database::search("SELECT `grade`.`id` FROM `grade` LEFT JOIN `teacher` ON  `grade`.`id`=`teacher`.`grade_id`  WHERE `teacher`.`grade_id` IS NULL");
                                $cn = $c->num_rows; //take no. of rows in resultset

                                for ($u = 0; $u < $cn; $u++) { //for loop will run for no. of rows times
                                    $cr = $c->fetch_assoc(); //take the row from resultset
                                ?>
                                    <!-- display the grades that doesn' have teacher incharges yet -->
                                    <option><?php echo $cr["id"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- when click delete button, saveGrade() function in admin.js will run. it passes the value of teacher id to js file  -->
                        <div onclick="saveGrade(<?php echo $tid ?>);" class="col-11 col-lg-5 button" style="border-radius:10px;height: 40px; width:20%;background-color:#b17179;margin-left:20px">
                            <span>Save</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- select grade -->

            <!-- teaching subjects -->

            <div class="col-12 mt-4 " style="background-color:#e5e4e2;width: 100%;height:auto;display: flex;align-items: center;justify-content: center;">
                <div class="bg-light" style="width: 95%;height:240px;border-radius:10px;overflow-y: scroll;">
                    <label style="margin-left: 20px;" for="exampleFormControlInput1" class="form-label mt-2">Currently teaching subjects and grades</label>


                    <table class="table" style="overflow-y: scroll;" id="table">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Class</th>
                                <th scope="col">Remove</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // select teacher teaching subjects with grades from subject_has_teacher of teacher with given id
                            $c1 = Database::search("SELECT * FROM `subject_has_teacher` WHERE `teacher_id`='" . $tid . "'");
                            $cn1 = $c1->num_rows; // no. of rows in resultset

                            for ($u1 = 0; $u1 < $cn1; $u1++) { //for loop will run for no. of rows times
                                $cr1 = $c1->fetch_assoc(); //take the row from resultset

                                // select subject name
                                $s1 = Database::search("SELECT * FROM `subject` WHERE `id`='" . $cr1["subject_id"] . "'");
                                $sr = $s1->fetch_assoc(); //take the row from resultset
                                $uu = $u1 + 1;
                            ?>
                                <tr>
                                    <!-- display teaching subjects with grades details -->
                                    <th><?php echo $sr["name"] ?></th>
                                    <td><?php echo $cr1["grade_id"] ?></td>
                                    <!-- when click delete button, deleteTS() function in admin.js will run. it passes the value of id of teacging subject with grade  -->
                                    <td><button onclick='deleteTS(<?php echo $cr1["id"] ?>)' class="btn btn-danger" style="height: 30px;">Remove</button></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- teaching subjects -->

        </div>
        <!-- main div -->

        <script src="admin.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "admin_login.php";
    </script>
<?Php
}
?>