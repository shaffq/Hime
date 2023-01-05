<?php include('server.php');


if (isset($_POST["publish"])) {
    $cert_name = test_input($_POST["cert_name"]);
    $cert_desc = test_input($_POST["cert_desc"]);
    $cert_link = test_input($_POST["cert_link"]);

    $sql = "INSERT INTO certificate (cert_name, cert_desc, cert_link, status) VALUES ('$cert_name', '$cert_desc', '$cert_link', 'pending')";
    $result = $conn->query($sql);

    if ($result == true) {
        header("location: index.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Certificate</title>
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
        <div class="row height">
            <div class="col">
                <div class="row height">
                    <div class="col-3">
                        <a href="index.php">
                            <img src="sidebar/img/fullLogoBlack.png" style="max-width: 50%;margin-left: 20px; margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col mx-auto my-auto">
                        <main>
                            <form id="certForm" method="post" class="row g-3">

                                <div class="my-4">
                                    <h1 class="fw-bold">Advertise your <span class="text-primary">Certificate</span> Program.</h1>
                                    <h4 class="text-secondary">It's simple and easy</h4>
                                </div> 

                                <div class="col-12">
                                    <label for="cert_name" class="form-label">Courses Name</label>
                                    <input type="text" class="form-control" name="cert_name" id="cert_name">
                                </div>
                                <div class="col-12">
                                    <label for="cert_desc" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="cert_desc" id="cert_desc">
                                </div>
                                <div class="col-12">
                                    <label for="cert_link" class="form-label">Link</label>
                                    <input type="text" class="form-control" name="cert_link" id="cert_link">
                                </div>

                                <div class="my-4">
                                    <button class="btn btn-primary w-100" type="submit" name="publish">Publish</button>
                                </div>

                            </form>
                        </main>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
            </div>
            <div class="col p-0 d-flex justify-content-center align-items-center">
                <img src="img/register.jpg" class="img-fluid" alt="" style="width:100%; height:100%; object-fit:cover; border-radius: 30px 0px 0px 30px;">
            </div>
        </div>
    </div>
</body>

</html>