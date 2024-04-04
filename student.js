function toggleDiv(divid) {

    if (divid == "ddiv") {
        if (document.getElementById("divdash").style.display == 'block') {
            document.getElementById("divprofile").style.display = 'none';
            document.getElementById("divdash").style.display = 'block';
        } else {
            document.getElementById("divprofile").style.display = 'none';
            document.getElementById("divdash").style.display = 'block';
        }

    } else {
        if (document.getElementById("divprofile").style.display == 'block') {
            document.getElementById("divprofile").style.display = 'block';
            document.getElementById("divdash").style.display = 'none';
        } else {
            document.getElementById("divprofile").style.display = 'block';
            document.getElementById("divdash").style.display = 'none';
        }
    }
}

// register
function register() {
    var fn = document.getElementById("f");//taking the first name field
    var l = document.getElementById("l");//taking the last name field
    var e = document.getElementById("e");//taking the email field
    var m = document.getElementById("m");//taking the mobile field
    var pn = document.getElementById("pn"); //taking the parent name field
    var pm = document.getElementById("pm");//taking the parent mobile field
    var gr = document.getElementById("gr");//taking the grade select field
    var g //global variable
    var email = e.value;
    if (document.getElementById("gm").checked) {//if male checked
        g = 1;//assign 1 to global vareable g
    } else {// if female checked
        g = 2;//assign 2 to global vareable g
    }

    var as; //global variable

    if (document.getElementById("dan").checked) { //if dancing is selected,
        as = 11; //then assign 11 to global variable as
    } else if (document.getElementById("em").checked) {//if eastern music is selected,
        as = 12;//then assign 12 to global variable as
    } else if (document.getElementById("wm").checked) {//if western music is selected,
        as = 13;//then assign 13 to global variable as
    } else if (document.getElementById("ar").checked) {//if art is selected,
        as = 14;//then assign 14 to global variable as
    } else if (document.getElementById("dr").checked) {//if rama is selected,
        as = 15;//then assign 15 to global variable as
    }

    var f = new FormData();//creating new form in js
    f.append("f", fn.value);//insert first name field value for the form
    f.append("l", l.value);//insert last name field value for the form
    f.append("e", e.value);//insert email field value for the form
    f.append("m", m.value);//insert mobile field value for the form
    f.append("pn", pn.value);//insert parent name value for the form
    f.append("pm", pm.value);//insert parent mobile value for the form
    f.append("gr", gr.value);//insert grade selected value for the form
    f.append("g", g);//insert g value for the form
    f.append("as", as);//insert as value for the form

    $('#exampleModal').modal('show'); //show the spinner

    var r = new XMLHttpRequest(); // ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {
                fn.value = "";//empty first name field
                l.value = "";//empty last name field
                m.value = "";//empty mobile field
                pn.value = ""; //empty parent name field
                pm.value = "";//empty parent mobile field
                e.value = "";//empty email field

                setTimeout(sub, 5000, email); //call the function sub in 5s while sending the email to the function
            } else {
                $('#exampleModal').modal('hide'); //hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + ' </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "regStuProcess.php", true);// build the request
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}
function sub(e) {

    var f1 = new FormData();//creating new form in js

    f1.append("e", e); //insert the email coming from register function

    var r1 = new XMLHttpRequest();// ajax request object
    r1.onreadystatechange = function () {
        if (r1.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text1 = r1.responseText;// assign the respond to a variable

            if (text1 == 1) {
                $('#exampleModal').modal('hide'); //hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Account has successfuly created and email sent to the student </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            } else {
                $('#exampleModal').modal('hide'); //hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Error </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r1.open("POST", "regStuSubjects.php", true);// build the request
    r1.send(f1);// send the request along with  the form

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function login() {

    var u = document.getElementById("u1");//taking the email field
    var p = document.getElementById("p1");//taking the password field
    var r = document.getElementById("r1");//taking the remember me option

    var f = new FormData();//creating new form in js
    f.append("u", u.value);// insert email value to form
    f.append("p", p.value);// insert password value to form
    f.append("r", r.checked);//insert remember me selected value

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {// login detail are correct
                // can directrly access home page
                window.location = "studentHomePage.php"; //load the home page

            } else if (text == 3) { //first login
                // student should verify the accoun from verification code

                $('#exampleModal').modal('show'); //show account verification modal

            } else if (text == 4) { //upgraded student still not paid - still not end date expire
                // modal
                var f1 = new FormData();//creating new form in js
                f1.append("u", u.value); //insert the email to the form

                var r1 = new XMLHttpRequest();// ajax request object
                r1.onreadystatechange = function () {
                    if (r1.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

                        var text1 = r1.responseText;// assign the respond to a variable

                        // view modal
                        // the modal is coming in response text. take the id skipPayModal from login oage and insert the modal inside the div with that id
                        document.getElementById("skipPayModal").innerHTML = text1;
                        $('#skipPayModal').modal('show'); //show the inserted modal to student 

                        // when modal close by button,goes to home page
                        $('#skipPayModal').on('hidden.bs.modal', function () {
                            window.location = "studentHomePage.php";
                        })
                    }
                }

                r1.open("POST", "payModal4.php", true);
                r1.send(f1);
                // modal

            } else if (text == 5) { //upgraded student not paid and date expires - cant access home page without payment
                // modal
                var f2 = new FormData();//creating new form in js
                f2.append("u", u.value);//insert the email to the form

                var r2 = new XMLHttpRequest();// ajax request object
                r2.onreadystatechange = function () {
                    if (r2.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
                        var text2 = r2.responseText;// assign the respond to a variable

                        // the modal is coming in response text. take the id PayModal from login oage and insert the modal inside the div with that id
                        document.getElementById("payModal").innerHTML = text2;
                        $('#payModal').modal('show');//show the inserted modal to student 
                    }
                }
                r2.open("POST", "payModal4.php", true);
                r2.send(f2);
            }

            else {//login details are incorrect
                // bootstrap alert - show the error massage
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "loginStudentProcess.php", true);
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
// payment function
function pay(id) { //this will run when click the pay button on payment modal
    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            var obj = JSON.parse(text); //convert the Json object like text into a real Json object coming from the php side.

            //seperate the alues in Json object and store then in variables
            var amount = obj["amount"];
            var email = obj["email"];

            paypal.Buttons({ //paypal payment button

                createOrder: function (data, actions) { //creat the payment

                    return actions.order.create({
                        intent: 'CAPTURE',//capture payment from buyeer
                        payer: {
                            name: {
                                given_name: obj["fname"],
                                surname: obj["lname"]
                            },
                          
                            email_address: email,

                            phone: {
                                phone_type: "MOBILE",
                                phone_number: {
                                    national_number: obj["mobile"]
                                }
                            }
                        },
                        purchase_units: [{
                            amount: {
                                value: amount,
                                currency_code: "USD"
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                onApprove: function (data, actions) {
                    // payment approved
                    return actions.order.capture().then(function(details){
                        console.log(details);
                        paymentID = details.id;
                        var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Payment successfull</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                        saveInvoice(paymentID, id, email, amount);
                    });

                },
                onCancel: function (data) {
                    // cancel order
                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-warning alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Payment cancelled</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                },
                onError: function (err) {
                    //error that prevent customer from checout    
                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + err + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                }
            }).render('#paypal-button-container')

        }
    }

    r.open("GET", "payProcess.php?id=" + id, true);// build the request
    r.send();// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}

function saveInvoice(paymentID, id, email, amount) {

    var sid = id;
    var mail = email;
    var total = amount;

    var f = new FormData();//creating new form in js

    f.append("pid", paymentID);
    f.append("sid", sid);
    f.append("email", mail);
    f.append("total", total);

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var t = r.responseText;// assign the respond to a variable
            if (t == 1) { //if payment completed

                setTimeout(function () {
                    window.location = "invoice.php?id=" + paymentID; //go to invoice page by taking the payment id in GET method
                }, 1000);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);// build the request
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}

function printDiv() {
    // print the invoice
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function verify() {

    var vc = document.getElementById("vc");
    var u = document.getElementById("u1");

    var formData = new FormData();//creating new form in js
    formData.append("c", vc.value);
    formData.append("u", u.value);

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {

                setTimeout(function () {
                    window.location = "studentHomePage.php";
                    //go to home page in 1500 milisecond

                }, 1500);

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>your account is now activated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    };
    r.open("POST", "studentVerify.php", true);// build the request
    r.send(formData);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}
function forgotpassword() {

    document.getElementById("spinner").style.display = 'block';// show the spinner
    var u = document.getElementById("u1");//taking the email field

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable
            // alert(text);
            if (text == 1) {

                // alert("verification email sent,please check your inbox.")
                $('#forgetpasswordModal').modal('show');// show the forgot password modal
                document.getElementById("spinner").style.display = 'none';// hide the spinner

            } else {
                document.getElementById("spinner").style.display = 'none';// hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    }
    r.open("GET", "forgotPasswordStudent.php?u=" + u.value, true);// build the request
    r.send();// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function showPassword1() {

    var np = document.getElementById("np"); //taking the new password field
    var npb = document.getElementById("npb");  //taking the new password button

    if (npb.innerHTML == "Show") { //if button text is Show
        np.type = "text";          //set input type as text
        npb.innerHTML = "Hide";    //set button text as Hide
    } else {                       //if button text is Hide
        np.type = "password";      //set input type as password
        npb.innerHTML = "Show";    //set button text as Hide
    }

}

function showPassword2() {

    var rnp = document.getElementById("rnp");  //taking the re-enter new password field
    var rnpb = document.getElementById("rnpb"); //taking the re-enter new password nutton

    if (rnpb.innerHTML == "Show") {  //if button text is Show
        rnp.type = "text"; //set input type as text
        rnpb.innerHTML = "Hide"; //set button text as Hide
    } else { //if button text is Hide
        rnp.type = "password";//set input type as password
        rnpb.innerHTML = "Show"; //set button text as Hide
    }
}

function resetPassword() {


    var u = document.getElementById("u1");  //taking the email field
    var np = document.getElementById("np"); //taking the new password field
    var rnp = document.getElementById("rnp"); //taking the re-enter new password field
    var vc = document.getElementById("vc1"); //taking the verification code field

    var formData = new FormData();//creating new form in js
    formData.append("u", u.value); // insert email value to form
    formData.append("np", np.value); // insert new password field value to form
    formData.append("rnp", rnp.value); // insert re-enter password field value to form
    formData.append("vc", vc.value); // insert verification code field value to form

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable
            if (text == 1) {
                // alert("Password Reset Success");
                $('#forgetpasswordModal').modal('hide');
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Password Reset Successfuly.</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';



            } else {

                var w = document.getElementById("wish1").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    };
    r.open("POST", "resetPasswordStudent.php", true);// build the request
    r.send(formData);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}
function update() {

    var fname = document.getElementById("fn");//taking the first name field
    var lname = document.getElementById("ln");//taking the last name field
    var mobile = document.getElementById("m");//taking the mobile field
    var newmail = document.getElementById("e");//taking the email field
    var image = document.getElementById("imguploader");//taking the image field

    var form = new FormData();//creating new form in js

    form.append("fn", fname.value);// insert first name field value to form
    form.append("ln", lname.value);// insert last name field value to form
    form.append("m", mobile.value);// insert mobile field value to form

    form.append("ne", newmail.value);// insert email field value to form

    form.append("img", image.files[0]);// insert image name to form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable
            if (text == "") {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Profile Updated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
            // var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            setTimeout(function () {
                window.location.reload(1); //reload the page after update the profile in 2000 milisecond

            }, 2000);
            document.getElementById("divprofile").style.display = 'block';
            document.getElementById("divdash").style.display = 'none';

        }
    }

    r.open("POST", "updateStudentProfile.php", true);// build the request
    r.send(form);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

} function changeImg() { // when a new image selected, the profile iamge will change in the web page until upateing db

    var image = document.getElementById("imguploader");

    var view = document.getElementById("prev");
    var view1 = document.getElementById("prev1");

    image.onchange = function () {
        var file = this.files[0];
        // take the image path
        var url = window.URL.createObjectURL(file);
        // chnge image in web page until update the db
        view.src = url;
        view1.src = url;

    }
}

function clickimg() {
    changeImg();//call function changeImg()
}

var aid; //global variable to hold the assigment id when uploading answers
function upload(a) { //take the assigment id coming drom uploading answer when call this function
    aid = a;// asign the assiment id to the global variable aid
}
function up1() {

    var f = document.getElementById("getFile");
    var laid = aid; //assign the value of global variable aid

    if (!f.value) { // if file is not selected
        $('#exampleModal').modal('hide'); //hide the upload answermodal
        // bootstrap error massage
        var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Please select a file</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

    } else { //file is uploaded
        var form = new FormData();//creating new form in js

        form.append("img", f.files[0]); //insert the file to the form
        form.append("sid", laid); //insert the assignment id to the form

        var r = new XMLHttpRequest();// ajax request object

        r.onreadystatechange = function () {
            if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

                var text = r.responseText;// assign the respond to a variable
                $('#exampleModal').modal('hide');//hide the upload answermodal
                document.getElementById("getFile").value = null;
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Assigment Uploaded successfuly</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
        r.open("POST", "uploadAnswer.php", true);// build the request
        r.send(form);// send the request
    }
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2800);
}

function refresh() {

    setInterval(a, 1000);


} function a() { //refresh assigment table
    $("#table").load(window.location.href + " #table");
    $("#notice").load(window.location.href + " #notice");

}
