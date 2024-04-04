<?php
session_start();

require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { // checking if there is admin data in the session

    $s = $_SESSION["a"]; //asigning data insession to a variable
    $id = $s["id"];

    //search from admin_profile table with the id in session in database
    $up = Database::search("SELECT * FROM `admin_profile` WHERE `a_id`= '" . $id . "'");
    $pn = $up->num_rows; //take the no. of rows or resultset

?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Admin Home page</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="icon" href="images/logo.jpg" />
        <!--logo-->
        <link rel="stylesheet" href="mainPage.css" />
        <link rel="stylesheet" href="button.css" />
        <link rel="stylesheet" href="newButton.css" />
        <link rel="stylesheet" href="icofont.css" />
        <link rel="stylesheet" href="icofont.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <style>
            .t1 :hover {
                background-color: silver;
            }
        </style>

    </head>

    <body style="overflow-x:hidden;background-color:#f8f8ff;">

        <div id="wish"></div>
        <!-- main div -->
        <div class="row">
            <!-- vertical nav -->
            <div class="col-12 col-lg-2" style="background-color: #ECEFEC;height:auto;display:inline-block;">

                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <?php
                        if ($pn == 1) {
                            $spic = $up->fetch_assoc();
                        ?>
                            <img class="rounded-circle mt-4" width="100px" height="100px" src="<?php echo $spic["code"]; ?>" img-thumbnail id="prev" />

                        <?php
                        } else {
                        ?>
                            <img class="rounded-circle mt-4" width="100px" height="100px" src="images/download.png" img-thumbnail id="prev" />

                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-12 ms-2 mt-5" style="text-align: center;">
                        <span><?php echo $s["f_name"] . " " . $s["l_name"]; ?></span><br>

                    </div>
                    <div class="col-12 mt-3">
                        <hr style="width: 90%;margin-left:auto;margin-right:auto">
                    </div>
                </div>
                <ul class="nav flex-column">


                    <li class="nav-item mt-4">
                        <a onclick="toggleDiv('ddiv');" class="nav-link active mt-2" style="color:grey;" aria-current="page" href="#"><i class="bi bi-tv" style="color: purple;margin-right:8px"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="toggleDiv('pdiv');" class="nav-link" style="color:grey;" href="#"><i class="bi bi-person-fill" style="color: red;margin-right:7px"></i> User Profile</a>

                </ul>

            </div>
            <!-- vertical nav -->

            <!-- dashboard -->
            <div class="col-12 col-lg-10" id="divdash" style=" display:inline-block;background-image: linear-gradient(to right, #87cefa , #21abcd);display:block;height:auto">

                <div class="row">
                    <div class="col-lg-5 col-6">
                        <div style="font-weight:bold;width: auto;height:30px;margin-top:10px;color:whitesmoke">ADMIN DASHBOARD</div>
                    </div>
                    <div class="col-lg-5 col-6 ">
                        <div onclick="location.href='logout.php';" style="text-align:end;cursor:pointer;font-weight:bold;width: auto;height:30px;margin-top:10px;color:whitesmoke">LOGOUT</div>
                    </div>
                </div>

                <div class="row">

                    <div class="row mt-5 mb-3 ms-1">
                        <div class="col-12 ">
                            <div style="height: auto;background-color:whitesmoke;border-radius:7px;">
                                <div class="row" style="z-index:5; ">
                                    <div class="col-lg-3 col-12 mb-5" style="margin-top:-40px;">
                                        <!-- bu -->
                                        <section id="intro" onclick="location.href='manageStudents.php';">

                                            <div id="intro-content" class="center-content">

                                                <div class="center-content-inner">

                                                    <div class="content-section content-section-margin">

                                                        <div class="content-section-grid clearfix">

                                                            <a href="#" class="button nav-link">

                                                                <div class="bottom"></div>

                                                                <div class="top">

                                                                    <div class="label" style="font-size: 19px;">Manage Students</div>

                                                                    <div class="button-border button-border-left"></div>
                                                                    <div class="button-border button-border-top"></div>
                                                                    <div class="button-border button-border-right"></div>
                                                                    <div class="button-border button-border-bottom"></div>

                                                                </div>

                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </section>
                                        <!-- bu -->
                                    </div>
                                    <div class="col-lg-3 col-12" style="margin-top:-40px">
                                        <!-- bu -->
                                        <section id="intro" onclick="location.href='manageTeacher.php';">

                                            <div id="intro-content" class="center-content">

                                                <div class="center-content-inner">

                                                    <div class="content-section content-section-margin">

                                                        <div class="content-section-grid clearfix">

                                                            <a href="#" class="button nav-link">

                                                                <div class="bottom"></div>

                                                                <div class="top">

                                                                    <div class="label" style="font-size: 19px;">Manage Teachers</div>

                                                                    <div class="button-border button-border-left"></div>
                                                                    <div class="button-border button-border-top"></div>
                                                                    <div class="button-border button-border-right"></div>
                                                                    <div class="button-border button-border-bottom"></div>

                                                                </div>

                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </section>
                                        <!-- bu -->
                                    </div>
                                    <div class="col-lg-3 col-12" style="margin-top:-40px">
                                        <!-- bu -->
                                        <section id="intro" onclick="location.href='manageAcOf.php';">

                                            <div id="intro-content" class="center-content">

                                                <div class="center-content-inner">

                                                    <div class="content-section content-section-margin">

                                                        <div class="content-section-grid clearfix">

                                                            <a href="#" class="button nav-link">

                                                                <div class="bottom"></div>

                                                                <div class="top">

                                                                    <div class="label" style="font-size: 16px;">Manage Academic Officers</div>

                                                                    <div class="button-border button-border-left"></div>
                                                                    <div class="button-border button-border-top"></div>
                                                                    <div class="button-border button-border-right"></div>
                                                                    <div class="button-border button-border-bottom"></div>

                                                                </div>

                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </section>
                                        <!-- bu -->
                                    </div>
                                    <div class="col-lg-3 col-12 mb-4" style="margin-top:-40px">
                                        <!-- bu -->
                                        <section id="intro" onclick='document.getElementById("offcanvasBottom").style.display = "block";' data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">

                                            <div id="intro-content" class="center-content">

                                                <div class="center-content-inner">

                                                    <div class="content-section content-section-margin">

                                                        <div class="content-section-grid clearfix">

                                                            <a href="#" class="button nav-link">

                                                                <div class="bottom"></div>

                                                                <div class="top">

                                                                    <div class="label" style="font-size: 16px;margin-left:-27px">Manage Administration</div>

                                                                    <div class="button-border button-border-left"></div>
                                                                    <div class="button-border button-border-top"></div>
                                                                    <div class="button-border button-border-right"></div>
                                                                    <div class="button-border button-border-bottom"></div>

                                                                </div>

                                                            </a>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </section>
                                        <!-- bu -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 ms-1">
                        <div class="col-12">
                            <div style="height: auto;background-color:whitesmoke;border-radius:7px;">
                                <div class="row" style="z-index:5 ">
                                    <div class="col-12 col-lg-7 ms-3" style="margin-bottom: 20px;margin-top:20px">
                                        <select class="form-select" aria-label="Default select example" id="grade">
                                            <?php
                                            $g1 = Database::search("SELECT * FROM `grade`");
                                            $gn = $g1->num_rows;
                                            for ($i = 0; $i < $gn; $i++) {
                                                $gr = $g1->fetch_assoc();
                                            ?>
                                                <option><?php echo $gr["id"] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button onclick="viewMarks();" type="button" class="btn btn-outline-secondary col-lg-3 ms-5 " style="margin-bottom: 20px;margin-top:20px">Check student results</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- registration email -->
                    <div class="row mb-3 me-2 ms-2">
                        <div class="col-12">
                            <div style="height: auto;background-color:whitesmoke;border-radius:7px;">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Send registration invitations to teachers
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <label class="form-label" style="color: gray;">Email of the teacher : </label>
                                                <div class="row">
                                                    <div class="col-lg-9 col-12">
                                                        <input type="email" class="form-control" id="e" aria-describedby="emailHelp">

                                                    </div>
                                                    <div class="col-lg-3 col-6">
                                                        <button onclick="sendemail();" style="height:35px;width:100% " type="button" class="btn btn-info d-grid">Send email</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Send registration invitations to Academic officers
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <label class="form-label" style="color: gray;">Email of the Academic officer : </label>
                                                <div class="row">
                                                    <div class="col-lg-9 col-12">
                                                        <input type="email" class="form-control" id="eo" aria-describedby="emailHelp">

                                                    </div>
                                                    <div class="col-lg-3 col-6">
                                                        <button onclick="sendemailo();" style="height:35px;width:100% " type="button" class="btn btn-info d-grid">Send email</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- registration email -->

                    <!-- ofcancas 1-->
                    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="height: 80%;overflow-y:scroll;display:none;background:#f8f8ff">
                        <div class="offcanvas-header">
                            <h3 class="offcanvas-title" id="offcanvasBottomLabel">
                                Manage Administration
                            </h3>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                            </button>
                        </div>
                        <div class="offcanvas-body small">

                            <!-- componenets -->
                            <div class="row mt-5" style="height:auto;display:flex;align-items:center;justify-content:center">
                                <!-- 1 -->
                                <div class="col-lg-3 col-11">
                                    <div class="card" style="height: 250px;">
                                        <h5 class="card-header">Time Table</h5>
                                        <div class="card-body">
                                            <p class="card-text">Update or add Time Tables</p>
                                            <div class="box-1" style="height: 70px;background:#8fbc8f;margin-top:35%">
                                                <div class="btn btn-one">
                                                    <span>Time Table</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="col-lg-3 col-11">
                                    <div class="card" style="height: 250px;">
                                        <h5 class="card-header">Academic officer task</h5>
                                        <div class="card-body">
                                            <p class="card-text">Add or edit the tasks assign to academic officers</p>

                                            <div onclick='document.getElementById("offcanvasBottom").style.display = "none";
                                                    document.getElementById("secondoffcanvas").style.display = "block";' data-bs-toggle="offcanvas" data-bs-target="#secondoffcanvas" aria-controls="offcanvasBottom" class="box-1" style="height: 70px;background:#f08080;margin-top:28%">
                                                <div class="btn btn-one">
                                                    <span>Task</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="col-lg-3 col-11">
                                    <div class="card" style="height: 250px;">
                                        <h5 class="card-header"> Subjects & Teachers</h5>
                                        <div class="card-body">
                                            <p class="card-text">Assign subjects for teachers</p>
                                            <div class="box-1" onclick='window.location="addTeacherSubject.php"' style="height: 70px;background:#9bc4e2;margin-top:36%">
                                                <div class="btn btn-one">
                                                    <span onclick='window.location="addTeacherSubject.php"'>Teachers & subjects</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- componenets -->
                        </div>
                    </div>
                    <!-- offcanvas 1-->

                    <!-- off 2 -->
                    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="secondoffcanvas" aria-labelledby="offcanvasBottomLabel" style="height: 88%;overflow-y:scroll;display:none">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Add or Edit task for academic officers</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small" style="background-color: #f4f0ec;">

                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Add new Task </label>
                                        <input type="text" class="form-control form-control-sm" id="task" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <label for="exampleFormControlInput1" class="form-label">Select Officer</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="ao">
                                        <?php
                                        // selecting officers which doesn't have tasks
                                        $ao1 = Database::search("SELECT * FROM `ac_officer` LEFT JOIN `ac_has_task` ON  `ac_officer`.`id`=`ac_has_task`.`ac_id`   WHERE `ac_has_task`.`ac_id` IS NULL ");
                                        $no1 = $ao1->num_rows; // taking no. of rows
                                        for ($ii = 0; $ii < $no1; $ii++) { //for loop will run for no. of rows times
                                            $r1 = $ao1->fetch_assoc(); //taking a row from resultset
                                        ?>
                                            <!-- display name in option. -->
                                            <option><?php echo $r1["fname"] . " " . $r1["lname"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 col-lg-1">
                                    <!-- when click the add button, addTask() function will run on admin.js  -->
                                    <button onclick="addTask();" type="button" class="btn btn-info btn-sm" style="height: 30px;margin-top:30px">Add</button>
                                </div>
                                <label for="exampleFormControlInput1" class="form-label mt-5">View existing tasks</label>

                                <div id="taskTable">
                                    <div class="col-12 col-lg-12 mt-3 t1" style="height: 200px;">

                                        <div class="row" style="border-bottom:solid;border-color:black">
                                            <div class="col-1 fw-bold">#</div>
                                            <div class="col-3 fw-bold">Task</div>
                                            <div class="col-1 fw-bold">Officer Id</div>
                                            <div class="col-2 fw-bold">Officer Name</div>
                                            <div class="col-3 fw-bold">Add new officer</div>
                                            <div class="col-1 fw-bold"></div>
                                        </div>

                                        <!-- db connection to take tasks and their officers -->
                                        <?php
                                        $t = Database::search("SELECT * FROM `ac_has_task`");
                                        $n = $t->num_rows;

                                        for ($i = 0; $i < $n; $i++) {
                                            $r = $t->fetch_assoc();

                                            $at = Database::search("SELECT * FROM `ac_task` WHERE `id`='" . $r["task_id"] . "'");
                                            $ant = $at->fetch_assoc();

                                            $a = Database::search("SELECT * FROM `ac_officer` WHERE `id`='" . $r["ac_id"] . "'");
                                            $an = $a->fetch_assoc();
                                        ?>
                                            <div class="row mt-2 mb-1">
                                                <div class="col-1"><?php echo $i + 1; ?></div>
                                                <div class="col-3" id="taskrename"><?php echo $ant["task"] ?></div>
                                                <div class="col-1"><?php echo $an["id"]; ?></div>
                                                <div class="col-2"><?php echo $an["fname"] . " " . $an["lname"]; ?></div>
                                                <div class="col-3">
                                                    <select id="of" class="form-select form-select-sm" aria-label=".form-select-sm example" style="display:inline-block;width: 250px;">

                                                        <?php
                                                        // selecting officers which doesn't have tasks
                                                        $ao = Database::search("SELECT * FROM `ac_officer` LEFT JOIN `ac_has_task` ON  `ac_officer`.`id`=`ac_has_task`.`ac_id`   WHERE `ac_has_task`.`ac_id` IS NULL ");

                                                        $no = $ao->num_rows;
                                                        for ($q = 0; $q < $no; $q++) {
                                                            $or = $ao->fetch_assoc();
                                                        ?>

                                                            <option><?php echo $or["fname"] . "  " . $or["lname"] ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <!-- when click the button add, taskId() function will run on js. in here we pass the value of task id to js file through function -->
                                                    <button onclick="taskId(<?php echo $ant['id'] ?>);" class="btn btn-danger" style="display:inline-block;height:30px;width:70px;margin-left:30px">Add</button>

                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- off 2 -->

                </div>
            </div>
            <!-- dashboard end -->


            <!-- profile -->
            <div class="col-12 col-lg-10" id="divprofile" style="height:auto;display:none;background-color:#f8f8ff;position:relative">

                <div style="position:relative;z-index:5;">
                    <img src="images/adminprofile.jpeg" style="height:600px;filter: brightness(50%);width:100%" alt="" />

                    <div style="z-index: 6;width:100%;position:absolute; top: 10px;left: 30px;color:whitesmoke">
                        <span style="display: block;font-size:18px;">Admin profile</span>
                        <span style="font-size: 30px;display: block;margin-top:150px;font-weight:bold;">Hello <?php echo $s["f_name"]; ?></span>
                        <span style="font-size: 18px;display: block;margin-top:30px">This is your profile page.<br>
                            You can change your details any time.</span>

                        <button class="mt-5 btn btn-info" style="border-radius: 6px;height:45px;color:whitesmoke;font-size:17px" onclick="update();">edit profile</button>

                        <div class="mt-5 mb-3" style="width:75%;background-color: #f5f5f5;height:auto;border-radius:10px;margin: 0 auto;color:black">

                            <div style="width: 100%;background-color:whitesmoke;height:auto;
                                 border-top-left-radius: 10px;border-top-right-radius:10px ;color:black;font-size:15px">
                                <span class="mt-1 mb-1 ms-1">ADMIN INFORMATION </span>
                            </div>

                            <div class="row mt-4">

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
                                    <label for="imguploader" class="btn btn-danger mt-4" onclick="clickimg();">Update Profile Image</label>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">First name</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["f_name"]; ?>" id="fn" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2 mt-1">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Last name</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["l_name"]; ?>" id="ln" aria-describedby="emailHelp">

                                        </div>
                                    </div>
                                </div>



                                <div class="col-12 col-lg-6 mb-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-11" style="margin: 0 auto">

                                            <label class="form-label" style="color: gray;">Current password</label>
                                            <input type="email" class="form-control" placeholder="<?php echo $s["password"]; ?>" readonly id="exampleInputEmail1" aria-describedby="emailHelp">

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
                                            <input type="email" class="form-control" placeholder="<?php echo $s["email"]; ?>" id="e" aria-describedby="emailHelp">

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
        <!-- main div -->

        <script src="admin.js"></script>
        <script src="verifyemail.js"></script>
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
        window.location = "admin_login.php";
    </script>
<?Php
}
?>