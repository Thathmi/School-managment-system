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
// function for login
function login() {

    var u = document.getElementById("u1"); //taking the email field
    var p = document.getElementById("p1");//taking the password field
    var r = document.getElementById("r1");//taking the remember me option

    var f = new FormData(); // creating a new form in js
    f.append("u", u.value); // insert email value to form
    f.append("p", p.value); // insert password value to form
    f.append("r", r.checked); //insert remember me selected value

    var r = new XMLHttpRequest(); // ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText; // assign the respond to a variable

            if (text == 1) { // login detail are correct
                window.location = "adminHomePage.php"; // re directed to admin home page
            } else { //login details are incorrect

                // bootstrap alert - show the error massage
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    }

    r.open("POST", "loginAdminProcess.php", true); // build the request
    r.send(f); // send the request along with the form created

    // bootstrap alert massage dissapear in 2s.
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
// function for forgot password
function forgotpassword() {

    document.getElementById("spinner").style.display = 'block'; // show the spinner
    var u = document.getElementById("u1"); //taking the email field

    var r = new XMLHttpRequest(); // ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText; // assign the respond to a variable

            if (text == 1) { //show the modal

                $('#forgetpasswordModal').modal('show'); // show the forgot password modal
                document.getElementById("spinner").style.display = 'none'; // hide the spinner

            } else { //error 
                document.getElementById("spinner").style.display = 'none'; // hide the spinner
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    }
    r.open("GET", "forgotPasswordAdmin.php?u=" + u.value, true); // build the request
    r.send(); // send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
// function for show password 1
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
// function for show password 2
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
// function for reset password
function resetPassword() {

    var u = document.getElementById("u1");  //taking the email field
    var np = document.getElementById("np"); //taking the new password field
    var rnp = document.getElementById("rnp"); //taking the re-enter new password field
    var vc = document.getElementById("vc1"); //taking the verification code field

    var formData = new FormData(); //creating new form in js
    formData.append("u", u.value); // insert email value to form
    formData.append("np", np.value); // insert new password field value to form
    formData.append("rnp", rnp.value); // insert re-enter password field value to form
    formData.append("vc", vc.value); // insert verification code field value to form

    var r = new XMLHttpRequest(); // ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText; // assign the respond to a variable
            if (text == 1) {

                $('#forgetpasswordModal').modal('hide');
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Password Reset Successfuly.</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            } else {
                var w = document.getElementById("wish1").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    };
    r.open("POST", "resetPasswordAdmin.php", true); // build the request
    r.send(formData); // send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}
function update() {

    var fname = document.getElementById("fn"); //taking the first name field
    var lname = document.getElementById("ln");//taking the last name field
    var mobile = document.getElementById("m");//taking the mobile field
    var newmail = document.getElementById("e");//taking the email field
    var image = document.getElementById("imguploader");//taking the image field

    var form = new FormData(); //creating new form in js

    form.append("fn", fname.value);// insert first name field value to form
    form.append("ln", lname.value);// insert last name field value to form
    form.append("m", mobile.value);// insert mobile field value to form
    form.append("ne", newmail.value);// insert email field value to form
    form.append("img", image.files[0]);// insert image name to form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            // insert response text into bootstrap alert
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            setTimeout(function () {
                window.location.reload(1); //reload the page after update the profile in 2000 milisecond
                document.getElementById("divprofile").style.display = 'block';
                document.getElementById("divdash").style.display = 'none';
            }, 2000);
        }
    }

    r.open("POST", "updateAdminProfile.php", true); // build the request
    r.send(form); // send the request

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
    changeImg(); //call function changeImg()
}

function saveGrade(id) {

    var s = document.getElementById("s");//taking the grade field

    var form = new FormData(); //creating new form fron js

    form.append("s", s.value); // insert grade field value to form
    form.append("id", id); // insert teacher id came from php side


    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            if (text == "ok") {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Grade Updated</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                setTimeout(function () {
                    window.location.reload(1); //reload the page in 1s
                }, 1000);

                refreshGrade();
            } else {

                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

            }
        }
    }

    r.open("POST", "saveGrade.php", true); // build the request
    r.send(form); // send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function refreshGrade() {
    $("#g1").load(window.location.href + " #g1");
    $("#table").load(window.location.href + " #table");
}

function deleteTS(id) {

    var form = new FormData(); //creating new form in js
    form.append("id", id); // insert teacher id came from php side

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            if (text == "ok") {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Deleted</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                refreshGrade(); // when call this function, it will refresh the table
            } else {
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Couldnt delete</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "deleteSubjectGrade.php", true); // build the request
    r.send(form); // send the request

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}

// when click delete student button, php file send the sudent id aling with it. 
function deleteStudent(id) {

    var form = new FormData(); //creating new form in js

    form.append("id", id); // insert the student id came from php file to the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable
            alert("Student Deleted");
            setTimeout(function () {
                window.location.reload(1); //reload the page in 1s
            }, 1000);
        }
    }
    r.open("POST", "deleteStudent.php", true); // build the request
    r.send(form); //send the request

}

// when click delete teacher button, php file send the teacher id aling with it. 
function deleteTeacher(id) {

    var form = new FormData();//creating new form in js

    form.append("id", id);// insert the student id came from php file to the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            alert("Teacher Deleted");
            setTimeout(function () {
                window.location.reload(1); //reload the page in 1s
            }, 1000);
        }
    }
    r.open("POST", "deleteTeacher.php", true); // build the request
    r.send(form); // send the request
}

