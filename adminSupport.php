<?php
// Connect to the database
$db = mysqli_connect('','','','', 3306)
or die('Error connecting to MySQL server.');
?>

<?php
// Get the global variables
session_start();
?>

<?php
// Get the type from the URL
$view = $_REQUEST["type"];
echo $view;
?>

<?php
if ($view = 0) {
	$query = "SELECT * FROM PageView";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	echo "<table border=1 style='width:100%'><thead><th>View ID</th><th>View Date</th><th>Customer ID</th><th>Stock ID</th></thead>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['ViewID'] . "</td><td>" . $row['ViewDate'] . "</td><td>" . $row['CustomerID'] . "</td><td>" . $row['StockID'] . "</td></tr>";

	}
}
if ($view = 2) {
	$query = "SELECT * FROM PageView";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	echo "<table border=1 style='width:100%'><thead><th>View ID</th><th>View Date</th><th>Customer ID</th><th>Stock ID</th></thead>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['ViewID'] . "</td><td>" . $row['ViewDate'] . "</td><td>" . $row['CustomerID'] . "</td><td>" . $row['StockID'] . "</td></tr>";

	}
}
// Closes the database connection
mysqli_close($db);
?>
