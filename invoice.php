<?php

session_start();
require "connection.php";

// payment id is pid
$pid = $_GET["id"];

?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.jpg" /> <!--logo-->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <title>Invoice</title>

</head>

<body class="mt-1" style="background-color: 3f7f7ff;">

    <div class="container-fluid">
        <div class="row" style="background-color: #F2F3F1	;">

            <!--header design-->
            <div class="col-12">
                <div class="row mt-2 mb-1">
                    <div class="offset-lg-0 col-6 col-lg-6 align-self-start">
                        <text class="topic">School managment system</text>
                        <label style="margin-left: 5px;margin-right:5px;">|</label>
                        <span class="text-start label1"><b>Payment Invoice</b></span>

                        <label style="margin-left: 5px;">|</label>

                    </div>
                    <div class="col-6 col-lg-6 text-end" style="cursor:pointer;" onclick='window.location="studentHomePage.php"'>

                        | Back to home page |
                    </div>
                </div>
            </div>
            <!--header design over-->
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">

            <div class="col-12 btn-toolbar justify-content-end">
                <button class="btn btn-dark me-2 shadow-none" onclick="printDiv();"><i class="bi bi-printer-fill"></i> Print</button>
                <button class="btn btn-danger me-2 shadow-none"><i class="bi bi-file-earmark-pdf-fill"></i> Save as
                    PDF</button>
            </div>

            <div class="col-12">
                <hr>
            </div>
            <?php
            $p = Database::search("SELECT * FROM `invoice` WHERE `payment_id`= '" . $pid . "'");
            $pn = $p->fetch_assoc();

            $s = Database::search("SELECT * FROM `student` WHERE `id`= '" . $pn["student_id"] . "'");
            $sr = $s->fetch_assoc();
            ?>
            <div id="GFG">
                <div class="col-12">
                    <div class="row">
                        <div class="col-8 col-md-5 offset-md-7 offset-4 text-end">
                            <h4 class=" text-decoration-underline" style="color: #769CC9;">School Managment system</h4>
                            <h5>payment for grade <?php echo $sr["grade_id"] ?></h5><br>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-5 mt-1">
                            <h6>INVOICE TO:</h6>

                            <h6>Name &nbsp;&nbsp;: <?php echo $sr["fname"] . " " . $sr["lname"]; ?></h6>
                            <h6>Index &nbsp;&nbsp;&nbsp;:&nbsp; <?php echo $sr["id"] ?></h6>
                            <h6>Grade &nbsp;&nbsp;: <?php echo $sr["grade_id"] ?></h6>
                            <h6>Email &nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $sr["email"]; ?></h6>
                        </div>

                        <div class="col-12 col-md-3 col-lg-3 offset-md-4  offset-lg-4 offset-0 text-start mt-1">
                            <h5 style="color: #769CC9;">INVOICE NO :&nbsp;<?php echo $pn["id"]; ?></h5>
                            <h5 style="color: #769CC9;">PAYMENT ID :&nbsp;<?php echo $pid; ?></h5>
                            <h6>&nbsp;Date and Time of Payment :&nbsp; <?php echo $pn["date"]; ?></h6>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 mb-3 text-center">
                    <label class="form-label fs-6 text-black-50">
                        Invoice was careted on a computer and is valid without Signatre and Seal
                    </label>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="student.js"></script>
</body>

</html>