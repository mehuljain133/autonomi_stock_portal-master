<?php
require_once "functions.php";
//$bill_date, $bill_amount, $bill_image_link, $stock_id, $quantity

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["stock_id"])) {
		insert_purchase($_POST["bill_date"], $_POST["bill_amount"], $_POST["bill_image_link"], $_POST["stock_id"], $_POST["quantity"]);
		header("Location: home.php");
	}
	else {
		insert_new_stock($_POST["bill_date"], $_POST["bill_amount"], $_POST["bill_image_link"], $_POST["name"], $_POST["description"], $_POST["image_link"], $_POST["quantity"]);
		header("Location: home.php");
	}
}
else {
	header("Location: index.php");
}

?>