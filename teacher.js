function toggleDiv(divid) {

    if (divid == "ddiv") { //when click dashboard tab in navigation
        if (document.getElementById("divdash").style.display == 'block') { //if profile is displaying
            document.getElementById("divprofile").style.display = 'none'; //then hide profile
            document.getElementById("divdash").style.display = 'block'; //display dashboard
        } else { //if dashboard is displaying
            document.getElementById("divprofile").style.display = 'none'; //hide profile
            document.getElementById("divdash").style.display = 'block'; //display dashoard
        }

    } else {//when click profile tab in navigation
        if (document.getElementById("divprofile").style.display == 'block') {//if dashboard is displaying
            document.getElementById("divprofile").style.display = 'block';//then display profile
            document.getElementById("divdash").style.display = 'none';//hide dashboard
        } else {//if profile is displaying
            document.getElementById("divprofile").style.display = 'block';//staty at the same page
            document.getElementById("divdash").style.display = 'none';//hide dashoard
        }
    }
}
function changesignup() {

    document.getElementById("login").style.display = 'none';
    document.getElementById("signup").style.display = 'block';

}
function gologin() {

    document.getElementById("login").style.display = 'block';
    document.getElementById("signup").style.display = 'none';
}
// register
function register() {

    var fn = document.getElementById("f"); //taking the first name field
    var l = document.getElementById("l");//taking the last name field
    var e = document.getElementById("e");//taking the email field
    var m = document.getElementById("m");//taking the mobile field
    var u = document.getElementById("u");//taking the username field

    var g //global variable

    if (document.getElementById("gm").checked) { //if male checked
        g = 1; //assign 1 to global vareable g
    } else { // if female checked
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

                fn.value = ""; //empty first name field
                l.value = ""; //empty last name field
                m.value = "";//empty mobile field
                u.value = "";//empty username field
                e.value = "";//empty email field

                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Account has successfuly created. </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + ' </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "regTeacherProcess.php", true);// build the request
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
    var r = document.getElementById("r2");//taking the remember me option

    var f = new FormData();//creating new form in js
    f.append("u", u.value);// insert email value to form
    f.append("p", p.value);// insert password value to form
    f.append("ra", r.checked);//insert remember me selected value

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable
            // alert(text);
            if (text == 1) {// login detail are correct
                window.location = "teacherHomePage.php";
                // var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Account acctivated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            } else if (text == 3) { //first login

                $('#exampleModal').modal('show'); //show account verification modal

            } else {//login details are incorrect
                // bootstrap alert - show the error massage

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "loginTeacherProcess.php", true);// build the request
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

    var r = new XMLHttpRequest(); //ajax request
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {
                setTimeout(function () {
                window.location = "teacherHomePage.php";//go to home page in 2000 milisecond
    
                }, 1500);

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>your account is now activated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>invalid verification code</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    };
    r.open("POST", "teacherVerify.php", true);// build the request
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
    r.open("GET", "forgotPasswordTeacher.php?u=" + u.value, true);// build the request
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
                $('#forgetpasswordModal').modal('hide');
                var w = document.getElementById("wish1").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "resetPasswordTeacher.php", true);// build the request
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

    var form = new FormData();

    form.append("fn", fname.value);// insert first name field value to form
    form.append("ln", lname.value);// insert last name field value to form
    form.append("m", mobile.value);// insert mobile field value to form
    form.append("ne", newmail.value);// insert email field value to form
    form.append("img", image.files[0]);// insert image name to form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable
            // bootstrap alert
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            setTimeout(function () {
                window.location.reload(1); //reload the page after update the profile in 2000 milisecond

            }, 2000);
            document.getElementById("divprofile").style.display = 'block';
            document.getElementById("divdash").style.display = 'none';
        }
    }

    r.open("POST", "updateTeacherProfile.php", true);// build the request
    r.send(form);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}

