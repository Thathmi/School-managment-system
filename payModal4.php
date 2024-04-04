<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

require "connection.php"; // connecting database connection file

$u = $_POST["u"]; //store the value coming from student.js through POST method

$da = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$da->setTimezone($tz);
$date = $da->format("Y-m-d ");
$year = $da->format("Y ");

// select the student with given index if the student didnt pay yet.
$p = Database::search("SELECT * FROM `payment` WHERE `student_id`='" . $u . "' AND `pay_status_id`='2'");
$pr = $p->fetch_assoc();
$eday = $pr["end_date"]; //take the end date of the payment

if ($eday > $date or $eday == $date) { //modal 4
    // this modal appears when the end date is greater than today's date. so student can still skip the payment and access the homepage
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:red;" id="exampleModalLabel">Enroll for next grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span style="font-size: 16px;font-weight:bold">you have acces to your
                    account free for </span> <span style="font-size: 16px;font-weight:bold;color:red"> 1 month</span> <br>
                <span style="font-size: 16px;font-weight:bold">.please Make your payment USD  <?php echo $pr["amount"] ?>
                    befor <?php echo $eday ?> </span>
                <!-- <input type="email" class="form-control mt-2" id="vc" aria-describedby="emailHelp"> -->
            </div>
            <div class="modal-footer">
                <!-- when click the button, it call the pay() function by sending the student id -->
                <div style="width:100% ;" type="button" class="btn btn-light" id="paypal-button-container" onclick="pay(<?php echo $u ?>);">Pay Now</div>
            </div>
            <!-- </div> -->
        </div>
    </div>
<?php

} else { // modal 5
    // this modal appears when the end date is less than today's date. so student can't  skip the payment and access the homepage.
    // student should do the payment to access the homepage. free trial period is over. 
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;" id="exampleModalLabel">Enroll for next grade - trial period expires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span style="font-size: 16px;color:red;">your free access to your account time period has expired.
                    please Make your payment USD  <?php echo $pr["amount"] ?>
                    now to access your account </span>
            </div>
            <div class="modal-footer">
                <!-- when click the button, it call the pay() function by sending the student id -->
                <div style="width:100% ;" type="button" class="btn btn-light" id="paypal-button-container" onclick="pay(<?php echo $u ?>);">Pay</div>
            </div>
        </div>
    </div>
<?php
}
?>

<script src="https://www.paypal.com/sdk/js?client-id=ATlMlZ4_iAbkbvsrSjQ_lwYEqMPvOtHTsEK7HZskbYQygubuKVn-Va4YUilXShGABOqjhPymBJkWIcHH&currency=USD"></script>
