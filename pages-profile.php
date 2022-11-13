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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <style>
        .overlay {
            margin-top: -40px;
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

        #color1 {
            background-color: #F9B93F;
        }

        #color2 {
            background-color: #47DEB1;
        }

        #color3 {
            background-color: #50CBF2;
        }

        #color4 {
            background-color: #F68283;
        }
    </style>
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

    <main>
        <div class="row">
            <div class="col-8">
                <div class="card border-0">
                    <img src="img/header.jpg" class="card-img-top cover" alt="">
                    <div class="card-body" style="background-color:#F8F9FB">
                        <div class="row">
                            <div class="col-2 ml-4 overlay d-flex justify-content-center align-items-center">
                                <img class="img-fluid rounded-circle" src="sidebar/img/face-1.png" alt="">
                            </div>
                            <div class="col d-flex justify-content-start align-items-center">
                                <div class="container-fluid">
                                    <div class="col m-0 h2"><?php echo $first_name . ' ' . $last_name ?></div>
                                    <div class="col"><?php echo $bio ?></div>
                                </div>
                            </div>
                            <div class="col-3 p-0 d-flex justify-content-end align-items-start">
                                <?php if (isset($_SESSION["freelancer_profile"])) {
                                    echo '<button class="btn btn-primary" type="submit" name="message">Message</button>';
                                } else {
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-5">
                    <div class="my-4">
                        <h4>About Me</h4>
                        <p><?php echo $about_me ?></p>
                    </div>

                    <p>
                    <div class="d-grid gap-2">
                        <button class="btn py-4 pl-4 text-start" style="background-color: #fff;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <div class="row">
                                <div class="col">
                                    Work Experience
                                </div>
                                <div class="col-1">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                    </p>
                    <div class="collapse show" id="collapseExample">
                        <div class="card card-body border-0" style="background-color: #F8F9FB;">
                            <h4 class="mb-4">Work Experience</h4>

                            <?php for ($i = 0; $i < count($company); $i++) {
                                echo '
                                <div class="row mb-4">
                                    <div class="col-1 pt-1 d-flex justify-content-center align-items-start">
                                        <button type="button" class="btn btn-primary rounded-pill" style="width: 2rem; height:2rem;">
                                    </div>
                                    <div class="col ml-3">
                                        <div class="h5 row my-0">' . $company[$i] . '</div>
                                        <div class="row text-secondary">' . $position[$i] . '</div>
                                        <div class="row text-secondary">' . $work_start[$i] . ' - ' . $work_end[$i] . '</div>
                                        <div class="row">' . $work_description[$i] . '</div>
                                    </div>
                                </div>
                            ';
                            }
                            ?>

                        </div>
                    </div>

                    <p>
                    <div class="d-grid gap-2">
                        <button class="btn py-4 pl-4 text-start" style="background-color: #fff;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                            <div class="row">
                                <div class="col">
                                    Education
                                </div>
                                <div class="col-1">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                    </p>
                    <div class="collapse show" id="collapseExample2">
                        <div class="card card-body border-0" style="background-color: #F8F9FB;">
                            <h4 class="mb-4">Education</h4>

                            <?php for ($i = 0; $i < count($institute); $i++) {
                                echo '
                            <div class="row mb-4">
                                <div class="col-1 pt-1 d-flex justify-content-center align-items-start">
                                    <button type="button" class="btn btn-primary rounded-pill" style="width: 2rem; height:2rem;">
                                    </button>
                                </div>
                                <div class="col ml-3">
                                    <div class="h5 row my-0">' . $institute[$i] . '</div>
                                    <div class="row text-secondary">' . $specialization[$i] . '</div>
                                    <div class="row text-secondary">' . $edu_start[$i] . ' - ' . $edu_end[$i] . '</div>
                                    <div class="row">' . $edu_description[$i] . '</div>
                                </div>
                            </div>
                            ';
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col mx-3">
                <div class="card border-0 px-4 py-2 mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Location</h5>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="col">
                                <?php echo $city . ', ' . $state ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 px-4 py-2 mb-3">
                    <div class="card-body">
                        <h5 class="mb-1">Languages & Skills</h5>
                        <button class="btn btn-primary btn-sm px-3 mt-2"><?php echo $languages ?></button>
                        <button class="btn btn-primary btn-sm px-3 mt-2"><?php echo $skills ?></button>
                    </div>
                </div>

                <div class="card border-0 px-4 py-2 mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Cerification</h5>
                        <div class="row mb-2">
                            <div class="col-1">
                                <i class="bi bi-patch-check-fill" style="color: blue;"></i>
                            </div>
                            <div class="col">
                                CAP (Cerification Analytics Professional)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 px-4 py-2 mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Connect</h5>
                        <div class="row linkConnect mb-2" role="button" onclick="window.open('<?php echo $linkedin; ?>')">
                            <div class="col-1">
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="col">
                                Website
                            </div>
                        </div>
                        <div class="row linkConnect mb-2" role="button" onclick="window.open('<?php echo $facebook; ?>')">
                            <div class="col-1">
                                <i class="bi bi-facebook"></i>
                            </div>
                            <div class="col">
                                Facebook
                            </div>
                        </div>
                        <div class="row linkConnect mb-2" role="button" onclick="window.open('<?php echo $instagram; ?>')">
                            <div class="col-1">
                                <i class="bi bi-instagram"></i>
                            </div>
                            <div class="col">
                                Instagram
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 px-4 py-2">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <h5>Review <span class="h6 fw-light text-secondary">(<?php echo $row_cnt5 ?>)</span></h5>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-sm w-100 d-flex justify-content-center align-items-center mx-auto text-white" style="background-color: #47DEB1;">
                                    <i class="bi bi-star"></i>&nbsp
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
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>';
                            } elseif ($rating[$i] == 4.5) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-half" style="color:orange"></i>';
                            } elseif ($rating[$i] == 4) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 3.5) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-half" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 3) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 2.5) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-half" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 2) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 1.5) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star-half" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 1) {
                                echo '<i class="bi bi-star-fill" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            } elseif ($rating[$i] == 0.5) {
                                echo '<i class="bi bi-star-half" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>
                                <i class="bi bi-star" style="color:orange"></i>';
                            }
                            ?>
                    </div>
                <?php echo '
                        </div>
                        <p class="mt-3">"' . $feedback[$i] . '"</p>';
                        }
                ?>
                </div>
            </div>
        </div>
        </div>
    </main>

</body>

</html>