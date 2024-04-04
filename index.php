<!DOCTYPE html>
<html>

<head>
    <title>main page</title>
    <link rel="icon" href="images/logo.jpg" /> <!--logo-->
    <link rel="stylesheet" href="mainPage.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="header.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
</head>

<body style="background-color: rgb(220,220,220);overflow-x:hidden"> <!--set page background color-->

    <!--main div-->
    <div style="z-index: 1;">

        <header>
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3" style="justify-content: center;align-items:center;display:flex;font-size: 27px;">

                    <div class="headerFont1" style="display:inline-block;color:#77b5fe;font-size:18px">School</div>
                    <div class="headerFont2" style="display:inline-block;color:rgb(245, 249, 255);font-size:18px;font-family:'n'">Managment</div>
                    <div class="headerFont1" style="display:inline-block;color:#87cefa;font-size:18px">System</div>

                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <div style="justify-content: center;align-items:center;display: flex;font-weight:bold;cursor: pointer;">
                        <div onclick='window.location="index.html"' ; style="display:inline-block;margin-left:20px ;">HOME
                        </div>
                        <div style="display:inline-block;margin-left:20px ">MISSION</div>
                        <div style="display:inline-block;margin-left:20px ">CONTACTS</div>
                    </div>
                </div>

            </div>

        </header>

        <div class="row" style=" margin-top:100px;margin-left: 7px;">

            <!--img slider-->

            <div class="col-lg-6">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-2 " style="height: 100%; margin-left:-5px">
                        <div class="carousel-item active">
                            <img src="images/1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <!--img slider-->

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="row" style="justify-content:center;display:flex;align-items:center">
                            <!-- button 1-->
                            <div class="col-10 col-md-10 col-lg-10">
                                <button onclick='window.location="studentHomePage.php"' class="cssbuttons-io-button  fw-bold"> Student login
                                    <div class="icon">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <!-- button 1-->

                            <!-- button 2-->
                            <div class="col-10 col-md-10 col-lg-10">
                                <button onclick='window.location="teacherHomePage.php"' class="cssbuttons-io-button1  fw-bold"> Teacher login
                                    <div class="icon1">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <!-- button 2-->

                            <!-- button 3-->
                            <div class="col-10 col-md-10 col-lg-10">
                                <button onclick='window.location="acOfficerHomePage.php"' class="cssbuttons-io-button3  fw-bold">Academic officer login
                                    <div class="icon3">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <!-- button 3-->

                            <!-- button 4-->
                            <div class="col-10 col-md-10 col-lg-10">
                                <button onclick='window.location="adminHomePage.php"' class="cssbuttons-io-button4  fw-bold"> Admin login
                                    <div class="icon4">
                                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <!-- button 4-->
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <!--description-->
                        <div class="col-lg-11 rounded-2" style="background-color:#F5F5F5;" style="height: 500px;">
                            <div style="margin-left: 20px;font-size:18px;">
                                "Empower the educational services in ever changing environment to create
                                better opportunities for the students and teachers for their consistent growth.
                            </div>
                        </div>
                        <!--description-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--main div-->

    <script src="bootstrap.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>

</html>