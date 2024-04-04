<!-- academic officer views marks -->
<?php
session_start();
require "connection.php"; //connecting database connection file

if (isset($_SESSION["a"])) { //check admin is signed in

    $s = $_SESSION["a"];
    $id = $s["id"];

    $gid = $_GET["gid"]; //assign the grade coming from home page to a variable


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Marks page</title>
        <!-- Style -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
        <link rel="icon" href="images/logo.jpg" />
        <!--logo-->
        <link href="mainPage.css" rel="stylesheet" />
        <link href="demo.css" rel="stylesheet" />
        <link href="fresh-bootstrap-table.css" rel="stylesheet" />
        <link href="fresh-bootstrap-table.css.map" rel="stylesheet" />
        <!-- Fonts and icons -->
        <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.0/dist/bootstrap-table.min.css">
    </head>

    <body style="background-color:#73c2fb;">
        <div id="wish"></div>

        <div class="fresh-table full-color-azure" style="margin-top:0px;">
            <div class="toolbar toolbar-color-azure fixed-table-header">
                <button onclick="window.location='adminHomePage.php'" id="alertBtn" class="btn btn-default">Back</button>
                <!-- display the grade in the top of the page -->
                <span style="width: 300px;font-size:16px;margin-left:10px;color:beige;mrgin-top:20px">Grade : &nbsp; <?php echo $gid ?></span>
            </div>
            <?php
            if ($gid < 6) { //if grade is less than 6
            ?>
                <div>
                    <table id="fresh-table" class=" fresh-table.full-screen-table" style="overflow-y:scroll">
                        <thead>
                            <th>#</th>
                            <th> Index No.</th>
                            <th> Name</th>
                            <?php
                            // select the subjects that relevant to grades less that 6
                            $su = Database::search("SELECT * FROM `subject` WHERE `id` < '5' ");
                            $sn1 = $su->num_rows; //no. of rows in resulset
                            for ($w = 0; $w < $sn1; $w++) {
                                $sr1 = $su->fetch_assoc();
                            ?>
                                <!-- display the subject in tablle head -->
                                <th><?php echo $sr1["name"] ?></th>
                            <?php
                            }
                            ?>
                            <th>Avarage</th>
                            <th>status</th>
                        </thead>
                        <tbody style="font-size: 16px;">
                            <!-- select all studen relevant to selected grade -->
                            <?php
                            $sq = Database::search("SELECT * FROM `student` WHERE `grade_id`='" . $gid . "'");
                            $sn = $sq->num_rows; //no. of rows in resulset

                            $da = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $da->setTimezone($tz);
                            $date = $da->format("Y-m-d ");
                            $year = $da->format("Y ");

                            for ($rr = 0; $rr < $sn; $rr++) {
                                $sr = $sq->fetch_assoc();
                                $sid = $sr["id"]; //takin the index from the row
                            ?>
                                <tr>
                                    <!--row number-->
                                    <td><?php echo $rr + 1 ?></td>
                                    <!--display index-->
                                    <td><?php echo $sid ?></td>
                                    <!--display full name-->
                                    <td><?php echo $sr["fname"] . " " . $sr["lname"] ?></td>
                                    <?php
                                    // 3 data
                                    // select the assignment with subject id 1 and relevent to the gade selected
                                    $as = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='1' AND `year`='" . $year . "'");
                                    $asn = $as->num_rows;

                                    if ($asn == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr = $as->fetch_assoc();

                                        $m = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr["id"] . "' AND `student_id`='" . $sid . "' ");
                                        $mn = $m->num_rows;

                                        if ($mn == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr = $m->fetch_assoc();
                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php

                                    // 4 data
                                    // select the assignment with subject id 2 and relevent to the gade selected
                                    $as1 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='2' AND `year`='" . $year . "'");
                                    $asn1 = $as1->num_rows;

                                    if ($asn1 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr1 = $as1->fetch_assoc();

                                        $m1 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr1["id"] . "' AND `student_id`='" . $sid . "' ");
                                        $mn1 = $m1->num_rows;

                                        if ($mn1 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr1 = $m1->fetch_assoc();
                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr1["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php

                                    // 5 data
                                    // select the assignment with subject id 3 and relevent to the gade selected
                                    $as2 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='3' AND `year`='" . $year . "'");
                                    $asn2 = $as2->num_rows;

                                    if ($asn2 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr2 = $as2->fetch_assoc();

                                        $m2 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr2["id"] . "' AND `student_id`='" . $sid . "' ");
                                        $mn2 = $m2->num_rows;

                                        if ($mn2 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2"> pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr2 = $m2->fetch_assoc();
                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr2["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php

                                    // 5 data
                                    // select the assignment with subject id 4 and relevent to the gade selected
                                    $as3 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='4' AND `year`='" . $year . "'");
                                    $asn3 = $as3->num_rows;

                                    if ($asn3 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr3 = $as3->fetch_assoc();

                                        $m3 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr3["id"] . "' AND `student_id`='" . $sid . "' ");
                                        $mn3 = $m3->num_rows;

                                        if ($mn3 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2"> pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr3 = $m3->fetch_assoc();
                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr3["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    // take the avarage of marks in selected grade, with specific student is ,with this year
                                    $av = Database::search("SELECT AVG(marks.`marks`) FROM `marks` WHERE `student_id` ='" . $sid . "'  AND `marks_year`='" . $year . "' AND `status`='1' AND `grade_id`='" . $gid . "' ");
                                    $avg = $av->fetch_assoc();
                                    ?>
                                    <!-- display avarage mark -->
                                    <td style="color:#af002a;font-weight:bold"><?php echo $avg["AVG(marks.`marks`)"] ?></td>

                                    <?php
                                    // check the grade is upgraded
                                    $p = Database::search("SELECT * FROM `grade_upgrade` WHERE `student_id`='" . $sr["id"] . "' AND `year`='" . $year . "' AND `grade`='" . $gid . "'");
                                    $pr = $p->num_rows;
                                    if ($pr == 0) { //still not upgrade
                                    ?>
                                        <td></td>
                                    <?php
                                    } else { //grade upgraded
                                        $pn = $p->fetch_assoc();
                                    ?>
                                        <?php
                                        if ($pn["upgrade_id"] == 1) { //student pass
                                        ?>
                                            <td>
                                                <div style="background-color:green ;color:white;width: 50px;border-radius:6px;text-align:center;font-weight:bold">Pass</div>
                                            </td>
                                        <?php
                                        } else { //studen fail
                                        ?>
                                            <td>
                                                <div style="background-color:red ;color:white;width: 50px;border-radius:6px;text-align:center;font-weight:bold">Fail</div>
                                            </td>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                    <!-- upgrade -->
                    <?php
                    // serach whether the grade alredy upgraded or not
                    $ug = Database::search("SELECT * FROM `grade_upgrade` WHERE `grade`='" . $gid . "' AND `year`='" . $year . "'");
                    $ugn = $ug->num_rows;
                    if ($ugn == 0) { //not upgraded yet

                        $d = Database::search("SELECT `assigments`.`id` FROM `assigments`  LEFT JOIN `marks` ON  `assigments`.`id`=`marks`.`assigments_id`   WHERE `marks`.`assigments_id` IS NULL AND `assigments`.`year`='" . $year . "' AND `assigments`.grade_id='" . $gid . "'");
                        $dn = $d->num_rows;

                        if ($dn == 0) { //no pending marks
                            $p1 = Database::search("SELECT * FROM `grade_upgrade` WHERE `grade`='" . $sr["grade_id"] . "' AND `year`='" . $year . "'");
                            $pr1 = $p1->num_rows;

                            if ($pr1 == 0) { //still not upgraded
                    ?>
                                <div id="up" style="display:block">
                                    <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                        Upgrade the grade of students with avarage more than : </span>
                                    <input id="avg" type="text">
                                    <button style="background-color: green;border:none;border-radius:5px;color:white" onclick="upgrade(<?php echo $gid ?>);">
                                        upgrade</button>
                                </div>
                            <?php
                            } 
                        } else {
                            ?>
                            <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                Marks are pending </span>
                        <?php
                        }
                    } else { //upgraded
                        $ugf = $ug->fetch_assoc();
                        $ngrd = $ugf["grade"];
                        $newgg = $ngrd + 1;
                        // select whether the fee amount for next grade is defined or not
                        $pp1 = Database::search("SELECT * FROM `payment` WHERE `year`='" . $year . "' AND `new_grade`='" . $newgg . "'");
                        $ppr1 = $pp1->num_rows;
                        if ($ppr1 == 0) { //not defined. so show the add fee amount area.
                        ?>
                            <div><span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                    Garde <?php echo  $sr["grade_id"] + 1 ?> fee : &nbsp; USD. $ <input type="text" id="fee">
                                    <button onclick="fee(<?php echo $gid ?>);" style="background-color: green;border:none;border-radius:5px;color:white">send emails to students</button>
                                </span></div>
                        <?php
                        } else {//defined
                        ?>
                            <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                Grade upgraded for Grade <?php echo $gid ?> students in year <?php echo $year ?> </span>
                    <?php
                        }
                    }
                    ?>


                    <!-- upgrade -->
                </div>
                <!-- </div> -->
            <?php
            }
            /////////////////////////////////// // other grades //////////////////////////////////////////
            else {
            ?>
                <div>
                    <table id="fresh-table" class=" fresh-table.full-screen-table" style="overflow-y:scroll">
                        <thead>
                            <th>#</th>
                            <th> Index No.</th>
                            <th>Name</th>
                            <?php
                            $su = Database::search("SELECT * FROM `subject` WHERE `id` < '11' ");
                            $sn1 = $su->num_rows;
                            for ($w = 0; $w < $sn1; $w++) {
                                $sr1 = $su->fetch_assoc();
                            ?>
                                <th><?php echo $sr1["name"] ?></th>
                            <?php
                            }
                            ?>
                            <th>Avarage</th>
                            <th>status</th>

                            <!-- <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th> -->
                        </thead>
                        <tbody>
                            <?php
                            $sq = Database::search("SELECT * FROM `student` WHERE `grade_id`='" . $gid . "'");
                            $sn = $sq->num_rows;

                            $da = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $da->setTimezone($tz);

                            $year = $da->format("Y ");

                            for ($rr = 0; $rr < $sn; $rr++) {
                                $sr = $sq->fetch_assoc();
                                $sid = $sr["id"];

                            ?>

                                <tr>
                                    <td><?php echo $rr + 1 ?></td>
                                    <!--1 td-->
                                    <td><?php echo $sid ?></td>
                                    <!--1 td-->
                                    <td><?php echo $sr["fname"] . " " . $sr["lname"] ?></td>
                                    <!--2 td-->

                                    <?php
                                    // 3 data
                                    // select the assignment with subject id 1 and relevent to the gade selected
                                    $as = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='1' AND `year`='" . $year . "'");
                                    $asn = $as->num_rows;

                                    if ($asn == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr = $as->fetch_assoc();

                                        $m = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn = $m->num_rows;

                                        if ($mn == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr = $m->fetch_assoc();
                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 4 data
                                    // select the assignment with subject id 2 and relevent to the gade selected
                                    $as1 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='2' AND `year`='" . $year . "'");
                                    $asn1 = $as1->num_rows;

                                    if ($asn1 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr1 = $as1->fetch_assoc();

                                        $m1 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr1["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1' ");
                                        $mn1 = $m1->num_rows;

                                        if ($mn1 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr1 = $m1->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr1["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 5 data
                                    // select the assignment with subject id 3 and relevent to the gade selected
                                    $as2 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='3' AND `year`='" . $year . "'");
                                    $asn2 = $as2->num_rows;

                                    if ($asn2 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr2 = $as2->fetch_assoc();

                                        $m2 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr2["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn2 = $m2->num_rows;

                                        if ($mn2 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr2 = $m2->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr2["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 6 data
                                    // select the assignment with subject id 4 and relevent to the gade selected
                                    $as3 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='4' AND `year`='" . $year . "'");
                                    $asn3 = $as3->num_rows;

                                    if ($asn3 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr3 = $as3->fetch_assoc();

                                        $m3 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr3["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn3 = $m3->num_rows;

                                        if ($mn3 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr3 = $m3->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr3["marks"] ?>%</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 7 data
                                    // select the assignment with subject id 5 and relevent to the gade selected
                                    $as4 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='5' AND `year`='" . $year . "'");
                                    $asn4 = $as4->num_rows;

                                    if ($asn4 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr4 = $as4->fetch_assoc();

                                        $m4 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr4["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn4 = $m4->num_rows;

                                        if ($mn4 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr4 = $m4->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr4["marks"] ?> %</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 7 data
                                    // select the assignment with subject id 6 and relevent to the gade selected
                                    $as5 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='6' AND `year`='" . $year . "'");
                                    $asn5 = $as5->num_rows;

                                    if ($asn5 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr5 = $as5->fetch_assoc();

                                        $m5 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr5["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn5 = $m5->num_rows;

                                        if ($mn5 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr5 = $m5->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr5["marks"] ?>%</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 8 data
                                    // select the assignment with subject id 7 and relevent to the gade selected
                                    $as6 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='7' AND `year`='" . $year . "'");
                                    $asn6 = $as6->num_rows;

                                    if ($asn6 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr6 = $as6->fetch_assoc();

                                        $m6 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr6["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn6 = $m6->num_rows;

                                        if ($mn6 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr6 = $m6->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr6["marks"] ?>%</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    // 9 data
                                    // select the assignment with subject id 8 and relevent to the gade selected
                                    $as7 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='8' AND `year`='" . $year . "'");
                                    $asn7 = $as7->num_rows;

                                    if ($asn7 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                    ?>
                                        <td>-</td>
                                        <?php
                                    } else { //assignment relevant to the subject in selected grade has uploaded
                                        $asr7 = $as7->fetch_assoc();

                                        $m7 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr7["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                        $mn7 = $m7->num_rows;

                                        if ($mn7 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2">pending</td>
                                        <?php
                                        } else { //marks are released by officer
                                            $mr7 = $m7->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr7["marks"] ?>%</td>
                                    <?php
                                        }
                                    }
                                    ?> <?php
                                        // 10 data
                                        // select the assignment with subject id 9 and relevent to the gade selected
                                        $as8 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='9' AND `year`='" . $year . "'");
                                        $asn8 = $as8->num_rows;

                                        if ($asn8 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                        ?>
                                        <td>-</td>
                                        <?php
                                        } else { //assignment relevant to the subject in selected grade has uploaded
                                            $asr8 = $as8->fetch_assoc();

                                            $m8 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr8["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                            $mn8 = $m8->num_rows;

                                            if ($mn8 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2"> pending</td>
                                        <?php
                                            } else { //marks are released by officer
                                                $mr8 = $m8->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr8["marks"] ?>%</td>
                                    <?php
                                            }
                                        }
                                    ?> <?php
                                        // 3 data
                                        // select the assignment with subject id 10 and relevent to the gade selected
                                        $as9 = Database::search("SELECT * FROM `assigments` WHERE `grade_id`='" . $gid . "' AND `subject_id`='10' AND `year`='" . $year . "'");
                                        $asn9 = $as9->num_rows;

                                        if ($asn9 == 0) { //assignment relevant to the subject in selected grade isnt uploaded yet
                                        ?>
                                        <td>-</td>
                                        <?php
                                        } else { //assignment relevant to the subject in selected grade has uploaded
                                            $asr9 = $as9->fetch_assoc();

                                            $m9 = Database::search("SELECT * FROM `marks` WHERE `assigments_id`='" . $asr9["id"] . "' AND `student_id`='" . $sid . "' AND `status`='1'");
                                            $mn9 = $m9->num_rows;

                                            if ($mn9 == 0) { //still marks are not released by academic officer
                                        ?>
                                            <td style="color:#dbd7d2"> pending</td>
                                        <?php
                                            } else { //marks are released by officer
                                                $mr9 = $m9->fetch_assoc();

                                        ?>
                                            <!-- display the marks for relevan ubject in selected grade -->
                                            <td style="color: black;font-weight:bold"><?php echo $mr9["marks"] ?>%</td>
                                    <?php
                                            }
                                        }
                                        // take the avarage of marks in selected grade, with specific student is ,with this year
                                        $av = Database::search("SELECT AVG(marks.`marks`) FROM `marks` WHERE `student_id` ='" . $sid . "'  AND `marks_year`='" . $year . "' AND `status`='1' AND `grade_id`='" . $gid . "' ");
                                        $avg = $av->fetch_assoc();
                                    ?>
                                    <!-- display avarage mark -->
                                    <td style="color:#af002a;font-weight:bold"><?php echo $avg["AVG(marks.`marks`)"] ?></td>

                                    <?php
                                    // check the grade is upgraded
                                    $p = Database::search("SELECT * FROM `grade_upgrade` WHERE `student_id`='" . $sr["id"] . "' AND `year`='" . $year . "' AND `grade`='" . $gid . "'");
                                    $pr = $p->num_rows;
                                    if ($pr == 0) { //not upgraded yet
                                    ?>
                                        <td></td>
                                    <?php
                                    } else { //upgraded
                                        $pn = $p->fetch_assoc();
                                    ?>

                                        <?php
                                        if ($pn["upgrade_id"] == 1) { //student pass for next grade
                                        ?>
                                            <td>
                                                <!-- display pass -->
                                                <div style="background-color:green ;color:white;width: 50px;border-radius:6px;text-align:center;font-weight:bold">Pass</div>
                                            </td>
                                        <?php
                                        } else { //studen fail this grade
                                        ?>
                                            <td>
                                                <!-- display fail -->
                                                <div style="background-color:red ;color:white;width: 50px;border-radius:6px;text-align:center;font-weight:bold">Fail</div>
                                            </td>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- upgrade -->
                    <?php
                    // serach whether the grade alredy upgraded or not
                    $ug = Database::search("SELECT * FROM `grade_upgrade` WHERE `grade`='" . $gid . "' AND `year`='" . $year . "'");
                    $ugn = $ug->num_rows;
                    if ($ugn == 0) { //not upgraded yet
                        $d = Database::search("SELECT `assigments`.`id` FROM `assigments`  LEFT JOIN `marks` ON  `assigments`.`id`=`marks`.`assigments_id`   WHERE `marks`.`assigments_id` IS NULL AND `assigments`.`year`='" . $year . "' AND `assigments`.grade_id='" . $gid . "'");
                        $dn = $d->num_rows;

                        if ($dn == 0) { //no pending marks
                            $p1 = Database::search("SELECT * FROM `grade_upgrade` WHERE `grade`='" . $sr["grade_id"] . "' AND `year`='" . $year . "'");
                            $pr1 = $p1->num_rows;

                            if ($pr1 == 0) { //still not upgrade rdes
                    ?>
                                <div id="up" style="display:block">
                                    <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                        Upgrade the grade of students with avarage more than : </span>
                                    <input id="avg" type="text">
                                    <!-- send grade to the function upgrade when calling it-->
                                    <button style="background-color: green;border:none;border-radius:5px;color:white" onclick="upgrade(<?php echo $gid ?>);">
                                        upgrade</button>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                Marks are pending </span>
                        <?php
                        }
                    }  else { //upgraded
                        $ugf = $ug->fetch_assoc();
                        $ngrd = $ugf["grade"];
                        $newgg = $ngrd + 1;
                        // select whether the fee amount for next grade is defined or not
                        $pp1 = Database::search("SELECT * FROM `payment` WHERE `year`='" . $year . "' AND `new_grade`='" . $newgg . "'");
                        $ppr1 = $pp1->num_rows;
                        if ($ppr1 == 0) { //not defined. so show the add fee amount area.
                        ?>
                            <div><span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                    Garde <?php echo  $sr["grade_id"] + 1 ?> fee : &nbsp; USD. $ <input type="text" id="fee">
                                    <button onclick="fee(<?php echo $gid ?>);" style="background-color: green;border:none;border-radius:5px;color:white">send emails to students</button>
                                </span></div>
                        <?php
                        } else {//defined
                        ?>
                            <span style="color:#be0032;font-weight:bold;font-size:16px;margin-left:20px">
                                Grade upgraded for Grade <?php echo $gid ?> students in year <?php echo $year ?> </span>
                    <?php
                        }
                    }
                    ?>
                    <!-- upgrade -->
                </div>
            <?php
            }
            ?>
        </div>
        <script src="admin.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>
        <script src="demo.js"></script>
        <script src="jquery.sharrre.js"></script>
        <script src="gsdk-switch.js"></script>
        <script src="acOfficer.js"></script>

        <script type="text/javascript">
            var $table = $('#fresh-table')
            var $alertBtn = $('#alertBtn')

            window.operateEvents = {
                'click .like': function(e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .edit': function(e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row))
                    console.log(value, row, index)
                },
                'click .remove': function(e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    })
                }
            }

            function operateFormatter(value, row, index) {
                return [
                    '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                    '</a>',
                    '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                    '</a>'
                ].join('')
            }

            $(function() {
                $table.bootstrapTable({
                    classes: 'table table-hover table-striped',
                    toolbar: '.toolbar',

                    search: true,
                    showRefresh: true,
                    showToggle: true,
                    showColumns: true,
                    pagination: true,
                    striped: true,
                    sortable: true,
                    pageSize: 8,
                    pageList: [8, 10, 25, 50, 100],

                    formatShowingRows: function(pageFrom, pageTo, totalRows) {
                        return ''
                    },
                    formatRecordsPerPage: function(pageNumber) {
                        return pageNumber + ' rows visible'
                    }
                })


            })
        </script>
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