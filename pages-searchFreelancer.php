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

if (isset($_POST["freelancer_profile"])) {
    $_SESSION["freelancer_profile"] = $_POST["freelancer_profile"];
    header("location: pages-profile.php");
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
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .show:hover {
            transform: scale(1.01);
            box-shadow: 0 20px 45px 0 rgba(0, 0, 0, 0.1);
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
        himeSidebar($linkDashboard, $linkSearch, $textSearch, $postJob);
    } else {
        include "sidebar/sidebar2.php";
        himeSidebar();
    }
    ?>

    <main class="my-4">
        <div class="container-fluid">
            <h3 class="mb-5">Find Freelancer</h3>

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
                            <form action="pages-searchFreelancer.php" method="post">
                                <div class="row">
                                    <div class="col"><input type="text" name="search" class="form-control border-0" placeholder="Search for freelancer" value="<?php echo $search ?>" /></div>
                                    <button type="sumbit" class="btn btn-sm d-flex justify-content-center align-items-center col-1 text-white btn-primary"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
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
                            <div class="row">
                                <div class="col-1 bg-primary rounded-start" style="width:1px">
                                    &nbsp;
                                </div>
                                <div class="col-1 mx-auto ms-3 my-4">
                                    <img class="img-fluid rounded-circle p-0" src="sidebar/img/face-1.png" alt="">
                                </div>
                                <div class="col-2 ms-3 my-auto">
                                    <div class="row">
                                    ' . $first_name[$i]  . '
                                    </div>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="col-auto p-0">
                                            <i class="bi bi-star-fill p-0" style="color:orange"></i>
                                        </div>
                                        <div class="col text-secondary ps-2">
                                            4.8 (7)
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col-2 my-auto">
                                    <button type="submit" class="btn btn-primary px-3">View Profile</button>
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