<?php

function insert_purchase ($bill_date, $bill_amount, $bill_image_link, $stock_id, $quantity) {
	$conn = setup();

	$bill_id = enter_bill($bill_date, $bill_amount, $bill_image_link);

	$sql = "INSERT INTO purchase_list (stock_id, quantity, bill_id) VALUES (".$stock_id.", ".$quantity.", ".$bill_id.")";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function insert_new_stock ($bill_date, $bill_amount, $bill_image_link, $name, $description, $image_link, $quantity) {
	$conn = setup();

	$stock_id = define_new_stock($name, $description, $image_link);

	insert_purchase($bill_date, $bill_amount, $bill_image_link, $stock_id, $quantity);
}

function delete_stock ($stock_id, $quantity, $reason) {
	$conn = setup();

	$sql = "INSERT INTO deleted_stock VALUES (".$stock_id.", ".$quantity.", '".$reason."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function create_new_user($user_fullname, $u_name, $password, $email_id) {
	$conn = setup();

	$sql = "INSERT INTO users (user_fullname, username, password, email_id, user_type) VALUES (\"".$user_fullname."\", \"".$u_name."\", \"".md5($password)."\", \"".$email_id."\", 'student')";

	$conn -> query($sql);

	$conn->close();
}

function login($u_name, $password) {
	$conn = setup();

	$result = $conn -> query("select user_id from users where username = \"".$u_name."\" && password = \"".md5($password)."\"");
	if ($result->num_rows > 0) {
		$data = $result->fetch_assoc();
		$_SESSION["user_id"] = $data["user_id"];
		$conn->close();
		return TRUE;
	}
	else {
		$conn->close();
		return FALSE;
	}
}

function get_username() {
	$conn = setup();

	$result = $conn -> query("SELECT username FROM users WHERE user_id = ".$_SESSION["user_id"].";");
	if ($result->num_rows > 0) {
		$data = $result->fetch_assoc();
		$u_name = $data["username"];
		$conn->close();
		return $u_name;
	}
	else {
		echo "error in getting username";
		$conn->close();
		return FALSE;
	}
}

function get_stock_name($stock_id) {
	$conn = setup();

	$result = $conn -> query("SELECT name FROM stock_description WHERE stock_id = $stock_id");
	if ($result->num_rows > 0) {
		$data = $result->fetch_assoc();
		$name = $data["name"];
		$conn->close();
		return $name;
	}
	else {
		echo "error in getting stock name";
		$conn->close();
		return FALSE;
	}
}

function check_user_type () {
	$conn = setup();

	$result = $conn -> query("SELECT user_type FROM users WHERE user_id = ".$_SESSION["user_id"].";");
	if ($result->num_rows > 0) {
		$data = $result->fetch_assoc();
		$user_type = $data["user_type"];
		$conn->close();
		return $user_type;
	}
	else {
		echo "error in getting user_type";
		$conn->close();
		return FALSE;
	}
}

function calculate_quantity ($flag, $stock_id) {
	# TOTAL PURCHASED
	if ($flag == 0) {
		return get_purchased_quantity($stock_id);
	}
	# TOTAL PURCHASED - DELETED
	else if ($flag == 1) {
		return get_purchased_quantity($stock_id) - get_deleted_quantity($stock_id);
	}
	# TOTAL PURCHASED - DELETED - ISSUED
	else if ($flag == 2) {
		return get_purchased_quantity($stock_id) - get_deleted_quantity($stock_id) - get_issued_quantity($stock_id);
	}
	else {
		echo "invalid flag input";
	}
}

function get_purchased_quantity ($stock_id) {
	$conn = setup();
	$quantity = 0;

	$result = $conn->query("SELECT quantity FROM purchase_list WHERE stock_id = $stock_id");
	# for checking if there was any result, without this there will be an error in some cases
	if ($result->num_rows > 0) {
		while ($data = $result->fetch_assoc()) {
			$quantity += $data["quantity"];
		}
	}
	$conn->close();
	return $quantity;
}

function get_deleted_quantity ($stock_id) {
	$conn = setup();
	$quantity = 0;
	
	$result = $conn->query("SELECT quantity FROM deleted_stock WHERE stock_id = $stock_id");
	# for checking if there was any result, without this there will be an error in some cases
	if ($result->num_rows > 0) {
		while ($data = $result->fetch_assoc()) {
			$quantity += $data["quantity"];
		}
	}
	$conn->close();
	return $quantity;
}

function get_issued_quantity ($stock_id) {
	$conn = setup();
	$quantity = 0;
	
	$result = $conn->query("SELECT quantity FROM issued_stock_list WHERE stock_id = $stock_id");
	# for checking if there was any result, without this there will be an error in some cases
	if ($result->num_rows > 0) {
		while ($data = $result->fetch_assoc()) {
			$quantity += $data["quantity"];
		}
	}
	$conn->close();
	return $quantity;
}

function issue_stock ($user_id, $stock_id, $quantity) {
	$conn = setup();

	$sql = "INSERT INTO issued_stock_list (user_id, stock_id, quantity, issue_date, return_date) VALUES (".$user_id.", ".$stock_id.", ".$quantity.", curdate(), date_add(curdate(), INTERVAL 2 WEEK))";

	if ($conn->query($sql) === TRUE) {
	    echo "New issue request created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

function return_stock ($user_id, $issue_id, $stock_id, $issue_date, $issued_quantity, $return_quantity) {
	$conn = setup();

	if ($return_quantity == $issued_quantity) {
		$sql = "UPDATE issued_stock_list SET return_status = 'pending' WHERE issue_id = $issue_id";

		if ($conn->query($sql) === TRUE) {
		    echo "Return Request has been sent";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		$sql = "INSERT INTO issued_stock_list (user_id, stock_id, quantity, issue_date, return_date, return_status) VALUES (".$user_id.", ".$stock_id.", ".$return_quantity.", '".$issue_date."', date_add('$issue_date', INTERVAL 2 WEEK), 'pending')";
		
		if ($conn->query($sql) === TRUE) {
		    echo "Return successful in return reissue";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = "UPDATE issued_stock_list SET quantity = ".$issued_quantity - $return_quantity." WHERE issue_id = $issue_id";	

		if ($conn->query($sql) === TRUE) {
		    echo "updated the issued quantity";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
}

function reissue_stock ($user_id, $issue_id, $stock_id, $issued_quantity, $reissue_quantity) {
	$conn = setup();

	if ($issued_quantity == $reissue_quantity) {
		$sql = "UPDATE issued_stock_list SET return_date = date_add(curdate(), INTERVAL 2 WEEK) WHERE issue_id = $issue_id";

		if ($conn->query($sql) === TRUE) {
		    echo "Reissue successful";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		issue_stock ($user_id, $stock_id, $reissue_quantity);
		$sql = "UPDATE issued_stock_list SET quantity = ".$issued_quantity - $reissue_quantity." WHERE issue_id = $issue_id";

		if ($conn->query($sql) === TRUE) {
		    echo "updated the issued quantity";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();
}

// function return_reissue_stock ($user_id, $issue_id, $stock_id, $issue_date, $issued_quantity, $return_quantity, $reissue_quantity) {
// 	$conn = setup();

// 	issue_stock ($user_id, $stock_id, $reissue_quantity);
// 	$sql = "INSERT INTO issued_stock_list (user_id, stock_id, quantity, issue_date, return_date, return_status) VALUES (".$user_id.", ".$stock_id.", ".$return_quantity.", $issue_date, date_add($issue_date, INTERVAL 2 WEEK), 'pending')";
	
// 	if ($conn->query($sql) === TRUE) {
// 	    echo "Return successful in return reissue";
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . $conn->error;
// 	}

// 	$sql = "UPDATE issued_stock_list SET quantity = ".$issued_quantity - $return_quantity - $reissue_quantity." WHERE issue_id = $issue_id";	

// 	if ($conn->query($sql) === TRUE) {
// 	    echo "updated the issued quantity";
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . $conn->error;
// 	}

// 	$conn->close();
// }

function enter_bill ($bill_date, $bill_amount, $bill_image_link) {
	$conn = setup();

	$sql = "INSERT INTO bills (bill_date, bill_amount, bill_image_link) VALUES (\"".$bill_date."\", ".$bill_amount.", \"".$bill_image_link."\")";

	if ($conn->query($sql) === TRUE) {
		$result = $conn -> query("SELECT bill_id FROM bills WHERE bill_date = \"".$bill_date."\" && bill_amount = ".$bill_amount." && bill_image_link = \"".$bill_image_link."\"");
		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			$bill_id = $data["bill_id"];
			$conn->close();
			return $bill_id;
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}

function define_new_stock ($name, $description, $image_link) {
	$conn = setup();

	$sql = "INSERT INTO stock_description (name, description, image_link) VALUES (\"".$name."\", \"".$description."\", \"".$image_link."\")";

	if ($conn->query($sql) === TRUE) {
		$result = $conn -> query("SELECT stock_id FROM stock_description WHERE name = \"".$name."\" && description = \"".$description."\" && image_link = \"".$image_link."\"");
		if ($result->num_rows > 0) {
			$data = $result->fetch_assoc();
			$stock_id = $data["stock_id"];
			$conn->close();
			return $stock_id;
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}


function validate_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
}

function setup() {
	$servername = "localhost";
	$username = "root";
	$pass = "";
	$db_name = "Stock";

	$conn = new mysqli($servername, $username, $pass);
	
	$conn->query("use ".$db_name);
	return $conn;
}

?>