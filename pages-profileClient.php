<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $sql = "SELECT first_name FROM freelancer WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profile_name = $row["first_name"];
            }
        }
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $linkProfile = "pages-profileFreelancer.php";
        $postJob = "hidden";
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
        $linkProfile = "pages-profileClient.php";
        $postJob = "";
    }
} else {
    $username = "";
}

if (isset($_SESSION["client_profile"])) {
    $client_profile = $_SESSION["client_profile"];
} else {
    $client_profile = "";
}

$sql = "SELECT * FROM client WHERE username='$client_profile' OR username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $profile_photo = $row["profile_photo"];
        $email = $row["email"];
        $contact_no = $row["contact_no"];
        $address = $row["address"];
        $city = $row["city"];
        $state = $row["state"];
        $postcode = $row["postcode"];
        $client_description = $row["client_description"];
        $website = $row["website"];
    }
} else {
}

$sql2 = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE job.c_username='$client_profile' OR job.c_username='$username' ORDER BY date_created DESC";
$result2 = $conn->query($sql2);
$title = array();
$i = 0;
$row_cnt2 = mysqli_num_rows($result2);

if ($result2->num_rows > 0) {
    // output data of each row
    while ($row = $result2->fetch_assoc()) {
        $job_id[$i] = $row["job_id"];
        $title[$i] = $row["title"];
        $job_description[$i] = $row["job_description"];
        $category[$i] = $row["category"];
        $language[$i] = $row["language"];
        $budget[$i] = $row["budget"];
        $budget_type[$i] = $row["budget_type"];
        $location[$i] = $row["location"];
        $location_type[$i] = $row["location_type"];
        $date[$i] = $row["date"];
        $time_start[$i] = $row["time_start"];
        $time_end[$i] = $row["time_end"];
        $date_created[$i] = $row["date_created"];
        $i++;
    }
} else {
};

$sql3 = "SELECT * FROM review JOIN freelancer ON review.f_username=freelancer.username WHERE (c_username='$client_profile' OR c_username='$username') AND review_type='f-c'";
$result3 = $conn->query($sql3);
$rating = array();
$i = 0;
$row_cnt3 = mysqli_num_rows($result3);

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
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

$sql4 = "SELECT * FROM job WHERE (job.c_username='$client_profile' OR job.c_username='$username') AND job.job_status='available'";
$result4 = $conn->query($sql4);
$row_cnt4 = mysqli_num_rows($result4);

$sql5 = "SELECT * FROM job WHERE (job.c_username='$client_profile' OR job.c_username='$username') AND (job.job_status='completed' OR job.job_status='unavailable')";
$result5 = $conn->query($sql5);
$row_cnt5 = mysqli_num_rows($result5);

$sql6 = "SELECT unique_id FROM users WHERE email='$client_profile' OR email='$username'";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) {
    while ($row = $result6->fetch_assoc()) {
        $unique_id = $row["unique_id"];
    }
} else {
}

