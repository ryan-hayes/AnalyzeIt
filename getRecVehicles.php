<?php
// Connect to the database
$db = mysqli_connect('cm-database.czvehxkx0tve.us-west-2.rds.amazonaws.com','hayes1rp','carmaxroot','carmaxDB', 3306)
or die('Error connecting to MySQL server.');
?>

<?php
// Get the global variables
session_start();
?>

<?php
// Get the filtering type from the URL
$filter = $_REQUEST["filter"];
// Make ASC the default filtering parameter
$filters = array("Vehicle.Make ASC", "Vehicle.Price ASC", "Vehicle.Price DESC", "Vehicle.Mileage ASC", "Vehicle.Mileage DESC", "Vehicle.ModelYr DESC", "Vehicle.ModelYr ASC", "Vehicle.Make ASC", "Vehicle.EconCity ASC", "Vehicle.EconHwy ASC");
$appliedFilter = $filters[$filter];
?>

<?php
// Pull vehicles from database
$query = "SELECT DISTINCT Vehicle.StockID, Make, Model, ModelYr, Mileage, Price FROM Vehicle INNER JOIN PageView ON Vehicle.StockID=PageView.StockID WHERE PageView.CustomerID='" . $_SESSION['currentUser'] . "' ORDER BY " . $appliedFilter . " LIMIT 0, 8;";
mysqli_query($db, $query) or die('Error querying database.');
$result = mysqli_query($db, $query);
// Sets up the layout table to display results in
echo "<table border=0 id='rec_usedCarsTable'>";

while ($row = mysqli_fetch_array($result)) {
		// Get the vehicle image from CloudFront 
		$imgurl = "http://d3nvmyy5qbpxn2.cloudfront.net/img/" . $row['StockID'] . ".jpg";
		echo "<tr><td class='rec_imgCell'>";
		// Put the vehicle image in the first column
		echo "<img class='rec_carImg' src='" . $imgurl ."' onclick='addPageView(" . $row['StockID'] . ")'/> </td>";
		// Put the vehicle details in the second column
		echo "<td class='rec_infoCell'><a class='rec_bigText'>" . $row['ModelYr'] . " " . $row['Make'] . " " . $row['Model'] . "</a><br>";
		echo "<a class='rec_smallText'>$" . number_format($row['Price']) . "</a><a id='rec_mileage' class='rec_smallText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($row['Mileage'], 0, -3) . "K mi.</a>
		<br> <button id='rec_btnViewVehicle' onclick='recordPageView(" . $row['StockID'] . ");'>View</button></td></tr>";
}

// Closes the database connection
mysqli_close($db);
?>
</table>