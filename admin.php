<?php include('server.php');

unset($_SESSION['freelancer_profile']);
unset($_SESSION['client_profile']);

if (isset($_SESSION["Admin"])) {
} else {
    header("location: index.php");
}

$sql = "SELECT * FROM freelancer";
$result = $conn->query($sql);
$first_nameF = array();
$i = 0;
$row_Freelancer = mysqli_num_rows($result);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $username_freelancer[$i] = $row["username"];
        $first_nameF[$i] = $row["first_name"];
        $emailF[$i] = $row["email"];
        $i++;
    }
} else {
}

$sql2 = "SELECT * FROM client";
$result2 = $conn->query($sql2);
$first_nameC = array();
$i = 0;
$row_Client = mysqli_num_rows($result2);

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $username_client[$i] = $row["username"];
        $first_nameC[$i] = $row["first_name"];
        $emailC[$i] = $row["email"];
        $i++;
    }
} else {
}

$sql3 = "SELECT * FROM job JOIN client ON job.c_username=client.username ORDER BY date_created DESC";
$result3 = $conn->query($sql3);
$title = array();
$i = 0;
$row_Job = mysqli_num_rows($result3);

if ($result3->num_rows > 0) {
    // output data of each row
    while ($row = $result3->fetch_assoc()) {
        $job_id[$i] = $row["job_id"];
        $title[$i] = $row["title"];
        $date_created[$i] = $row["date_created"];
        $first_nameJC[$i] = $row["first_name"];
        $i++;
    }
} else {
}

$sql4 = "SELECT * FROM contract_payment";
$result4 = $conn->query($sql4);
$payment_id = array();
$i = 0;

if ($result4->num_rows > 0) {
    // output data of each row
    while ($row = $result4->fetch_assoc()) {
        $payment_id[$i] = $row["payment_id"];
        $application_id[$i] = $row["application_id"];
        $payment_amount[$i] = $row["payment_amount"];
        $payment_status[$i] = $row["payment_status"];
        $i++;
    }
} else {
}

$sql5 = "SELECT * FROM certificate";
$result5 = $conn->query($sql5);
$cert_name = array();
$i = 0;
$row_Cert = mysqli_num_rows($result5);

if ($result5->num_rows > 0) {
    // output data of each row
    while ($row = $result5->fetch_assoc()) {
        $cert_id[$i] = $row["cert_id"];
        $cert_name[$i] = $row["cert_name"];
        $cert_desc[$i] = $row["cert_desc"];
        $cert_link[$i] = $row["cert_link"];
        $cert_status[$i] = $row["status"];
        $i++;
    }
} else {
}

$sql6 = "SELECT * FROM wallet_transaction JOIN wallet ON wallet_transaction.wallet_id=wallet.wallet_id";
$result6 = $conn->query($sql6);
$transaction_id = array();
$i = 0;
$row_Withdraw = mysqli_num_rows($result6);

if ($result6->num_rows > 0) {
    // output data of each row
    while ($row = $result6->fetch_assoc()) {
        $transaction_id[$i] = $row["transaction_id"];
        $wallet_id[$i] = $row["wallet_id"];
        $full_name[$i] = $row["full_name"];
        $bank[$i] = $row["bank"];
        $account_no[$i] = $row["account_no"];
        $balance[$i] = $row["balance"];
        $withdrawn[$i] = $row["withdrawn"];
        $amount[$i] = $row["amount"];
        $status[$i] = $row["status"];
        $i++;
    }
} else {
}

if (isset($_POST["viewJob"])) {
    $_SESSION["job_id"] = $_POST["job_id"];
    header("location: pages-jobDetails.php");
}

if (isset($_POST["deleteJob"])) {
    $job_id = ($_POST["job_id"]);

    $sql = "SELECT * FROM job_application WHERE job_id='$job_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sql = "DELETE job_application, job FROM job_application INNER JOIN job WHERE job_application.job_id= job.job_id and job_application.job_id = '$job_id'";
        $result = $conn->query($sql);

        if ($result == true) {
            header("location: admin.php");
        }
    } else {
        $sql = "DELETE FROM job WHERE job_id='$job_id'";
        $result = $conn->query($sql);
        if ($result == true) {
            header("location: admin.php");
        }
    }
}