function changeImg() { // when a new image selected, the profile iamge will change in the web page until upateing db

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

function assigment() {
    var a = document.getElementById("a"); //taking the assigment name field
    var s = document.getElementById("s"); //taking the subject field
    var g = document.getElementById("g");//taking the grade field
    var d = document.getElementById("d");//taking the end date field
    var af = document.getElementById("af");//taking the file field

    var f = new FormData();//creating new form in js
    f.append("a", a.value); //insert the asigment name field value to the form
    f.append("s", s.value); //insert the selected subject value to the form
    f.append("g", g.value); //insert the selected grade  value to the form
    f.append("d", d.value); //insert the end date field value to the form
    f.append("af", af.files[0]); //insert the file to the form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable

            if (text == "ok") { //when assignment uploaded successfully

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Assigment uploaded</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                document.getElementById("a").value = " "; //empty the assigment name field
                document.getElementById("s").value = " ";//empty the subject field
                document.getElementById("g").value = " ";//empty the grade field
                document.getElementById("d").value = " ";//empty the date field
                document.getElementById("af").value = " ";//empty the file field

            } else { // not uploaded. errors
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "addAssigment.php", true);// build the request
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function note() {
    var a = document.getElementById("n");//taking the note name field
    var s = document.getElementById("ns");//taking the subject field
    var g = document.getElementById("ng");//taking the grade field
    var af = document.getElementById("nf");//taking the file field

    var f = new FormData();//creating new form in js
    f.append("a", a.value);//insert the note name field value to the form
    f.append("s", s.value);//insert the subject field value to the form
    f.append("g", g.value);//insert the grade field value to the form
    f.append("af", af.files[0]);//insert the file to the form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {//when note uploaded successfully
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Lesson Note uploaded</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                document.getElementById("n").value = "";//empty the note name field
                document.getElementById("ns").value = "";//empty the subject field
                document.getElementById("ng").value = "";//empty the grade field
                document.getElementById("nf").value = "";//empty the file field

            } else {// not uploaded. errors
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "addNote.php", true);// build the request
    r.send(f);// send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2700);
}
function save(id) {
    var sid = id; // the student id coming from php file.

    var m = document.getElementById("marks" + id); //take the marks field of selected row
    var aid = document.getElementById("aid"); //take assignment id field
    var s = document.getElementById("student" + id); // take student field of selected row

    var f = new FormData();//creating new form in js
    f.append("m", m.value); //insert the marks value of selected rowto the form
    f.append("a", aid.value);//insert the assinment id to the form
    f.append("s", s.value);//insert the student  value of selected row to the form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable

            if (text == 1) {

                // take the marks field in selected row and make the valu of it as tha added mark.
                document.getElementById("marks" + id).value = m.value;

                setTimeout(function () {
                    window.location.reload(1); //reload the page after 1s
                }, 1000);

            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "addMarks.php", true);// build the request
    r.send(f);// send the request
}
function sendAnswer(a) {

    var f = new FormData();//creating new form in js
    f.append("a", a); //insert the value coming from php file to the form

    var r = new XMLHttpRequest();// ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText;// assign the respond to a variable

            if (text == "") { //if there is no response text. that means no error in marksAc.php
                // send marks to academic oficer

                var f1 = new FormData();//creating new form in js
                f1.append("aid", a); ///insert the value coming from php file to the form

                // ajax inside ajax
                var r1 = new XMLHttpRequest();// ajax request object

                r1.onreadystatechange = function () {
                    if (r1.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

                        var text1 = r1.responseText;// assign the respond to a variable
                        alert(text1);
                        setTimeout(function () {
                            window.location.reload(1); //reload the page after update the profile in 2000 milisecond
                        }, 1500);
                    }
                }
                r1.open("POST", "marksAc.php", true);// build the request
                r1.send(f1);// send the request

            } else { // there is response text. that means  error in marksAc.php
                alert(text);
            }
        }
    }

    r.open("POST", "sendMarks.php", true);// build the request
    r.send(f);// send the request
}

function refresh() {
    setInterval(a, 1000);
}

function a() { //refresh assigment table
    $("#table").load(window.location.href + " #table");
    $("#notice").load(window.location.href + " #notice");

}