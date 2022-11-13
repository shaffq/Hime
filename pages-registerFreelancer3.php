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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
                                        <form id="registrationForm3" method="post" class="row g-3">
                                            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">

                                            <div class="my-5">
                                                <h1 class="fw-bold">Set up you<span class="text-primary"> Hime </span> profile</h1>
                                                <h5 class="text-secondary">Please provide a summary of your profile</h5>
                                            </div>

                                            <div class="col-12">
                                                <label for="bio" class="form-label">Bio</label>
                                                <input type="text" class="form-control" id="bio" name="bio" maxlength="50">
                                                <div class="row mt-1 d-flex justify-content-end align-items-end">
                                                    <div class="col-1 text-end p-0"><span id="characters">0<span></div>
                                                    <div class="col-auto ps-0">/50</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="about_me" class="form-label">About Me</label>
                                                <textarea class="form-control mb-3" id="about_me" name="about_me" rows="10"></textarea>
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <h5>Speciality</h5>
                                            <div class="col-6 mb-3">
                                                <label for="skills" class="form-label">Skills</label>
                                                <input type="text" class="form-control" id="skills" name="skills" placeholder="">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="languages" class="form-label">Languages</label>
                                                <input type="text" class="form-control" id="languages" name="languages" placeholder="">
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <h5>Education</h5>
                                            <div id="show_education">
                                                <div class="col-12 mb-3">
                                                    <label for="institute" class="form-label">Institute</label>
                                                    <input type="text" class="form-control" id="institute" name="institute[]" placeholder="Example: University of Kuala Lumpur">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="specialization" class="form-label">Specialization</label>
                                                    <input type="text" class="form-control" id="specialization" name="specialization[]" placeholder="Example: Bachelor of Information Technology (Hons.) in Software Engineering">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="edu_description" class="form-label">Education Description</label>
                                                    <input type="text" class="form-control" id="edu_description" name="edu_description[]" placeholder="">
                                                </div>
                                                <div class="row">
                                                    <div class="col-3 mb-3">
                                                        <label for="edu_start" class="form-label">Date attended</label>
                                                        <input type="text" class="form-control" id="edu_start" name="edu_start[]" placeholder="From">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label for="edu_end" class="form-label">&nbsp;</label>
                                                        <input type="text" class="form-control" id="edu_end" name="edu_end[]" placeholder="To">
                                                    </div>
                                                    <div class="col-2 mb-3"></div>
                                                    <div class="col-4 mb-3">
                                                        <div class="form-label">&nbsp;</div>
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary add_education_btn"><i class="bi bi-plus-lg"></i> Add Education</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <h5>Work Experience</h5>
                                            <div id="show_work">
                                                <div class="col-12 mb-3">
                                                    <label for="company" class="form-label">Company/Job Name</label>
                                                    <input type="text" class="form-control" id="company" name="company[]" placeholder="">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" id="position" name="position[]" placeholder="">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="work_description" class="form-label">Work Description</label>
                                                    <input type="text" class="form-control" id="work_description" name="work_description[]" placeholder="">
                                                </div>
                                                <div class="row">
                                                    <div class="col-3 mb-3">
                                                        <label for="work_start" class="form-label">Date attended</label>
                                                        <input type="text" class="form-control" id="work_start" name="work_start[]" placeholder="From">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label for="work_end" class="form-label">&nbsp;</label>
                                                        <input type="text" class="form-control" id="work_end" name="work_end[]" placeholder="To">
                                                    </div>
                                                    <div class="col-3 mb-3"></div>
                                                    <div class="col-3 mb-3">
                                                        <div class="form-label">&nbsp;</div>
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary add_work_btn"><i class="bi bi-plus-lg"></i> Add Work</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 border-bottom mb-3"></div>
                                            <h5>Social Media</h5>
                                            <div class="col-4 mb-3">
                                                <label for="social_facebook" class="form-label">Facebook</label>
                                                <input type="text" class="form-control" id="social_facebook" name="social_facebook" placeholder="">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="social_linkedin" class="form-label">LinkedIn</label>
                                                <input type="text" class="form-control" id="social_linkedin" name="social_linkedin" placeholder="">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label for="social_instagram" class="form-label">Instagram</label>
                                                <input type="text" class="form-control" id="social_instagram" name="social_instagram" placeholder="">
                                            </div>

                                            <div class="col-4"></div>
                                            <div class="col-4"><a href="pages-registerFreelancer2.php" class="btn btn-secondary w-100" role="button">Back</a></div>
                                            <div class="col-4"><button class="w-100 btn btn-primary" type="submit" name="next2">Continue</button></div>
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

    <script>
        $(document).ready(function() {
            $(".add_education_btn").click(function(e) {
                e.preventDefault();
                $("#show_education").prepend(`<div class="row border-bottom mb-4">
                                                        <div class="col-12 mb-3">
                                                            <label for="institute" class="form-label">Institute</label>
                                                            <input type="text" class="form-control" id="institute" name="institute[]" placeholder="Example: University of Kuala Lumpur">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="specialization" class="form-label">Specialization</label>
                                                            <input type="text" class="form-control" id="specialization" name="specialization[]" placeholder="Example: Bachelor of Information Technology (Hons.) in Software Engineering">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="edu_description" class="form-label">Education Description</label>
                                                            <input type="text" class="form-control" id="edu_description" name="edu_description[]" placeholder="">
                                                        </div>
                                                        <div class="row m-0 mb-4 p-0">
                                                            <div class="col-3">
                                                                <label for="edu_start" class="form-label">Date attended</label>
                                                                <input type="text" class="form-control" id="edu_start" name="edu_start[]" placeholder="From">
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="edu_end" class="form-label">&nbsp;</label>
                                                                <input type="text" class="form-control" id="edu_end" name="edu_end[]" placeholder="To">
                                                            </div>
                                                            <div class="col-3"></div>
                                                            <div class="col-3">
                                                                <div class="form-label">&nbsp;</div>
                                                                <div class="d-grid">
                                                                    <button class="btn btn-danger remove_education_btn">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`);
            });

            $(document).on('click', '.remove_education_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent().parent().parent();
                console.log(row_item);
                $(row_item).remove();
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(".add_work_btn").click(function(e) {
                e.preventDefault();
                $("#show_work").prepend(`<div class="row border-bottom mb-4">
                                                <div class="col-12 mb-3">
                                                    <label for="company" class="form-label">Company/Job Name</label>
                                                    <input type="text" class="form-control" id="company" name="company[]" placeholder="">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" id="position" name="position[]" placeholder="">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="work_description" class="form-label">Work Description</label>
                                                    <input type="text" class="form-control" id="work_description" name="work_description[]" placeholder="">
                                                </div>
                                                <div class="row m-0 mb-4 p-0">
                                                    <div class="col-3">
                                                        <label for="work_start" class="form-label">Date attended</label>
                                                        <input type="text" class="form-control" id="work_start" name="work_start[]" placeholder="From">
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="work_end" class="form-label">&nbsp;</label>
                                                        <input type="text" class="form-control" id="work_end" name="work_end[]" placeholder="To">
                                                    </div>
                                                    <div class="col-3"></div>
                                                    <div class="col-3">
                                                        <div class="form-label">&nbsp;</div>
                                                        <div class="d-grid">
                                                            <button class="btn btn-danger remove_work_btn">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`);
            });

            $(document).on('click', '.remove_work_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent().parent().parent();
                console.log(row_item);
                $(row_item).remove();
            });

        });
    </script>

    <script>
        $('input[name="bio"]').on('keyup keydown', updateCount);

        function updateCount() {
            $('#characters').text($(this).val().length);
        }
    </script>

</body>

</html>