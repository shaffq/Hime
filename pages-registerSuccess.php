<?php include('server-register.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
        $sqlQ = "SELECT * FROM freelancer WHERE username='$username'";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
        $postJob = "";
        $sqlQ = "SELECT * FROM client WHERE username='$username'";
    }
} else {
    $username = "";
}

$sql = $sqlQ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
    }
} else {
    echo "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
        }

        .form-control {
            background-color: #E7ECF4;
            border: 0;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .form-select {
            background-color: #E7ECF4;
            border: 0;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .user {
            padding: 15px;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php if ($_SESSION["Usertype"] == 1) {
                echo '<div class="col-3 text-white bg-primary sticky-top d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-success rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-check-lg d-flex justify-content-center align-items-center" style="color:#fff;"></i></button>
                            </div>
                            <div class="col-6 border-end border-success border-2" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-success rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-check-lg d-flex justify-content-center align-items-center" style="color:#fff;"></i></button>
                            </div>
                            <div class="col-6 border-end border-success border-2" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-success rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-check-lg d-flex justify-content-center align-items-center" style="color:#fff;"></i></button>
                            </div>
                            <div class="col-6 border-end border-success border-2" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-light rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-circle-fill d-flex justify-content-center align-items-center" style="color:#4054D2;"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Your Details</div>
                            </div>
                            <div class="col-6" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Add Your Experience</div>
                            </div>
                            <div class="col-6" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Socials</div>
                            </div>
                            <div class="col-6" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Done!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            } else {
                echo '<div class="col-3 text-white bg-primary sticky-top d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-success rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-check-lg d-flex justify-content-center align-items-center" style="color:#fff;"></i></button>
                            </div>
                            <div class="col-6 border-end border-success border-2" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-light rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-circle-fill d-flex justify-content-center align-items-center" style="color:#4054D2;"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Your Details</div>
                            </div>
                            <div class="col-6" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-start align-items-center" style="height: 3rem;">
                                <div>Done!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            ?>

            <div class="col mx-auto my-auto">
                <div class="container-fluid">
                    <h1 class="fw-bold text-center">Welcome, <span class="text-primary"> <?php echo $first_name ?> </span></h1>
                    <div class="d-grid gap-2 d-flex justify-content-center align-items-center py-5">
                        <a href="<?php echo $linkDashboard ?>" class="btn btn-primary px-5 py-3" role="button">Go to Dashboard</a>
                        <a href="<?php echo $linkSearch ?>" class="btn btn-secondary px-5 py-3" role="button"><?php echo $textSearch ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>