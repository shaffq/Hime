<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
        $btn = "hidden";
        $completeText = "Request Payment";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
        $postJob = "";
        $btn = "";
        $completeText = "Release Payment";
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

if (isset($_POST["job_instruction"])) {
    $job_id = test_input($_POST["job_id"]);
    $instruction = test_input($_POST["instruction"]);

    $sql = "UPDATE job SET job_instruction='$instruction' WHERE job_id='$job_id'";
    $result = $conn->query($sql);
}

if (isset($_POST["review"]) && $_SESSION["Usertype"] == 1) {
    $job_id = test_input($_POST["job_id"]);
    $f_username = test_input($_POST["f_username"]);
    $c_username = test_input($_POST["c_username"]);
    $rating = test_input($_POST["rating"]);
    $feedback = test_input($_POST["feedback"]);

    $sql = "INSERT INTO review(job_id, f_username, c_username, review_type, rating, feedback) VALUES ('$job_id', '$f_username', '$c_username', 'f-c', '$rating', '$feedback')";
    $result = $conn->query($sql);
} elseif (isset($_POST["review"]) && $_SESSION["Usertype"] == 2) {
    $job_id = test_input($_POST["job_id"]);
    $f_username = test_input($_POST["f_username"]);
    $c_username = test_input($_POST["c_username"]);
    $rating = test_input($_POST["rating"]);
    $feedback = test_input($_POST["feedback"]);

    $sql = "INSERT INTO review(job_id, f_username, c_username, review_type, rating, feedback) VALUES ('$job_id', '$f_username', '$c_username', 'c-f', '$rating', '$feedback')";
    $result = $conn->query($sql);
}

$sql = "SELECT * FROM contract JOIN job ON contract.job_id=job.job_id JOIN freelancer ON contract.f_username=freelancer.username JOIN contract_payment ON contract.payment_id=contract_payment.payment_id WHERE contract.job_id='$job_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $f_username = $row["f_username"];
        $contract_status = $row["contract_status"];

        $title = $row["title"];
        $job_desc = $row["job_description"];
        $job_instruction = $row["job_instruction"];
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

        $f_firstname = $row["first_name"];
        $c_username = $row["c_username"];

        $payment_amount = $row["payment_amount"];
    }
} else {
}

$sql2 = "SELECT * FROM client WHERE username='$c_username'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $c_firstname = $row["first_name"];
    }
} else {
}

if (isset($_POST["job_complete"]) && $_SESSION["Usertype"] == 2) {
    $sql = "UPDATE job SET job_status='completed' WHERE job_id='$job_id'";
    $result = $conn->query($sql);

    $sql2 = "SELECT * FROM wallet WHERE f_username='$f_username'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $total_earned = $row["total_earned"];
            $balance = $row["balance"];
        }
    } else {
    }

    $newTotal = $total_earned + $payment_amount;
    $newBalance = $balance + $payment_amount;

    $sql3 = "UPDATE wallet SET total_earned='$newTotal', balance='$newBalance' WHERE f_username='$f_username'";
    $result3 = $conn->query($sql3);

    $sql4 = "UPDATE job_application SET application_status='Completed' WHERE job_id='$job_id' AND f_username='$f_username'";
    $result4 = $conn->query($sql4);

    $sql5 = "UPDATE contract SET contract_status='Completed' WHERE job_id='$job_id' AND f_username='$f_username'";
    $result5 = $conn->query($sql5);
    header("location: pages-jobDetailsHired.php");
} elseif (isset($_POST["job_complete"]) && $_SESSION["Usertype"] == 1) {
    $sql = "UPDATE contract SET contract_status='RequestCompleted' WHERE job_id='$job_id' AND f_username='$f_username'";
    $result = $conn->query($sql);
    header("location: pages-jobDetailsHired.php");
}

if ($_SESSION["Usertype"] == 1) {
    $sql3 = "SELECT * FROM review WHERE job_id='$job_id' AND review_type='f-c'";
    $result3 = $conn->query($sql3);
} elseif ($_SESSION["Usertype"] == 2) {
    $sql3 = "SELECT * FROM review WHERE job_id='$job_id' AND review_type='c-f'";
    $result3 = $conn->query($sql3);
}

$sql6 = "SELECT * FROM review WHERE f_username='$f_username' AND review_type='c-f'";
$result6 = $conn->query($sql6);
$rating = array();
$i = 0;
$cnt_review = mysqli_num_rows($result6);

