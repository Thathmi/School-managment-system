<?php
session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

    $s = $_SESSION["a"];
    $id = $s["id"];

    $up = Database::search("SELECT * FROM `admin_profile` WHERE `a_id`= '" . $id . "'");
    $pn = $up->num_rows;

?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>main page</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="mainPage.css" />
        <link rel="stylesheet" href="button.css" />
        <link rel="stylesheet/scss" type="text/css" href="button.scss" />
        <link rel="stylesheet" href="icofont.css" />
        <link rel="stylesheet" href="icofont.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

        <style>
            @import 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300';

            html,
            body {
                width: 100%;
                height: 100%;
                overflow: hidden;
                margin: 0;
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
                font-family: 'Open Sans Condensed', sans-serif;
            }

            div[class*=box] {
                height: 33.33%;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .box-1 {
                background-color: #FF6766;
            }

            .box-2 {
                background-color: #3C3C3C;
            }

            .box-3 {
                background-color: #66A182;
            }

            .btn {
                line-height: 50px;
                height: 50px;
                text-align: center;
                width: 250px;
                cursor: pointer;
            }

            .btn-one {
                color: #FFF;
                transition: all 0.3s;
                position: relative;
            }

            .btn-one span {
                transition: all 0.3s;
            }

            .btn-one::before {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                opacity: 0;
                transition: all 0.3s;
                border-top-width: 1px;
                border-bottom-width: 1px;
                border-top-style: solid;
                border-bottom-style: solid;
                border-top-color: rgba(255, 255, 255, 0.5);
                border-bottom-color: rgba(255, 255, 255, 0.5);
                transform: scale(0.1, 1);
            }

            .btn-one:hover span {
                letter-spacing: 2px;
            }

            .btn-one:hover::before {
                opacity: 1;
                transform: scale(1, 1);
            }

            .btn-one::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                transition: all 0.3s;
                background-color: rgba(255, 255, 255, 0.1);
            }

            .btn-one:hover::after {
                opacity: 0;
                transform: scale(0.1, 1);
            }
        </style>

    </head>

    <body style="overflow-x:hidden;background-color:#f8f8ff">

        <div class="row mt-5" style="height:auto;display:flex;align-items:center;justify-content:center">
            <!-- 1 -->
            <div class="col-lg-3 col-11">
                <div class="card">
                    <h5 class="card-header">Time Table</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <div class="box-1" style="height: 70px;background:#8fbc8f">
                            <div class="btn btn-one">
                                <span>Tasks</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="col-lg-3 col-11">
                <div class="card">
                    <h5 class="card-header">Academic officer task</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                        <div class="box-1" style="height: 70px;background:#f08080">
                            <div class="btn btn-one">
                                <span>Time Table</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- 3 -->
            <div class="col-lg-3 col-11">
                <div class="card">
                    <h5 class="card-header">Assign subjects for teachers</h5>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <div class="box-1" style="height: 70px;background:#9bc4e2">
                            <div class="btn btn-one">
                                <span>Teachers & subjects</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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