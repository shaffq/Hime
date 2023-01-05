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
    $username = "";
    $textSearch = "";
    $linkSearch = "";
    $linkDashboard = "";
    $postJob = "";
}

if (isset($_POST["postJob"])) {
    $title = test_input($_POST["title"]);
    $category = test_input($_POST["category"]);
    $language = test_input($_POST["language"]);
    $description = test_input($_POST["description"]);
    $budget = test_input($_POST["budget"]);
    $budget_type = test_input($_POST["budget_type"]);
    $date = test_input($_POST["date"]);
    $time_start = test_input($_POST["time_start"]);
    $time_end = test_input($_POST["time_end"]);
    $duration = test_input($_POST["duration"]);
    $location = test_input($_POST["location"]);
    $location_type = test_input($_POST["location_type"]);

    $sql = "INSERT INTO job (c_username, title, job_description, category, language, budget, budget_type, location, location_type, date, time_start, time_end, duration, job_status) VALUES ('$username', '$title', '$description', '$category', '$language', '$budget', '$budget_type', '$location', '$location_type', '$date', '$time_start', '$time_end', '$duration', 'available')";
    $result = $conn->query($sql);

    if ($result == true) {
        $_SESSION["job_id"] = $conn->insert_id;
        $_SESSION["job_posted"] = "job_posted";
        header("location: message-success.php");
    }
}

$sql = "SELECT * FROM category";
$result = $conn->query($sql);
$category = array();
$i = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $category[$i] = $row["category"];
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
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/915317e5b1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "sidebar/sidebar.php";
    himeSidebar($linkDashboard, $linkSearch, $linkProfile, $textSearch, $postJob, $profile_name);
    ?>

    <main class="my-4">
        <div class="container-fluid">
            <h3 class="mb-5">Create New Job</h3>
            <form method="post">
                <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col">
                        <div class="row py-3 border-bottom">
                            <div class="col-4">
                                <label for="title" class="form-label fw-semibold">Job Title</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control text-white bg-primary border-0 py-4 title" name="title" id="title">
                            </div>
                        </div>
                        <div class="row py-3 border-bottom">
                            <div class="col-4">
                                <label for="description" class="form-label fw-semibold">Job Description</label>
                                <p class="text-secondary">Provide a short description about the job.</p>
                            </div>
                            <div class="col">
                                <textarea class="form-control" rows="7" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row pt-3 border-bottom">
                            <div class="col-4">
                                <label for="category" class="form-label fw-semibold">Category</label>
                                <p class="text-secondary">Choose a category for this job</p>
                            </div>
                            <div class="col-4">
                                <select class="form-select" name="category">
                                    <option disabled selected>Category</option>
                                    <?php
                                    for ($i = 0; $i < count($category); $i++) {
                                        echo '<option value="' . $category[$i] . '">' . $category[$i] . '</option>';
                                    }
                                    ?>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-4 other-form">
                                <input type="text" class="form-control" placeholder="Please specify" name="category" id="category" required />
                            </div>
                        </div>
                        <div class="row pt-3 border-bottom">
                            <div class="col-4">
                                <label for="language" class="form-label fw-semibold">Language</label>
                                <p class="text-secondary">Choose a language for this job</p>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Language" name="language" id="language" required />
                            </div>
                        </div>
                        <div class="row py-3 border-bottom">
                            <div class="col-4">
                                <label for="budget" class="form-label fw-semibold">Budget</label>
                                <p class="text-secondary">Choose how you prefer to pay for this job</p>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="budget_type" id="budget_type1" autocomplete="off" value="Hourly" />
                                    <label class="btn btn-outline-primary w-50 py-3" for="budget_type1"><i class="fa-solid fa-clock me-3"></i>Hourly</label>
                                    <input type="radio" class="btn-check" name="budget_type" id="budget_type2" autocomplete="off" value="Fixed" />
                                    <label class="btn btn-outline-primary w-50 py-3" for="budget_type2"><i class="fa-solid fa-money-check-dollar me-3"></i>Fixed</label>
                                </div>
                            </div>
                            <div class="col-4 hourly-form">
                                <label for="budget" class="form-label">Hourly Rate</label>
                                <input type="text" class="form-control" placeholder="0.00" name="budget" id="budget" aria-describedby="basic-addon1">
                            </div>
                            <div class="col-4 fixed-form">
                                <label for="budget" class="form-label">Fixed Rate</label>
                                <input type="text" class="form-control" placeholder="0.00" name="budget" id="budget" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="row py-3 border-bottom">
                            <div class="col-4">
                                <label for="budget" class="form-label fw-semibold">Location</label>
                                <p class="text-secondary">Choose how candidates will<br> be working for this job</p>
                            </div>
                            <div class="col-4 my-auto">
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="location_type" id="location_type1" autocomplete="off" value="Remote" />
                                    <label class="btn btn-outline-primary w-50 py-3" for="location_type1"><i class="fa-solid fa-globe me-3"></i>Remote</label>
                                    <input type="radio" class="btn-check" name="location_type" id="location_type2" autocomplete="off" value="On-Site" />
                                    <label class="btn btn-outline-primary w-50 py-3" for="location_type2"><i class="fa-solid fa-map-location-dot me-2"></i>On-Site</label>
                                </div>
                            </div>
                            <div class="col-4 remote-form">
                                <label for="location" class="form-label">Platform</label>
                                <input type="text" class="form-control" placeholder="e.g: Microsoft Teams" name="location" id="location">
                            </div>
                            <div class="col-4 onsite-form">
                                <label for="location" class="form-label">Address</label>
                                <input type="text" class="form-control" placeholder="e.g: MITEC, Kuala Lumpur" name="location" id="location">
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-4">
                                <label for="time" class="form-label fw-semibold">Schedule</label>
                            </div>
                            <div class="col-4">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" placeholder="" name="date" id="date" />
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <label for="time_start" class="form-label">Start Time</label>
                                <input type="time" class="form-control" placeholder="" name="time_start" id="time_start" />
                            </div>
                            <div class="col-4">
                                <label for="time_end" class="form-label">Finish Time</label>
                                <input type="time" class="form-control" placeholder="" name="time_end" id="time_end" />
                            </div>
                        </div>
                        <div class="row border-bottom pb-3">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <label for="duration" class="form-label">Work Duration <span class="text-secondary">(Hours)</span></label>
                                <input type="duration" class="form-control" placeholder="e.g: 5" name="duration" id="duration" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <button type="submit" name="postJob" class="btn btn-primary py-3 w-100 mt-5">Post Job</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-1">
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        $(function() {
            var hidestuff = function() {
                $(".other-form").hide();
            }

            $("select[name='category']").change(function() {
                hidestuff();

                var value = $(this).val();
                if (value == "Other") {
                    $(".other-form").show();
                }
            });
            hidestuff();
        });
    </script>
    <script>
        $(function() {
            var hidestuff = function() {
                $(".hourly-form,.fixed-form").hide();
            }

            $("input[name='budget_type']").change(function() {
                hidestuff();

                var value = $(this).val();
                if (value == "Hourly") {
                    $(".hourly-form").show();
                }
                if (value == "Fixed") {
                    $(".fixed-form").show();
                }
            });
            hidestuff();
        });
    </script>
    <script>
        $(function() {
            var hidestuff = function() {
                $(".remote-form,.onsite-form").hide();
            }

            $("input[name='location_type']").change(function() {
                hidestuff();

                var value = $(this).val();
                if (value == "Remote") {
                    $(".remote-form").show();
                }
                if (value == "On-Site") {
                    $(".onsite-form").show();
                }
            });
            hidestuff();
        });
    </script>
</body>

</html>