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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hime V2</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob)
    ?>

    <main>



        <div class="row">
            <div class="col">
                <a href="index.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Homepage</a>
                <a href="pages-login.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Login</a>
                <a href="server-logout.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Logout</a>
                <a href="pages-register.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Register</a>
                <a href="pages-registerClient2.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Register Client 2</a>
                <a href="pages-registerFreelancer2.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Register Freelancer 2</a>
                <a href="pages-registerFreelancer3.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Register Freelancer 3</a>
                <a href="pages-registerFreelancer4.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Register Freelancer 4</a>
            </div>
            <div class="col">
                <a href="dashboard-client.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Dashboard Client</a>
                <a href="dashboard-freelancer.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Dashboard Freelancer</a>
            </div>
            <div class="col">
                <a href="pages-profile.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Profile</a>
                <p class="text-danger">*Client Profile</p>
                <a href="pages-message.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Message</a>
                <a href="pages-setting.php" class="btn btn-warning mb-1 w-100" role="button" data-bs-toggle="button">Setting</a>
            </div>
            <div class="col">
                <a href="pages-searchJob.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Search Job</a>
                <a href="pages-searchFreelancer.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Search Freelancer</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <a href="pages-postJob.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Post Job</a>
                <a href="pages-postCert.php" class="btn btn-danger mb-1 w-100" role="button" data-bs-toggle="button">Post Certificate</a>
            </div>
            <div class="col">
                <a href="pages-jobDetails.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Job Details</a>
                <a href="pages-jobDetailsClient.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Job Details Client</a>
                <a href="pages-jobDetailsHired.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Job Details Hired</a>
            </div>
            <div class="col">
                <a href="message-success.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Success</a>
                <a href="message-failed.php" class="btn btn-danger mb-1 w-100" role="button" data-bs-toggle="button">Failed</a>
            </div>
            <div class="col">
                <a href="pages-review.php" class="btn btn-primary mb-1 w-100" role="button" data-bs-toggle="button">Review</a>
            </div>
        </div>

    </main>
</body>

</html>