if ($result6->num_rows > 0) {
    // output data of each row
    while ($row = $result6->fetch_assoc()) {
        $rating[$i] = $row["rating"];
        $i++;
    }
} else {
}

$sql7 = "SELECT * FROM review WHERE c_username='$c_username' AND review_type='f-c'";
$result7 = $conn->query($sql7);
$rating2 = array();
$x = 0;
$cnt_review2 = mysqli_num_rows($result7);

if ($result7->num_rows > 0) {
    // output data of each row
    while ($row = $result7->fetch_assoc()) {
        $rating2[$x] = $row["rating"];
        $x++;
    }
} else {
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>

    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        .rating {
            border: none;
            float: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label:before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating>.half:before {
            content: "\f089";
            position: absolute;
        }

        .rating>label {
            color: #ddd;
            float: right;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #fd7e14;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #fd7e14;
        }

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
                                    <button type="button" class="btn btn-success btn-circle mx-2"><i class="fa-solid fa-pen"></i></button><span class="mx-4 fw-semibold">Offer</span><i class="fa-solid fa-chevron-right mx-4"></i>
                                </div>
                                <div class="col-auto  d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn btn-success btn-circle mx-2"><i class="fa-solid fa-wallet"></i></button><span class="mx-4 fw-semibold">Confirmation & Deposit</span><i class="fa-solid fa-chevron-right mx-4"></i>
                                </div>
                                <div class="col-auto  d-flex justify-content-start align-items-center">
                                    <?php if ($job_status == "completed") {
                                        echo '<button type="button" class="btn btn-success btn-circle mx-2"><i class="fa-solid fa-hourglass-half"></i></button><span class="mx-4 fw-semibold">In progress</span><i class="fa-solid fa-chevron-right mx-4"></i>';
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-primary btn-circle mx-2"><i class="fa-solid fa-hourglass-half"></i></button><span class="mx-4 fw-semibold text-primary">In progress</span><i class="fa-solid fa-chevron-right mx-4"></i>';
                                    }
                                    ?>
                                </div>
                                <div class="col-auto  d-flex justify-content-start align-items-center">
                                    <?php
                                    if ($job_status == "completed") {
                                        if ($result3->num_rows > 0) {
                                            echo '<button type="button" class="btn btn-success btn-circle mx-2"><i class="fa-solid fa-star"></i></button><span class="mx-4 fw-semibold">Review</span>';
                                        } else {
                                            echo '<button type="button" class="btn btn-primary btn-circle mx-2"><i class="fa-solid fa-star"></i></button><span class="mx-4 fw-semibold text-primary">Review</span>';
                                        }
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-outline-secondary btn-circle mx-2"><i class="fa-solid fa-star"></i></button><span class="mx-4 text-secondary">Review</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="row">
                            <div class="col">
                                <h4 class="mb-4">Job Instruction</h4>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary btn-sm " type="button" data-bs-toggle="modal" data-bs-target="#editModal" <?php echo $btn ?>><i class="fa-solid fa-pen-to-square"></i>&nbsp&nbspEdit</a>
                            </div>
                        </div>

                        <div class="card border-0">
                            <div class="card-body">
                                <p class="card-text"><?php if ($job_instruction == '') {
                                                            echo "No Information";
                                                        } else {
                                                            echo $job_instruction;
                                                        } ?>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="my-5">
                        <div class="row">
                            <div class="col">
                                <h4>Attached Files</h4>
                                <p>Files and assets that have been attached to this project.</p>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary btn-sm" type="button" <?php echo $btn ?>><i class="fa-solid fa-plus"></i>&nbsp&nbspUpload File</a>
                            </div>
                        </div>

                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">File Name</th>
                                    <th scope="col">File Size</th>
                                    <th scope="col">Date Uploaded</th>
                                    <th scope="col">Uploaded By</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="border-bottom">
                                    <td class="align-middle">
                                        <div class="row">
                                            <div class="col-auto my-auto">
                                                <i class="fa-solid fa-file-pdf h3" style="color:red;"></i>
                                            </div>
                                            <div class="col my-auto fw-semibold p-0 m-0">
                                                Program Tentative.pdf
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">200KB</td>
                                    <td class="align-middle">Jan 4,2022</td>
                                    <td class="align-middle">Jane</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="align-middle">
                                        <div class="row">
                                            <div class="col-auto my-auto">
                                                <i class="fa-solid fa-file-pdf h3" style="color:red;"></i>
                                            </div>
                                            <div class="col my-auto fw-semibold p-0 m-0">
                                                Handbook.pdf
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">1.5MB</td>
                                    <td class="align-middle">Jan 5,2022</td>
                                    <td class="align-middle">Jane</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card border-0 p-4 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="mb-3">Job Details</h5>
                            </div>
                            <div class="row">
                                <div class="col-1 d-flex justify-content-start align-items-center">
                                    Status
                                </div>
                                <div class="col d-flex justify-content-end align-items-center">
                                    <?php if ($job_status == "completed") {
                                        echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white my-2 px-4">Completed</button>';
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-warning btn-sm rounded-pill text-white my-2 px-4">In-Progress</button>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end align-items-center">
                                    <?php

                                    $sql8 = "SELECT * FROM contract WHERE job_id='$job_id'";
                                    $result8 = $conn->query($sql8);

                                    if ($result8->num_rows > 0) {
                                        while ($row = $result8->fetch_assoc()) {
                                            $contract_status = $row["contract_status"];
                                        }
                                    }

                                    if ($contract_status == "Completed") {
                                        echo '<button type="button" class="btn btn-success btn-sm rounded-pill text-white px-4">Paid</button>';
                                    } elseif ($contract_status == "RequestCompleted") {
                                        echo '<button type="button" class="btn btn-primary btn-sm rounded-pill px-4">Payment Requested</button>';
                                    } elseif ($contract_status == "Active") {
                                        echo '';
                                    } else {
                                        echo '';
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 d-flex justify-content-start align-items-center">
                                    Payment
                                </div>
                                <div class="col d-flex justify-content-end align-items-center">
                                    <i class="fa-solid fa-coins mx-3" style="color:#ffc107;"></i>
                                    <?php echo 'RM ' . $payment_amount ?>
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
                            <?php
                            date_default_timezone_set("Asia/Kuala_Lumpur");
                            $date_now = date("Y-m-d");

                            if ($_SESSION["Usertype"] == 2) {
                                if ($date_now >= $date) {
                                    if ($job_status == "completed") {
                                        echo '';
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-primary mb-1 px-5 w-100" data-bs-toggle="modal" data-bs-target="#completeModal">Job is Completed</button>';
                                    }

                                    if ($job_status == "completed") {
                                        if ($result3->num_rows > 0) {
                                            echo '';
                                        } else {
                                            echo '<button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal">Leave a Review</button>';
                                        }
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal" disabled>Leave a Review</button>';
                                    }
                                } else {
                                    echo '<button type="button" class="btn btn-primary px-5 w-100" data-bs-toggle="modal" data-bs-target="#completeModal" disabled>Job is Completed</button>
                                        <button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal" disabled>Leave a Review</button>';
                                }
                            } elseif ($_SESSION["Usertype"] == 1) {
                                if ($date_now >= $date) {
                                    if ($contract_status == "RequestCompleted" or $contract_status == "Completed") {
                                        echo '';
                                    } elseif ($contract_status == "Active") {
                                        echo '<button type="button" class="btn btn-primary mb-1 px-5 w-100" data-bs-toggle="modal" data-bs-target="#completeModal">Job is Completed</button>';
                                    }

                                    if ($job_status == "completed") {
                                        if ($result3->num_rows > 0) {
                                            echo '';
                                        } else {
                                            echo '<button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal">Leave a Review</button>';
                                        }
                                    } elseif ($job_status == "unavailable") {
                                        echo '<button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal" disabled>Leave a Review</button>';
                                    }
                                } else {
                                    echo '<button type="button" class="btn btn-primary px-5 w-100" data-bs-toggle="modal" data-bs-target="#completeModal" disabled>Job is Completed</button>
                                        <button type="button" class="btn btn-secondary px-5 w-100" data-bs-toggle="modal" data-bs-target="#reviewModal" disabled>Leave a Review</button>';
                                }
                            }


                            ?>

                        </div>
                    </div>
                    <div class="card border-0 px-4 py-2 mb-3">
                        <div class="card-body">
                            <h5 class="mb-3">Client</h5>
                            <div class="row">
                                <div class="col-2 p-0 mx-2 my-auto">
                                    <img class="img-fluid rounded-circle p-0" src="sidebar/img/face-1.png" alt="">
                                </div>
                                <div class="col ms-3 my-auto">
                                    <div class="row">
                                        <?php echo $c_firstname ?>
                                    </div>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="col-auto p-0">
                                            <i class="fa-solid fa-star" style="color:orange"></i>
                                        </div>
                                        <div class="col text-secondary">
                                            <?php
                                            if ($result7->num_rows > 0) {
                                                $avrg2 = array_sum($rating2) / $cnt_review2;
                                                echo $avrg2;
                                            } else {
                                                echo '0';
                                            }
                                            echo ' (' . $cnt_review2 . ')'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <form method="post">
                                    <input type="hidden" name="c_username" value="<?php echo $c_username; ?>">
                                    <div class="row">
                                        <div class="col p-1">
                                            <button type="submit" class="btn btn-light w-100" name="message">Message</button>
                                        </div>
                                        <div class="col p-1">
                                            <button type="submit" class="btn btn-primary w-100" name="view">View</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 px-4 py-2 mb-3">
                        <div class="card-body">
                            <h5 class="mb-3">Freelancer</h5>
                            <div class="row">
                                <div class="col-2 p-0 mx-2 my-auto">
                                    <img class="img-fluid rounded-circle p-0" src="sidebar/img/face-1.png" alt="">
                                </div>
                                <div class="col ms-3 my-auto">
                                    <div class="row">
                                        <?php echo $f_firstname ?>
                                    </div>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="col-auto p-0">
                                            <i class="fa-solid fa-star" style="color:orange"></i>
                                        </div>
                                        <div class="col text-secondary">
                                            <?php
                                            if ($result6->num_rows > 0) {
                                                $avrg = array_sum($rating) / $cnt_review;
                                                echo $avrg;
                                            } else {
                                                echo '0';
                                            }
                                            echo ' (' . $cnt_review . ')'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <form method="post">
                                    <input type="hidden" name="c_username" value="<?php echo $f_username; ?>">
                                    <div class="row">
                                        <div class="col p-1">
                                            <button type="submit" class="btn btn-light w-100" name="message">Message</button>
                                        </div>
                                        <div class="col p-1">
                                            <button type="submit" class="btn btn-primary w-100" name="view">View</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>


<div class="modal fade" id="completeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="applyModalLabel">Job Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col-auto">
                            <div class="row">
                                <img class="img-fluid rounded-circle mx-auto my-2" src="sidebar/img/face-1.png" alt="" style="height:100px; width:auto;">
                            </div>
                            <div class="row">
                                <div class="text-center"><?php echo $c_firstname ?></div>
                            </div>
                            <div class="row">
                                <div class="h1 text-center my-3">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>
                            </div>
                            <div class="row">
                                <img class="img-fluid rounded-circle mx-auto my-2" src="sidebar/img/face-1.png" alt="" style="height:100px; width:auto;">
                            </div>
                            <div class="row">
                                <div class="text-center"><?php echo $f_firstname ?></div>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 mx-3 mb-3">
                    <button type="submit" class="btn btn-primary py-2 px-3 w-100" name="job_complete"><?php echo $completeText ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="applyModalLabel">Job Instruction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <h5 class="my-3">Instructions</h5>
                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                    <textarea class="form-control my-3" name="instruction" id="instruction" rows="10"><?php if ($job_instruction == '') {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo $job_instruction;
                                                                                                        } ?></textarea>
                </div>
                <div class="modal-footer border-0 mx-3 mb-3">
                    <button type="submit" class="btn btn-primary py-2 px-3 w-100" name="job_instruction">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form method="post">
                <div class="modal-header border-0 mx-3 my-2">
                    <h5 class="modal-title border-0" id="applyModalLabel">Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-3">
                    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                    <input type="hidden" name="f_username" value="<?php echo $f_username; ?>">
                    <input type="hidden" name="c_username" value="<?php echo $c_username; ?>">

                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col-auto">
                            <div class="row">
                                <img class="img-fluid rounded-circle mx-auto my-2" src="sidebar/img/face-1.png" alt="" style="height:100px; width:auto;">
                            </div>
                            <div class="row mt-2">
                                <?php
                                if ($_SESSION["Usertype"] == 1) {
                                    echo '<div class="text-center">' . $c_firstname . '</div>';
                                } elseif ($_SESSION["Usertype"] == 2) {
                                    echo '<div class="text-center">' . $f_firstname . '</div>';
                                }
                                ?>
                            </div>
                            <div class="row h3 my-4">
                                <div class="col-auto mx-auto">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="my-3">Leave a feedback</h5>
                                <textarea class="form-control" name="feedback" id="feedback" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 mx-3 mb-3">
                    <button type="submit" class="btn btn-primary py-2 px-3 w-100" name="review">Leave a Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>