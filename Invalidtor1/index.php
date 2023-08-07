<?php

require 'conn.php';


if (isset($_POST['save'])) {


    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];



    $insert = "INSERT INTO tbl_invalid (`fname`, `name`, `phone`,`email`) VALUES ('$fname','$lname','$phone','$email')";

    $query = mysqli_query($conn, $insert);

    if ($query) {

        echo "<script>alert('success')</script>";
    } else {
        echo "<script>alert('Failed')</script>";
    }
}


?>


<!doctype html>
<html>

<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <style>
        .errorHeader {
            font-size: 15px;
            color: rgb(237, 70, 70);
            display: none;
            font-weight: bold;
        }
    </style>


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <label for="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstNameInput" name="fname" onchange="firstnameValidate()" placeholder="Firstname">
                        <span id="firstNameIcon"></span>
                        <span id="firstNameInputStatus" class="errorHeader">FirstName Required</span>

                    </div>
                    <div class="form-group has-feedback">
                        <label for="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastNameInput" name="lname" placeholder="Lastname">
                        <span id="lastNameIcon"></span>
                        <span id="lastNameInputStatus" class="errorHeader">LastName Required</span>

                    </div>
                    <div class="form-group has-feedback">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phone" placeholder="PhoneNumber">
                        <span id="phoneIcon"></span>
                        <span id="phoneStatus" class="errorHeader">Phone Required</span>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailInput" name="email" placeholder="Email">
                        <span id="emailIcon"></span>
                        <span id="emailInputStatus" class="errorHeader">Email Required</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="save" class="btn btn-success">Save</button>
                        <button type="submit" class="btn btn-primary">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="script.js"></script>

<script>
    window.onload = function() {

        document.onsubmit = function() {
            return checkForm();
        }
        document.getElementById('lastNameInput').onchange = lastNameValidate;
        document.getElementById('phoneNumber').onchange = phoneValidate;
        document.getElementById('emailInput').onchange = emailValidate;

    }

    function firstnameValidate() {

        var firstnameInput = document.getElementById("firstNameInput");

        if (firstnameInput.value == "") {

            document.getElementById("firstNameInputStatus").style.display = "block";
            firstnameInput.parentNode.className = "form-group has-error has-feedback";
            document.getElementById("firstNameIcon").className = "glyphicon glyphicon-remove form-control-feedback";

            return false;
        } else {

            document.getElementById("firstNameInputStatus").style.display = "none";
            firstnameInput.parentNode.className = "form-group has-success has-feedback";
            document.getElementById('firstNameIcon').className = "glyphicon glyphicon-ok form-control-feedback";
            return true;

        }

    }

    function lastNameValidate() {

        if (lastNameInput.value == "") {
            document.getElementById("lastNameInputStatus").style.display = "block";
            lastNameInput.parentNode.className = "form-group has-error has-feedback";
            document.getElementById('lastNameIcon').className = "glyphicon glyphicon-remove form-control-feedback"

            return false;
        } else {
            document.getElementById("lastNameInputStatus").style.display = "none";
            lastNameInput.parentNode.className = "form-group has-success has-feedback";
            document.getElementById('lastNameIcon').className = "glyphicon glyphicon-ok form-control-feedback";
            return true;
        }

    }

    function phoneValidate() {


        if (phoneNumber.value == "") {

            document.getElementById('phoneStatus').style.display = "block";
            phoneNumber.parentNode.className = "form-group has-error has-feedback"
            document.getElementById('phoneIcon').className = "glyphicon glyphicon-remove form-control-feedback"

            return false

        } else {

            document.getElementById('phoneStatus').style.display = "none";
            phoneNumber.parentNode.className = "form-group has-success has-feedback";
            document.getElementById('phoneIcon').className = "glyphicon glyphicon-ok form-control-feedback";

            return true
        }

    }

    function emailValidate() {

        if (emailInput.value == "") {

            document.getElementById("emailInputStatus").innerHTML = "Email cannot empty!";
            document.getElementById("emailInputStatus").style.display = "block";
            emailInput.parentNode.className = "form-group has-error has-feedback";
            document.getElementById('emailIcon').className = "glyphicon glyphicon-remove form-control-feedback"

            return false;

        } else if (!validEmailAddress(emailInput.value)) {

            document.getElementById('emailInputStatus').innerHTML = "Incorrage address format!";
            document.getElementById('emailInputStatus').style.display = "block";
            emailInput.parentNode.className = "form-group has-warning has-feedback"
            document.getElementById('emailIcon').className = "glyphicon glyphicon-warning-sign form-control-feedback";

            return false;

        } else {

            document.getElementById('emailInputStatus').style.display = 'none'
            emailInput.parentNode.className = "form-group has-success has-feedback";
            document.getElementById('emailIcon').className = "glyphicon glyphicon-ok form-control-feedback"

            return true

        }

    }

    function checkForm() {

        var valid = true

        if (!firstnameValidate()) valid = false;
        if (!lastNameValidate()) valid = false;
        if (!phoneValidate()) valid = false;
        if (!emailValidate()) valid = false;


        return valid;

    }

    function validEmailAddress(email) {

        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        return pattern.test(email);

    }
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->

</html>