if (isset($_POST["job_id"])) {
    $_SESSION["job_id"] = $_POST["job_id"];
    $jobID = $_SESSION["job_id"];
    header("location: pages-jobDetails.php?job_id=$jobID");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .overlay {
            margin-top: -90px;
            z-index: 1;
        }

        .cover {
            display: block;
            position: relative;
            overflow: hidden;
            object-fit: cover;
            width: 100%;
            height: 250px;
            object-position: center 50%;
            z-index: 1;
        }

        .cover1 {
            object-fit: cover;
            width: 100%;
            height: 350px;
            object-position: center 50%;
        }

        .cover img {
            max-width: 100%;
            z-index: 1;
        }

        .linkConnect {
            color: black;
        }

        .linkConnect:hover {
            color: #4054D2;
            font-weight: bold;
        }

        .show:hover {
            transform: scale(1.01);
        }

        .btn-circle {
            width: 55px;
            height: 55px;
            border-radius: 100px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION["Username"])) {
        include "sidebar/sidebar.php";
        himeSidebar($linkDashboard, $linkSearch, $linkProfile, $textSearch, $postJob, $profile_name);
    } else {
        include "sidebar/sidebar2.php";
        himeSidebar();
    }
    ?>

    <div class="loader mx-auto my-auto">
        <?php
        include "loader/loader.php";
        ?>
    </div>

    <main class="bodyActual" hidden>
        <div class="container-fluid">
            <div class="row">
                <div class="card border-0 px-0">
                    <img src="img/header2.jpg" class="card-img cover1">
                </div>
                <div class="row overlay">
                    <div class="col-2">
                    </div>
                    <div class="col">
                        <div class="card border-0">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img class="img-fluid rounded-circle p-3" src="sidebar/img/face-1.png">
                                    </div>
                                    <div class="col d-flex justify-content-start align-items-center">
                                        <div class="container-fluid">
                                            <div class="col h3 mb-1"><?php echo $first_name ?></div>
                                            <div class="col"><?php echo $city . ', ' . $state ?></div>
                                            <div class="col mt-1"><i class="fa-solid fa-star me-2" style="color:orange"></i>
                                                <?php
                                                if ($result3->num_rows > 0) {
                                                    $avrg = array_sum($rating) / $row_cnt3;
                                                    echo '<span class="fw-semibold">' . $avrg . '</span>';
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                                <span class="text-secondary">/ 5</span>
                                                <span class="text-primary ms-5"><i class="fa-solid fa-link me-2"></i></i> <?php echo $website ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-start">
                                        <button type="button" name="message" class="btn btn-primary px-4" onClick="window.open('message/login.php');"><i class="fa-solid fa-envelope me-3"></i>Message</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="card bg-light border-0">
                                            <div class="card-body px-5">
                                                <div class="row">
                                                    <div class="col text-center border-end">
                                                        <div class="h5"><?php echo $row_cnt2 ?></div>
                                                        <p class="text-secondary mb-0">Job Listed</p>
                                                    </div>
                                                    <div class="col text-center border-end">
                                                        <div class="h5"><?php echo $row_cnt4 ?></div>
                                                        <p class="text-secondary mb-0">Job Opening</p>
                                                    </div>
                                                    <div class="col text-center">
                                                        <div class="h5"><?php echo $row_cnt5 ?></div>
                                                        <p class="text-secondary mb-0">Freelancer Hired</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <?php echo 'Test ID:' . $unique_id ?> -->
                        <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row">
                                    <h5>About Us</h5>
                                    <p class="text-secondary mb-0"><?php echo $client_description ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row mt-5 px-5">
                    <div class="col">
                        <h5>Job</h5>
                        <?php
                        for ($i = 0; $i < count($title); $i++) {
                            echo '<form method="post">
                            <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                            <div class="card show border-0 my-3">
                                <div class="card-header border-0 px-4 text-secondary text-end" style="background-color:#e1e5f2;">
                                '; ?><?php
                                        $now = time();
                                        $your_date = strtotime($date_created[$i]);
                                        $datediff = $now - $your_date;

                                        echo 'Posted ' . round($datediff / (60 * 60 * 24)) . ' days ago';
                                        ?><?php echo '
                                </div>
                                    <div class="card-body">
                                        <div class="row px-4 py-1">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-auto d-flex justify-content-center align-items-center">
                                                        <button type="button" class="btn btn-primary btn-circle"><i class="fa-solid fa-' . mb_substr(lcfirst($title[$i]), 0, 1) . ' fa-lg"></i></button>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <button type="submit" class="btn btn-link text-decoration-none stretched-link text-black border-0 text-start"><h4 class="mb-0">' . $title[$i] . '</h4></button> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                                ' . date("j M Y", strtotime($date[$i])) . '
                                                            </div>
                                                            <div class="col">
                                                                <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                                ' . date("g:i A", strtotime($time_start[$i])) . ' - ' . date("g:i A", strtotime($time_end[$i])) . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 my-auto">
                                                        <div class="h4 text-end mb-0 text-primary fw-semibold">RM ' . $budget[$i] . '</div>
                                                        <p class="text-end mb-0">' . $budget_type[$i] . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>';
                                        }
                                            ?>
                    </div>
                    <div class="col-4">
                        <h4 class="invisible">Rating</h4>
                        <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5>Review <span class="h6 fw-light text-secondary">(<?php echo $row_cnt3 ?>)</span></h5>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-sm bg-success w-100 d-flex justify-content-center align-items-center mx-auto text-white">
                                            <i class="fa-solid fa-star me-3"></i>
                                            <?php
                                            if ($result3->num_rows > 0) {
                                                $avrg = array_sum($rating) / $row_cnt3;
                                                echo $avrg;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </button>
                                    </div>
                                </div>

                                <?php
                                if ($result3->num_rows > 0) {
                                    for ($i = 0; $i < count($rating); $i++) {
                                        echo '<div class="border-top my-4"></div>
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="sidebar/img/face-1.png" class="img-fluid rounded-circle" alt="...">
                                            </div>
                                            <div class="col my-auto">
                                                <div class="fw-semibold">
                                                ' . $reviewf_name[$i] . '
                                                </div>
                                            </div>
                                            <div class="col-auto my-auto">'; ?>
                                        <?php
                                        if ($rating[$i] == 5) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 4.5) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star-half-stroke" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 4) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 3.5) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star-half-stroke" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 3) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 2.5) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star-half-stroke" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 2) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 1.5) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-solid fa-star-half-stroke" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 1) {
                                            echo '<i class="fa-solid fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        } elseif ($rating[$i] == 0.5) {
                                            echo '<i class="fa-solid fa-star-half-stroke" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>
                                                    <i class="fa-regular fa-star" style="color:orange"></i>';
                                        }
                                        ?>
                                <?php echo '
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col">
                                            <p>"' . $feedback[$i] . '"</p>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '';
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>

<script src="loader/loader.js"></script>

</html>