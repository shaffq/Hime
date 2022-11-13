<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
        $btn = "";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
        $postJob = "";
        $btn = "hidden";
    }
} else {
    $username = "";
    $textSearch = "";
    $linkSearch = "";
    $linkDashboard = "";
    $postJob = "";
    $btn = "hidden";
}

if (isset($_SESSION["job_id"])) {
    $job_id = $_SESSION["job_id"];
} else {
    $job_id = "";
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
        $c_username = $row["c_username"];
        $c_name = $row["first_name"];
        $c_desc = $row["client_description"];
        $c_city = $row["city"];
        $c_state = $row["state"];
        $c_email = $row["email"];
    }
} else {
}

$sql2 = "SELECT * FROM job_application WHERE job_id='$job_id' AND f_username='$username'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $application_status = $row["application_status"];
    }
    if ($application_status == "Applied") {
        $btnApply = "disabled";
    } elseif ($application_status == "Rejected") {
        $btnApply = "";
    }
    $msg = "show";
} else {
    $btnApply = "";
    $msg = "";
}



if (isset($_POST["apply_job"]) && $msg == "") {
    $bid = test_input($_POST["bid"]);
    $message = test_input($_POST["message"]);

    $sql = "INSERT INTO job_application(job_id, f_username, bid, message, application_status) VALUES ('$job_id', '$username', '$bid','$message', 'Applied')";
    $result = $conn->query($sql);
    if ($result == true) {
        $_SESSION["job_id"] = $job_id;
        $_SESSION["job_applied"] = "job_applied";
        header("location: message-success.php");
    }
}

if (isset($_POST["fav"])) {
    $sql = "INSERT INTO freelancer_fav(f_username, job_id) VALUES ('$username', '$job_id')";
    $result = $conn->query($sql);
}

if (isset($_POST["view"])) {
    $_SESSION["client_profile"] = $c_username;
    header("location: pages-profile.php");
}

$sql6 = "SELECT * FROM review JOIN freelancer ON review.f_username=freelancer.username WHERE c_username='$c_username' AND review_type='f-c'";
$result6 = $conn->query($sql6);
$rating = array();
$i = 0;
$cnt_review = mysqli_num_rows($result6);

