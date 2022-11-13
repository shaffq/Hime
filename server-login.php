<?php
session_start();


// Create connection
$conn = new mysqli("localhost", "root", "", "himev2");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST["login"])){
	session_unset();
	$username=test_input($_POST["username"]);
	$password=test_input($_POST["password"]);
	$usertype=test_input($_POST["usertype"]);

	if ($usertype=="freelancer") {
		$sql = "SELECT * FROM freelancer WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		if($result->num_rows == 1){
			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=1;
			unset($_SESSION["errorMsg"]);
			header("location: dashboard-freelancer.php");
		}
		else{
			$_SESSION["errorMsg"]="Error";
		}
	}
	else{
		$sql = "SELECT * FROM client WHERE username = '$username' AND password = '$password'";
		$result = $conn->query($sql);
		if($result->num_rows == 1){
			$_SESSION["Username"]=$username;
			$_SESSION["Usertype"]=2;
			unset($_SESSION["errorMsg"]);
			header("location: dashboard-client.php");
		}
		else{
			$_SESSION["errorMsg"]="Error";
		}
	}
	
}


if(isset($_SESSION["errorMsg"])){
	$errorMsg=$_SESSION["errorMsg"];
	unset($_SESSION["errorMsg"]);
}
else{
	$errorMsg="";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//$conn->close();
?>