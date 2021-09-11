<?php
require_once "functions.php";
# add check for multiple users with same username
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["user_fullname"]) && isset($_POST["u_name"]) && isset($_POST["password"]) && isset($_POST["email_id"]) && isset($_POST["confirm_password"])) {
		if ($_POST["password"] === $_POST["confirm_password"]) {
			create_new_user($_POST["user_fullname"], $_POST["u_name"], $_POST["password"], $_POST["email_id"]);
		}
		else {
			$_SESSION["registration_error"] = "THE PASSWORDS DID NOT MATCH";
		}
		header("Location: index.php");
	}
}?>