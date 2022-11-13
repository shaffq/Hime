<?php
session_start();


// Create connection
$conn = new mysqli("localhost", "root", "", "himev2");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$username = $name = $email = $password = "";

if (isset($_POST["register"])) {
	$first_name = test_input($_POST["first_name"]);
	$last_name = test_input($_POST["last_name"]);
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$repassword = test_input($_POST["repassword"]);
	$usertype = test_input($_POST["usertype"]);

	if ($usertype == "freelancer") {
		$sql = "SELECT * FROM freelancer WHERE username = '$username' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION["errorMsg2"] = "Error";
		} else {
			unset($_SESSION["errorMsg2"]);
			$sql = "INSERT INTO freelancer (username, password, first_name, last_name) VALUES ('$username', '$password', '$first_name', '$last_name')";
			$result = $conn->query($sql);
			if ($result == true) {
				$_SESSION["Username"] = $username;
				$_SESSION["Usertype"] = 1;
				header("location: pages-registerFreelancer2.php");
			}
		}
	} else {
		$sql = "SELECT * FROM client WHERE username = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION["errorMsg2"] = "Error";
		} else {
			unset($_SESSION["errorMsg2"]);
			$sql = "INSERT INTO client (username, password, first_name, last_name) VALUES ('$username', '$password', '$first_name', '$last_name')";
			$result = $conn->query($sql);
			if ($result == true) {
				$_SESSION["Username"] = $username;
				$_SESSION["Usertype"] = 2;
				header("location: pages-registerClient2.php");
			}
		}
	}
} else if (isset($_POST["editRegister"])) {
	$first_name = test_input($_POST["first_name"]);
	$last_name = test_input($_POST["last_name"]);
	$username = test_input($_POST["username"]);
	$currentPassword = test_input($_POST["currentPassword"]);
	$password = test_input($_POST["password"]);
	$repassword = test_input($_POST["repassword"]);

	$sql = "UPDATE freelancer SET first_name='$first_name', last_name='$last_name', password='$password' WHERE username='$username'";
	$result = $conn->query($sql);
} else if (isset($_POST["next1"])) {
	$email = test_input($_POST["email"]);
	$contact_no = test_input($_POST["contact_no"]);
	$birthdate = test_input($_POST["birthdate"]);
	$gender = test_input($_POST["gender"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE freelancer SET email='$email', contact_no='$contact_no', birthdate='$birthdate', gender='$gender', address='$address', city='$city', state='$state', postcode='$postcode' WHERE username='$username'";
	$result = $conn->query($sql);
	if ($result == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 1;
		header("location: pages-registerFreelancer3.php");
	}
} else if (isset($_POST["edit1"])) {
	$email = test_input($_POST["email"]);
	$contact_no = test_input($_POST["contact_no"]);
	$birthdate = test_input($_POST["birthdate"]);
	$gender = test_input($_POST["gender"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE freelancer SET email='$email', contact_no='$contact_no', birthdate='$birthdate', gender='$gender', address='$address', city='$city', state='$state', postcode='$postcode' WHERE username='$username'";
	$result = $conn->query($sql);
} else if (isset($_POST["next2"])) {
	$bio = test_input($_POST["bio"]);
	$about_me = test_input($_POST["about_me"]);
	$skills = test_input($_POST["skills"]);
	$languages = test_input($_POST["languages"]);
	$social_facebook = test_input($_POST["social_facebook"]);
	$social_linkedin = test_input($_POST["social_linkedin"]);
	$social_instagram = test_input($_POST["social_instagram"]);
	$username = test_input($_POST["username"]);

	$values = array();
	for ($i = 0; $i < count($_POST['institute']); $i++) {
		$values[] = '("' . $username . '","' . $_POST['institute'][$i] . '","' . $_POST['specialization'][$i] . '","' . $_POST['edu_description'][$i] . '","' . $_POST['edu_start'][$i] . '","' . $_POST['edu_end'][$i] . '")';
	}
	$sql = "INSERT INTO freelancer_edu(f_username, institute, specialization, description, start_date , end_date) VALUES " . implode(',', $values);
	$result = $conn->query($sql);

	$values2 = array();
	for ($x = 0; $x < count($_POST['company']); $x++) {
		$values2[] = '("' . $username . '","' . $_POST['company'][$x] . '","' . $_POST['position'][$x] . '","' . $_POST['work_description'][$x] . '","' . $_POST['work_start'][$x] . '","' . $_POST['work_end'][$x] . '")';
	}
	$sql2 = "INSERT INTO freelancer_work(f_username, company, position, description, start_date, end_date) VALUES " . implode(',', $values2);
	$result2 = $conn->query($sql2);

	$sql3 = "INSERT INTO freelancer_social(f_username, instagram, linkedin, facebook) VALUES ('$username','$social_facebook','$social_linkedin','$social_instagram')";
	$result3 = $conn->query($sql3);

	$sql4 = "UPDATE freelancer SET bio='$bio', about_me='$about_me', skills='$skills', languages='$languages' WHERE username='$username'";
	$result4 = $conn->query($sql4);
	if ($result4 == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 1;
		header("location: pages-registerFreelancer4.php");
	}
} else if (isset($_POST["edit2"])) {
	$bio = test_input($_POST["bio"]);
	$about_me = test_input($_POST["about_me"]);
	$skills = test_input($_POST["skills"]);
	$languages = test_input($_POST["languages"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE freelancer SET bio='$bio', about_me='$about_me', skills='$skills', languages='$languages' WHERE username='$username'";
	$result = $conn->query($sql);
} else if (isset($_POST["next3"])) {
	$service = test_input($_POST["service"]);
	$username = test_input($_POST["username"]);


	$sql = "UPDATE freelancer SET service='$service' WHERE username='$username'";
	$result = $conn->query($sql);

	$sql2 = "INSERT INTO wallet (f_username, total_earned, balance, withdrawn) VALUES ('$username', 0, 0, 0)";
	$result2 = $conn->query($sql2);

	if ($result == true && $result2 == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 1;
		header("location: pages-registerSuccess.php");
	}
} else if (isset($_POST["edit3"])) {
	$service_availability = test_input($_POST["service_availability"]);
	$username = test_input($_POST["username"]);


	$sql = "UPDATE freelancer SET service_availability='$service_availability' WHERE username='$username'";
	$result = $conn->query($sql);
} else if (isset($_POST["nextClient1"])) {
	$types = test_input($_POST["types"]);
	$description = test_input($_POST["description"]);
	$contact_no = test_input($_POST["contact_no"]);
	$email = test_input($_POST["email"]);
	$website = test_input($_POST["website"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE client SET types='$types', contact_no='$contact_no', address='$address', city='$city', state='$state', postcode='$postcode', description='$description', website='$website', email='$email' WHERE username='$username'";
	$result = $conn->query($sql);
	if ($result == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 2;
		header("location: pages-registerSuccess.php");
	}
} else if (isset($_POST["editClient1"])) {
	$contact_no = test_input($_POST["contact_no"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$description = test_input($_POST["description"]);
	$website = test_input($_POST["website"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE client SET contact_no='$contact_no', address='$address', city='$city', state='$state', postcode='$postcode', description='$description', website='$website' WHERE username='$username'";
	$result = $conn->query($sql);
}

if (isset($_SESSION["errorMsg2"])) {
	$errorMsg2 = $_SESSION["errorMsg2"];
	unset($_SESSION["errorMsg2"]);
} else {
	$errorMsg2 = "";
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = addslashes($data);
	return $data;
}

//$conn->close();
