<?php include('server-login.php');

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
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }

        .row {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col p-0 d-flex justify-content-center align-items-center">
                <img src="img/login.png" class="img-fluid" alt="" style="width:100%; height:100%; object-fit:cover; border-radius: 0px 30px 30px 0px;">
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                        <a href="index.php">
                            <img src="sidebar/img/fullLogoBlack.png" style="max-width: 50%;margin-left: 20px; margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col mx-auto my-auto">
                        <main>
                            <form id="loginForm" method="post">

                                <div class="my-4">
                                    <h1 class="fw-bold">Welcome back</h1>
                                    <h1 class="fw-bold"> to<span class="text-primary"> Hime</span></h1>
                                    <h5 class="text-secondary">Sign in to your account below</h5>
                                </div>


                                <?php if ($errorMsg == "Error") {
                                    echo '<div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>&nbsp&nbsp&nbsp&nbspIncorrect username or password
                                  </div>';
                                } else {
                                } ?>

                                <div class="btn-group w-100 my-4">
                                    <input type="radio" class="btn-check" name="usertype" id="option1" autocomplete="off" value="freelancer" />
                                    <label class="btn btn-outline-primary w-50" for="option1">Freelancer</label>
                                    <input type="radio" class="btn-check" name="usertype" id="option2" autocomplete="off" value="client" />
                                    <label class="btn btn-outline-primary w-50" for="option2">Client</label>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>

                                <div class="my-4">
                                    <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                                </div>


                                <p class="text-muted text-center" style="font-size: small;">
                                    Don't have an account yet? <a href="pages-register.php">Sign Up</a>.
                                </p>
                            </form>
                        </main>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>