function sendemail() {

    var e = document.getElementById("e");//taking the email field
    var f = new FormData();//creating new form from js
    f.append("e", e.value);//insert email field value for the form

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = this.responseText;// assign the respond to a variable

            if (text == 1) { //email sent
                // bootrtarp alert
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Email sent</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                document.getElementById("e").value = " "; //empty the email field

            } else { //error
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + ' </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "teacherVerifyEmail.php", true);// build the request
    r.send(f);//send request along with form

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
function sendemailo() {
    var e = document.getElementById("eo");//taking the email field
    var f = new FormData();//creating new form from js
    f.append("e", e.value);//insert email field value for the form

    var r = new XMLHttpRequest();// ajax request object
    r.onreadystatechange = function () {
        if (r.readyState == 4) {// ckecking the respond is in stage 4 (came to client side)

            var text = this.responseText;// assign the respond to a variable

            if (text == 1) {//email sent
                // bootrtarp aler
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>Email sent</strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
                document.getElementById("e").value = " ";//empty the email field

            } else {//error
                var w = document.getElementById("wish").innerHTML = '<div id="message" style=" position: fixed;  top: 0  left: auto;right:auto;width:100%"> <div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%;margin-left:auto;margin-right:auto;height:50px;font-size:15px"> <svg xmlns="http://www.w3.org/2000/svg" id="info-fill"  width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:"> <use xlink:href="#exclamation-triangle-fill"/>         </svg> <strong>' + text + ' </strong> <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button></div> </div>        ';
            }
        }
    }
    r.open("POST", "acOfficerVerifyEmail.php", true);// build the request
    r.send(f);//send request along with form

    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}
