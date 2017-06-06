
<?php
	// Database connection
$db = mysqli_connect('cm-database.czvehxkx0tve.us-west-2.rds.amazonaws.com','hayes1rp','carmaxroot','carmaxDB', 3306)
	or die('Error connecting to MySQL server.');
?>

<?php
	// Pull entries from database
	$query = "SELECT * FROM Authentication WHERE username = '" . $_POST['uid'] . "' AND password = '" . $_POST['pwd'] . "'";
	echo $query;
	mysqli_query($db, $query) or die('Error querying database.');

	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {
		session_start();
		$_SESSION["currentUser"] = $row['userID'];
		header("Location: index.php");
	}
mysqli_close($db);
?>