// when click delete teacher button, php file send the teacher id aling with it. 
function deleteAc(id) {

    var form = new FormData(); //creating new form in js

    form.append("id", id);// insert the student id came from php file to the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            alert("Academic Officer Deleted");
            setTimeout(function () {
                window.location.reload(1);//reload the page in 1s
            }, 1000);
        }
    }

    r.open("POST", "deleteAc.php", true);// build the request
    r.send(form); // send the request
}
function openTask() {


    document.getElementById("offcanvasBottom").style.display = "none";
    document.getElementById("secondoffcanvas").style.display = "block";


}
function addTask() {
    var t = document.getElementById("task"); //taking the task field

    if (!t.value) { //check if task is empty
        var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Please enter a task</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
    } else { //task is typed

        var form = new FormData(); //creating new form from js

        form.append("task", t.value); //insert the task to form

        var r = new XMLHttpRequest(); // ajax request object

        r.onreadystatechange = function () {
            if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

                var text = r.responseText; // assign the respond to a variable

                if (text == 1) {

                    setTimeout(taskId, 2000, "p"); //call the function taskId in 2s. when calling, send the value "p"
                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Task added succesfuly</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';

                    setTimeout(refreshTask, 5200); //call the function refreshTask in 5.2s

                } else {
                    var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong></strong> ' + text + ' <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                }
            }
        }

        r.open("POST", "addTask.php", true); // build the request
        r.send(form); // send the request
    }
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}

function refreshTask() {
    $("#taskTable").load(window.location.href + " #taskTable"); // refresh the task table
    document.getElementById("task").value = " "; //empty the value of task field
}

function taskId(id) {
    // when adding a new task, this function will call from addTask function with value "p". then if block will run
    if (id == "p") {

        var t = document.getElementById("task"); //taking the task field
        var ao = document.getElementById("ao"); //taking the officer name field
        var form = new FormData(); //creating new form from js

        form.append("task", t.value); //insert the task to form
        form.append("ao", ao.value); //insert the officer name to form
        form.append("n", 1); //insert integer 1 to form

        var r = new XMLHttpRequest(); // ajax request object

        r.onreadystatechange = function () {
            if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

                var text = r.responseText; // assign the respond to a variable
                setTimeout(refreshTask, 1200); //call the function refreshTask in 1.2s
            }
        }

        r.open("POST", "addAoTask.php", true); // build the request
        r.send(form); // send the request
    } else {
        // when changing the officer for specific task, this function will call from php file with the value of task id.then else block will run
        var ao = document.getElementById("of"); //taking the officer name field

        var form = new FormData();//creating new form from js

        form.append("task", id);  //insert the task id coming from php side to form
        form.append("ao", ao.value); //insert the oficer name to form
        form.append("n", 2); //insert integer 2 to form

        var r = new XMLHttpRequest(); // ajax request object

        r.onreadystatechange = function () {
            if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

                var text = r.responseText; // assign the respond to a variable
                var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>Task updated succesfuly</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                setTimeout(refreshTask, 1200); //call the function refreshTask in 1.2s
            }
        }

        r.open("POST", "addAoTask.php", true); // build the request
        r.send(form); // send the request
    }

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

}

function viewMarks() {

    var g = document.getElementById("grade").value;

    window.location = "adminViewMarks.php?gid=" + g;
}
function addteacherSub() {

    var g = document.getElementById("grade");//taking the grade field
    var s = document.getElementById("sub");//taking the subject field
    var t = document.getElementById("tid");//taking the teacher id field

    var form = new FormData(); //creating new form from js

    form.append("g", g.value); //insert grade field value for the form
    form.append("t", t.value);//insert subject field value for the form
    form.append("s", s.value);//insert teacher id field value for the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)
            var text = r.responseText; // assign the respond to a variable

            // bootstrap alert
            var w = document.getElementById("wish").innerHTML = '<div id="message"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>         </svg> <strong>' + text + '</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
        }
    }
    r.open("POST", "teacherSubject.php", true);// build the request
    r.send(form); //send the request along with the form

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function Search() {
    var search = document.getElementById("search"); //taking the grade field

    var form = new FormData();//creating new form from js

    form.append("s", search.value);//insert grade field value for the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            //take the component with table id from php side and insert the results
            document.getElementById("table").innerHTML = text;
        }
    }
    r.open("POST", "searchGrade.php", true);// build the request
    r.send(form);//send request along with form
}
function upgrade(gid) {

    var avg = document.getElementById("avg");//avarage marks field

    var form = new FormData(); //creating new form

    form.append("avg", avg.value); //insert the avarage marks field value to the form
    form.append("gid", gid); //insert the grade to the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            if (text == 1) { //upgrade succeffsull
                setTimeout(function () {
                    window.location.reload(1); //reload the page after 1s
                }, 1000);
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "upgradeGrade.php", true);// build the request
    r.send(form);//send request along with form
}

function fee(gid) {
    var fee = document.getElementById("fee");//fee field

    var form = new FormData();//creating new form

    form.append("fee", fee.value);//insert the fee field value to the form
    form.append("gid", gid);//insert the grade to the form

    var r = new XMLHttpRequest(); // ajax request object

    r.onreadystatechange = function () {
        if (r.readyState == 4) { // ckecking the respond is in stage 4 (came to client side)

            var text = r.responseText; // assign the respond to a variable

            if (text == "") {
                alert("grade updated successfuly")
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "fees.php", true);// build the request
    r.send(form);
}