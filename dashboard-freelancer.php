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
        $wallet_id = $row["wallet_id"];
        $full_name = $row["full_name"];
        $bank = $row["bank"];
        $account_no = $row["account_no"];
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

$sql7 = "SELECT * FROM freelancer_fav JOIN job ON freelancer_fav.job_id=job.job_id WHERE f_username='$username'";
$result7 = $conn->query($sql7);
$title2 = array();
$i = 0;

if ($result7->num_rows > 0) {
    while ($row = $result7->fetch_assoc()) {
        $job_id2[$i] = $row["job_id"];
        $f_username2[$i] = $row["f_username"];
        $title2[$i] = $row["title"];
        $budget_type2[$i] = $row["budget_type"];
        $date2[$i] = $row["date"];
        $time_start2[$i] = $row["time_start"];
        $time_end2[$i] = $row["time_end"];
        $budget2[$i] = $row["budget"];
        $job_status2[$i] = $row["job_status"];
        $i++;
    }
} else {
}

$sql8 = "SELECT * FROM contract JOIN contract_payment ON contract.payment_id= contract_payment.payment_id JOIN job ON contract.job_id=job.job_id WHERE contract.f_username ='$username'";
$result8 = $conn->query($sql8);
$payment_id = array();
$i = 0;

if ($result8->num_rows > 0) {
    while ($row = $result8->fetch_assoc()) {
        $payment_id[$i] = $row["payment_id"];
        $payment_amount[$i] = $row["payment_amount"];
        $payment_status[$i] = $row["contract_status"];
        $payment_job[$i] = $row["title"];
        $i++;
    }
} else {
}

$sql9 = "SELECT * FROM wallet_transaction JOIN wallet ON wallet_transaction.wallet_id=wallet.wallet_id WHERE wallet.f_username ='$username'";
$result9 = $conn->query($sql9);
$transaction_id = array();
$i = 0;

if ($result9->num_rows > 0) {
    while ($row = $result9->fetch_assoc()) {
        $transaction_id[$i] = $row["transaction_id"];
        $transaction_amount[$i] = $row["amount"];
        $transaction_status[$i] = $row["status"];
        $i++;
    }
} else {
}

if (isset($_POST["view"])) {
    if ($_POST["status"] == "available") {
        $_SESSION["job_id"] = $_POST["view"];
        header("location: pages-jobDetails.php");
    } else {
    }
}

if (isset($_POST["withdraw"])) {
    $wallet_id = test_input($_POST["wallet_id"]);
    $amount = test_input($_POST["amount"]);
    $acc_name = test_input($_POST["acc_name"]);
    $bank = test_input($_POST["bank"]);
    $acc_no = test_input($_POST["acc_no"]);

    $sql10 = "UPDATE wallet SET full_name='$acc_name', bank='$bank', account_no='$acc_no' WHERE wallet_id='$wallet_id'";
    $result10 = $conn->query($sql10);

    $sql11 = "INSERT INTO wallet_transaction (wallet_id, amount, status) VALUES ('$wallet_id', '$amount', 'Requested')";
    $result11 = $conn->query($sql11);

    if ($result == true) {
        header("location: dashboard-freelancer.php");
    }
}

