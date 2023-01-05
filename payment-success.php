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
    header("location: index.php");
}

$session_id = $_GET['session_id'];

require './vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51KzHTmFIeo8lkpejL9uDm8OMmgdjS4u4yq4EtLQI5rbIUwOush1zGaaPs0b5A5KrJFWaTTkYyVKAnO994sQulCNE00rFmPT0Cg');
$checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
$intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
$customer = \Stripe\Customer::retrieve($checkout_session->customer);

$payment_status = $intent->status;
$payment_id = $intent->id;
$amount = $intent->amount;
$application_id = $checkout_session->client_reference_id;
$lastTwoDigit = substr($amount, -2);
$firstDigit = substr($amount, 0, -2);
$finalAmount = $firstDigit . '.' . $lastTwoDigit;

$sql = "SELECT * FROM job_application WHERE application_id='$application_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $job_id = $row["job_id"];
        $bid = $row["bid"];
        $f_username = $row["f_username"];
    }
} else {
}

if ($intent->status == 'succeeded') {

    $sql2 = "UPDATE job SET job_status='unavailable' WHERE job_id='$job_id'";
    $result2 = $conn->query($sql2);

    $sql3 = "UPDATE job_application SET application_status='Hired' WHERE job_id='$job_id' AND f_username = '$f_username'";
    $result3 = $conn->query($sql3);

    $sql4 = "UPDATE job_application SET application_status='Rejected' WHERE job_id='$job_id' AND NOT (f_username <=> '$f_username');";
    $result4 = $conn->query($sql4);

    $sql5 = "INSERT INTO contract_payment (payment_id, application_id, payment_amount, payment_status) VALUES ('$intent->id', '$application_id', '$finalAmount', 'Received')";
    $result5 = $conn->query($sql5);

    $sql6 = "INSERT INTO contract (job_id, f_username, payment_id, contract_status) VALUES ('$job_id', '$f_username','$intent->id', 'Active')";
    $result6 = $conn->query($sql6);

    $sql7 = "UPDATE job SET budget=$bid WHERE job_id='$job_id'";
    $result7 = $conn->query($sql7);

} else {
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <style>
        .circle-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            float: left;
            margin: 10px;
        }

        .iconSuccess {
            position: absolute;
            color: #fff;
            font-size: 45px;
            top: 55px;
            left: 50px;
            transform: translate(-50%, -50%);
        }

        .circle {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            padding: 2.5px;
            background-clip: content-box;
            animation: spin 10s linear infinite;
        }

        .circle-wrapper:active .circle {
            animation: spin 2s linear infinite;
        }

        .success {
            background-color: #4BB543;
            border: 2.5px dashed #4BB543;
        }

        @keyframes spin {
            100% {
                transform: rotateZ(360deg);
            }
        }

        .page-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $linkProfile, $textSearch, $postJob, $profile_name);
    ?>

    <main>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col mx-auto my-auto">
                <div class="page-wrapper">
                    <div class="circle-wrapper">
                        <div class="success circle"></div>
                        <div class="iconSuccess">
                            <i class="bi bi-check-lg"></i>
                        </div>

                    </div>
                </div>
                <h1 class="fw-semibold text-success text-center mt-5">Payment Successful</h1>

                <p class="text-center">Your payment has been processed. Details of this transaction will be available on your dashboard.</p>
                <div class="d-grid col-6 mt-5 mx-auto">
                    <a href="<?php echo $linkDashboard ?>" class="btn btn-primary px-5 py-3" role="button">Go to Dashboard</a>
                </div>

            </div>
            <div class="col-3">
            </div>
        </div>

    </main>
</body>

</html>