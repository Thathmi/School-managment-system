<?php

require("connection.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>main page</title>
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

<body style="overflow-x:hidden;background-color:#f8f8ff;">

    <div id="wish"></div>
    <div class="row">

        <div class="col-12" style="background-image: linear-gradient(to right,#b17179 ,#4a304d);height:40px">
            <div class="row">
                <div onclick="window.location='acOfficerHomePage.php'" ; class="col-1"><i style="font-size: 25px;margin-left:10px" class="bi bi-arrow-left-circle "></i></div>

                <div class="col-11" style="text-align: center;">
                    <span class="mt-1" style="font-size: 22px;color:whitesmoke">Student Reistration</span>
                </div>
            </div>
        </div>

        <div class="col-12" style="background-color: #f8f8ff;">
            <div class="mb-3" style="width:65%;height:auto;background-color:#e5e4e2;margin-left:15%;margin-top:20px;border-radius:6px">

                <div class="row">
                    <div class="col-lg-5 col-12" style="margin-left: 5%;margin-top:10px">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">First Name</label>
                            <input id="f" type="text" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="col-lg-5 col-12" style="margin-top:10px;margin-left:3%">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                            <input id="l" type="text" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>

                    <div class="col-lg-5 col-12" style="margin-left: 5%;margin-top:10px">
                        <label for="exampleFormControlInput1" class="form-label">Gender</label>
                        <div class="form-check1" style="font-size: 15px;margin-left: 7%">


                            <div class="form-check" style="font-size: 15px;margin-left: 7%;">
                                <input class="form-check-input" id="gm" type="radio" name="flexRadioDefault" value="">
                                <label class="form-check-label" for="gm">
                                    Male
                                </label>
                            </div>

                            <div class="form-check" style="font-size: 15px;margin-left: 7%;">
                                <input class="form-check-input" id="gf" type="radio" name="flexRadioDefault" value="">
                                <label class="form-check-label" for="gf">
                                    Female
                                </label>
                            </div>



                            </label>
                        </div>
                        <!-- <div class="form-check" style="font-size: 15px;margin-left: 7%;">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Male
                            </label>
                        </div> -->
                    </div>
                    <div class="col-lg-5 col-12" style="margin-top:10px;margin-left:3%">
                        <label for="exampleFormControlInput1" class="form-label">Grade</label>

                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="gr">
                            <?php
                            $s = Database::search("SELECT * FROM `grade`"); //database connection and search grades
                            $n = $s->num_rows; //take number of rows

                            for ($i == 0; $i < $n; $i++) {
                                $r = $s->fetch_assoc(); //takin rows one by one
                            ?>
                                <option value="<?php echo $r["id"]; ?>"><?php echo $r["grade"]; ?></option>
                                <!--print values-->
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <!-- AESTHATIC SUBJECTS -->
                    <div class="col-lg-12 col-12" style="margin-top:20px;margin-left:4%">
                        <label for="exampleFormControlInput2" class="form-label">Select aesthatic subject </label>

                        <div class="form-check" style="font-size: 15px;margin-left: 3%">


                            <div class="form-check" style="font-size: 15px;margin-left: 3%;display:inline-block">
                                <input class="form-check-input" id="dan" type="radio" name="flexRadioDefault1" value="">
                                <label class="form-check-label" for="dan">
                                    Dancing
                                </label>
                            </div>

                            <div class="form-check" style="font-size: 15px;margin-left: 3%;display:inline-block">
                                <input class="form-check-input" id="em" type="radio" name="flexRadioDefault1" value="">
                                <label class="form-check-label" for="em">
                                    Eastern Music
                                </label>
                            </div>

                            <div class="form-check" style="font-size: 15px;margin-left: 3%;display:inline-block">
                                <input class="form-check-input" id="wm" type="radio" name="flexRadioDefault1" value="">
                                <label class="form-check-label" for="wm">
                                    Western Music
                                </label>
                            </div>

                            <div class="form-check" style="font-size: 15px;margin-left: 3%;display:inline-block">
                                <input class="form-check-input" id="ar" type="radio" name="flexRadioDefault1" value="">
                                <label class="form-check-label" for="ar">
                                    Art
                                </label>
                            </div>

                            <div class="form-check" style="font-size: 15px;margin-left: 3%;display:inline-block">
                                <input class="form-check-input" id="dr" type="radio" name="flexRadioDefault1" value="">
                                <label class="form-check-label" for="dr">
                                    Drama
                                </label>
                            </div>



                            </label>
                        </div>
                    </div>


                    <hr style="width: 90%;margin-left:auto;margin-right:auto" class="mt-3">

                    <div class="col-lg-5 col-12" style="margin-left: 5%;margin-top:10px">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input id="e" type="email" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="col-lg-5 col-12" style="margin-top:10px;margin-left:3%">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mobile</label>
                            <input id="m" type="text" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>

                    <hr style="width: 90%;margin-left:auto;margin-right:auto" class="mt-3">

                    <div class="col-lg-5 col-12" style="margin-left: 5%;margin-top:10px">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Parent Name</label>
                            <input id="pn" type="text" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="col-lg-5 col-12" style="margin-top:10px;margin-left:3%">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Parent Mobile</label>
                            <input id="pm" type="text" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>
                    </div>


                </div>
                <div class="col-12 ms-4 mb-4">
                    <button onclick="register();" style="width:90%;border:none;border-radius:6px;background-color:#b17179">Register</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          
            <div class="spinner-border " id="spinner" style="color:palevioletred;width: 3.5rem; height: 3.5rem;margin-left:45%;margin-top:45%" role="status"></div>
              
            
        </div>
    </div>




    <script src="student.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="bootstrap.bundle.js"></script> -->
</body>

</html>