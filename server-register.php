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
	// $repassword = test_input($_POST["repassword"]);
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
			$ran_id = rand(time(), 100000000);
			$encrypt_pass = md5($password);
			
			$sql2 = "INSERT INTO users (unique_id, fname, lname, email, password, img, status)VALUES ('$ran_id', '$first_name','$last_name', '$username', '$encrypt_pass', 'profile.jpg', 'Offline')";
			$result2 = $conn->query($sql2);

			$sql3 = "INSERT INTO wallet (f_username, total_earned, balance, withdrawn) VALUES ('$username', 0, 0, 0)";
			$result3 = $conn->query($sql3);

			if ($result3 == true) {
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
} else if (isset($_POST["editAccount"])) {
	$username = test_input($_POST["username"]);
	$currentPassword = test_input($_POST["currentPassword"]);
	$password = test_input($_POST["password"]);
	$repassword = test_input($_POST["repassword"]);

	$sql = "SELECT password FROM freelancer WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$checkPassword = $row["password"];

			if ($currentPassword == $checkPassword) {
				$sql = "UPDATE freelancer SET password='$password' WHERE username='$username'";
				$result = $conn->query($sql);

				if ($result == true) {
					header("location: pages-setting.php");
				}
			} else {
				header("location: dashboard-freelancer.php");
			}
		}
	} else {
	}
} else if (isset($_POST["editAccountClient"])) {
	$username = test_input($_POST["username"]);
	$currentPassword = test_input($_POST["currentPassword"]);
	$password = test_input($_POST["password"]);
	$repassword = test_input($_POST["repassword"]);

	$sql = "SELECT password FROM client WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$checkPassword = $row["password"];

			if ($currentPassword == $checkPassword) {
				$sql = "UPDATE client SET password='$password' WHERE username='$username'";
				$result = $conn->query($sql);

				if ($result == true) {
					header("location: pages-setting.php");
				}
			} else {
				header("location: dashboard-client.php");
			}
		}
	} else {
	}
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
	$first_name = test_input($_POST["first_name"]);
	$last_name = test_input($_POST["last_name"]);
	$email = test_input($_POST["email"]);
	$contact_no = test_input($_POST["contact_no"]);
	$birthdate = test_input($_POST["birthdate"]);
	$gender = test_input($_POST["gender"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE freelancer SET first_name='$first_name', last_name='$last_name', email='$email', contact_no='$contact_no', birthdate='$birthdate', gender='$gender', address='$address', city='$city', state='$state', postcode='$postcode' WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result == true) {
		header("location: pages-setting.php");
	}
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

	$sql5 = "DELETE FROM freelancer_edu WHERE f_username='$username'";
	$result5 = $conn->query($sql5);

	$sql6 = "DELETE FROM freelancer_work WHERE f_username='$username'";
	$result6 = $conn->query($sql6);

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
		header("location: pages-setting.php");
	}
} else if (isset($_POST["next3"])) {
	$service = test_input($_POST["service"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE freelancer SET service='$service' WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 1;
		header("location: pages-registerSuccess.php");
	}
} else if (isset($_POST["edit3"])) {
	$service = test_input($_POST["service"]);
	$username = test_input($_POST["username"]);
	$social_facebook = test_input($_POST["social_facebook"]);
	$social_linkedin = test_input($_POST["social_linkedin"]);
	$social_instagram = test_input($_POST["social_instagram"]);

	$sql = "UPDATE freelancer SET service='$service' WHERE username='$username'";
	$result = $conn->query($sql);

	$sql2 = "UPDATE freelancer_social SET instagram='$social_instagram', linkedin='$social_linkedin', facebook='$social_facebook' WHERE f_username='$username'";
	$result2 = $conn->query($sql2);

	if ($result2 == true) {
		header("location: pages-setting.php");
	}
} else if (isset($_POST["nextClient1"])) {
	$types = test_input($_POST["types"]);
	$first_name = test_input($_POST["first_name"]);
	$last_name = test_input($_POST["last_name"]);
	$email = test_input($_POST["email"]);
	$contact_no = test_input($_POST["contact_no"]);
	$website = test_input($_POST["website"]);
	$description = test_input($_POST["description"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE client SET types='$types', first_name='$first_name', last_name='$last_name', email='$email', contact_no='$contact_no', website='$website', client_description='$description', address='$address', city='$city', state='$state', postcode='$postcode' WHERE username='$username'";
	$result = $conn->query($sql);
	if ($result == true) {
		$_SESSION["Username"] = $username;
		$_SESSION["Usertype"] = 2;
		header("location: pages-registerSuccess.php");
	}
} else if (isset($_POST["editClient1"])) {
	$types = test_input($_POST["types"]);
	$first_name = test_input($_POST["first_name"]);
	$last_name = test_input($_POST["last_name"]);
	$email = test_input($_POST["email"]);
	$contact_no = test_input($_POST["contact_no"]);
	$address = test_input($_POST["address"]);
	$city = test_input($_POST["city"]);
	$state = test_input($_POST["state"]);
	$postcode = test_input($_POST["postcode"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE client SET types='$types', first_name='$first_name', last_name='$last_name', email='$email', contact_no='$contact_no', address='$address', city='$city', state='$state', postcode='$postcode' WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result == true) {
		header("location: pages-setting.php");
	}
} else if (isset($_POST["editClient2"])) {
	$website = test_input($_POST["website"]);
	$description = test_input($_POST["description"]);
	$username = test_input($_POST["username"]);

	$sql = "UPDATE client SET website='$website', client_description='$description' WHERE username='$username'";
	$result = $conn->query($sql);

	if ($result == true) {
		header("location: pages-setting.php");
	}
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