if (isset($_POST["approve"])) {
    $cert_id = test_input($_POST["cert_id"]);
    $sql = "UPDATE certificate SET status='approved' WHERE cert_id='$cert_id'";
    $result = $conn->query($sql);
    if ($result == true) {
        header("location: admin.php");
    }
}

if (isset($_POST["deleteCert"])) {
    $cert_id = test_input($_POST["cert_id"]);
    $sql = "DELETE FROM certificate WHERE cert_id='$cert_id'";
    $result = $conn->query($sql);
    if ($result == true) {
        header("location: admin.php");
    }
}



if (isset($_POST["withdraw"])) {
    $transaction_id = test_input($_POST["transaction_id"]);
    $balance = test_input($_POST["balance"]);
    $withdrawn = test_input($_POST["withdrawn"]);
    $amount = test_input($_POST["amount"]);
    $wallet_id = test_input($_POST["wallet_id"]);

    $newBalance = $balance - $amount;
    $newWithdrawn = $withdrawn + $amount;

    $sql = "UPDATE wallet_transaction SET status='Approved' WHERE transaction_id='$transaction_id'";
    $result = $conn->query($sql);

    if ($result == true) {
        $sql = "UPDATE wallet SET balance='$newBalance', withdrawn='$newWithdrawn' WHERE wallet_id='$wallet_id'";
        $result = $conn->query($sql);
        header("location: admin.php");
    }
}

if (isset($_POST["viewFreelancer"])) {
    $_SESSION["freelancer_profile"] = $_POST["freelancer_profile"];
    header("location: pages-profileFreelancer.php");
}

if (isset($_POST["deleteFreelancer"])) {
    $freelancer_profile = $_POST["freelancer_profile"];
    $sql = "DELETE FROM wallet WHERE f_username='$freelancer_profile'";
    $result = $conn->query($sql);

    $sql2 = "DELETE FROM freelancer_social WHERE f_username='$freelancer_profile'";
    $result2 = $conn->query($sql2);

    $sql3 = "DELETE FROM freelancer WHERE username='$freelancer_profile'";
    $result3 = $conn->query($sql3);
    if ($result3 == true) {
        header("location: admin.php");
    }
}

if (isset($_POST["client_profile"])) {
    $_SESSION["client_profile"] = $_POST["client_profile"];
    header("location: pages-profileClient.php");
}

