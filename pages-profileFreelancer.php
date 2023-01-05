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

if (isset($_SESSION["freelancer_profile"])) {
    $freelancer_profile = $_SESSION["freelancer_profile"];
} else {
    $freelancer_profile = "";
}

$sql = "SELECT * FROM freelancer WHERE username='$freelancer_profile' OR username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $profile_photo = $row["profile_photo"];
        $email = $row["email"];
        $contact_no = $row["contact_no"];
        $birthdate = $row["birthdate"];
        $gender = $row["gender"];
        $address = $row["address"];
        $city = $row["city"];
        $state = $row["state"];
        $postcode = $row["postcode"];
        $bio = $row["bio"];
        $about_me = $row["about_me"];
        $skills = $row["skills"];
        $languages = $row["languages"];
        $service = $row["service"];
    }
} else {
}

$sql2 = "SELECT * FROM freelancer_edu WHERE f_username='$freelancer_profile' OR f_username='$username'";
$result2 = $conn->query($sql2);
$institute = array();
$i = 0;

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $institute[$i] = $row["institute"];
        $specialization[$i] = $row["specialization"];
        $edu_description[$i] = $row["description"];
        $edu_start[$i] = $row["start_date"];
        $edu_end[$i] = $row["end_date"];
        $i++;
    }
} else {
}

$sql3 = "SELECT * FROM freelancer_work WHERE f_username='$freelancer_profile' OR f_username='$username'";
$result3 = $conn->query($sql3);
$company = array();
$i = 0;

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $company[$i] = $row["company"];
        $position[$i] = $row["position"];
        $work_description[$i] = $row["description"];
        $work_start[$i] = $row["start_date"];
        $work_end[$i] = $row["end_date"];
        $i++;
    }
} else {
}

$sql4 = "SELECT * FROM freelancer_social WHERE f_username='$freelancer_profile' OR f_username='$username'";
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        $instagram = $row["instagram"];
        $linkedin = $row["linkedin"];
        $facebook = $row["facebook"];
    }
} else {
}

$sql5 = "SELECT * FROM review JOIN client ON review.c_username=client.username WHERE (f_username='$freelancer_profile' OR f_username='$username') AND review_type='c-f'";
$result5 = $conn->query($sql5);
$rating = array();
$i = 0;
$row_cnt5 = mysqli_num_rows($result5);

if ($result5->num_rows > 0) {
    while ($row = $result5->fetch_assoc()) {
        $reviewf_username[$i] = $row["f_username"];
        $reviewc_username[$i] = $row["c_username"];
        $rating[$i] = $row["rating"];
        $feedback[$i] = $row["feedback"];
        $review_time[$i] = $row["review_time"];
        $reviewc_name[$i] = $row["first_name"];
        $i++;
    }
} else {
}

$sql6 = "SELECT * FROM contract WHERE (f_username='$freelancer_profile' OR f_username='$username') AND contract_status='Completed'";
$result6 = $conn->query($sql6);
$row_cnt6 = mysqli_num_rows($result6);

