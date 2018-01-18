<?php
session_start();
include_once "../Portal/Includes/db.php";
include_once "../Portal/Includes/functions.php";
include_once "../Portal/Includes/classes.php";
date_default_timezone_set('Europe/London');
$submit = strip_tags(htmlentities($_POST['submit'],ENT_QUOTES | ENT_IGNORE, "UTF-8"));

if (isset($submit) && $_SERVER['REQUEST_METHOD'] == "POST") {

	// Prepare Query

$stmt =$conn->prepare("SELECT ID, u_name, user_image, u_first, u_last, u_email, u_pwd, user_role FROM user WHERE u_name = ? ");

//Sanitize $_POST
$user = escape($_POST['u_name']);
$pass = escape($_POST['pwd']);
// Bind and Execute
$stmt->bind_param("s", $user);
$stmt->execute();

//Bind and store Results
$stmt->bind_result($ID, $u_name, $user_image, $u_first, $u_last, $u_email, $u_pwd, $user_role);
$stmt->store_result();
//Fetch Data
$stmt->fetch();

//Check if STMT is == 1 returned value if not Redirect to login page
if ($stmt->num_rows == 1 && $stmt->num_rows < 2) {
$stmt->close();

	// Verify Password compare database to user input
	if(password_verify($pass, $u_pwd)) {
		// If password verifies create Sessions..
		 			 $_SESSION['ID'] = $ID;
	         $_SESSION['u_name'] = $u_name;
	         $_SESSION['user_image'] =$user_image;
	         $_SESSION['u_first'] = $u_first;
	         $_SESSION['u_last'] = $u_last;
	         $_SESSION['u_email'] = $u_email;
	         $_SESSION['user_role'] = $user_role;
         				// Update Last Signed in
					 $format = date('d/m/Y H:i:s');
					 $stmt1 = $conn->prepare("UPDATE user SET Last_Signed_in = ? WHERE ID = ?");
					 $stmt1->bind_param("si", $format, $ID);
					 $stmt1->execute();
					 $stmt1->close();
					 $log = "Accessed CMS";
				         $user = $_SESSION['u_name'];
				         $wonum = "Login";

				         $test = new log();
				         $test->logaction($log, $wonum, $user);

					 header("Location: ../Portal/index.php");
					} else {
						header("Location: ../index.php");
						die();
					}
					} else {
						header("Location: ../index.php");
						die();
					}
	} else {
		header("Location: ../index.php");
	    	die();
	}
?>
