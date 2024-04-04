<?php
session_start();

require "connection.php"; //connecting the database connection file

if (isset($_SESSION["s"])) { //check student is logged in

    $s = $_SESSION["s"]; //assign the session data to a variable
    $id = $s["id"]; //take the index from session data

    $up = Database::search("SELECT * FROM `student_profile` WHERE `st_id`= '" . $id . "'");
    $pn = $up->num_rows;
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Studen home page</title>
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
    <!-- boady will call the function refresh() when loading the page -->

    <body style="overflow-x:hidden;background-color:#f5f5f5;" onload="refresh();">
        <div id="wish"></div>
        <!-- main div -->
        <div class="row">
            <!-- vertical nav -->
            <div class="col-12 col-lg-2" style="background-color:#ECEFEC ;height:90vmax">

                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <?php
                        if ($pn == 1) { // if student has uploded a profile image
                            $spic = $up->fetch_assoc();
                        ?>
                            <!-- then show the profile image -->
                            <img class="rounded-circle mt-4" width="100px" height="100px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev" />
                        <?php
                        } else { //student has not uploaded the profile image yet
                        ?>
                            <!-- then show the empty profile image -->
                            <img class="rounded-circle mt-4" width="125px" height="100px" src="images/download.png" img-thumbnail id="prev" />
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-12 ms-2 mt-5" style="text-align: center;">
                        <!-- display the full name taken by session -->
                        <span><?php echo $s["fname"] . " " . $s["lname"]; ?></span><br>
                        <!-- display the grade taken by session -->
                        <span>Grade <?php echo $s["grade_id"]; ?> </span><br>
                    </div>
                    <div class="col-12 mt-3">
                        <hr style="width: 90%;margin-left:auto;margin-right:auto">
                    </div>
                </div>
                <ul class="nav flex-column">
                    <!-- toggle in between profile and dasgboard -->
                    <li class="nav-item mt-2">
                        <a onclick="toggleDiv('ddiv');" class="nav-link active mt-2" style="color:grey;" aria-current="page" href="#"><i class="bi bi-tv" style="color: purple;margin-right:8px"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="toggleDiv('pdiv');" class="nav-link" style="color:grey;" href="#"><i class="bi bi-person-fill" style="color: red;margin-right:7px"></i> User Profile</a>
                </ul>
            </div>
            <!-- vertical nav -->

            <!-- dashboard -->
            <div class="col-12 col-lg-10" id="divdash" style="display:block;height:100vh;position:relative;z-index:5;">

                <div style=" background-image: linear-gradient(to right,#9dd5cb , #3482aa);height:60%;width:100%;position:relative;z-index:6;"></div>

                <div class="row" style="position:absolute; top: 10px;left: 30px;z-index:7">
                    <div class="col-lg-12 col-6">
                        <div style="width: 200px;height:30px;margin-top:10px;color:whitesmoke;display:inline-block">STUDENT DASHBOARD |
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
                                    <td>Health</td>
                                    <td>Geopraphy</td>
                                    <td>Science</td>
                                    <td>PTS</td>
                                </tr>
                                <tr class="mt-1">
                                    <th style="font-size: small;">9.00 - 10.00</th>
                                    <td>History</td>
                                    <td>Civics</td>
                                    <td>English</td>
                                    <td>Maths</td>
                                    <td>Tamil</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">10.00 - 11.00</th>
                                    <td>Maths</td>
                                    <td>Sinhsls</td>
                                    <td>Science</td>
                                    <td>Geography</td>
                                    <td>Tamil</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">11.00 - 11.30</th>
                                    <td colspan="5" style="text-align:center;font-size:20px">Interval</td>

                                </tr>
                                <tr>
                                    <th style="font-size: small;">11.30 - 12.30</th>
                                    <td>Health</td>
                                    <td>Sinhala</td>
                                    <td>PTS</td>
                                    <td>Science</td>
                                    <td>English</td>
                                </tr>
                                <tr>
                                    <th style="font-size: small;">12.30 - 1.30</th>
                                    <td>Aesthatic</td>
                                    <td>Science</td>
                                    <td>History</td>
                                    <td>Maths</td>
                                    <td>Civics</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-lg-5 col-10 bg-white  overflow-scroll d-none d-sm-none d-md-block d-lg-block" style="border-radius:10px;height: 65%; width:30%;position:absolute; top: 25%;left: 67%;z-index:7">
                        <span style="margin-left:25%;font-size:17px;font-weight:bold;text-decoration:underline">Special notices</span>

                        <div class="row mt-3" id="notice">
                            <?php
                            // select the noticec from noticec table which are relevant to students and to the student's grade and 
                            $n = Database::search("SELECT * FROM `notice` WHERE `person`= 's' AND `grade`='" . $s["grade_id"] . "' ");
                            $nn = $n->num_rows; //no. of rows in esultset
                            for ($q1 = 0; $q1 < $nn; $q1++) {
                                $nr = $n->fetch_assoc();
                            ?>
                                <div class="mt-2">
                                    <!-- display the notice -->
                                    <i class="bi bi-dot"></i> <span><?php echo $nr["notice"] ?>
                                    </span><br>
                                </div>
                                <div>
                                    <!-- display the date and time of notice -->
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
                    <div class="col-lg-5 col-10 overflow-scroll" style="border-radius:10px;height: 65%; width:92%;position:absolute; top: 100%;left: 5%;z-index:8">
                        <span style="font-size: 20px;">Assigments</span>
                        <table class="table table-success table-striped table-hover mt-2 " id="table">
                            <thead>
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Assigment name</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End date</th>
                                    <th scope="col">Download</th>
                                    <th scope="col">Upload answer</th>
                                    <th scope="col">Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // select all the assignment that ssigned for student
                                $ss = Database::search("SELECT * FROM `student_has_assigments` WHERE `student_id`='" . $id . "'");
                                $sn = $ss->num_rows; //no. of rows in esultset

                                for ($qq = 0; $qq < $sn; $qq++) {
                                    $sid = $ss->fetch_assoc();
                                    // select the assignment from abouve assignment id
                                    $aas = Database::search("SELECT * FROM `assigments` WHERE `id`='" . $sid["assigments_id"] . "' ORDER BY `start_date` ASC");

                                    $aa = $aas->fetch_assoc();
                                    // selec the subject for relevant assignment
                                    $sub = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $aa["subject_id"] . "'");
                                    $subn = $sub->fetch_assoc();
                                ?>
                                    <!-- assigning values to table from database -->
                                    <tr>
                                        <!-- not displaying the assignment id. but given the value of assignment id -->
                                        <td style="display:none ;" id="aname"><?php echo $aa['id'] ?></td>
                                        <!-- subject name  -->
                                        <td><?php echo $subn["name"]; ?></td>
                                        <!-- assignment name  -->
                                        <td><?php echo $aa["name"]; ?></td>
                                        <!-- star date  -->
                                        <td><?php echo $aa["start_date"]; ?></td>
                                        <!-- end date -->
                                        <td><?php echo $aa["end_date"]; ?></td>

                                        <?php
                                        $da = new DateTime();
                                        $tz = new DateTimeZone("Asia/Colombo");
                                        $da->setTimezone($tz);
                                        $date = $da->format("Y-m-d ");
                                        // if today's date is less than end date of the assignemnt
                                        if ($aa["end_date"] >= $date) { //still can upload the answer
                                        ?>
                                            <!-- send the assignment id todownload.php file so the relevant assignment will download -->
                                            <td><a href="download.php?id=<?php echo $aa['id']; ?>" class="btn btn-danger" style="height: 27px;font-size:12px;font-weight:bold">Download</a></td>
                                            <td>
                                                <?php
                                                // check if the student has sent answer for the relevant assignment
                                                $aasr = Database::search("SELECT * FROM `answer` WHERE `student_id` = '" . $id . "' AND `assigments_id`='" . $aa["id"] . "'");
                                                $aasn = $aasr->num_rows; //no. of rows in resultset

                                                if ($aasn == 0) { //upload for 1st time
                                                ?>
                                                    <!--buton will appear as upload answer becaus its 1st time and send the value of asignment id to upload function when click the button -->
                                                    <button onclick="upload(<?php echo $aa['id'] ?>)" class="btn btn-warning" style="display:block;height: 27px;font-size:12px;font-weight:bold" data-bs-toggle="modal" data-bs-target="#exampleModal" id="submit">Upload Answer</button>
                                                <?php
                                                } else { //re-upload - student alredy uploaded answer before
                                                ?>
                                                    <!--button will appear as re-upload answer and send the value of asignment id to upload function when click the button -->
                                                    <button onclick="upload(<?php echo $aa['id'] ?>)" class="btn btn-info" style="display:block;height: 27px;font-size:12px;font-weight:bold" data-bs-toggle="modal" data-bs-target="#exampleModal">Reupload Answer</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <?php

                                        } else { //expired - when today's date is greater than end date.
                                            // check if the student has sent answer for the relevant assignment
                                            $aasr1 = Database::search("SELECT * FROM `answer` WHERE `student_id` = '" . $id . "' AND `assigments_id`='" . $aa["id"] . "'");
                                            $aasn1 = $aasr1->num_rows;
                                            if ($aasn1 == 0) { // not uploaded the answer
                                            ?>
                                                <!-- botton will appear as not submitted -->
                                                <td colspan="2"><button class="btn btn-dark" style="width:80%;height: 27px;font-size:12px;font-weight:bold">Not submitted</button></td>
                                            <?php
                                            } else { //uploaded the answer
                                            ?>
                                                <!-- button will appear as submitted -->
                                                <td colspan="2"><button class="btn btn-success" style="width:80%;height: 27px;font-size:12px;font-weight:bold">submitted</button></td>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        // check the academic officer has released the marks.
                                        $q = Database::search("SELECT * FROM `marks` WHERE `student_id` ='" . $id . "' AND `status`='1' AND `assigments_id`= '" . $sid["assigments_id"] . "' ");
                                        $qn = $q->num_rows; //no. of rows in resultset

                                        if ($qn == 1) { //officer has uploaded the marks for specific assignment
                                            $qr = $q->fetch_assoc();
                                        ?>
                                            <!-- marks for specific assignment will appear in red -->
                                            <td style="color: red;font-weight:bold"><?php echo $qr["marks"] ?> %</td>
                                        <?php
                                        } else { //still not released the marks
                                        ?>
                                            <td>-</td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>

                </div>
                <!-- assigments -->

                <!-- notes -->

                <div class="row mt-2">
                    <!-- when click thebutton, it will directed to viewNote.php file -->
                    <button onclick="window.location='viewNotes.php'" class="button col-lg-5 col-10" style="background-color:#5f9ea0;border-radius:10px;height: 8%; width:92%;position:absolute; top: 170%;left: 5%;z-index:8">
                        <span style="font-weight: bold;">view notes</span>
                    </button>
                </div>
                <!-- notes -->

            </div>
            <!-- dashboard end -->

            <!-- profile -->
            <?php
            ?>
            <div class="col-12 col-lg-10" id="divprofile" style="height:auto;display:none;background-color:#f8f8ff;position:relative">
                <div style="position:relative;z-index:5;">
                    <img src="images/studentProfile.jpg" style="height:600px;filter: brightness(50%);width:100%" alt="" />

                    <div style="z-index: 6;width:100%;position:absolute; top: 10px;left: 30px;color:whitesmoke">
                        <span style="display: block;font-size:18px;">User profile</span>
                        <span style="font-size: 30px;display: block;margin-top:150px;font-weight:bold;">Hello <?php echo $s["fname"] ?></span>
                        <span style="font-size: 18px;display: block;margin-top:30px">This is your profile page.<br>
                            You can change your details any time.</span>
                        <!-- when click the button, update() function will run. it will save the changes made in the rofile -->
                        <button class="mt-5 btn btn-info" style="border-radius: 6px;height:45px;color:whitesmoke;font-size:17px" onclick="update();">edit profile</button>

                        <div class="mt-5 mb-3" style="width:75%;background-color: #f5f5f5;height:auto;border-radius:10px;margin: 0 auto;color:black">

                            <div style="width: 100%;background-color:whitesmoke;height:auto;
                        border-top-left-radius: 10px;border-top-right-radius:10px ;color:black;font-size:15px">
                                <span class="mt-1 mb-1 ms-1">USER INFORMATION </span>
                            </div>

                            <div class="row ">

                                <div class="col-md-4 col-lg-12 col-12 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php
                                        if ($pn == 1) { // student has uploaded profile image 
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="160px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev1" />
                                        <?php
                                        } else { //student has not uploade the image yet
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="160px" src="images/download.png" img-thumbnail id="prev1" />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" id="imguploader" accept="image/*" class="d-none" />
                                        <!-- clickimg() function will run -->
                                        <label for="imguploader" class="btn btn-danger mt-4" onclick="clickimg();">Update Profile Image</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">First name</label>
                                            <!-- display the firs name taken from session-->
                                            <input type="text" class="form-control" id="fn" placeholder="<?php echo $s["fname"]; ?>" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Last name</label>
                                            <!-- display the last name taken from session-->
                                            <input type="text" class="form-control" placeholder="<?php echo $s["lname"]; ?>" id="ln" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Index number</label>
                                            <!-- display the index taken from session -->
                                            <input type="email" readonly class="form-control" placeholder="<?php echo $s["id"]; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Current password</label>
                                            <!-- display the password taken from session but cant edit or change -->
                                            <input type="email" class="form-control" placeholder="<?php echo $s["password"]; ?>" readonly id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Grade</label>
                                            <!-- display the grade taken from session. but cant edit or change -->
                                            <input type="email" readonly class="form-control" placeholder="<?php echo $s["grade_id"] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Enrolled Subjects</label>
                                            <!-- display the subjects that alresy enrolled. bu cant edit or change -->
                                            <input type="email" class="form-control" placeholder="" readonly id="exampleInputEmail1" aria-describedby="emailHelp">
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
                                            <!-- display the mobile taken from session-->
                                            <input type="email" class="form-control" placeholder="0<?php echo $s["mobile"]; ?>" id="m" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Email address</label>
                                            <!-- display the email taken from session-->
                                            <input type="email" class="form-control" placeholder="<?php echo $s["email"]; ?>" id="e" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="width: 90%;margin: 0 auto" class="mt-4">

                            <div class="row mt-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- profile -->
        </div>
        </div>
        </div><!-- main div -->

        <!-- Modal -->
        <!-- this will appear when student tries to upload answer to assignemnt -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Anaswe </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type='file' id="getFile">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <!-- function up1() wil call -->
                        <button type="button" class="btn btn-warning" onclick="up1();">Upload Assigment</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="student.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </body>

    </html>
<?php
} else { //when not logged in, directed to login page
?>
    <script>
        window.location = "student_login.php";
    </script>
<?Php
}
?>