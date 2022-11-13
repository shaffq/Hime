<?php include('server-register.php');

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

$sql = "SELECT * FROM freelancer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $profile_photo = $row["profile_photo"];
    $email = $row["email"];
    $contact_no = $row["contact_no"];
    $birthdate = $row["birthdate"];
    $gender = $row["gender"];
    $address = $row["address"];
    $city = $row["city"];
    $state = $row["state"];
    $postcode = $row["postcode"];
    $bio = $row["bio"];
    $about_me = $row["about_me"];
    $skills = $row["skills"];
    $languages = $row["languages"];
    $service = $row["service"];
  }
} else {
}

$sql2 = "SELECT * FROM freelancer_edu WHERE f_username='$username'";
$result2 = $conn->query($sql2);
$institute = array();
$i = 0;

if ($result2->num_rows > 0) {
  // output data of each row
  while ($row = $result2->fetch_assoc()) {
    $id[$i] = $row["id"];
    $institute[$i] = $row["institute"];
    $specialization[$i] = $row["specialization"];
    $edu_description[$i] = $row["description"];
    $edu_start[$i] = $row["start_date"];
    $edu_end[$i] = $row["end_date"];
    $i++;
  }
} else {
}

$sql3 = "SELECT * FROM freelancer_work WHERE f_username='$username'";
$result3 = $conn->query($sql3);
$company = array();
$i = 0;
if ($result3->num_rows > 0) {
  // output data of each row
  while ($row = $result3->fetch_assoc()) {
    $id[$i] = $row["id"];
    $company[$i] = $row["company"];
    $position[$i] = $row["position"];
    $work_description[$i] = $row["description"];
    $work_start[$i] = $row["start_date"];
    $work_end[$i] = $row["end_date"];
    $i++;
  }
} else {
}

