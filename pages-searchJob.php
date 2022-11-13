<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
        $search = "";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
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

if (isset($_POST["job_id"])) {
    $_SESSION["job_id"] = $_POST["job_id"];
    header("location: pages-jobDetails.php");
}

$sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE job.job_status='available' ORDER BY date_created DESC";
$result = $conn->query($sql);
$title = array();
$i = 0;

if (isset($_POST["newestJob"])) {
    $sql = "SELECT * FROM job_marketplace WHERE job.job_status='available' ORDER BY date_created DESC";
    $result = $conn->query($sql);
}

if (isset($_POST["oldestJob"])) {
    $sql = "SELECT * FROM job_marketplace WHERE job.job_status='available'";
    $result = $conn->query($sql);
}

if (isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql = "SELECT * FROM job JOIN client ON job.c_username=client.username WHERE title LIKE '%$search%' and job.job_status='available' ORDER BY date_created DESC";
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
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

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
            $job_id[$i] = $row["job_id"];
            $title[$i] = $row["title"];
            $job_description[$i] = $row["job_description"];
            $category[$i] = $row["category"];
            $language[$i] = $row["language"];
            $budget[$i] = $row["budget"];
            $budget_type[$i] = $row["budget_type"];
            $location[$i] = $row["location"];
            $location_type[$i] = $row["location_type"];
            $date[$i] = $row["date"];
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
        himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob);
    } else {
        include "sidebar/sidebar2.php";
        himeSidebar();
    }
    ?>

    <main class="my-4">
        <div class="container-fluid">
            <h3 class="mb-5">Find Jobs</h3>

            <div class="row">
                <div class="col-auto">
                    <div class="row">
                        <div class="col h5 d-flex justify-content-start align-items-center">
                            Filter
                        </div>
                        <div class="col d-flex justify-content-end align-items-center">
                            <span onclick="remove()"><button type="button" class="btn btn-sm btn-outline-secondary">Clear</button></span>
                        </div>
                    </div>
                    <br>
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sortby" class="form-label">Sort by</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected disabled>Sort by</option>
                                    <option value="newest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" placeholder="Search category" name="category" id="category" />
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="rateType" class="form-label">Rate Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="hourly" id="hourly">
                                    <label class="form-check-label" for="hourly">
                                        Hourly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="fixed" id="fixed">
                                    <label class="form-check-label" for="fixed">
                                        Fixed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Filter</button>
                    </div>
                </div>
                <div class="col mx-2">
                    <div class="card border-0 px-3 mb-4">
                        <div class="card-body">
                            <form action="pages-searchJob.php" method="post">
                                <div class="row">
                                    <div class="col"><input type="text" name="search" class="form-control border-0" placeholder="Search for job title" value="<?php echo $search ?>" /></div>
                                    <button type="sumbit" class="btn btn-sm d-flex justify-content-center align-items-center col-1 text-white btn-primary"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    $row_cnt = mysqli_num_rows($result);

                    if ($search !== "") {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Jobs of <span class="text-primary fw-semibold">' . $search . '</span></h5>';
                    } else {
                        echo '<h5>Showing <span class="text-primary fw-semibold">' . $row_cnt . '</span> Jobs</h5>';
                    }
                    ?>

                    <?php
                    for ($i = 0; $i < count($title); $i++) {
                        echo '<form action="pages-searchJob.php" method="post">
                    <input type="hidden" name="job_id" value="' . $job_id[$i] . '">
                    <div class="card show border-0 my-3">
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-1 bg-primary rounded-start" style="width:1px">
                                    &nbsp;
                                </div>
                                <div class="col m-4 my-2 py-4">
                                    <h4 class="fw-semibold">' . $title[$i] . '</h4>
                                    <p class="text-secondary m-0">' . $job_description[$i] . '</p>
                                    <p class="mt-3 m-0"><button type="button" class="btn btn-sm btn-light rounded-pill px-3">' . $category[$i] . '</button>
                                    <button type="button" class="btn btn-sm btn-light rounded-pill px-3">' . $language[$i] . '</button></p>
                                </div>
                                <div class="col-3 m-4 my-auto py-4">
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="h5 text-primary text-end">RM ' . $budget[$i] . '/' . $budget_type[$i] . '</div>
                                        </div>
                                    </div>    
                                    <div class="row">  
                                        <div class="col-12">
                                            <div class="d-grid gap-2 d-flex justify-content-md-end">
                                                <button type="button" class="btn btn-light btn-light"><i class="bi bi-bookmark"></i></button>
                                                <button type="submit" class="btn btn-primary px-5">Apply</button>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="row">  
                                        <div class="col mt-2 p-0">
                                            <div class="text-secondary text-end">'; ?><?php
                                                                                        $now = time();
                                                                                        $your_date = strtotime($date_created[$i]);
                                                                                        $datediff = $now - $your_date;

                                                                                        echo 'Posted ' . round($datediff / (60 * 60 * 24)) . ' days ago';
                                                                                        ?><?php echo '</div>
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

</html>