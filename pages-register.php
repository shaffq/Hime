<?php include('server-register.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
    } else {
    }
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }

        .height {
            height: 100vh;
        }
    </style>

</head>

<body>

    <div class="loader">
        <?php
        include "loader/loader.php";
        ?>
    </div>

    <div class="bodyActual" hidden>
        <div class="container-fluid">
            <div class="row height">
                <div class="col">
                    <div class="row height">
                        <div class="col-3">
                            <a href="index.php">
                                <img src="sidebar/img/fullLogoBlack.png" style="max-width: 50%;margin-left: 20px; margin-top: 20px;">
                            </a>
                        </div>
                        <div class="col mx-auto my-auto">
                            <main>
                                <form id="registrationForm" method="post" class="row g-3">

                                    <div class="my-4">
                                        <h1 class="fw-bold">Create an account<span class="text-primary"> .</span></h1>
                                        <h4 class="text-secondary">It's free and easy</h4>
                                    </div>

                                    <?php if ($errorMsg2 == "Error") {
                                        echo '<div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>&nbsp&nbsp&nbsp&nbspUsername has been taken
                                  </div>';
                                    } else {
                                    } ?>

                                    <div>Register as: </div>

                                    <div class="btn-group w-100 mb-4">
                                        <input type="radio" class="btn-check" name="usertype" id="option1" autocomplete="off" value="freelancer" required/>
                                        <label class="btn btn-outline-primary w-50" for="option1">Freelancer</label>
                                        <input type="radio" class="btn-check" name="usertype" id="option2" autocomplete="off" value="client" required/>
                                        <label class="btn btn-outline-primary w-50" for="option2">Client</label>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                                            </div>
                                            <div class="col">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                    </div>

                                    <div id="message" style="display: none;">
                                        <div class="col-12">
                                            <button id="letter" type="button" class="btn btn-sm btn-light col mt-2 rounded-pill px-3">Lower-case</button>
                                            <button id="capital" type="button" class="btn btn-sm btn-light col mt-2 rounded-pill px-3">Upper-case</button>
                                            <button id="number" type="button" class="btn btn-sm btn-light col mt-2 rounded-pill px-3">Number</button>
                                            <button id="length" type="button" class="btn btn-sm btn-light col mt-2 rounded-pill px-3">More than 8 characters</button>
                                        </div>
                                    </div>

                                    <!-- <div class="col-12">
                                        <label for="repassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="repassword" id="repassword">
                                    </div> -->

                                    <div class="my-4">
                                        <button class="btn btn-primary w-100" type="submit" name="register">Sign Up</button>
                                    </div>

                                    <p class="text-muted text-center" style="font-size: small;">
                                        Do you already have an account? <a href="pages-login.php">Login</a>.
                                    </p>

                                </form>
                            </main>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
                <div class="col p-0 d-flex justify-content-center align-items-center">
                    <img src="img/register.jpg" class="img-fluid" alt="" style="width:100%; height:100%; object-fit:cover; border-radius: 30px 0px 0px 30px;">
                </div>
            </div>
        </div>
    </div>


    <script>
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("btn-light");
                letter.classList.add("btn-success");
            } else {
                letter.classList.remove("btn-success");
                letter.classList.add("btn-light");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("btn-light");
                capital.classList.add("btn-success");
            } else {
                capital.classList.remove("btn-success");
                capital.classList.add("btn-light");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("btn-light");
                number.classList.add("btn-success");
            } else {
                number.classList.remove("btn-success");
                number.classList.add("btn-light");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("btn-light");
                length.classList.add("btn-success");
            } else {
                length.classList.remove("btn-success");
                length.classList.add("btn-light");
            }
        }
    </script>
    <script src="loader/loader.js"></script>

</body>

</html>