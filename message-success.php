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
    $username = "";
    $textSearch = "";
    $linkSearch = "";
    $linkDashboard = "";
    $postJob = "";
}

if (isset($_SESSION["job_id"])) {
    $job_id = $_SESSION["job_id"];
} else {
    $job_id = "";
}

if (isset($_SESSION["job_posted"])) {
    $main = "Job Successfully Posted";
    $sub = "We will inform you about the next information, please sit tight.";
}

if (isset($_SESSION["job_applied"])) {
    $main = "Job Successfully Applied";
    $sub = "We will inform you about the next information, please sit tight.";
}

if (isset($_SESSION["client_payment"])) {
    $main = "Payment Successful";
    $sub = "Hime Guarantee is a feature to protect clients by holding the payment to hired freelancer 
    until the job is marked as completed.Job contract will be generated automatically and will be 
    available in the next 24 hours.";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <style>
        .circle-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            float: left;
            margin: 10px;
        }

        .iconSuccess {
            position: absolute;
            color: #fff;
            font-size: 45px;
            top: 55px;
            left: 50px;
            transform: translate(-50%, -50%);
        }

        .circle {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            padding: 2.5px;
            background-clip: content-box;
            animation: spin 10s linear infinite;
        }

        .circle-wrapper:active .circle {
            animation: spin 2s linear infinite;
        }

        .success {
            background-color: #4BB543;
            border: 2.5px dashed #4BB543;
        }

        @keyframes spin {
            100% {
                transform: rotateZ(360deg);
            }
        }

        .page-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob)
    ?>

    <main>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col mx-auto my-auto">
                <div class="page-wrapper">
                    <div class="circle-wrapper">
                        <div class="success circle"></div>
                        <div class="iconSuccess">
                            <i class="bi bi-check-lg"></i>
                        </div>

                    </div>
                </div>
                <h1 class="fw-semibold text-success text-center mt-5"><?php echo $main ?></h1>
                <p class="text-center"><?php echo $sub ?></p>
                <div class="d-grid gap-2 d-flex justify-content-center align-items-center py-5">
                    <a href="<?php echo $linkDashboard ?>" class="btn btn-secondary px-5 py-3" role="button">Go to Dashboard</a>
                    <a href="<?php echo $linkSearch ?>" class="btn btn-primary px-5 py-3" role="button">Search Other Job</a>
                </div>
            </div>
            <div class="col-3">
            </div>
        </div>

    </main>
</body>

</html>