if (isset($_POST["fav"])) {
    $job_id = test_input($_POST["view"]);
    $username = test_input($_POST["f_username"]);

    $sql = "DELETE FROM freelancer_fav WHERE job_id='$job_id' and f_username='$username'";
    $result = $conn->query($sql);

    if ($result == true) {
        header("location: dashboard-freelancer.php");
    }
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
            background-image: linear-gradient(45deg, #0B63F6, #003CC5);
        }

        .card-color1 {
            background: #11998e;
            background: -webkit-linear-gradient(to right, #38ef7d, #11998e);
            background: linear-gradient(to right, #38ef7d, #11998e);
        }

        .card-color2 {
            background-image: radial-gradient(circle 957px at 8.7% 50.5%, rgba(246, 191, 13, 1) 0%, rgba(249, 47, 47, 1) 90%);
        }

        .card-color3 {
            background-image: linear-gradient(134.6deg, rgba(201, 37, 107, 1) 15.4%, rgba(116, 16, 124, 1) 74.7%);
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
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $linkProfile, $textSearch, $postJob, $profile_name);
    ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 class="py-4">Welcome, <span class="text-primary fw-semibold"><?php echo $first_name ?></span></h3>
                    <div class="row">
                        <div class="col">
                            <div class="card card-color1 shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-auto">
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
                            <div class="card card-color2 shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-auto">
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
                            <div class="card card-color3 shadow border-0 p-2">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-auto">
                                            <i class="fa-solid fa-wallet bg-white text-white bg-opacity-25 rounded p-3"></i>
                                        </div>
                                        <div class="col text-white">
                                            <div class="row">RM <?php echo $total_earned ?></div>
                                            <div class="row">Total Earning</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="pt-5 py-4"></i>Jobs</h3>

                    <ul class="nav nav-tabs nav-fill mt-1" id="jobTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="applied-tab" data-bs-toggle="tab" data-bs-target="#applied-tab-pane" type="button" role="tab" aria-controls="applied-tab-pane" aria-selected="false">Applied</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="hired-tab" data-bs-toggle="tab" data-bs-target="#hired-tab-pane" type="button" role="tab" aria-controls="hired-tab-pane" aria-selected="false">In Progress</button>
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
                                                echo '<button type="button" class="btn btn-primary btn-sm rounded-pill my-2 px-4"><i class="fa-solid fa-paper-plane me-2"></i>' . $application_status[$i] . '' . '</button>';
                                            } elseif ($application_status[$i] == 'Hired') {
                                                echo '<button type="button" class="btn btn-warning btn-sm rounded-pill text-white my-2 px-4"><i class="fa-solid fa-hourglass-half me-2"></i>In Progress</button>';
                                            } elseif ($application_status[$i] == 'Rejected') {
                                                echo '<button type="button" class="btn btn-danger btn-sm rounded-pill my-2 px-4"><i class="fa-solid fa-xmark me-2"></i>' . $application_status[$i] . '' . '</button>';
                                            } elseif ($application_status[$i] == 'Completed') {
                                                echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4"><i class="fa-solid fa-check me-2"></i>' . $application_status[$i] . '</button>';
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
                                                echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Paid</button>';
                                            } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                                echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Payment Requested</button>';
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
                                        echo '<div class="my-3 h5"><i class="fa-solid fa-circle-exclamation me-3"></i>No data to display</div>';
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
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill my-2 px-4"><i class="fa-solid fa-paper-plane me-2"></i>' . $application_status[$i] . '</button>';
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
                                                    echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Paid</button>';
                                                } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                                    echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Payment Requested</button>';
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
                                                // if (!$i++) echo '<div class="my-3 h5"><i class="fa-solid fa-circle-exclamation me-3"></i>No data to display</div>';
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
                                        <button type="button" class="btn btn-warning btn-sm rounded-pill text-white my-2 px-4"><i class="fa-solid fa-hourglass-half me-2"></i>In Progress</button>';
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
                                            echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Paid</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                            echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Payment Requested</button>';
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
                                        // if (!$i++) echo '<div class="my-3 h5"><i class="fa-solid fa-circle-exclamation me-3"></i>No data to display</div>';
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
                                        <button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4"><i class="fa-solid fa-check me-2"></i>' . $application_status[$i] . '</button>';
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
                                            echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Paid</button>';
                                        } elseif ($job_idContract == "$job_id[$i]" && $username == "$f_username" && $contract_status == "RequestCompleted") {
                                            echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fa-solid fa-dollar-sign me-2"></i>Payment Requested</button>';
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
                                        // if (!$i++) echo '<div class="my-3 h5"><i class="fa-solid fa-circle-exclamation me-3"></i>No data to display</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <h3 class="mt-5"><i class="fa-solid fa-bookmark me-3" style="color:#f28482"></i> Favorites</h3>

                    <div class="row">
                        <div class="col">
                            <?php
                            if ($result7->num_rows > 0) {
                                for ($i = 0; $i < count($title2); $i++) {
                                    echo '<form action="dashboard-freelancer.php" method="post">
                                            <input type="hidden" name="view" value="' . $job_id2[$i] . '">
                                            <input type="hidden" name="f_username" value="' . $f_username2[$i] . '">
                                            <input type="hidden" name="status" value="' . $job_status2[$i] . '">
                                            <div class="card zoom1 border-0 my-3">
                                            <div class="card-header border-0 px-4 py-3" style="background-color:#e1e5f2;">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="submit" name="fav" class="btn" style="background-color:#f28482" ><i class="fa-solid fa-bookmark" style="color:#fff"></i></button>
                                                    </div>'; ?>

                                    <?php
                                    if ($job_status2[$i] == "available") {
                                        echo '<div class="col text-end">
                                        <button type="button" class="btn btn-success btn-sm rounded-pill px-4 col"><i class="fa-regular fa-circle-dot me-2"></i>Hiring</button>
                                        </div>';
                                    } else {
                                        echo '<div class="col text-end">
                                        <button type="button" class="btn btn-danger btn-sm rounded-pill px-4 col"><i class="fa-regular fa-circle-dot me-2"></i>Closed</button>
                                        </div>';
                                    }
                                    ?>

                                    <?php echo '
                                    </div>
                                            </div>
                                            <div class="card-body py-4 px-4">
                                                <div class="row">
                                                    <div class="col-5">'; ?>

                                    <?php
                                    if ($job_status2[$i] == "available") {
                                        echo '<button type="submit" class="btn btn-link text-decoration-none stretched-link p-0 text-black">' . $title2[$i] . '   </button>';
                                    } else {
                                        echo  $title2[$i];
                                    }
                                    ?>
                            <?php echo '                                                                    
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-coins" style="color:#ffc107;"></i>&nbsp;&nbsp
                                                    ' . 'RM ' . $budget2[$i] . ' ' . $budget_type[$i] . '                                          
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-calendar" style="color:#0d6efd;"></i>&nbsp;&nbsp
                                                    ' . date("j M Y", strtotime($date2[$i])) . '                                          
                                                    </div>
                                                    <div class="col text-center border-start">
                                                    <i class="fa-solid fa-clock" style="color:#198754;"></i>&nbsp;&nbsp
                                                    ' . date("g:i A", strtotime($time_start2[$i])) . ' - ' . date("g:i A", strtotime($time_end2[$i])) . '                                           
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
                <div class="col-3">
                    <h3 class="py-4 invisible">Profile</h3>
                    <div class="row mx-2">
                        <div class="card py-4 border-0">
                            <img src="sidebar/img/face-1.png" class="card-img-top rounded-circle mx-auto" style="width:40%;" alt="">
                            <div class="card-body">
                                <h3 class="card-title text-center"><span class="fw-semibold"><?php echo $first_name ?></span></h3>
                                <button type="button" class="btn btn-sm d-flex bg-success justify-content-center align-items-center col-4 mx-auto text-white py-1">
                                    <i class="fa-solid fa-star me-2"></i>
                                    <?php
                                    if ($result6->num_rows > 0) {
                                        $avrg = array_sum($rating) / $cnt_review;
                                        echo $avrg;
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </button>
                                <p class="card-text text-center mt-4"><?php echo $bio ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 mt-3">
                        <div class="card card-gradient py-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row border-bottom pb-3">
                                    <div class="card-title "><span class="text-white"><i class="fa-solid fa-wallet me-3"></i>Your Wallet</span></div>
                                    <h2 class="card-text text-white">RM <?php echo $balance ?></h2>
                                </div>
                                <div class="row pt-3">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-light btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#transactionModal"><i class="fa-solid fa-landmark"></i></button>
                                        <p class="text-white mb-0">Transaction</p>
                                    </div>
                                    <div class="col border-start text-center">
                                        <button type="button" class="btn btn-light btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#withdrawModal"><i class="fa-solid fa-money-bill-transfer"></i></button>
                                        <p class="text-white mb-0">Withdraw</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 mx-3 my-2">
                <h5 class="modal-title border-0" id="transactionModalLabel">Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">
                <div class="card border-0 p-4">
                    <div class="card-body">
                        <h4 class="mb-4">Job Transaction</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Job</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                if ($result8->num_rows > 0) {
                                    for ($i = 0; $i < count($payment_id); $i++) {
                                        echo '
                                    <tbody>
                                    <tr>
                                        <td scope="row">' . $payment_id[$i] . '</td>
                                        <td>RM ' . $payment_amount[$i] . '</td>
                                        <td>' . $payment_job[$i] . '</td>
                                        <td>'; ?> <?php if ($payment_status[$i] == "Completed") {
                                                        echo '<span class="text-success fw-semibold">Payment Received</span>';
                                                    } elseif ($payment_status[$i] == "Active") {
                                                        echo '<span class="text-danger fw-semibold">Job not Completed</span>';
                                                    } elseif ($payment_status[$i] == "RequestCompleted") {
                                                        echo '<span class="text-warning fw-semibold">Payment Requested</span>';
                                                    } ?> <?php echo '</td>                            
                                    </tr>
                                    </tbody>';
                                                        }
                                                    } else {
                                                        echo '
                                                        <tbody>
                                                            <tr>
                                                            <td scope="row" class="text-danger fw-semibold">No Transaction</td>
                                                            </tr>
                                                        </tbody>';
                                                    }
                                                            ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 p-4">
                    <div class="card-body">
                        <h4 class="mb-4">Withdrawn</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>


                                <?php
                                if ($result9->num_rows > 0) {
                                    for ($i = 0; $i < count($transaction_id); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td scope="row">' . $transaction_id[$i] . '</td>
                                            <td>RM ' . $transaction_amount[$i] . '</td>
                                            <td>'; ?> <?php if ($transaction_status[$i] == "Approved") {
                                                            echo '<span class="text-success fw-semibold">Withdrawal Completed</span>';
                                                        } elseif ($transaction_status[$i] == "Requested") {
                                                            echo '<span class="text-warning fw-semibold">Withdrawal Requested</span>';
                                                        } ?> <?php echo '</td>                            
                                        </tr>
                                        </tbody>';
                                                            }
                                                        } else {
                                                            echo '
                                    <tbody>
                                        <tr>
                                        <td scope="row" class="text-danger fw-semibold">No Transaction</td>
                                        </tr>
                                    </tbody>';
                                                        }




                                                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <input type="hidden" name="wallet_id" value="<?php echo $wallet_id; ?>">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="withdrawModalLabel">Withdraw</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="my-2">
                        <h5>Amount</h5>
                        <input type="text" class="form-control my-3" name="amount" id="amount" placeholder="">
                    </div>
                    <div class="mt-4">
                        <h5 class="my-3">Bank Details</h5>
                        <p>Bank Account Holder Full Name</p>
                        <input type="text" class="form-control my-3" name="acc_name" id="acc_name" placeholder="" value="<?php echo $full_name ?>">
                        <p>Bank</p>
                        <select class="form-select my-3" name="bank" id="bank" aria-label="Default select example">
                            <option <?php if ($bank == "") echo 'selected="selected"'; ?>>Select</option>
                            <option <?php if ($bank == "CIMB Bank Berhad") echo 'selected="selected"'; ?> value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                            <option <?php if ($bank == "Malayan Banking Berhad") echo 'selected="selected"'; ?>value="Malayan Banking Berhad">Malayan Banking Berhad</option>
                            <option <?php if ($bank == "Ambank") echo 'selected="selected"'; ?>value="Ambank">Ambank</option>
                            <option <?php if ($bank == "Citibank Berhad") echo 'selected="selected"'; ?>value="Citibank Berhad">Citibank Berhad</option>
                            <option <?php if ($bank == "RHB Bank Berhad") echo 'selected="selected"'; ?>value="RHB Bank Berhad">RHB Bank Berhad</option>
                            <option <?php if ($bank == "Public Bank Berhad") echo 'selected="selected"'; ?>value="Public Bank Berhad">Public Bank Berhad</option>
                        </select>
                        <p>Account Number</p>
                        <input type="text" class="form-control my-3" name="acc_no" id="acc_no" placeholder="" value="<?php echo $account_no ?>">
                    </div>
                </div>
                <div class="modal-footer border-0 mx-3 mb-3">
                    <button type="submit" class="btn btn-primary py-2 px-3 w-100" name="withdraw">Send Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>