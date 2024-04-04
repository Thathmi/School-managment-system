<?php
session_start();
require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { //check admin is logged in
?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Add teacher page</title>
        <link rel="stylesheet" href="header.css" />
        <link rel="icon" href="images/logo.jpg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="bootstrap.min.css" />
        <link rel="stylesheet" href="mainPage.css" />
        <link rel="stylesheet" href="button.css" />
        <link rel="stylesheet" href="newButton.css" />
        <link rel="stylesheet/scss" type="text/css" href="button.scss" />
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

        </style>

    </head>

    <body style="overflow-x:hidden;background-color:#f8f8ff;">

        <!-- bootstrap alert will show in this div -->
        <div id="wish"></div>

        <!-- nav -->
        <header>
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3" style="justify-content: center;align-items:center;display: flex;font-size: 27px;">

                    <div class="headerFont1" style="display:inline-block;color:#77b5fe;font-size:18px">School</div>
                    <div class="headerFont2" style="display:inline-block;color:rgb(245, 249, 255);font-size:18px;font-family:'n'">Managment</div>
                    <div class="headerFont1" style="display:inline-block;color:#87cefa;font-size:18px">System</div>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div style="justify-content: center;align-items:center;display: flex;font-weight:bold;cursor: pointer;">
                        <div onclick='window.location="adminHomePage.php"' ; style="display:inline-block;margin-left:20px ;"><i class="bi bi-arrow-left"></i>ADMIN DASHBOARD
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- nav -->

        <!-- main div -->
        <div class="col-12">
            <div class="row" style="justify-content: center;display:flex;align-items:center;margin-top:50px">

                <div class="col-11 mt-5" style="background-color:#e5e4e2;border-radius:10px;height:510px">
                    <label for="exampleFormControlInput1" class="form-label mt-2" style="text-decoration:underline;font-size:larger">update or add new teachers to subjects</label>

                    <div class="row mt-4">

                        <div class="col-lg-3 col-12">
                            <label for="exampleFormControlInput1" class="form-label">Grade</label>
                            <select class="form-select" aria-label="Default select example" id="grade">
                                <?php
                                // take all the grades
                                $g = Database::search("SELECT * FROM `grade`");
                                $gn = $g->num_rows; //no. of rows
                                for ($i = 0; $i < $gn; $i++) { // fro loop will run fro no.of rows times
                                    $gr = $g->fetch_assoc(); // take the 1st row from resultset
                                ?>
                                    <!-- display value taken from db in option -->
                                    <option><?php echo $gr["id"] ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-lg-3 col-12">
                            <label for="exampleFormControlInput1" class="form-label">Subject</label>
                            <select class="form-select" aria-label="Default select example" id="sub">
                                <?php
                                // take all the subjects
                                $g1 = Database::search("SELECT * FROM `subject`");
                                $gn1 = $g1->num_rows; //no. of rows
                                for ($i1 = 0; $i1 < $gn1; $i1++) { // fro loop will run fro no.of rows times
                                    $gr1 = $g1->fetch_assoc(); // take the 1st row from resultset
                                ?>
                                    <!-- display value taken from db in option -->
                                    <option><?php echo $gr1["name"] ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-lg-4 col-12">
                            <label for="exampleFormControlInput1" class="form-label">Teacher</label>
                            <div class="input-group">
                                <select class="form-select" id="tid" aria-label="Example select with button addon">
                                    <?php
                                    // take all the teachers who are activate
                                    $g2 = Database::search("SELECT * FROM `teacher` WHERE `activation_id`='1'");
                                    $gn2 = $g2->num_rows; //no. of rows
                                    for ($i2 = 0; $i2 < $gn2; $i2++) { // fro loop will run fro no.of rows times
                                        $gr2 = $g2->fetch_assoc(); // take the 1st row from resultset
                                    ?>
                                        <!-- display value taken from db in option -->
                                        <option><?php echo $gr2["id"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- call the teacher details offcanvas -->
                                <button onclick='document.getElementById("offcanvasBottom").style.display = "block";' data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" class="btn btn-outline-secondary" style="width:40%;height:38px" type="button">teacher details</button>
                            </div>
                        </div>
                        <div class="col-lg-1 col-6"><button onclick="addteacherSub()" type="button" class="btn btn-success" style="width:110%;height: 38px;margin-top:30px">Save</button></div>
                    </div>

                    <hr style="width: 95%;margin-left:auto;margin-right:auto;margin-top:30px;">
                    <label for="exampleFormControlInput1" class="form-label mt-1" style="text-decoration:underline;font-size:larger">Search teachers</label>

                    <div class="row mt-3" style="justify-content: center;display:flex;align-items:center">
                        <div class="col-7">
                            <div class="input-group ">
                                <select id="search" class="form-select form-select-sm" id="tid" aria-label="Example select with button addon">
                                    <?php
                                    // take all the grades
                                    $g = Database::search("SELECT * FROM `grade`");
                                    $gn = $g->num_rows;
                                    for ($i = 0; $i < $gn; $i++) {
                                        $gr = $g->fetch_assoc();
                                    ?>
                                        <!-- display value taken from db in option -->
                                        <option><?php echo $gr["id"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- when click button, search() function will run -->
                                <button onclick="Search();" class="btn btn-outline-primary" style="width:20%;height:38px" type="button"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1" style="justify-content: center;display:flex;align-items:center;">
                        <div class="col-12 col-lg-10" id="table" style="overflow-y: scroll;height:200px">

                        </div>
                    </div>
                </div>

                <!-- offcancas 1-->
                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="height: 80%;overflow-y:scroll;display:none;background:#f8f8ff">
                    <div class="offcanvas-header">
                        <h3 class="offcanvas-title" id="offcanvasBottomLabel">
                            Teacher Information
                        </h3>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                        </button>
                    </div>
                    <div class="offcanvas-body small">

                        <!-- componenets -->
                        <div class="row mt-5" style="height:auto;display:flex;align-items:center;justify-content:center">
                            <div class="col-11 col-lg-8" style="height: 250px;">
                                <!-- table -->
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Teacher No.</th>
                                            <th scope="col">Name</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // take all the teachers who are activate
                                        $g22 = Database::search("SELECT * FROM `teacher` WHERE `activation_id`='1'");
                                        $gn22 = $g22->num_rows;
                                        for ($i22 = 0; $i22 < $gn22; $i22++) {
                                            $gr22 = $g22->fetch_assoc();
                                        ?>
                                            <tr>
                                                <!-- display value taken from db in option -->
                                                <td><?php echo $gr22["id"] ?></td>
                                                <td><?php echo $gr22["fname"] . " " . $gr22["lname"] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- table -->
                            </div>
                        </div>

                        <!-- componenets -->
                    </div>
                </div>

                <!-- offcanvas 1-->
            </div>
        </div>
        <!-- main div -->

        <script src="header.js"></script>
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