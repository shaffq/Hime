<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
    } else {
        header("location: index.php");
    }
} else {
    $username = "";
    header("location: index.php");
}

$sql = "SELECT * FROM job_application JOIN job ON job_application.job_id=job.job_id WHERE f_username='$username'";
$result = $conn->query($sql);
$title = array();
$i = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $job_id[$i] = $row["job_id"];
        $title[$i] = $row["title"];
        $budget_type[$i] = $row["budget_type"];
        $date[$i] = $row["date"];
        $time_start[$i] = $row["time_start"];
        $time_end[$i] = $row["time_end"];
        $bid[$i] = $row["bid"];
        $application_status[$i] = $row["application_status"];
        $i++;
    }
} else {
}

$sql2 = "SELECT * FROM freelancer WHERE username='$username'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $bio = $row["bio"];
    }
} else {
    echo "";
}

$sql3 = "SELECT * FROM wallet WHERE f_username='$username'";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $total_earned = $row["total_earned"];
        $balance = $row["balance"];
        $withdrawn = $row["withdrawn"];
    }
} else {
}

$sql4 = "SELECT * FROM contract WHERE f_username='$username' AND contract_status='Completed'";
$result4 = $conn->query($sql4);
$cnt_jobCompleted = mysqli_num_rows($result4);

$sql5 = "SELECT * FROM contract WHERE f_username='$username' AND contract_status='Active'";
$result5 = $conn->query($sql5);
$cnt_jobActive = mysqli_num_rows($result5);

if (isset($_POST["job_id"])) {
    if ($_POST["application_status"] == "Applied") {
        $_SESSION["job_id"] = $_POST["job_id"];
        header("location: pages-jobDetails.php");
    } elseif ($_POST["application_status"] == "Hired") {
        $_SESSION["job_id"] = $_POST["job_id"];
        header("location: pages-jobDetailsHired.php");
    } elseif ($_POST["application_status"] == "Rejected") {
        $_SESSION["job_id"] = $_POST["job_id"];
        header("location: pages-jobDetails.php");
    } elseif ($_POST["application_status"] == "Completed") {
        $_SESSION["job_id"] = $_POST["job_id"];
        header("location: pages-jobDetailsHired.php");
    }
}

