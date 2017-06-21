<?php
// Connects to the database
$db = mysqli_connect('','','','', 3306)
or die('Error connecting to MySQL server.');
?>

<?php
// Gets the session information if the user is logged in
session_start();
echo $_SESSION['currentUser'];
?>

<?php
// Gets the vehicle that was viewed
$stockId = $_REQUEST["sid"];
?>

<?php
// Generate the page view id
$query = "SELECT MAX(ViewID) FROM PageView";
mysqli_query($db, $query) or die('Error querying database.');
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)) {
	$viewid = $row['MAX(ViewID)'] + 1;
}

// Insert the new row
$query = "INSERT INTO `carmaxDB`.`PageView` (`ViewID`, `ViewDate`, `CustomerID`, `StockID`) VALUES ('" . $viewid . "', '" . date("Y-m-d") . "', '3107', '" . $stockId . "');";
echo $query;
mysqli_query($db, $query) or die('Error querying database.');

// Closes the database connection
mysqli_close($db);
?>