$sql7 = "SELECT unique_id FROM users WHERE email='$freelancer_profile' OR email='$username'";
$result7 = $conn->query($sql7);
if ($result7->num_rows > 0) {
    while ($row = $result7->fetch_assoc()) {
        $unique_id = $row["unique_id"];
    }
} else {
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
                                            <div class="col h3 mb-1"><?php echo $first_name . ' ' .  $last_name ?></div>
                                            <div class="col"><?php echo $city . ', ' . $state ?></div>
                                            <div class="col mt-1"><i class="fa-solid fa-star me-2" style="color:orange"></i>
                                                <?php
                                                if ($result5->num_rows > 0) {
                                                    $avrg = array_sum($rating) / $row_cnt5;
                                                    echo '<span class="fw-semibold">' . $avrg . '</span>';
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                                <span class="text-secondary">/ 5</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-start">
                                        <button type="button" class="btn btn-primary px-4" onClick="window.open('message/login.php');"><i class="fa-solid fa-envelope me-3"></i>Message</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="card bg-light border-0">
                                            <div class="card-body px-5">
                                                <div class="row">
                                                    <div class="col text-center border-end">
                                                        <div class="h5"><?php echo $row_cnt6 ?></div>
                                                        <p class="text-secondary mb-0">Job Completed</p>
                                                    </div>
                                                    <div class="col text-center border-end">
                                                        <div class="h5"><?php echo $row_cnt5 ?></div>
                                                        <p class="text-secondary mb-0">Review</p>
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
                                    <h5>About Me</h5>
                                    <p class="text-secondary mb-0"><?php echo $about_me ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row mt-5 px-5">
                    <div class="col">
                        <h5>Education</h5>
                        <?php for ($i = 0; $i < count($institute); $i++) {
                            echo '<div class="card border-0 mt-3">
                                <div class="card-body">
                                    <div class="row p-4">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary btn-circle"><i class="fa-solid fa-graduation-cap"></i></button>
                                        </div>
                                        <div class="col ms-3">
                                            <div class="h5 row">' . $institute[$i] . '</div>
                                            <div class="row text-secondary">' . $specialization[$i] . '</div>
                                            <div class="row text-secondary">' . $edu_start[$i] . ' - ' . $edu_end[$i] . '</div>
                                            <div class="row">' . $edu_description[$i] . '</div>
                                        </div>
                                    </div>
                                </div>
                              </div>';
                        }
                        ?>

                        <h5 class="mt-5">Work Experience</h5>
                        <?php for ($i = 0; $i < count($company); $i++) {
                            echo '<div class="card border-0 mt-3">
                                <div class="card-body">
                                    <div class="row p-4">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary btn-circle"><i class="fa-solid fa-briefcase"></i></button>
                                        </div>
                                        <div class="col ms-3">
                                            <div class="h5 row">' . $company[$i] . '</div>
                                            <div class="row text-secondary">' . $position[$i] . '</div>
                                            <div class="row text-secondary">' . $work_start[$i] . ' - ' . $work_end[$i] . '</div>
                                            <div class="row">' . $work_description[$i] . '</div>
                                        </div>
                                    </div>
                                </div>
                              </div>';
                        }
                        ?>


                    </div>
                    <div class="col-4">
                        <h4 class="invisible">Rating</h4>
                        <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-3">Connect</h5>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col linkConnect border-end" role="button" onclick="window.open('<?php echo $linkedin; ?>')">
                                        <i class="fa-solid fa-link me-3"></i>Website
                                    </div>
                                    <div class="col linkConnect border-end" role="button" onclick="window.open('<?php echo $facebook; ?>')">
                                        <i class="fa-brands fa-facebook me-3"></i></i>Facebook
                                    </div>
                                    <div class="col linkConnect" role="button" onclick="window.open('<?php echo $instagram; ?>')">
                                        <i class="fa-brands fa-instagram me-3"></i></i>Instagram
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-3">Language and Skills</h5>
                                        <button class="btn btn-sm rounded-pill px-3 mt-2 text-white" style="background-color:#f4a261;"><?php echo $languages ?></button>
                                        <button class="btn btn-sm rounded-pill px-3 mt-2 text-white" style="background-color:#2a9d8f;"><?php echo $skills ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col">
                                        <h5>Cerification</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <i class="fa-solid fa-certificate" style="color: orange;"></i>
                                    </div>
                                    <div class="col">
                                        CAP (Cerification Analytics Professional)
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="card border-0 mt-3">
                            <div class="card-body p-4">
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5>Review <span class="h6 fw-light text-secondary">(<?php echo $row_cnt5 ?>)</span></h5>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-sm bg-success w-100 d-flex justify-content-center align-items-center mx-auto text-white">
                                            <i class="fa-solid fa-star me-3"></i>
                                            <?php
                                            if ($result5->num_rows > 0) {
                                                $avrg = array_sum($rating) / $row_cnt5;
                                                echo $avrg;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </button>
                                    </div>
                                </div>
                                <?php

                                if ($result5->num_rows > 0) {

                                    for ($i = 0; $i < count($rating); $i++) {
                                        echo '<div class="border-top my-4"></div>
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="sidebar/img/face-1.png" class="img-fluid rounded-circle" alt="...">
                                            </div>
                                            <div class="col my-auto">
                                                <div class="fw-semibold">
                                                ' . $reviewc_name[$i] . '
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
                                } ?>

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