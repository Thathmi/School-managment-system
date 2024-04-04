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
function changesignup() {

    document.getElementById("login").style.display = 'none'; // hide the login div
    document.getElementById("signup").style.display = 'block'; //show the sign up div

}
function gologin() {

    document.getElementById("login").style.display = 'block'; //show the login div
    document.getElementById("signup").style.display = 'none'; // hide the sign up div
}
// register
function register() {
    var fn = document.getElementById("f");//taking the first name field
    var l = document.getElementById("l");//taking the last name field
    var e = document.getElementById("e");//taking the email field
    var m = document.getElementById("m");//taking the mobile field
    var u = document.getElementById("u");//taking the username field

    var g //global variable

    if (document.getElementById("gm").checked) {//if male checked
        g = 1;//assign 1 to global vareable g
    } else {// if female checked
        g = 2;//assign 2 to global vareable g
    }

    var f = new FormData();//creating new form in js

    f.append("f", fn.value);//insert first name field value for the form
    f.append("l", l.value);//insert last name field value for the form
    f.append("e", e.value);//insert email field value for the form
    f.append("m", m.value);//insert mobile field value for the form
    f.append("u", u.value);//insert username field value for the form
    f.append("g", g);//insert g value for the form

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {

                fn.value = "";//empty first name field
                l.value = "";//empty last name field
                m.value = "";//empty mobile field
                e.value = "";//empty email field
                u.value = "";//empty username field

                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Account has successfuly created. </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + ' </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "regAcOfficerProcess.php", true);// build the request
    r.send(f);// send the request

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
            // alert(text);
            if (text == 1) {// login detail are correct
                window.location = "acOfficerHomePage.php";

            } else if (text == 3) { //first login

                $('#exampleModal').modal('show'); //show account verification modal

            } else {//login details are incorrect
                // bootstrap alert - show the error massage
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "loginAcOfProcess.php", true);// build the request
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
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
                window.location = "acOfficerHomePage.php";//go to home page in 2000 milisecond
                    }, 1500);

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>your account is now activated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>invalid verification code</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    };
    r.open("POST", "acOfVerify.php", true);// build the request
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
            if (text == 1) {
                $('#forgetpasswordModal').modal('show');// show the forgot password modal
                document.getElementById("spinner").style.display = 'none';// hide the spinner

            } else {
                document.getElementById("spinner").style.display = 'none';// hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("GET", "forgotPasswordAcOf.php?u=" + u.value, true);// build the request
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
                $('#forgetpasswordModal').modal('hide'); //hide forgot password modal
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Password Reset Successfuly.</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish1").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    };
    r.open("POST", "resetPasswordAcOf.php", true);// build the request
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
            if(text==""){
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Profile Updated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }else{
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }


            setTimeout(function () {
                window.location.reload(1); //reload the page after update the profile in 2000 milisecond
            }, 2000);
            document.getElementById("divprofile").style.display = 'block';
            document.getElementById("divdash").style.display = 'none';
        }
    }

    r.open("POST", "updateAcOfProfile.php", true);// build the request
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


function viewMarks(id) {

    window.location = "acViewMarks.php?aid=".id;

}
function sendAnswer(id) {

    var form = new FormData();//creating new form in js

    form.append("aid", id); //insert the assignment id to the form that came by acViewMarks.php file.

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable
            alert(text);
        }
    }
    r.open("POST", "releaseMarks.php", true);// build the request
    r.send(form);// send the request
}

function Notice(id) {
    if (id == 1) { // if id = 1, then its a notice for teacher
        var notice = document.getElementById("noticeTeacher").value; //take the value of notice field
        if (!notice) { // if notice field is empty,
            // error message
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Please enter a notice</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
        } else { //a notice is typed
            var form = new FormData();//creating new form in js

            form.append("n", notice); //insert the notice to the form
            form.append("i", id); //insert the id value (1) to the form

            var r = new XMLHttpRequest();// ajax request object

            r.onreadystatechange = function () {
                if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

                    var text = r.responseText;// assign the respond to a variable

                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                    document.getElementById("noticeTeacher").value = " "; //empty the notice field
                }
            }
            r.open("POST", "noticeTeacher.php", true);// build the request
            r.send(form);// send the request
        }
    } else { //notice for student
        var notice = document.getElementById("noticeStudent").value;//take the value of notice field
        var grade = document.getElementById("grade").value;//take the value of selected grade
        if (!notice) {// if notice field is empty,
             // error message
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Please enter a notice</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
        } else {//a notice is typed
            var form = new FormData();//creating new form in js

            form.append("i", id); //insert the id value (2) to the form
            form.append("n", notice); //insert the notice to the form
            form.append("g", grade); //insert the grade to the form

            var r = new XMLHttpRequest();// ajax request object

            r.onreadystatechange = function () {
                if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

                    var text = r.responseText;// assign the respond to a variable
                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                    document.getElementById("noticeStudent").value = " ";//empty the notice field
                }
            }
            r.open("POST", "noticeTeacher.php", true);// build the request
            r.send(form);// send the request
        }
    }
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}