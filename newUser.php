
<?php
	// Database connection
	$db = mysqli_connect('cm-database.czvehxkx0tve.us-west-2.rds.amazonaws.com','hayes1rp','carmaxroot','carmaxDB', 3306)
	or die('Error connecting to MySQL server.');
?>

<?php
	$firstName = $_POST['fname'];
	$lastName = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['newpass'];
	$username = strtok($email, '@');
	echo $firstName . $lastName . $email . $password . $username;
	
	// Create random user ID #
	$userID = rand(1000,9999);
	$query = "SELECT userID FROM Authentication";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		if ($row['userID'] = $userID)
			$userID = rand(1000,9999);
		
	}
	// Publish user information to Auth table
	$query = "INSERT INTO Authentication (userID, username, password) VALUES ('" . $userID . "', '" . $username . "', '" . $password . "');";
	echo $query;
	mysqli_query($db, $query) or die('Error querying database.');
	// Publish user information to Customer table
	$query = "INSERT INTO Customer (CustomerID, LastName, FirstName, Email)
	VALUES ('" . $userID . "', '" . $lastName . "', '" . $firstName . "', '" . $email . "');";
	mysqli_query($db, $query) or die('Error querying database.');
	// Save userID to session and re-direct to index
	session_start();
	$_SESSION["currentUser"] = $userID;
	header("Location: index.php");
mysqli_close($db);
?>