$sql6 = "SELECT * FROM review JOIN client ON review.c_username=client.username WHERE f_username='$username' AND review_type='c-f'";
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>

    <style>
        .nav-link {
            color: #9FA0AB;
            border: none !important;
        }

        .nav-link.active {
            background: transparent !important;
            color: #4054D2 !important;
            border-bottom: 2px solid #4054D2 !important;
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            font-weight: 600;
        }

        .nav-link:hover {
            border-color: #F8F9FB !important;
            font-weight: bold;
            font-weight: 600;
        }

        .nav-link.active:hover {
            background: transparent !important;
            color: #4054D2 !important;
            border-bottom: 2px solid #4054D2 !important;
            border-top: 0px;
            border-right: 0px;
            border-left: 0px;
            font-weight: 600;
        }

        .zoom1:hover {
            transform: scale(1.02);
        }

        .card-gradient {
            background-image: linear-gradient(45deg, #7D6AE7, #0D6EFD);

        }
    </style>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob)
    ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 class="py-4">Dashboard</h3>
                    <div class="row">
                        <div class="col">
                            <div class="card bg-primary shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-3">
                                            <i class="fa-solid fa-list-check bg-white text-white bg-opacity-25 rounded p-3"></i>
                                        </div>
                                        <div class="col text-white">
                                            <div class="row"><?php echo $cnt_jobCompleted ?></div>
                                            <div class="row">Job Completed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-3">
                                            <i class="fa-solid fa-spinner bg-white text-white bg-opacity-25 rounded p-3"></i>
                                        </div>
                                        <div class="col text-white">
                                            <div class="row"><?php echo $cnt_jobActive ?></div>
                                            <div class="row">Job In Progress</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-danger shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-3">
                                            <i class="fa-solid fa-wallet bg-white text-white bg-opacity-25 rounded p-3"></i>
                                        </div>
                                        <div class="col text-white">
                                            <div class="row">RM <?php echo $total_earned ?></div>
                                            <div class="row">Money Earned</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="pt-5 py-4">Jobs</h4>

                    <ul class="nav nav-tabs nav-fill mt-1" id="jobTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="applied-tab" data-bs-toggle="tab" data-bs-target="#applied-tab-pane" type="button" role="tab" aria-controls="applied-tab-pane" aria-selected="false">Applied</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hired-tab" data-bs-toggle="tab" data-bs-target="#hired-tab-pane" type="button" role="tab" aria-controls="hired-tab-pane" aria-selected="false">Hired</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-1" id="jobTabContent">
                        <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
                            <div class="row">
                                <div class="col">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < count($title); $i++) {
                                            echo '<form action="dashboard-freelancer.php" method="post">
                                            <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                                            <input type="hidden" name="application_status" value="' . $application_status[$i] . '">
                                            <div class="card zoom1 border-0 my-3">
                                            <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">'; ?>

                                            <?php if ($application_status[$i] == 'Applied') {
                                                echo '<button type="button" class="btn btn-primary btn-sm rounded-pill my-2 px-4">' . $application_status[$i] . '' . '</button>';
                                            } elseif ($application_status[$i] == 'Hired') {
                                                echo '<button type="button" class="btn btn-warning btn-sm rounded-pill text-white my-2 px-4">' . $application_status[$i] . '' . '</button>';
                                            } elseif ($application_status[$i] == 'Rejected') {
                                                echo '<button type="button" class="btn btn-danger btn-sm rounded-pill my-2 px-4">' . $application_status[$i] . '' . '</button>';
                                            } elseif ($application_status[$i] == 'Completed') {
                                                echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4">' . $application_status[$i] . '<i class="fa-solid fa-check ms-2"></i>' . '</button>';
                                            } ?>

                                            <?php

                                            $sql7 = "SELECT * FROM contract WHERE job_id='$job_id[$i]'";
                                            $result7 = $conn->query($sql7);

                                            if ($result7->num_rows > 0) {
                                                while ($row = $result7->fetch_assoc()) {
                                                    $job_idContract = $row["job_id"];
                                                    $f_username = $row["f_username"];
                                                    $contract_status = $row["contract_status"];
                                                }
                                            } else {
                                                $job_idContract = "";
                                            }

                                            if ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Completed") {
                                                echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4">Paid</button>';
                                            } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                                echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Payment Requested</button>';
                                            } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Active") {
                                                echo '';
                                            } else {
                                                echo '';
                                            }

                                            ?>

                                    <?php echo '
                                            </div>
                                            <div class="card-body py-4 px-4">
                                                <div class="row">
                                                    <div class="col-5">                                                
                                                    <button type="submit" class="btn btn-link text-decoration-none stretched-link p-0 text-black">' . $title[$i] . '   </button>                                                                                      
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp
                                                    ' . 'RM ' . $bid[$i] . ' ' . $budget_type[$i] . '                                          
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                    ' . date("j M Y", strtotime($date[$i])) . '                                          
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                    ' . date("g:i A", strtotime($time_start[$i])) . ' - ' . date("g:i A", strtotime($time_end[$i])) . '                                           
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                          </form>';
                                        }
                                    } else {
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="applied-tab-pane" role="tabpanel" aria-labelledby="applied-tab" tabindex="0">
                            <div class="row">
                                <div class="col">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        for ($i = 0; $i < count($title); $i++) {
                                            if ($application_status[$i] == "Applied") {
                                                echo '  <form action="dashboard-freelancer.php" method="post">
                                                <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                                                <input type="hidden" name="application_status" value="' . $application_status[$i] . '">
                                                <div class="card zoom1 border-0 my-3">
                                                <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill my-2 px-4">' . $application_status[$i] . '</button>';
                                    ?>

                                                <?php

                                                $sql7 = "SELECT * FROM contract WHERE job_id='$job_id[$i]'";
                                                $result7 = $conn->query($sql7);

                                                if ($result7->num_rows > 0) {
                                                    while ($row = $result7->fetch_assoc()) {
                                                        $job_idContract = $row["job_id"];
                                                        $f_username = $row["f_username"];
                                                        $contract_status = $row["contract_status"];
                                                    }
                                                }

                                                if ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Completed") {
                                                    echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4">Paid</button>';
                                                } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                                    echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Payment Requested</button>';
                                                } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Active") {
                                                    echo '';
                                                } else {
                                                    echo '';
                                                }

                                                ?>

                                    <?php echo '
                                                </div>
                                                <div class="card-body py-4 px-4">
                                                    <div class="row">
                                                        <div class="col-5">                                                
                                                        <button type="submit" class="btn btn-link text-decoration-none stretched-link p-0 text-black">' . $title[$i] . '   </button>                                                                                      
                                                        </div>
                                                        <div class="col text-center border-start">
                                                        <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp
                                                        ' . 'RM ' . $bid[$i] . ' ' . $budget_type[$i] . '                                          
                                                        </div>
                                                        <div class="col text-center border-start">
                                                        <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                        ' . date("j M Y", strtotime($date[$i])) . '                                          
                                                        </div>
                                                        <div class="col text-center border-start">
                                                        <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                        ' . date("g:i A", strtotime($time_start[$i])) . ' - ' . date("g:i A", strtotime($time_end[$i])) . '                                           
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                              </form>';
                                            } else {
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hired-tab-pane" role="tabpanel" aria-labelledby="hired-tab" tabindex="0">
                            <?php
                            if ($result->num_rows > 0) {
                                for ($i = 0; $i < count($title); $i++) {
                                    if ($application_status[$i] == "Hired") {
                                        echo '  <form action="dashboard-freelancer.php" method="post">
                                        <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                                        <input type="hidden" name="application_status" value="' . $application_status[$i] . '">
                                        <div class="card zoom1 border-0 my-3">
                                        <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                                        <button type="button" class="btn btn-warning btn-sm rounded-pill text-white my-2 px-4">' . $application_status[$i] . '</button>';
                            ?>

                                        <?php

                                        $sql7 = "SELECT * FROM contract WHERE job_id='$job_id[$i]'";
                                        $result7 = $conn->query($sql7);

                                        if ($result7->num_rows > 0) {
                                            while ($row = $result7->fetch_assoc()) {
                                                $job_idContract = $row["job_id"];
                                                $f_username = $row["f_username"];
                                                $contract_status = $row["contract_status"];
                                            }
                                        }

                                        if ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Completed") {
                                            echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4">Paid</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                            echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Payment Requested</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Active") {
                                            echo '';
                                        } else {
                                            echo '';
                                        }

                                        ?>

                            <?php echo '
                                        </div>
                                        <div class="card-body py-4 px-4">
                                            <div class="row">
                                                <div class="col-5">                                                
                                                <button type="submit" class="btn btn-link text-decoration-none stretched-link p-0 text-black">' . $title[$i] . '   </button>                                                                                      
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp
                                                ' . 'RM ' . $bid[$i] . ' ' . $budget_type[$i] . '                                          
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                ' . date("j M Y", strtotime($date[$i])) . '                                          
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                ' . date("g:i A", strtotime($time_start[$i])) . ' - ' . date("g:i A", strtotime($time_end[$i])) . '                                           
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      </form>';
                                    } else {
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
                            <?php
                            if ($result->num_rows > 0) {
                                for ($i = 0; $i < count($title); $i++) {
                                    if ($application_status[$i] == "Completed") {
                                        echo '  <form action="dashboard-freelancer.php" method="post">
                                        <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                                        <input type="hidden" name="application_status" value="' . $application_status[$i] . '">
                                        <div class="card zoom1 border-0 my-3">
                                        <div class="card-header border-0 px-4" style="background-color:#e1e5f2;">
                                        <button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4">' . $application_status[$i] . '<i class="fa-solid fa-check ms-2"></i>' . '</button>';
                            ?>

                                        <?php

                                        $sql7 = "SELECT * FROM contract WHERE job_id='$job_id[$i]'";
                                        $result7 = $conn->query($sql7);

                                        if ($result7->num_rows > 0) {
                                            while ($row = $result7->fetch_assoc()) {
                                                $job_idContract = $row["job_id"];
                                                $f_username = $row["f_username"];
                                                $contract_status = $row["contract_status"];
                                            }
                                        }

                                        if ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Completed") {
                                            echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4">Paid</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                            echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Payment Requested</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "Active") {
                                            echo '';
                                        } else {
                                            echo '';
                                        }

                                        ?>

                            <?php echo '
                                        </div>
                                        <div class="card-body py-4 px-4">
                                            <div class="row">
                                                <div class="col-5">                                                
                                                <button type="submit" class="btn btn-link text-decoration-none stretched-link p-0 text-black">' . $title[$i] . '   </button>                                                                                      
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp
                                                ' . 'RM ' . $bid[$i] . ' ' . $budget_type[$i] . '                                          
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                ' . date("j M Y", strtotime($date[$i])) . '                                          
                                                </div>
                                                <div class="col text-center border-start">
                                                <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                ' . date("g:i A", strtotime($time_start[$i])) . ' - ' . date("g:i A", strtotime($time_end[$i])) . '                                           
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      </form>';
                                    } else {
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="col-3">
                    <h3 class="py-4 invisible">Profile</h3>
                    <div class="row mx-2">
                        <div class="card py-5 border-0">
                            <img src="sidebar/img/face-1.png" class="card-img-top rounded-circle mx-auto mb-3" style="width:40%;" alt="">
                            <div class="card-body">
                                <h3 class="card-title text-center"><span class="fw-semibold"><?php echo $first_name ?></span></h3>
                                <p class="card-text text-center"><?php echo $bio ?></p>
                                <button type="button" class="btn btn-sm d-flex bg-success justify-content-center align-items-center col-3 mx-auto text-white py-1"><i class="fa-solid fa-star"></i>&nbsp&nbsp
                                    <?php
                                    if ($result6->num_rows > 0) {
                                        $avrg = array_sum($rating) / $cnt_review;
                                        echo $avrg;
                                    } else {
                                        echo '0';
                                    }
                                    ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 mt-3">
                        <div class="card card-gradient py-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="card-title "><span class="text-white"><i class="fa-solid fa-wallet me-3"></i>Your Wallet</span></div>
                                <h3 class="card-text text-white">RM 160.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>