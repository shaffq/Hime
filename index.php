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
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background-color: #F8F9FB;
        }

        .cover {
            display: block;
            position: relative;
            overflow: hidden;
            object-fit: cover;
            width: 100%;
            height: 600px;
            object-position: center 50%;
        }

        .over {
            z-index: 100;
        }
    </style>
</head>

<body>
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
                    <li><a href="pages-searchFreelancer.php" class="nav-link px-2 link-dark">Find Freelancer</a></li>';
                }
                ?>
                <li><a href="faq.php" class="nav-link px-2 link-dark">FAQs</a></li>
                <li><a href="about.php" class="nav-link px-2 link-dark">About</a></li>
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
                <div class="row position-absolute p-0 m-0" style="height: 600px;">
                    <div class="col-2">
                    </div>
                    <div class="col my-auto">
                        <h1 class="fw-semibold text-white">Match with your favorite job or freelancer</h1>
                        <a class="btn btn-primary px-4 py-2 mt-3" href="#" role="button">Become a freelancer</a>
                        <a class="btn btn-light ms-3 px-4 py-2 mt-3" href="#" role="button">Become a client</a>
                    </div>
                    <div class="col">
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-dark text-white p-0 m-0" style="height: 170px;">
            <div class="col my-auto">

            </div>
            <div class="col my-auto">

            </div>
            <div class="col my-auto">

            </div>
        </div>
        <div class="px-4 pt-5 my-5 text-center">
            <h1 class="display-4 fw-bold">Title Here</h1>
            <div class="col-lg-6 mx-auto my-5">
                <p class="fs-5">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
                <div class="container px-5">
                    <img src="img/header.jpg" class="img-fluid rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
                </div>
            </div>
        </div>
    </main>
</body>

</html>