if (isset($_POST["deleteClient"])) {
    $client_profile = $_POST["client_profile"];
    $sql = "DELETE FROM client WHERE username='$client_profile'";
    $result = $conn->query($sql);
    if ($result == true) {
        header("location: admin.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="sidebar/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>


    <style>
        .button {
            width: 100%;
            height: 53px;
            font-weight: 400;
            font-size: 0.9rem;
            font-weight: 600;
            background-color: #fff;
            color: #2D303D;
            border-radius: 50px;
            border: none;
            text-align: center;
            align-items: middle;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            transition-duration: 0.3s;
        }

        .button:hover {
            background-color: #13B24A;
            color: white;
        }
    </style>

</head>


<body>
    <nav>

        <div class="sidebar-top" style="margin-left: auto; margin-right: auto; margin-top: 25px; margin-bottom: 30px">
            <a href="index.php">
                <img src="sidebar/img/fullLogo.png" class="logo" alt="">
            </a>
        </div>

        <div class="sidebar-links">
            <ul>
                <div class="active-tab"></div>
                <li class="tooltip-element" data-tooltip="0">
                    <a href="admin.php" class="active" data-active="0">
                        <div class="icon">
                            <i class='bx bx-home-alt'></i>
                            <i class='bx bxs-home'></i>
                        </div>
                        <span class="link hide">Dashboard</span>
                    </a>
                </li>
                <!-- <li class="tooltip-element" data-tooltip="1">
                    <a href="" data-active="1">
                        <div class="icon">
                            <i class='bx bx-search'></i>
                            <i class='bx bxs-search'></i>
                        </div>
                        <span class="link hide">Search</span>
                    </a>
                </li>
                <li class="tooltip-element" data-tooltip="2">
                    <a href="" data-active="2">
                        <div class="icon">
                            <i class='bx bx-user'></i>
                            <i class='bx bxs-user'></i>
                        </div>
                        <span class="link hide">Profile</span>
                    </a>
                </li>
                <li class="tooltip-element" data-tooltip="3">
                    <a href="" data-active="3">
                        <div class="icon">
                            <i class='bx bx-message-square-detail'></i>
                            <i class='bx bxs-message-square-detail'></i>
                        </div>
                        <span class="link hide">Message</span>
                    </a>
                </li> -->
                <!-- <div class="tooltip">
                    <span class="show">Dashboard</span>
                    <span>Projects</span>
                    <span>Messages</span>
                    <span>Analytics</span>
                </div> -->
            </ul>

            <!-- <h4 class="hide">Shortcuts</h4> -->

            <!-- <ul>
                <li class="tooltip-element" data-tooltip="0">
                    <a href="" data-active="4">
                        <div class="icon">
                            <i class='bx bx-cog'></i>
                            <i class='bx bxs-cog'></i>
                        </div>
                        <span class="link hide">Settings</span>
                    </a>
                </li>
                <div class="tooltip">
                    <span class="show">Settings</span>
                </div>
            </ul> -->
        </div>

        <div class="sidebar-footer">
            <a href="#" class="account tooltip-element" data-tooltip="0">
                <i class='bx bx-user'></i>
            </a>
            <div class="admin-user tooltip-element" data-tooltip="1">
                <div class="admin-profile hide">
                    <img src="sidebar/img/face-1.png" alt="">
                    <div class="admin-info">
                        <h3>Admin</h3>
                    </div>
                </div>
                <a href="server-logout.php" class="log-out">
                    <i class='bx bx-log-out'></i>
                </a>
            </div>
            <div class="tooltip">
                <span class="show">John</span>
                <span>Logout</span>
            </div>
        </div>
    </nav>

    <main>
        <div class="container-fluid">

            <h3 class="py-4">Admin Dashboard</h3>

            <div class="row">
                <div class="col">
                    <div class="card bg-primary shadow border-0 p-2">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-list-check bg-white text-white bg-opacity-25 rounded p-3"></i>
                                </div>
                                <div class="col text-white">
                                    <div class="row"><?php echo $row_Freelancer ?></div>
                                    <div class="row">Freelancer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-success shadow border-0 p-2">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-spinner bg-white text-white bg-opacity-25 rounded p-3"></i>
                                </div>
                                <div class="col text-white">
                                    <div class="row"><?php echo $row_Client ?></div>
                                    <div class="row">Client</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger shadow border-0 p-2">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-wallet bg-white text-white bg-opacity-25 rounded p-3"></i>
                                </div>
                                <div class="col text-white">
                                    <div class="row"><?php echo $row_Job ?></div>
                                    <div class="row">Job Posted</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-warning shadow border-0 p-2">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-auto">
                                    <i class="fa-solid fa-wallet bg-white text-white bg-opacity-25 rounded p-3"></i>
                                </div>
                                <div class="col text-white">
                                    <div class="row"><?php echo $row_Cert ?></div>
                                    <div class="row">Certificate Posted</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Freelancer</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($first_nameF); $i++) {
                                        echo '
                                    <tbody>
                                    <tr>
                                        <td scope="row">' . $first_nameF[$i] . '</td>
                                        <td>' . $emailF[$i] . '</td>
                                        <td>
                                            <form action="admin.php" method="post">
                                                <input type="hidden" name="freelancer_profile" value="' . $username_freelancer[$i] . '">
                                                <button type="submit" name="viewFreelancer" class="btn btn-sm btn-primary">View</button>
                                                <button type="submit" name="deleteFreelancer" class="btn btn-sm btn-danger">Delete</button>
                                            </form>                             
                                        </td>                               
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

            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Client</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($first_nameC); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td>' . $first_nameC[$i] . '</td>
                                            <td>' . $emailC[$i] . '</td>
                                            <td>
                                            <form action="admin.php" method="post">
                                                    <input type="hidden" name="client_profile" value="' . $username_client[$i] . '">
                                                    <button type="submit" name="viewClient" class="btn btn-sm btn-primary">View</button>
                                                    <button type="submit" name="deleteClient" class="btn btn-sm btn-danger">Delete</button>

                                                </form>                              
                                            </td>                               
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

            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Job</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Job ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($title); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td>#' . $job_id[$i] . '</td>
                                            <td>' . $title[$i] . '</td>
                                            <td>' . $date_created[$i] . '</td>
                                            <td>' . $first_nameJC[$i] . '</td>
                                            <td>
                                                <form action="admin.php" method="post">
                                                    <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                                                    <button type="submit" name="viewJob" class="btn btn-sm btn-primary">View</button>
                                                    <button type="submit" name="deleteJob" class="btn btn-sm btn-danger">Delete</button>
                                                </form>                              
                                            </td>                               
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

            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Transaction</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Payment ID</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Application ID</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($payment_id); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td>' . $payment_id[$i] . '</td>
                                            <td>RM ' . $payment_amount[$i] . '</td>
                                            <td>' . $application_id[$i] . '</td>
                                            <td>' . $payment_status[$i] . '</td>
                                                                     
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

            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Certificate</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Certificate ID</th>
                                            <th scope="col">Certificate Name</th>
                                            <th scope="col">Certificate Link</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($cert_name); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td>#' . $cert_id[$i] . '</td>
                                            <td>' . $cert_name[$i] . '</td>
                                            <td>' . $cert_link[$i] . '</td>
                                            <td>' . $cert_status[$i] . '</td>
                                            <td>'; ?>
                                        <?php
                                        if ($cert_status[$i] == "pending") {
                                            echo '<form action="admin.php" method="post">
                                                <input type="hidden" name="cert_id" value="' . $cert_id[$i] . '">
                                                <button type="submit" id="approve" name="approve" class="btn btn-sm btn-primary w-100 px-4">Approve</button>
                                            </form>';
                                        } else {
                                            echo '<form action="admin.php" method="post">
                                                <input type="hidden" name="cert_id" value="' . $cert_id[$i] . '">
                                                <button type="submit" id="delete" name="deleteCert" class="btn btn-sm btn-danger col w-100 px-4">Delete</button>
                                            </form>';
                                        }
                                        ?>

                                    <?php echo '
                                            </td>                               
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

            <div class="row">
                <div class="col">
                    <div class="card border-0 p-4 mt-5">
                        <div class="card-body">
                            <h4 class="mb-4">Withdrawal</h4>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">Withdrawal ID</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Account No</th>
                                            <th scope="col">Requested Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($transaction_id); $i++) {
                                        echo '
                                        <tbody>
                                        <tr>
                                            <td>#' . $transaction_id[$i] . '</td>
                                            <td>' . $full_name[$i] . '</td>
                                            <td>' . $bank[$i] . '</td>
                                            <td>' . $account_no[$i] . '</td>
                                            <td>' . $amount[$i] . '</td>
                                            <td>' . $status[$i] . '</td>
                                            <td>'; ?>
                                        <?php
                                        if ($status[$i] == "Requested") {
                                            echo '
                                            <form action="admin.php" method="post">
                                                <input type="hidden" name="transaction_id" value="' . $transaction_id[$i] . '">
                                                <input type="hidden" name="wallet_id" value="' . $wallet_id[$i] . '">
                                                <input type="hidden" name="amount" value="' . $amount[$i] . '">
                                                <input type="hidden" name="balance" value="' . $balance[$i] . '">
                                                <input type="hidden" name="withdrawn" value="' . $withdrawn[$i] . '">
                                                <button type="submit" name="withdraw" class="btn btn-sm btn-danger w-100 mt-1">Approve</button>
                                            </form>';
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    <?php echo '
                                            </td>                               
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
    </main>



    <script src="sidebar/sidebar.js"></script>
</body>

</html>