if ($result6->num_rows > 0) {
    // output data of each row
    while ($row = $result6->fetch_assoc()) {
        $reviewf_username[$i] = $row["f_username"];
        $reviewc_username[$i] = $row["c_username"];
        $rating[$i] = $row["rating"];
        $feedback[$i] = $row["feedback"];
        $review_time[$i] = $row["review_time"];
        $reviewf_name[$i] = $row["first_name"];
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
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (isset($_SESSION["Username"])) {
        include "sidebar/sidebar.php";
        himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob);
    } else {
        include "sidebar/sidebar2.php";
        himeSidebar();
    }
    ?>

    <main class="my-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="row mx-2">
                        <div class="card pt-5 border-0">
                            <img src="sidebar/img/face-1.png" class="card-img-top rounded-circle mx-auto mb-3" style="width:40%;" alt="">
                            <div class="card-body">
                                <h3 class="card-title text-center"><span class="fw-semibold"><?php echo $c_name ?></span></h3>
                                <button type="button" class="btn btn-sm d-flex bg-success justify-content-center align-items-center col-3 mx-auto text-white py-1"><i class="fa-solid fa-star"></i>&nbsp&nbsp
                                    <?php
                                    if ($result6->num_rows > 0) {
                                        $avrg = array_sum($rating) / $cnt_review;
                                        echo $avrg;
                                    } else {
                                        echo '0';
                                    }
                                    ?></button>
                                <p class="card-text text-center mt-4"><?php echo $c_desc ?></p>
                                <div class="row mt-5">
                                    <form method="post">
                                        <input type="hidden" name="c_username" value="<?php echo $c_username; ?>">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-light w-100" name="message">Message</button>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary w-100" name="view">View</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col px-5">
                    <div class="row">
                        <?php if ($msg == "show") {
                            if ($application_status == "Applied") {
                                echo '<div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation me-2"></i> You have already applied for this job. You cannot apply again.                 
                                </div>';
                            } elseif ($application_status == "Rejected") {
                                echo '<div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation me-2"></i> You application have been rejected. You may re-apply if the job is still open for application.                 
                                </div>';
                            }
                        } else {
                        } ?>
                    </div>

                    <div class="row">
                        <div class="card border-0 p-0">
                            <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                                <div class="row">
                                    <div class="col d-flex justify-content-start align-items-center">
                                        Job #<?php echo $job_id ?>
                                    </div>
                                    <div class="col d-flex justify-content-end align-items-center">
                                        <?php
                                        if ($job_status == "available") {
                                            echo '<button type="button" class="btn btn-success btn-sm rounded-pill px-4"><i class="fa-regular fa-circle-dot me-2"></i>Hiring</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-danger btn-sm rounded-pill px-4"><i class="fa-regular fa-circle-dot me-2"></i>Closed</button>';
                                        }
                                        ?>

                                    </div>
                                </div>

                            </div>
                            <div class="card-body py-4 px-4">
                                <div class="row">
                                    <div class="col">
                                        <h2><?php echo $title ?></h2>
                                        <p class="text-secondary mb-0"><?php
                                                                        $now = time();
                                                                        $your_date = strtotime($date_created);
                                                                        $datediff = $now - $your_date;

                                                                        echo 'Posted ' . round($datediff / (60 * 60 * 24)) . ' days ago';
                                                                        ?>
                                        </p>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-center">
                                        <?php
                                        if ($btn == "") {
                                            if ($job_status == "available") {
                                                echo '<button class="btn btn-primary py-2 col-8" type="button" data-bs-toggle="modal" data-bs-target="#applyModal" ' . $btnApply . '>Apply Now</button>
                                                        <form method="post">
                                                            <input type="hidden" name="f_username" value="' . $username . '">
                                                            <input type="hidden" name="job_id" value="' . $job_id . '">
                                                            <button class="btn btn-link py-2 ms-1" type="submit" name="fav">
                                                                <i class="fa-regular fa-heart fa-xl" style="color:red"></i>
                                                            </button>
                                                        </form>';
                                            } else {
                                                echo '';
                                            }
                                        } else {
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-5">
                        <div class="card border-0">
                            <div class="card-body py-4 px-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp;
                                        RM <?php echo $budget . ' ' . $budget_type; ?>
                                    </div>
                                    <div class="col text-center border-start">
                                        <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp;
                                        <?php echo date("j M Y", strtotime($date)); ?>
                                    </div>
                                    <div class="col text-center border-start">
                                        <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp;
                                        <?php echo date("g:i A", strtotime($time_start)) . ' - ' . date("g:i A", strtotime($time_end)); ?>
                                    </div>
                                    <div class="col text-center border-start">
                                        <i class="fa-solid fa-hourglass-half" style="color:red;"></i></i>&nbsp;&nbsp;
                                        <?php echo $duration . ' Hours'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-5">
                        <div class="row">
                            <h4 class="mb-4">Skills And Expertise</h4>
                        </div>
                        <p>
                            <button type="button" class="btn btn-primary rounded-pill px-4"><?php echo $category ?></button>
                            <button type="button" class="btn btn-primary rounded-pill px-4"><?php echo $language ?></button>
                        </p>
                    </div>

                    <div class="my-5">
                        <div class="row">
                            <h4 class="mb-4">Job Description</h4>
                        </div>
                        <div class="card border-0">
                            <div class="card-body">
                                <p class="card-text"><?php echo $job_desc; ?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
</body>

<!-- ApplyModal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                <input type="hidden" name="f_username" value="<?php echo $username; ?>">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="applyModalLabel">Job Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="my-2">
                        <h5>Rate</h5>
                        <p>What pay rate are you offering?</p>
                        <input type="text" class="form-control my-3" name="bid" id="bid" placeholder="">
                    </div>
                    <div class="mt-4">
                        <h5 class="my-3">Message</h5>
                        <textarea class="form-control my-3" name="message" id="message" rows="5"></textarea>
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