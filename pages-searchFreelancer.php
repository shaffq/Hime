<?php include('server.php');

unset($_SESSION['freelancer_profile']);

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
        $search = "";
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
        $search = "";
    }
} else {
    $username = "";
    $textSearch = "";
    $linkSearch = "";
    $linkDashboard = "";
    $postJob = "";
    $search = "";
}

if (isset($_POST["freelancer_profile"])) {
    $_SESSION["freelancer_profile"] = $_POST["freelancer_profile"];
    header("location: pages-profileFreelancer.php");
}

$sql = "SELECT * FROM freelancer";
$result = $conn->query($sql);
$f_username = array();
$i = 0;

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql = "SELECT * FROM freelancer WHERE first_name LIKE '%$search%'";
    $result = $conn->query($sql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .show:hover {
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $f_username[$i] = $row["username"];
            $first_name[$i] = $row["first_name"];
            $last_name[$i] = $row["last_name"];
            $email[$i] = $row["email"];
            $contact_no[$i] = $row["contact_no"];
            $gender[$i] = $row["gender"];
            $bio[$i] = $row["bio"];
            $i++;
        }
    } else {
    }
    ?>

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

    <main class="bodyActual my-4" hidden>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col mx-2">

                    <h3 class="mb-5">Find Freelancer</h3>

                    <div class="mb-5">
                        <form action="pages-searchFreelancer.php" method="post">
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background-color: #fff;"><i class="fa-solid fa-magnifying-glass mx-2" style="color:#4054D2"></i></span>
                                <input type="text" name="search" class="form-control border-0 py-3" placeholder="Freelancer Name" value="<?php echo $search ?>" />
                                <button class="btn btn-primary px-4 py-3" type="sumbit">Find Freelancer</button>
                            </div>
                        </form>
                    </div>

                    <?php
                    $row_cnt = mysqli_num_rows($result);

                    if ($search !== "") {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Freelancer of <span class="text-primary fw-semibold">' . $search . '</span></h5>';
                    } else {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Freelancer</h5>';
                    }
                    ?>

                    <?php
                    for ($i = 0; $i < count($f_username); $i++) {
                        echo '<form action="pages-searchFreelancer.php" method="post">
                    <input type="hidden" name="freelancer_profile" value="' . $f_username[$i]  . '">
                    <div class="card show border-0 my-3">
                        <div class="card-body py-0">
                            <div class="row p-4">
                                <div class="col-1 p-0 mx-auto">
                                    <img class="img-fluid rounded-circle" src="sidebar/img/face-1.png">
                                </div>
                                <div class="col ms-3 my-auto" style="font-size: 13px;">
                                    <h5 class="mb-1">' . $first_name[$i]  . '</h5>
                                    <p class="mb-0"><i class="fa-solid fa-star me-1" style="color:orange"></i></i>'; ?>

                        <?php

                        $sql8 = "SELECT * FROM review WHERE  f_username='$f_username[$i]' AND review_type='c-f'";
                        $result8 = $conn->query($sql8);
                        $feedback = array();
                        $x = 0;
                        $row_cnt8 = mysqli_num_rows($result8);

                        if ($result8->num_rows > 0) {
                            while ($row = $result8->fetch_assoc()) {
                                $rating[$x] = $row["rating"];
                                $x++;
                            }
                        } else {
                        }

                        if ($result8->num_rows > 0) {
                            $avrg = array_sum($rating) / $row_cnt8;
                            echo $avrg . '<span class="text-secondary">/5' . ' (' . $row_cnt8 . ')</span>';
                        } else {
                            echo '0<span class="text-secondary">/5' . ' (' . $row_cnt8 . ')</span>';
                        }
                        ?>

                    <?php echo '
                                </p>
                                </div>
                                <div class="col-auto my-auto">
                                    <button type="submit" class="btn btn-primary px-3">View Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>';
                    }
                    ?>

                </div>
                <div class="col-2">
                </div>
            </div>

        </div>
    </main>
</body>

<script src="loader/loader.js"></script>

</html>