$sql4 = "SELECT * FROM freelancer_social WHERE f_username='$username'";
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
  // output data of each row
  while ($row = $result4->fetch_assoc()) {
    $instagram = $row["instagram"];
    $linkedin = $row["linkedin"];
    $facebook = $row["facebook"];
  }
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>


  <style>
    .nav-link {
      color: #9FA0AB;
      border: none !important;
    }

    .nav-link.active {
      background: transparent !important;
      color: #4054D2 !important;
      border-bottom: 2px solid #4054D2 !important;
      border-top: 0px;
      border-right: 0px;
      border-left: 0px;
      font-weight: 600;
    }

    .nav-link:hover {
      border-color: #F8F9FB !important;
      font-weight: bold;
      font-weight: 600;
    }

    .nav-link.active:hover {
      background: transparent !important;
      color: #4054D2 !important;
      border-bottom: 2px solid #4054D2 !important;
      border-top: 0px;
      border-right: 0px;
      border-left: 0px;
      font-weight: 600;
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
      <h3>Account Settings</h3>

      <ul class="nav nav-tabs nav-fill mt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Account</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Personal Details</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Socials</button>
        </li>
      </ul>

      <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
          <div class="row">
            <div class="col-7">
              <form id="editForm2" method="post">
                <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">

                <div class="card border-0">
                  <div class="card-body">
                    <div class="row my-4">
                      <div class="col-2 d-flex justify-content-center align-items-center">
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
                </div>

                <div class="my-5">
                  <div class="row my-3">
                    <div class="col-6">
                      <label for="first_name" class="form-label">First Name</label>
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
                    </div>
                    <div class="col-6">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
                    </div>
                  </div>

                  <div class="row my-3">
                    <div class="col-6">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="col-6">
                      <label for="contact_no" class="form-label">Contact No</label>
                      <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contact_no; ?>">
                    </div>
                  </div>


                  <div class="row my-3">
                    <div class="col">
                      <label for="birthdate" class="form-label">Date Of Birthday</label>
                      <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>">
                    </div>
                    <div class="col">
                      <label for="gender" class="form-label">Gender</label><br>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input <?php if ($gender == "Male") echo 'checked="checked"'; ?> type="radio" name="gender" value="Male" class="form-check-input" /> Male
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input <?php if ($gender == "Female") echo 'checked="checked"'; ?> type="radio" name="gender" value="Female" class="form-check-input" /> Female
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="my-5">
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="" value="<?php echo $address; ?>">
                  </div>

                  <div class="row my-3">
                    <div class="col">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control" name="city" id="city" value="<?php echo $city; ?>">
                    </div>
                    <div class="col">
                      <label for="state" class="form-label">State</label>
                      <select id="state" name="state" class="form-select">
                        <option <?php if ($state == "Johor") echo 'selected="selected"'; ?> value="Johor">Johor</option>
                        <option <?php if ($state == "Kedah") echo 'selected="selected"'; ?>value="Kedah">Kedah</option>
                        <option <?php if ($state == "Kelantan") echo 'selected="selected"'; ?>value="Kelantan">Kelantan</option>
                        <option <?php if ($state == "Kuala Lumpur") echo 'selected="selected"'; ?>value="Kuala Lumpur">Kuala Lumpur</option>
                        <option <?php if ($state == "Labuan") echo 'selected="selected"'; ?>value="Labuan">Labuan</option>
                        <option <?php if ($state == "Malacca") echo 'selected="selected"'; ?>value="Malacca">Malacca</option>
                        <option <?php if ($state == "Negeri Sembilan") echo 'selected="selected"'; ?>value="Negeri Sembilan">Negeri Sembilan</option>
                        <option <?php if ($state == "Pahang") echo 'selected="selected"'; ?>value="Pahang">Pahang</option>
                        <option <?php if ($state == "Penang") echo 'selected="selected"'; ?>value="Penang">Penang</option>
                        <option <?php if ($state == "Perak") echo 'selected="selected"'; ?>value="Perak">Perak</option>
                        <option <?php if ($state == "Perlis") echo 'selected="selected"'; ?>value="Perlis">Perlis</option>
                        <option <?php if ($state == "Putrajaya") echo 'selected="selected"'; ?>value="Putrajaya">Putrajaya</option>
                        <option <?php if ($state == "Sabah") echo 'selected="selected"'; ?>value="Sabah">Sabah</option>
                        <option <?php if ($state == "Sarawak") echo 'selected="selected"'; ?>value="Sarawak">Sarawak</option>
                        <option <?php if ($state == "Selangor") echo 'selected="selected"'; ?>value="Selangor">Selangor</option>
                        <option <?php if ($state == "Terengganu") echo 'selected="selected"'; ?>value="Terengganu">Terengganu</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="postcode" class="form-label">Postcode</label>
                      <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $postcode; ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col"></div>
                  <div class="col"></div>
                  <div class="col"><button class="w-100 btn btn-primary py-3" type="submit" name="next1">Save</button></div>
                </div>

              </form>
            </div>

            <div class="col">
              <div class="card border-0">
                <div class="card-body">
                  2
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

          <form id="editForm3" method="post">
            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">

            <div class="row">
              <div class="col">
                <label for="bio" class="form-label">Bio</label>
                <input type="text" class="form-control" id="bio" name="bio" value="<?php echo $bio; ?>">
                <div class="row my-3">
                  <div class="col">
                    <label for="skills" class="form-label">Skills</label>
                    <input type="text" class="form-control" id="skills" name="skills" value="<?php echo $skills; ?>">
                  </div>
                  <div class="col">
                    <label for="languages" class="form-label">Languages</label>
                    <input type="text" class="form-control" id="languages" name="languages" value="<?php echo $languages; ?>">
                  </div>
                </div>
              </div>
              <div class="col">
                <label for="about_me" class="form-label">About Me</label>
                <textarea class="form-control mb-3" id="about_me" name="about_me" rows="10"><?php echo $about_me; ?>"</textarea>
              </div>
            </div>

            <h5>Education</h5>
            <?php
            for ($i = 0; $i < count($institute); $i++) {
              echo '
            <div id="show_education">
            <input type="hidden"  id="id" name="id" value="' . $id[$i] . '">
              <div class="row my-3">
                <div class="col">
                  <label for="institute" class="form-label">Institute</label>
                  <input type="text" class="form-control" id="institute" name="institute[]" value="' . $institute[$i] . '">
                </div>
                <div class="col">
                  <label for="specialization" class="form-label">Specialization</label>
                  <input type="text" class="form-control" id="specialization" name="specialization[]" value="' . $specialization[$i] . '">
                </div>
                <div class="col-2">
                  <label for="edu_start" class="form-label">Date attended</label>
                  <input type="text" class="form-control" id="edu_start" name="edu_start[]" value="' . $edu_start[$i] . '">
                </div>
                <div class="col-2">
                  <label for="edu_end" class="form-label">&nbsp;</label>
                  <input type="text" class="form-control" id="edu_end" name="edu_end[]" value="' . $edu_end[$i] . '">
                </div>
              </div>
              <div class="row my-3">
                <div class="col">
                  <label for="edu_desc" class="form-label">Description</label>
                  <input type="text" class="form-control" id="edu_desc" name="edu_desc[]" value="' . $edu_description[$i] . '">
                </div>
                <div class="col-2"></div>
                <div class="col-2 d-flex justify-content-end align-items-end">
                  <button class="btn btn-danger remove_education_btn">Remove</button>
                </div>
              </div>
            </div>';
            }
            ?>

            <h5 class="mt-5">Work Experience</h5>
            <?php
            for ($i = 0; $i < count($company); $i++) {
              echo '
            <div id="show_work">
              <div class="row my-3">
                <div class="col">
                  <label for="company" class="form-label">Company/Job Name</label>
                  <input type="text" class="form-control" id="company" name="company[]" value="' . $company[$i] . '">
                </div>
                <div class="col">
                  <label for="position" class="form-label">Position</label>
                  <input type="text" class="form-control" id="position" name="position[]" value="' . $position[$i] . '">
                </div>
                <div class="col-2">
                  <label for="work_start" class="form-label">Date attended</label>
                  <input type="text" class="form-control" id="work_start" name="work_start[]" value="' . $work_start[$i] . '">
                </div>
                <div class="col-2">
                  <label for="work_end" class="form-label">&nbsp;</label>
                  <input type="text" class="form-control" id="work_end" name="work_end[]" value="' . $work_end[$i] . '">
                </div>
              </div>
              <div class="row my-3">
                <div class="col">
                  <label for="work_desc" class="form-label">Description</label>
                  <input type="text" class="form-control" id="work_desc" name="work_desc[]" value="' . $work_description[$i] . '">
                </div>
                <div class="col-2"></div>
                <div class="col-2 d-flex justify-content-end align-items-end">
                  <button class="btn btn-danger remove_work_btn">Remove</button>
                </div>
              </div>
            </div>';
            }
            ?>


          </form>

        </div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
          <form id="editForm4" method="post" class="row g-3">
            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">

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
            <h5>Resume</h5>
            <div class="col-12 mb-3">
              <label for="resume" class="form-label">Upload your resume to be displayed on your profile</label>
              <input class="form-control" type="file" id="resume" name="resume">
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="social-tab-pane" role="tabpanel" aria-labelledby="social-tab" tabindex="0">
          <h5>Social Media</h5>
          <div class="row my-3">
            <div class="col-4 mb-3">
              <label for="social_facebook" class="form-label">Facebook</label>
              <input type="text" class="form-control" id="social_facebook" name="social_facebook" value="<?php echo $facebook; ?>">
            </div>
            <div class="col-4 mb-3">
              <label for="social_linkedin" class="form-label">LinkedIn</label>
              <input type="text" class="form-control" id="social_linkedin" name="social_linkedin" value="<?php echo $linkedin; ?>">
            </div>
            <div class="col-4 mb-3">
              <label for="social_instagram" class="form-label">Instagram</label>
              <input type="text" class="form-control" id="social_instagram" name="social_instagram" value="<?php echo $instagram; ?>">
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
</body>

</html>