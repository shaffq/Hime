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
        $search = "";
        $sort = "";
        $categorySearch = "";
        $fav = "";
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
        $sort = "";
        $categorySearch = "";
        $fav = "";
    }
} else {
    $username = "";
    $textSearch = "";
    $linkSearch = "";
    $linkDashboard = "";
    $postJob = "";
    $search = "";
    $sort = "";
    $categorySearch = "";
    $fav = "hidden";
}

if (isset($_POST["view"])) {
    $_SESSION["job_id"] = $_POST["job_id"];
    $jobID = $_SESSION["job_id"];
    header("location: pages-jobDetails.php?job_id=$jobID");
}

if (isset($_POST["fav"])) {
    $job_id = $_POST["job_id"];
    $username = $_POST["f_username"];

    $sql = "SELECT * FROM freelancer_fav WHERE job_id='$job_id' and f_username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "DELETE FROM freelancer_fav WHERE job_id='$job_id' and f_username='$username'";
        $result = $conn->query($sql);
        if ($result == true) {
            header("location: pages-searchJob.php");
        }
    } else {
        $sql = "INSERT INTO freelancer_fav(f_username, job_id) VALUES ('$username', '$job_id')";
        $result = $conn->query($sql);
        if ($result == true) {
            header("location: pages-searchJob.php");
        }
    }
}



$sql2 = "SELECT * FROM certificate WHERE status='approved'";
$result2 = $conn->query($sql2);
$cert_name = array();
$i = 0;

if ($result2->num_rows > 0) {
    // output data of each row
    while ($row = $result2->fetch_assoc()) {
        $cert_id[$i] = $row["cert_id"];
        $cert_name[$i] = $row["cert_name"];
        $cert_desc[$i] = $row["cert_desc"];
        $cert_link[$i] = $row["cert_link"];
        $i++;
    }
} else {
}

$sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE job_status='available' ORDER BY date_created DESC";
$result = $conn->query($sql);
$title = array();
$i = 0;

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sort = $_POST["sort"];
    $categorySearch = $_POST["category"];

    if ($categorySearch !== "") {
        $sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE title LIKE '%$search%' AND category='$categorySearch' AND job_status='available' ORDER BY date_created $sort";
        $result = $conn->query($sql);
    } else {
        $sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE title LIKE '%$search%' AND job_status='available' ORDER BY date_created $sort";
        $result = $conn->query($sql);
    }
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

        .btn-circle {
            width: 55px;
            height: 55px;
            border-radius: 100px;
        }

        .card-gradient {
            background-image: linear-gradient(45deg, #0B63F6, #003CC5);

        }
    </style>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $job_id[$i] = $row["job_id"];
            $title[$i] = $row["title"];
            $job_description[$i] = $row["job_description"];
            $categoryJ[$i] = $row["category"];
            $language[$i] = $row["language"];
            $budget[$i] = $row["budget"];
            $budget_type[$i] = $row["budget_type"];
            $location[$i] = $row["location"];
            $location_type[$i] = $row["location_type"];
            $date[$i] = $row["date"];
            $time_start[$i] = $row["time_start"];
            $time_end[$i] = $row["time_end"];
            $date_created[$i] = $row["date_created"];
            $first_name[$i] = $row["first_name"];
            $i++;
        }
    } else {
    };
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
            <h3 class="mb-5">Find Jobs</h3>
            <div class="row">
                <div class="col-3 pe-5">
                    <div class="row mb-3">
                        <div class="h1 col">
                            Get <span class="fw-semibold text-primary">Certified</span>
                        </div>
                    </div>

                    <?php for ($i = 0; $i < count($cert_name); $i++) {
                        echo '<div class="row mb-3">
                        <div class="card card-gradient py-2 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="h5 col text-white">
                                        ' . $cert_name[$i] . '
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col text-end">
                                        <a class="btn btn-light px-4 rounded-pill" href="' . $cert_link[$i] . '" type="button">Enroll <i class="fa-solid fa-circle-right ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }

                    ?>
                </div>
                <div class="col mx-2">
                    <div class="mb-5">
                        <form action="pages-searchJob.php" method="post">
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background-color: #fff;"><i class="fa-solid fa-magnifying-glass mx-2" style="color:#4054D2"></i></span>
                                <input type="text" name="search" class="form-control border-0 py-3" style="width:40%;" placeholder="Job Title" value="<?php echo $search ?>" />
                                <select id="category" name="category" class="form-select border-0 border-start">
                                    <option value="" class="text-secondary">Category</option>
                                    <?php
                                    $sql5 = "SELECT * FROM category";
                                    $result5 = $conn->query($sql5);
                                    $category = array();
                                    $x = 0;

                                    if ($result5->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result5->fetch_assoc()) {
                                            $category[$x] = $row["category"];
                                            $x++;
                                        }
                                    } else {
                                    }

                                    for ($x = 0; $x < count($category); $x++) {
                                        echo '<option value="' . $category[$x] . '">' . $category[$x] . '</option>';
                                    }
                                    ?>
                                </select>
                                <select id="sort" name="sort" class="form-select border-0 border-start">
                                    <option value="DESC" class="text-secondary">Sort By</option>
                                    <option value="DESC">Newest</option>
                                    <option value="ASC">Oldest</option>
                                </select>
                                <button class="btn btn-primary px-4 py-3" type="sumbit">Find Job</button>
                            </div>
                        </form>
                    </div>

                    <?php
                    $row_cnt = mysqli_num_rows($result);

                    if ($search !== "" or $sort !== "") {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Jobs of <span class="text-primary fw-semibold">' . $search . '</span></h5>';
                    } else {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Jobs</h5>';
                    }
                    ?>

                    <?php
                    for ($i = 0; $i < count($title); $i++) {
                        echo '<form action="pages-searchJob.php" method="post">
                    <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                    <input type="hidden" name="f_username" value="' . $username . '">
                    <div class="card show border-0 my-3">
                        <div class="card-header border-0 px-4 text-secondary text-end" style="background-color:#e1e5f2;">
                        '; ?><?php
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                $date_today = date("Y-m-d");

                                if ($date_created[$i] == ($date_today)) {
                                    echo 'Posted Today';
                                } else {
                                    $now = time();
                                    $your_date = strtotime($date_created[$i]);
                                    $datediff = $now - $your_date;

                                    echo 'Posted ' . round($datediff / (60 * 60 * 24)) . ' days ago';
                                }
                                ?><?php echo '
                        </div>
                            <div class="card-body">
                                <div class="row px-4 py-4">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-auto d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-primary btn-circle"><i class="fa-solid fa-' . mb_substr(lcfirst($title[$i]), 0, 1) . ' fa-lg"></i></button>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <h3>' . $title[$i] . '</h3>
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
                                                <div class="h3 text-end mb-0 text-primary fw-semibold">RM ' . $budget[$i] . '</div>
                                                <p class="text-end mb-0">' . $budget_type[$i] . '</p>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                                <p class="text-secondary m-0">' . $job_description[$i] . '</p>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-grid gap-2 d-md-block">
                                                    <button class="btn btn-sm me-1 rounded-pill px-3 text-white" type="button" style="background-color:#f4a261;">' . $categoryJ[$i] . '</button>
                                                    <button class="btn btn-sm me-1 rounded-pill px-3 text-white" type="button" style="background-color:#2a9d8f;">' . $language[$i] . '</button>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-grid gap-2 d-flex justify-content-md-end">'; ?>
                    <?php
                        $sql = "SELECT * FROM freelancer_fav WHERE job_id='$job_id[$i]' and f_username='$username'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo '<button type="submit" name="fav" class="btn" style="background-color:#f28482" ' . $fav . '><i class="fa-solid fa-bookmark" style="color:#fff"></i></button>';
                        } else {
                            echo '<button type="submit" name="fav" class="btn btn-light" ' . $fav . '><i class="fa-solid fa-bookmark" style="color:#adb5bd"></i></button>';
                        }
                    ?>
                <?php echo '
                                                    <button type="submit" name="view" class="btn btn-primary px-5">View</button>
                                                </div>
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
            </div>
        </div>
    </main>

</body>

<script src="loader/loader.js"></script>

</html>