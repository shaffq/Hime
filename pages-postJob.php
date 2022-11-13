<?php include('server.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $textSearch = "Find Job";
        $linkSearch = "pages-searchJob.php";
        $linkDashboard = "dashboard-freelancer.php";
        $postJob = "hidden";
    } else {
        $textSearch = "Find Freelancer";
        $linkSearch = "pages-searchFreelancer.php";
        $linkDashboard = "dashboard-client.php";
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <style>
        .title::placeholder {
            color: white !important;
            opacity: 70% ! important;
            font-size: 20px;
            padding-left: 10px;
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
            <h3 class="mb-5">Create New Job</h3>

            <form method="post">

                <div class="my-5">
                    <input type="text" class="form-control text-white bg-primary border-0 py-5 title" placeholder="Your job title goes here" name="title" id="title">
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category">
                            <option disabled selected>Category</option>
                            <option value="Tutoring">Tutoring</option>
                            <option value="Translation">Translation</option>
                            <option value="Motivational">Motivational</option>
                            <option value="Workshop">Workshop</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" placeholder="Languauge" name="language" id="language" />
                    </div>
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label for="budget" class="form-label">Budget</label>
                                <input type="text" class="form-control" placeholder="0.00" name="budget" id="budget" aria-describedby="basic-addon1">
                            </div>
                            <div class="col">
                                <label for="budget_type" class="form-label">&nbsp;</label>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="budget_type" id="budget_type1" autocomplete="off" value="Hourly" />
                                    <label class="btn btn-outline-primary w-50" for="budget_type1">Hourly</label>
                                    <input type="radio" class="btn-check" name="budget_type" id="budget_type2" autocomplete="off" value="Fixed" />
                                    <label class="btn btn-outline-primary w-50" for="budget_type2">Fixed</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label for="budget" class="form-label">Location</label>
                                <input type="text" class="form-control" placeholder="Location" name="location" id="location">
                            </div>
                            <div class="col">
                                <label for="location_type" class="form-label">&nbsp;</label>
                                <div class="btn-group w-100">
                                    <input type="radio" class="btn-check" name="location_type" id="location_type1" autocomplete="off" value="Remote" />
                                    <label class="btn btn-outline-primary w-50" for="location_type1">Remote</label>
                                    <input type="radio" class="btn-check" name="location_type" id="location_type2" autocomplete="off" value="On-Site" />
                                    <label class="btn btn-outline-primary w-50" for="location_type2">On-Site</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" placeholder="" name="date" id="date" />
                    </div>
                    <div class="col">
                        <label for="time_start" class="form-label">Start Time</label>
                        <input type="time" class="form-control" placeholder="" name="time_start" id="time_start" />
                    </div>
                    <div class="col">
                        <label for="time_end" class="form-label">Finish Time</label>
                        <input type="time" class="form-control" placeholder="" name="time_end" id="time_end" />
                    </div>
                    <div class="col">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="duration" class="form-control" placeholder="" name="duration" id="duration" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Enter the description of your job</label>
                    <textarea class="form-control" rows="7" name="description" id="description"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Additional File</label>
                    <label class="btn btn-outline-secondary d-grid gap-2 py-4">
                        <i class="bi bi-cloud-upload"></i> Upload File <input type="file" hidden>
                    </label>
                </div>

                <div class="row my-4">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col"><button type="submit" name="postJob" class="w-100 btn btn-primary">Post Job</button></div>
                </div>
            </form>
        </div>

    </main>
</body>

</html>