<?php include('server-register.php');

if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        $linkProfile = "freelancerProfile.php";
        $linkEditProfile = "freelancerEditProfile.php";
        $textHeader = "Find Job";
        $linkHeader = "jobMarketplace.php";
        $linkDashboard = "freelancerDashboard.php";
    } else {
        $linkProfile = "clientProfile.php";
        $linkEditProfile = "clientEditProfile.php";
        $textHeader = "Find Freelancer";
        $linkHeader = "freelancerMarketplace.php";
        $linkDashboard = "clientDashboard.php";
    }
} else {
    $username = "";
    // header("location: index.php");
}

$sql = "SELECT * FROM client WHERE username='$username'";
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
        .height {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 text-white bg-primary sticky-top d-flex justify-content-center align-items-center height">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-2">
                        <div class="row">
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
                                        <form id="registrationClientForm2" method="post" class="row g-3">
                                            <div class="my-4">
                                                <h1 class="fw-bold">Set up you<span class="text-primary"> Hime </span> profile</h1>
                                                <h5 class="text-secondary">Please provide a summary of your profile</h5>
                                            </div>


                                            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
                                            <div class="col-12">
                                                <label for="type" class="form-label">Account Type</label><br>
                                                <div class="btn-group w-100">
                                                    <input type="radio" class="btn-check" name="types" id="option1" autocomplete="off" value="Organization" />
                                                    <label class="btn btn-outline-primary w-50" for="option1">Organization</label>

                                                    <input type="radio" class="btn-check" name="types" id="option2" autocomplete="off" value="Personal" />
                                                    <label class="btn btn-outline-primary w-50" for="option2">Personal</label>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row my-4">
                                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                                        <img class="img-fluid rounded-circle" src="sidebar/img/face-1.png" alt="">
                                                    </div>
                                                    <div class="col ml-4 my-auto">
                                                        <div>
                                                            <label class="btn btn-primary py-2 px-5">
                                                                Upload Profile Photo <input type="file" hidden>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="first_name" class="form-label">First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
                                                    </div>
                                                    <div class="col">
                                                        <label for="last_name" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="contact_no" class="form-label">Contact No</label>
                                                <input type="text" class="form-control" name="contact_no" id="contact_no">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" id="email">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="website" class="form-label">Website</label>
                                                <input type="text" class="form-control" name="website" id="website">
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="">
                                            </div>
                                            <div class="col-4">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" id="city">
                                            </div>
                                            <div class="col-4">
                                                <label for="state" class="form-label">State</label>
                                                <select id="state" name="state" class="form-select">
                                                    <option selected disabled>Select State</option>
                                                    <option value="Johor">Johor</option>
                                                    <option value="Kedah">Kedah</option>
                                                    <option value="Kelantan">Kelantan</option>
                                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                    <option value="Labuan">Labuan</option>
                                                    <option value="Malacca">Malacca</option>
                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                    <option value="Pahang">Pahang</option>
                                                    <option value="Penang">Penang</option>
                                                    <option value="Perak">Perak</option>
                                                    <option value="Perlis">Perlis</option>
                                                    <option value="Putrajaya">Putrajaya</option>
                                                    <option value="Sabah">Sabah</option>
                                                    <option value="Sarawak">Sarawak</option>
                                                    <option value="Selangor">Selangor</option>
                                                    <option value="Terengganu">Terengganu</option>
                                                </select>
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="postcode" class="form-label">Postcode</label>
                                                <input type="text" class="form-control" name="postcode" id="postcode">
                                            </div>
                                            <div class="col-4"></div>
                                            <div class="col-4"></div>
                                            <div class="col-4"><button class="w-100 btn btn-primary" type="submit" name="nextClient1">Done</button></div>
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