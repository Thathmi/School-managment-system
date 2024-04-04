<?php
session_start(); // start session
if (!isset($_SESSION["s"])) { // checking if there are details in session
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Student login page</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="images/logo.jpg" />
        <!--logo-->
        <link rel="stylesheet" href="header.css" />
        <link rel="stylesheet" href="mainPage.css" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

        <style>
            .button {
                border-radius: 2px;
                background-color: #d8bfd8;
                border: none;
                /* font-weight: bold; */
                color: black;
                text-align: center;
                font-size: 19px;
                padding: 8px;
                width: 130px;
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

    <body style="background-color: rgb(220,220,220);">

        <?php
        $es = ""; //global variable
        $ps = ""; //global variable

        if (isset($_COOKIE["es"])) { //check theres a cookie named "es"
            $es = $_COOKIE["es"]; //if it hase cookie named "es" then assign it to local variable $tt
        }

        if (isset($_COOKIE["ps"])) { //check theres a cookie named "ps"
            $ps = $_COOKIE["ps"]; //if it hase cookie named "ps" then assign it to local variable $ttp
        }
        ?>

        <header>
            <div class="row">
                <div class="col- col-md-3 col-lg-3" style="justify-content: center;align-items:center;display: flex;font-size: 27px;">
                    <div class="headerFont1" style="display:inline-block;color:#77b5fe;font-size:18px">School</div>
                    <div class="headerFont2" style="display:inline-block;color:rgb(245, 249, 255);font-size:18px;font-family:'n'">Managment</div>
                    <div class="headerFont1" style="display:inline-block;color:#87cefa;font-size:18px">System</div>
                </div>

                <div class="col-6 col-md-9 col-lg-8">
                    <div style="justify-content:end;align-items:end;display: flex;font-weight:bold;cursor: pointer;">
                        <div onclick='window.location="index.php"' ; style="display:inline-block;margin-left:20px ;font-size:16px"><i class="bi bi-arrow-left"></i> &nbsp; HOME
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <div id="wish"></div>
        <!--card-->
        <div class="card mb-3 " style="border-radius: 6px; max-width: 75%;margin-left:auto;margin-right:auto;margin-top:100px;">
            <div class="row g-0">
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title " style="font-weight:bold;font-size:22px">Student Login</h5>
                        <!--form-->
                        <div class="mb-3 " style="margin-top: 40px;">
                            <label for="exampleInputEmail1" class="form-label">Index Number</label>
                            <!-- if when its clicked remember me on login previously, then add the username taking from the cookie  -->
                            <input type="text" class="form-control" value="<?php echo $es; ?>" id="u1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <!-- if when its clicked remember me on login previously, then add the password taking from the cookie  -->
                            <input type="password" class="form-control" value="<?php echo $ps; ?>" id="p1">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="r1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="spinner-border " id="spinner" style="display:none;color: purple;width: 1.5rem; height: 1.5rem;margin-left:90px" role="status"></div>
                                    </div>
                                    <div class="col-9">
                                        <div style="text-align: end;cursor:pointer">
                                            <span onclick="forgotpassword();">Forgot password</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="button" style="margin-top: 20px;" onclick="login();"><span>Login </span></button>

                        <!--form-->

                    </div>
                </div>
                <div class="col-md-5">
                    <img src="images/login/student.jpg" class="img-fluid rounded-start" alt="...">
                </div>
            </div>
        </div>
        <!--card-->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:red;" id="exampleModalLabel">Account verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span style="font-size: 15px;"> please add the verification code sent
                            to your email to activate your account.</span>
                        <input type="email" class="form-control mt-2" id="vc" aria-describedby="emailHelp">
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" onclick="verify();">Verify</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal forgot password-->
        <div id="wish1"></div>
        <div class="modal fade" tabindex="-1" id="forgetpasswordModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="modal-title">Password Reset</h5>
                            </div>
                            <div class="col-12">
                                <h6 style="font-size: 13px;color:rgb(155, 0, 0)">The verification code was send to your email. Please check your email.</h6>
                            </div>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label">New Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="password" id="np">
                                    <button class="btn btn-outline-primary" type="button" id="npb" onclick="showPassword1();">Show</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Re-type Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp" />
                                    <button class="btn btn-outline-primary" id="rnpb" onclick="showPassword2();" type="button">Show</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Verification Code</label>
                                <input type="text" class="form-control" id="vc1" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal-->

        <!--skip payment Modal 4-->
        <div class="modal fade" id="skipPayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       </div>

        <!-- payment Modal 5 -->
        <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        </div>

        <script src="student.js"></script>
        <script src="header.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    </body>
    <!-- paypal link -->
    <script src="https://www.paypal.com/sdk/js?client-id=ATlMlZ4_iAbkbvsrSjQ_lwYEqMPvOtHTsEK7HZskbYQygubuKVn-Va4YUilXShGABOqjhPymBJkWIcHH"></script>

    </html>

<?php
} else {
?>
    <script>
        window.location = "studentHomePage.php";
    </script>
<?php
}
