<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
        $postJob = "";
    }
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hime</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background-color: #F8F9FB;
        }

        .bodyActual {
            background-color: #F8F9FB;
        }

        .cover {
            display: block;
            position: relative;
            overflow: hidden;
            object-fit: cover;
            width: 100%;
            height: 450px;
            object-position: center 50%;
        }

        .over {
            z-index: 100;
        }

        .font {
            font-family: "Metal", serif;
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
        <div class="container-fluid bg-white sticky-top">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-5 py-4 row shadow-sm">
                <a href="index.php" class="col">
                    <img src="sidebar/img/fullLogoBlack.png" class="img-fluid" alt="" style="max-width: 18%;">
                </a>
                <ul class="nav col col-md-auto mb-2 justify-content-center mb-md-0">

                    <?php if (isset($_SESSION["Username"])) {
                        echo '<li><a href="' . $linkDashboard . '" class="nav-link px-2 link-dark">Dashboard</a></li>
                    <li><a href="' . $linkSearch . '" class="nav-link px-2 link-dark">' . $textSearch . '</a></li>';
                    } else {
                        echo '<li><a href="index.php" class="nav-link px-2 link-dark">Home</a></li>
                    <li><a href="pages-searchJob.php" class="nav-link px-2 link-dark">Find Job</a></li>
                    <li><a href="pages-searchFreelancer.php" class="nav-link px-2 link-dark">Find Freelancer</a></li>
                    <li><a href="pages-postCert.php" class="nav-link px-2 link-dark">Certificate</a></li>';
                    }
                    ?>
                    
                </ul>

                <div class="col d-grid gap-2 d-flex justify-content-end align-items-center">
                    <?php if (isset($_SESSION["Username"])) {
                        echo '<a href="server-logout.php" class="btn btn-primary px-5">Logout</a>';
                    } else {
                        echo '<a href="pages-login.php" class="btn btn-outline-primary px-5">Login</a>
                        <a href="pages-register.php" class="btn btn-primary px-5">Sign Up</a>';
                    }
                    ?>
                </div>
            </header>
        </div>
        <main>
            <div class="container-fluid bg-dark p-0 m-0">
                <div class="row position-relative p-0 m-0">
                    <img src="img/index2.jpg" class="img-fluid p-0 m-0 cover opacity-50" alt="">
                    <div class="row position-absolute p-0 m-0" style="height: 450px;">
                        <div class="col-2">
                        </div>
                        <div class="col my-auto">
                            <h1 class="fw-semibold text-white" style="font-size:48px;">Match with your favorite </br> job or <span class="font fw-normal" style="font-size:65px;">freelancer</span></h1>
                            <a class="btn btn-primary px-4 py-2 mt-3 shadow" href="pages-register.php" role="button">Become a freelancer</a>
                            <a class="btn btn-light ms-3 px-4 py-2 mt-3 shadow" href="pages-register.php" role="button">Become a client</a>
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-dark text-white p-0 m-0" style="height: 130px;">
                <div class="col-3">
                </div>
                <div class="col text-center fw-semibold my-auto">
                    Trusted By:
                </div>
                <div class="col text-center my-auto">
                    <i class="fa-brands fa-google fa-2xl"></i>
                </div>
                <div class="col text-center my-auto">
                    <i class="fa-brands fa-microsoft fa-2xl"></i>
                </div>
                <div class="col text-center my-auto">
                    <i class="fa-brands fa-linkedin fa-2xl"></i>
                </div>
                <div class="col text-center my-auto">
                    <i class="fa-brands fa-tiktok fa-2xl"></i>
                </div>
                <div class="col-3">
                </div>
            </div>
            <div class="px-4 pt-5 my-5 text-center">
                <h1 class="display-4 fw-bold">Find <span class="text-primary">talent</span> your way</h1>
                <div class="col-lg-6 mx-auto my-5">
                    <p class="fs-5">
                        Work with the largest network of independent professionals and get things done—from quick turnarounds to big transformations.
                    </p>
                </div>
                <div class="overflow-hidden" style="max-height: 30vh;">
                    <div class="container px-5">
                        <img src="img/header.jpg" class="img-fluid rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

<script src="loader/loader.js"></script>

</html>