<?php
session_start();

require "connection.php";

if (isset($_SESSION["t"])) {

    $s = $_SESSION["t"];
    $id = $s["id"];

    $up = Database::search("SELECT * FROM `teacher_profile` WHERE `t_id`= '" . $id . "'");
    $pn = $up->num_rows;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Teacher Home page</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="images/logo.jpg" />
        <!--logo-->
        <link rel="stylesheet" href="mainPage.css" />
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

    <body style="overflow-x:hidden;background-color:#f5f5f5;" onload="refresh();">
        <div id="wish"></div>
        <!-- main div -->
        <div class="row">
            <!-- vertical nav -->
            <div class="col-12 col-lg-2" style="background-color: #ECEFEC;height:119vmax">

                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <?php
                        if ($pn == 1) {
                            $spic = $up->fetch_assoc();
                        ?>
                            <img class="rounded-circle mt-4" width="100px" height="100px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev" />
                            <!-- display the profile emaig -->
                        <?php
                        } else {
                        ?>
                            <img class="rounded-circle mt-4" width="125px" height="125px" src="images/download.png" img-thumbnail id="prev" />
                            <!-- if there is no profile image added, then display empty profile image -->
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-12 ms-2 mt-5" style="text-align: center;">
                        <span><?php echo $s["fname"] . " " . $s["lname"]; ?></span><br>
                        <!-- display the teacher name taken from session -->
                    </div>
                    <div class="col-12 mt-3">
                        <hr style="width: 90%;margin-left:auto;margin-right:auto">
                    </div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mt-2">
                        <!-- toggle between dashboard and profile page -->
                        <a onclick="toggleDiv('ddiv');" class="nav-link active mt-2" style="color:grey;" aria-current="page" href="#"><i class="bi bi-tv" style="color: purple;margin-right:8px"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="toggleDiv('pdiv');" class="nav-link" style="color:grey;" href="#"><i class="bi bi-person-fill" style="color: red;margin-right:7px"></i> User Profile</a>
                </ul>

            </div>
            <!-- vertical nav -->

            <!-- dashboard -->
            <div class="col-12 col-lg-10" id="divdash" style="display:block;height:100vh;position:relative;z-index:5;">

                <div style=" background-image: linear-gradient(to right,#ff8a98 ,#b57281);height:60%;width:100%;position:relative;z-index:6;"></div>

                <div class="row" style="position:absolute; top: 10px;left: 30px;z-index:7">
                    <div class="col-lg-12 col-6">
                        <div style="width: 200px;height:30px;margin-top:10px;color:whitesmoke;display:inline-block">TEACHER DASHBOARD |
                        </div>
                        <div onclick="location.href='logout.php';" style="cursor:pointer;color:black;display:inline-block">LOGOUT |</div>
                    </div>
                </div>
                <!-- time table &notices -->
                <div class="row">
                    <div class="col-lg-5 col-11 bg-dark " style="color:whitesmoke;border-radius:10px;height: 65%; width:57%;position:absolute; top: 25%;left: 5%;z-index:7">

                        <div style="color: white;text-decoration:underline;text-align:center;font-size:23px" class="mt-1 mb-3">Time Table</div>
                        <table class="table table-dark table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%;">Time</th>
                                    <th scope="col">Monday</th>
                                    <th scope="col">Tuesday</th>
                                    <th scope="col">Wednesday</th>
                                    <th scope="col">Thursday</th>
                                    <th scope="col">Friday</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="mt-1">
                                    <th style="font-size: small;">8.00 - 9.00</th>
                                    <td>Maths</td>
                                    <td>-</td>
                                    <td>English</td>
                                    <td>-</td>
                                    <td>English</td>
                                </tr>
                                <tr class="mt-1">
                                    <th style="font-size: small;">9.00 - 10.00</th>
                                    <td>-</td>
                                    <td>Science</td>
                                    <td>-</td>
                                    <td>Science</td>
                                    <td>English</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">10.00 - 11.00</th>
                                    <td>Maths</td>
                                    <td>Science</td>
                                    <td>English</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">11.00 - 11.30</th>
                                    <td colspan="5" style="text-align:center;font-size:20px">Interval</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">11.30 - 12.30</th>
                                    <td>-</td>
                                    <td>Science</td>
                                    <td>English</td>
                                    <td>-</td>
                                    <td>English</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">12.30 - 1.30</th>
                                    <td>Maths</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Science</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- NOTICE -->
                    <div class="col-lg-5 col-10 bg-white  overflow-scroll d-none d-sm-none d-md-block d-lg-block" style="border-radius:10px;height: 65%; width:30%;position:absolute; top: 25%;left: 67%;z-index:7">
                        <span style="margin-left:25%;font-size:17px;font-weight:bold;text-decoration:underline">Special notices</span>

                        <div class="row mt-3" id="notice">
                            <?php
                            // search notices to teacher from notice table
                            $n = Database::search("SELECT * FROM `notice` WHERE `person`= 't' ");
                            $nn = $n->num_rows; // no.of rows in resultset
                            for ($q1 = 0; $q1 < $nn; $q1++) { //for loop will run for no. of rows in resultset times
                                $nr = $n->fetch_assoc(); // take the 1st row
                            ?>
                                <!-- this divs will be created for no of rows times. then it will add each record from db to these divs -->
                                <div class="mt-2">
                                    <i class="bi bi-dot"></i> <span><?php echo $nr["notice"] ?>
                                    </span><br>
                                </div>
                                <div>
                                    <span style="font-size: small;color:gray">- <?php echo $nr["date_time"] ?> -</span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- time table &notices -->

                <!-- assigments -->
                <div class="row mt-2 mb-3">
                    <div class="col-lg-5 col-10 " style="background-color:#dcdada;border-radius:10px;height: 65%; width:92%;position:absolute; top: 100%;left: 5%;z-index:8">
                        <div style="font-size: 20px;width:102%;background-color:#fcc0c0;border-top-right-radius:10px;border-top-left-radius:10px;margin-left:-12px">
                            <span style="margin-left: 20px;">Add New Assigments</span>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-1 mb-1">
                                <label class="form-label" style="color: gray;">Assigment Name</label>
                                <input type="text" class="form-control form-control-sm" id="a" aria-describedby="emailHelp">
                            </div>

                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">Select Subject</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="s">
                                    <?php
                                    // select the unique(without repeating) sujects that this relevant teacher teaching
                                    $sq = Database::search("SELECT DISTINCT(`subject_id`) FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "'");
                                    $qn = $sq->num_rows; //no. of rows in resultset
                                    for ($i == 0; $i < $qn; $i++) { //for loop will run for no. of rows in resultset times

                                        $rq = $sq->fetch_assoc(); // take the 1st row
                                        $ssq = Database::search("SELECT * FROM `subject` WHERE `id`='" . $rq["subject_id"] . "'");
                                        $rrq = $ssq->fetch_assoc(); // take the 1st row
                                    ?>
                                        <!-- this option will be created for no of rows times. then it will add each record from db to these option tags -->
                                        <option value="<?php echo $rrq["id"] ?>"><?php echo $rrq["name"] ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">Select Grade</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="g">
                                    <?php
                                    // select the unique grades that this relevant teacher teaching

                                    $sss = Database::search("SELECT DISTINCT(`grade_id`) FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "'");
                                    $ssn = $sss->num_rows; //no. of rows in resultset
                                    for ($ii == 1; $ii < $ssn; $ii++) { //for loop will run for no. of rows in resultset times
                                        $rrs = $sss->fetch_assoc(); // take the 1st row
                                    ?>
                                        <!-- this option will be created for no of rows times. then it will add each record from db to these option tags -->

                                        <option><?php echo $rrs["grade_id"] ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">End date</label>
                                <input type="date" class="form-control form-control-sm" id="d" aria-describedby="emailHelp">

                            </div>
                            <div class="col-12 col-lg-6 mt-2">

                                <label class="form-label" style="color: gray;">Select Assigment file</label>
                                <input type="file" class="form-control form-control-sm" id="af" aria-describedby="emailHelp">
                            </div>
                            <div class="col-4 mt-4">
                                <button onclick="assigment()" class="button" style="background-color:#fcc0c0;border-radius:10px;z-index:8;width:100%">
                                    <span style="color:black">Add Assigment</span>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- assigments -->

                <!-- notes -->

                <div class="row mt-2 mb-3">
                    <div class="col-lg-5 col-10 " style="background-color:#dcdada;border-radius:10px;height: 65%; width:92%;position:absolute; top: 170%;left: 5%;z-index:8">
                        <div style="font-size: 20px;width:102%;background-color:#fc8eac;border-top-right-radius:10px;border-top-left-radius:10px;margin-left:-12px">
                            <span style="margin-left: 20px;">Add New Lesson Notes</span>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-1 mb-1">
                                <label class="form-label" style="color: gray;">Note Name</label>
                                <input type="email" class="form-control form-control-sm" id="n" aria-describedby="emailHelp">
                            </div>

                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">Select Subject</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="ns">
                                    <?php
                                    // select the sujects that this relevant teacher teaching

                                    $sq1 = Database::search("SELECT DISTINCT(`subject_id`) FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "'");
                                    $qn1 = $sq1->num_rows; //no. of rows in resultset
                                    for ($i1 == 0; $i1 < $qn1; $i1++) { //for loop will run for no. of rows in resultset times
                                        $rq1 = $sq1->fetch_assoc(); // take the 1st row

                                        $ssq1 = Database::search("SELECT * FROM `subject` WHERE `id`='" . $rq1["subject_id"] . "'");

                                        $rrq1 = $ssq1->fetch_assoc(); // take the 1st row
                                    ?>
                                        <!-- this option will be created for no of rows times. then it will add each record from db to these option tags -->

                                        <option value="<?php echo $rrq1["id"] ?>"><?php echo $rrq1["name"] ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">Select Grade</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="ng">
                                    <?php
                                    // select the unique grade that this relevant teacher teaching
                                    $sss1 = Database::search("SELECT DISTINCT(`grade_id`) FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "'");
                                    $ssn1 = $sss1->num_rows; //no. of rows in resultset
                                    for ($ii1 == 1; $ii1 < $ssn1; $ii1++) { //for loop will run for no. of rows in resultset times
                                        $rrs1 = $sss1->fetch_assoc(); // take the 1st row
                                    ?>
                                        <!-- this option will be created for no of rows times. then it will add each record from db to these option tags -->
                                        <option><?php echo $rrs1["grade_id"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mt-2" style="display:block">

                                <label class="form-label" style="color: gray;">Select Lesson note file</label>
                                <input type="file" class="form-control form-control-sm" id="nf" aria-describedby="emailHelp">
                            </div>
                            <div class="col-12 col-lg-6 mt-2" style="display:block">
                            </div>
                            <div class="col-4 mt-4" style="display:block">
                                <button onclick="note();" class="button" style="background-color:#fc8eac;border-radius:10px;z-index:8;width:100%">
                                    <span style="color:black">Add Note</span>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- notes -->
                <!-- view -->
                <div class="row mt-2 mb-3">
                    <div class="col-lg-5 col-10 overflow-scroll" style="border-radius:10px;height: 65%; width:92%;position:absolute; top: 240%;left: 5%;z-index:8">
                        <span style="font-size: 20px;">Assigments</span>
                        <table class="table table-danger table-striped table-hover mt-2 " id="table">
                            <thead>
                                <tr>
                                    <th scope="col">Assigment Id</th>
                                    <th scope="col">Assigment name</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">No. of students </th>

                                    <th scope="col">View Answers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // select the assigments this teacher uploaded
                                $ss = Database::search("SELECT * FROM `assigments` WHERE `teacher_id`='" . $id . "'"); //select asigments uploaded by teacher
                                $sn = $ss->num_rows; //takin no. of rows

                                for ($qq = 0; $qq < $sn; $qq++) { //want to take rows seperatly. therefore used a for loop.
                                    $sid = $ss->fetch_assoc(); //takin rows 

                                    // select the subjct for specifiv assigment
                                    $sub = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $sid["subject_id"] . "'");
                                    $subn = $sub->fetch_assoc();

                                    // count al the student in `student_has_assigments` table which has the relevant assigmnet
                                    $stu = Database::search("SELECT COUNT(*) AS tot FROM `student_has_assigments` WHERE `assigments_id`='" . $sid["id"] . "'");
                                    $stur = $stu->fetch_assoc();
                                ?>
                                    <!-- assigning values to table from database -->
                                    <!-- this table row and its cells will be created for no of rows times. then it will add each record from db to these cells -->

                                    <tr>
                                        <td><?php echo $sid["id"]; ?></td>
                                        <td><?php echo $sid["name"]; ?></td>
                                        <td><?php echo $subn["name"]; ?></td>
                                        <td><?php echo $sid["grade_id"]; ?></td>
                                        <td><?php echo $stur["tot"] ?></td>
                                        <td>
                                            <!-- when button click, it will go to viewAnswer.php file by  taking the assigment id -->
                                            <button onclick="window.location='viewAnswer.php?id=<?php echo $sid['id'] ?>'" class="button" style="background-color:#c08081;border-radius:10px;height: 25px; width:135px;position:absolute;  display: inline-block;">
                                                <span style="font-size:15px; display: inline-block;top:-10px">view Answers</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- view -->
            </div>
            <!-- dashboard end -->

            <!-- profile -->
            <div class="col-12 col-lg-10" id="divprofile" style="height:auto;display:none;background-color:#f8f8ff;position:relative">
                <div style="position:relative;z-index:5;">
                    <img src="images/teacherProfile.jpg" style="height:600px;filter: brightness(50%);width:100%" alt="" />

                    <div style="z-index: 6;width:100%;position:absolute; top: 10px;left: 30px;color:whitesmoke">
                        <span style="display: block;font-size:18px;">Teacher profile</span>
                        <span style="font-size: 30px;display: block;margin-top:150px;font-weight:bold;">Hello <?php echo $s["fname"] ?></span>
                        <span style="font-size: 18px;display: block;margin-top:30px">This is your profile page.<br>
                            You can change your details any time.</span>

                        <button class="mt-5 btn btn-info" style="border-radius: 6px;height:45px;color:whitesmoke;font-size:17px" onclick="update();">edit profile</button>

                        <div class="mt-5 mb-3" style="width:75%;background-color: #f5f5f5;height:auto;border-radius:10px;margin: 0 auto;color:black">

                            <div style="width: 100%;background-color:whitesmoke;height:auto;
                        border-top-left-radius: 10px;border-top-right-radius:10px ;color:black;font-size:15px">
                                <span class="mt-1 mb-1 ms-1">TEACHER INFORMATION </span>
                            </div>

                            <div class="row mt-4">

                                <div class="col-md-4 col-lg-12 col-12 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php
                                        if ($pn == 1) {
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="160px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev1" />
                                        <?php
                                        } else {
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="160px" src="images/download.png" img-thumbnail id="prev1" />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" id="imguploader" accept="image/*" class="d-none" />
                                        <!-- when click this button, you can select a new image -->
                                        <label for="imguploader" class="btn btn-danger mt-4" onclick="clickimg();">Update Profile Image</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">First name</label>
                                            <!-- display forst name -->
                                            <input type="text" class="form-control" placeholder="<?php echo $s["fname"]; ?>" id="fn" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Last name</label>
                                            <!-- display last name -->
                                            <input type="text" class="form-control" placeholder="<?php echo $s["lname"]; ?>" id="ln" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">User name</label>
                                            <!-- display username. but can edit -->
                                            <input type="email" class="form-control" id="exampleInputEmail1" readonly placeholder="<?php echo $s["uname"]; ?>" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Current password</label>
                                            <!-- display password. but can edit -->
                                            <input type="email" class="form-control" readonly id="exampleInputEmail1" placeholder="<?php echo $s["password"]; ?>" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">teacher Id</label>
                                            <!-- display id. but can edit -->
                                            <input type="email" class="form-control" readonly placeholder="<?php echo $id; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Incharge Grade</label>
                                            <!-- display incharge lass. but can edit -->
                                            <input type="email" class="form-control" placeholder="<?php echo $s["grade_id"]; ?>" readonly placeholder="" id="exampleInputEmail1" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Teaching Subjects</label>
                                            <div class="form-control" id="noticeStudent" readonly placeholder="">
                                                <?php
                                                // select the subjects with grades, the teacher teaching.
                                                $ts = Database::search("SELECT * FROM `subject_has_teacher` WHERE `teacher_id`='" . $id . "'");
                                                $tn = $ts->num_rows;
                                                for ($e = 0; $e < $tn; $e++) {
                                                    $t = $ts->fetch_assoc();
                                                    $su = Database::search("SELECT * FROM `subject` WHERE `id`='" . $t["subject_id"] . "'");
                                                    $sn = $su->fetch_assoc();
                                                ?>
                                                    <br>Grade <?php echo $t["grade_id"] ?> - <?php echo $sn["name"]; ?>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr style="width: 90%;margin: 0 auto" class="mt-4">

                            <div class="row mt-4">
                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Mobile</label>
                                            <!-- display mobile -->
                                            <input type="email" class="form-control" id="m" placeholder="0<?php echo $s["mobile"]; ?>" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Email address</label>
                                            <!-- display email -->
                                            <input type="email" class="form-control" id="e" placeholder="<?php echo $s["email"]; ?>" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- profile -->
        </div>
        </div>
        </div><!-- main div -->

        <script src="teacher.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- <script src="bootstrap.bundle.js"></script> -->
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "teacher_login.php";
    </script>
<?Php
}
?>