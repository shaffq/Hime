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

if (isset($_POST["application_id"])) {
    $_SESSION["application_id"] = $_POST["application_id"];
    header("location: pages-payment.php");
}

if (isset($_POST["view"])) {
    $_SESSION["job_id"] = $job_id;
    header("location: pages-jobDetails.php");
}

$sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE job_id='$job_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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

        $c_firstname = $row["first_name"];
        $c_lastname = $row["last_name"];
        $c_desc = $row["client_description"];
        $c_city = $row["city"];
        $c_state = $row["state"];
        $c_email = $row["email"];
    }
} else {
}

$sql2 = "SELECT * FROM job_application JOIN freelancer ON job_application.f_username=freelancer.username WHERE job_application.job_id='$job_id' AND job_application.application_status='Applied'";
$result2 = $conn->query($sql2);
$row_cnt = mysqli_num_rows($result2);
$f_username = array();
$i = 0;

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $application_id[$i] = $row["application_id"];
        $first_name[$i] = $row["first_name"];
        $last_name[$i] = $row["last_name"];
        $f_username[$i] = $row["f_username"];
        $bid[$i] = $row["bid"];
        $message[$i] = $row["message"];
        $application_status[$i] = $row["application_status"];
        $i++;
    }
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
    <style>
        .btn-circle {
            width: 45px;
            height: 45px;
            border-radius: 100px;
        }
    </style>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob)
    ?>

    <main class="my-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card zoom1 border-0">
                        <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                            Job #<?php echo $job_id ?>
                        </div>
                        <div class="card-body py-4 px-4">
                            <h3><?php echo $title ?></h3>
                        </div>
                    </div>
                    <div class="card mt-3 py-2 border-0">
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-auto d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-primary btn-circle mx-2"><i class="fa-solid fa-pen"></i></button><span class="mx-4 fw-semibold text-primary">Offer</span><i class="fa-solid fa-chevron-right mx-4"></i>
                                </div>
                                <div class="col-auto d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-outline-secondary btn-circle mx-2"><i class="fa-solid fa-wallet"></i></button><span class="mx-4 text-secondary">Confirmation & Deposit</span><i class="fa-solid fa-chevron-right mx-4"></i>
                                </div>
                                <div class="col-auto d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-outline-secondary btn-circle mx-2"><i class="fa-solid fa-hourglass-half"></i></button><span class="mx-4 text-secondary">In progress</span><i class="fa-solid fa-chevron-right mx-4"></i>
                                </div>
                                <div class="col-auto d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-outline-secondary btn-circle mx-2"><i class="fa-solid fa-star"></i></button><span class="mx-4 text-secondary">Review</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="row">
                            <div class="mb-4"><span class="h4 align-bottom">Job Application</span><button type="button" class="btn btn-primary ms-3"><?php echo $row_cnt ?></button></div>
                        </div>

                        <div class="card border-0">
                            <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                                <div class="row py-2">
                                    <div class="col fw-semibold my-auto mx-auto">
                                        Freelancer
                                    </div>
                                    <div class="col-1 my-auto">
                                    </div>
                                    <div class="col fw-semibold my-auto">
                                        Bid
                                    </div>
                                    <div class="col my-auto invisible">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0">
                                <?php
                                if ($result2->num_rows > 0) {
                                    for ($i = 0; $i < count($f_username); $i++) {
                                        echo ' <form action="pages-jobDetailsClient.php" method="post">
                                    <input type="hidden" name="application_id" value="' . $application_id[$i] . '">
                                        <div class="row py-3">
                                            <div class="col-1 my-auto mx-auto">
                                                <img class="img-fluid rounded-circle" src="sidebar/img/face-1.png" alt="">
                                            </div>
                                            <div class="col my-auto">
                                                ' . $first_name[$i] . '
                                            </div>
                                            <div class="col my-auto">
                                                RM ' . $bid[$i] . '
                                            </div>
                                            <div class="col-auto my-auto ">
                                                <button type="submit" class="btn btn-primary px-5">Review</button>
                                                <button type="button" class="btn btn-outline-primary px-4">Message</button>
                                                <button type="button" class="btn"><i class="fa-solid fa-xmark fa-xl"></i></i></button>
                                            </div>
                                        </div>                              
                                    </form>
                                    ';
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card border-0 p-4 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="mb-3">Job Details</h5>
                            </div>
                            <div class="row">
                                <div class="col-2 d-flex justify-content-start align-items-center">
                                    Status
                                </div>
                                <div class="col d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4"><i class="fa-regular fa-circle-dot me-2"></i>Hiring</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2 d-flex justify-content-start align-items-center">
                                    Date
                                </div>
                                <div class="col d-flex justify-content-end align-items-center">
                                    <i class="fa-solid fa-calendar mx-3" style="color:#0d6efd;"></i>
                                    <?php echo date("j M Y", strtotime($date)) ?>
                                </div>
                            </div>
                            <div class="row mt-2 mb-4">
                                <div class="col-2 d-flex justify-content-start align-items-center">
                                    Time
                                </div>
                                <div class="col d-flex justify-content-end align-items-center">
                                    <i class="fa-solid fa-clock mx-3" style="color:#198754;"></i>
                                    <?php echo date("g:i A", strtotime($time_start)) . ' - ' . date("g:i A", strtotime($time_end)) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<div class="modal fade" id="jobVisibility" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                <input type="hidden" name="f_username" value="<?php echo $username; ?>">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="applyModalLabel">Job Visibility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div>
                </div>
                <div class="modal-footer border-0 mx-3 mb-3">
                    <button type="submit" class="btn btn-primary py-2 px-3 w-100" name="apply_job">Send Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>