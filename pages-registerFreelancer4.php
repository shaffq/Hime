<?php include('server-register.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
    } else {
    }
} else {
    $username = "";
    header("location: index.php");
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
        .height {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 text-white bg-primary sticky-top d-flex justify-content-center align-items-center" style="height: 100vh;">
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
                            <button type="button" class="btn btn-light rounded-pill" style="width: 3rem; height:3rem;"><i class="bi bi-circle-fill d-flex justify-content-center align-items-center" style="color:#4054D2;"></i></button>
                            </div>
                            <div class="col-6 border-end border-2" style="height: 3rem;">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-6">
                                <span class="invisible">1</span>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn border border-2 rounded-pill" style="width: 3rem; height:3rem;"></button>
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
            </div>
            <div class="col my-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-3"></div>
                                <div class="col">
                                    <main>
                                        <form id="registrationForm4" method="post" class="row g-3">
                                            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">

                                            <div class="my-5">
                                                <h1 class="fw-bold">Set up you<span class="text-primary"> Hime </span> profile</h1>
                                                <h5 class="text-secondary">Please provide a summary of your profile</h5>
                                            </div>

                                            <div class="col-12">
                                                <h5 class="mb-3">Service</h5>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="service_availability" class="form-label">Service Availability</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="service" id="service" name="service" value="Remote">
                                                    <label class="form-check-label" for="remote">Remote</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="service" id="service" name="service" value="On Site">
                                                    <label class="form-check-label" for="on site">On Site</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="service" id="service" name="service" value="Both">
                                                    <label class="form-check-label" for="both">Both</label>
                                                </div>
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <!-- <h5>Resume</h5>
                                            <div class="col-12 mb-3">
                                                <label for="resume" class="form-label">Upload your resume to be displayed on your profile</label>
                                                <input class="form-control" type="file" id="resume" name="resume">
                                            </div> -->
                                            <div class="col-4"></div>
                                            <div class="col-4"><a href="pages-registerFreelancer3.php" class="btn btn-secondary w-100" role="button">Back</a></div>
                                            <div class="col-4"><button class="w-100 btn btn-primary" type="submit" name="next3">Done</button></div>
                                        </form>
                                    </main>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>