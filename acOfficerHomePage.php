<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["ac"])) { // checking if there is officer data in the session

    $s = $_SESSION["ac"]; //asigning data in session to a variable
    $id = $s["id"]; //asigning data in session to a variable

    //search from ac_officer_profile table with the id in session in database
    $up = Database::search("SELECT * FROM `ac_officer_profile` WHERE `ac_id`= '" . $id . "'");
    $pn = $up->num_rows; //take the no. of rows or resultset

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Academic officer page</title>
        <link rel="icon" href="images/logo.jpg" />
        <link rel="stylesheet" href="bootstrap.css" />
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

    <body style="overflow-x:hidden;background-color:#f5f5f5;">
        <div id="wish"></div>
        <!-- main div -->
        <div class="row">
            <!-- vertical nav -->
            <div class="col-12 col-lg-2" style="background-color:#ECEFEC;height:50vmax">

                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <?php
                        if ($pn == 1) { // if academic officr has an profile picture
                            $spic = $up->fetch_assoc();
                        ?>
                            <!-- display the profile picture -->
                            <img class="rounded-circle mt-4" width="100px" height="100px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev" />

                        <?php
                        } else { //academic officer doesn't uploaded a profile picture yet
                        ?>
                            <!-- diaply the no picture -->
                            <img class="rounded-circle mt-4" width="125px" height="100px" src="images/download.png" img-thumbnail id="prev" />

                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-12 ms-2 mt-5" style="text-align: center;">
                    </div>
                    <div class="col-12 mt-3">
                        <hr style="width: 90%;margin-left:auto;margin-right:auto">
                    </div>
                </div>
                <ul class="nav flex-column">

                    <li class="nav-item mt-2">
                        <!-- link to dashboard -->
                        <a onclick="toggleDiv('ddiv');" class="nav-link active mt-2" style="color:grey;" aria-current="page" href="#"><i class="bi bi-tv" style="color: purple;margin-right:8px"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <!-- link to profile -->
                        <a onclick="toggleDiv('pdiv');" class="nav-link" style="color:grey;" href="#"><i class="bi bi-person-fill" style="color: red;margin-right:7px"></i> User Profile</a>

                </ul>

            </div>
            <!-- vertical nav -->

            <!-- dashboard -->
            <div class="col-12 col-lg-10" id="divdash" style="display:block;height:100vh;position:relative;z-index:5;">

                <div style=" background-image: linear-gradient(to right,#b17179 ,#4a304d);height:60%;width:100%;position:relative;z-index:6;"></div>

                <div class="row" style="position:absolute; top: 10px;left: 30px;z-index:7">
                    <div class="col-lg-12 col-6">
                        <div style="width: 280px;height:30px;margin-top:10px;color:whitesmoke;display:inline-block">ACADEMIC OFFICER DASHBOARD |
                        </div>
                        <div onclick="location.href='logout.php';" style="cursor:pointer;color:black;display:inline-block">LOGOUT |</div>
                    </div>
                </div>
                <!-- register & assigment -->

                <div class="row">
                    <!-- when click the div, it will directed to register student page -->
                    <div onclick="window.location='registerStudent.php'" ; class="col-lg-5 col-11 bg-dark button" style="font-size:20px;color:whitesmoke;border-radius:10px;height: 10%; width:40%;position:absolute; top: 25%;left: 5%;z-index:7">

                        <span class="mt-1">Register new student</span>

                    </div>
                    <!-- when click the div,it will derected to marks sent by tacher page -->
                    <div onclick="window.location='viewMarks.php'" ; class="col-lg-5 col-10 bg-dark button" style="border-radius:10px;height: 10%; width:40%;position:absolute; top: 25%;left: 50%;z-index:7">
                        <span class="mt-1" style="font-size:20px;color:whitesmoke">Assigment marks</span>
                    </div>
                </div>
                <!-- register & assigment -->

                <!-- notice teachers -->
                <div class="row mt-2 mb-3">
                    <div class="col-lg-5 col-10 " style="background-color:#dcdada;border-radius:10px;height: 50%; width:40%;position:absolute; top: 50%;left: 5%;z-index:8">
                        <div style="font-size: 20px;width:106%;background-color:white;border-top-right-radius:10px;border-top-left-radius:10px;margin-left:-12px">
                            <span style="margin-left: 20px;">Notice for teachers</span>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-1 mb-1">
                                <label for="exampleFormControlTextarea1" class="form-label mt-3">Add Notice</label>
                                <textarea class="form-control" id="noticeTeacher" rows="3"></textarea>
                            </div>
                            <div class="col-5 mt-4">
                                <!-- when click the button,it sends value 1 to  Notice() function and it will run  -->
                                <button onclick="Notice(1);" class="button" style="background-color:#b17179;border-radius:10px;z-index:8;width:100%;height:38px">
                                    <span style="color:white;font-size:17px;margin-top:-20px">Send</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- notice teachers -->

                <!-- notice students -->

                <div class="row mt-2 mb-3">
                    <div class="col-lg-5 col-10 " style="background-color:#dcdada;border-radius:10px;height: 50%; width:40%;position:absolute; top: 50%;left: 50%;z-index:8">
                        <div style="font-size: 20px;width:106%;background-color:white;border-top-right-radius:10px;border-top-left-radius:10px;margin-left:-12px">
                            <span style="margin-left: 20px;">Notice for students</span>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-1 mb-1">
                                <label for="exampleFormControlTextarea1" class="form-label mt-3">Add Notice</label>
                                <textarea class="form-control" id="noticeStudent" rows="3"></textarea>
                            </div>
                            <div class="col-12 col-lg-6 mt-2 mb-1">
                                <label class="form-label" style="color: gray;">Select Grade</label>
                                <select id="grade" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <?php
                                    // take the grades from database
                                    $gr = Database::search("SELECT * FROM `grade`");
                                    $gn = $gr->num_rows;
                                    for ($r = 0; $r < $gn; $r++) {
                                        $grr = $gr->fetch_assoc();
                                    ?>
                                        <option><?php echo $grr["id"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-5 mt-4">
                                <!-- when click the button,it sends value 2 to  Notice() function and it will run  -->
                                <button onclick="Notice(2);" class="button" style="background-color:#b17179;border-radius:10px;z-index:8;width:100%;height:40px">
                                    <span style="color:white;font-size:17px;margin-top:-20px">Send</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- notice students -->
            </div>

            <!-- dashboard end -->
            <!-- profile -->
            <div class="col-12 col-lg-10" id="divprofile" style="height:auto;display:none;background-color:#f8f8ff;position:relative">
                <div style="position:relative;z-index:5;">
                    <img src="images/acProfile.jpg" style="height:600px;filter: brightness(50%);width:100%" alt="" />

                    <div style="z-index: 6;width:100%;position:absolute; top: 10px;left: 30px;color:whitesmoke">
                        <span style="display: block;font-size:18px;">User profile</span>
                        <span style="font-size: 30px;display: block;margin-top:150px;font-weight:bold;">Hello <?php echo $s["fname"] ?></span>
                        <span style="font-size: 18px;display: block;margin-top:30px">This is your profile page.<br>
                            You can change your details any time.</span>

                        <button class="mt-5 btn btn-info" style="border-radius: 6px;height:45px;color:whitesmoke;font-size:17px" onclick="update();">edit profile</button>

                        <div class="mt-5 mb-3" style="width:75%;background-color: #f5f5f5;height:auto;border-radius:10px;margin: 0 auto;color:black">

                            <div style="width: 100%;background-color:whitesmoke;height:auto;
                        border-top-left-radius: 10px;border-top-right-radius:10px ;color:black;font-size:15px">
                                <span class="mt-1 mb-1 ms-1">USER INFORMATION </span>
                            </div>

                            <div class="row mt-4">

                                <div class="col-md-4 col-lg-12 col-12 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php
                                        if ($pn == 1) { // if academic officr has an profile picture
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="170px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev1" />
                                        <?php
                                        } else { //academic officer doesn't uploaded a profile picture yet
                                        ?>
                                            <img class="rounded-circle mt-5" width="160px" height="160px" src="images/download.png" img-thumbnail id="prev1" />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" id="imguploader" accept="image/*" class="d-none" />
                                        <label for="imguploader" class="btn btn-danger mt-4" onclick="clickimg();">Update Profile Image</label>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">First name</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["fname"]; ?>" id="fn" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Last name</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["lname"]; ?>" id="ln" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">User name</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["uname"]; ?>" readonly id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Current password</label>
                                            <input type="email" class="form-control" readonly placeholder="<?php echo $s["password"]; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                                            <input type="email" class="form-control" placeholder="<?php echo $s["mobile"]; ?>" id="m" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">
                                            <label class="form-label" style="color: gray;">Email address</label>
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

        </div><!-- main div -->

        <script src="acOfficer.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </body>

    </html>
<?php
} else {

?>
    <script>
        window.location = "academic_officer_login.php";
    </script>
<?Php
}
?>