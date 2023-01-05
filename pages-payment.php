<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        header("location: index.php");
    } else {
        $sql = "SELECT first_name FROM client WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profile_name = $row["first_name"];
            }
        }
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
        $linkProfile = "pages-profileCLient.php";
        $postJob = "";
    }
} else {
    header("location: index.php");
}

if (isset($_SESSION["application_id"])) {
    $application_id = $_SESSION["application_id"];
} else {
    $application_id = "";
}


$sql = "SELECT * FROM job_application JOIN freelancer ON job_application.f_username=freelancer.username JOIN job ON job_application.job_id=job.job_id WHERE job_application.application_id='$application_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $application_id = $row["application_id"];
        $job_id = $row["job_id"];
        $f_username = $row["f_username"];
        $bid = $row["bid"];
        $message = $row["message"];
        $application_status = $row["application_status"];

        $first_name = $row["first_name"];
        $last_name = $row["last_name"];

        $c_username = $row["c_username"];
        $title = $row["title"];
        $job_desc = $row["job_description"];
        $category = $row["category"];
        $language = $row["language"];
        $budget = $row["budget"];
        $budget_type = $row["budget_type"];
        $location = $row["location"];
        $location_type = $row["location_type"];
        $date = $row["date"];
        $time_start = $row["time_start"];
        $time_end = $row["time_end"];
        $duration = $row["duration"];
        $date_created = $row["date_created"];
        $job_status = $row["job_status"];
    }
} else {
}

if ($budget_type == "Hourly") {
    $totalPayment = $bid * $duration;
} else {
    $totalPayment = $bid;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $linkProfile, $textSearch, $postJob, $profile_name);
    ?>

    <main>
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col my-auto">

                <input type="hidden" name="application_id" id="application_id" value="<?php echo $application_id ?>">
                <input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id ?>">
                <input type="hidden" name="title" id="title" value="<?php echo $title ?>">
                <input type="hidden" name="bid" id="bid" value="<?php echo $bid ?>">
                <input type="hidden" name="total" id="total" value="<?php echo number_format((float)$totalPayment, 2, '.', ''); ?>">
                <input type="hidden" name="f_username" id="f_username" value="<?php echo $f_username ?>">
                <input type="hidden" name="duration" id="duration" value="<?php echo $duration ?>">

                <h3 class="my-3">Summary</h3>

                <div class="row my-2">
                    <div class="row">
                        <div class="col">Job ID</div>
                        <div class="col d-flex justify-content-end">#<?php echo $job_id ?></div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="row">
                        <div class="col">Payment</div>
                        <div class="col d-flex justify-content-end">RM <?php echo $bid ?> <?php if ($budget_type == "Hourly") {
                                                                                                echo ' x ' . $duration . 'Hourly';
                                                                                            } else {
                                                                                                echo '';
                                                                                            } ?></div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="row">
                        <div class="col h2">Total</div>
                        <div class="col h2 d-flex justify-content-end"><span class="text-primary fw-semibold">RM <?php echo number_format((float)$totalPayment, 2, '.', ''); ?></span> </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary my-5 px-5 w-100" id="pay">Approve & Pay</button>

            </div>
            <div class="col-4">
            </div>
        </div>

        <script src="http://js.stripe.com/v3/"></script>
        <script src="js/checkout.js"></script>

    </main>

</body>

</html>