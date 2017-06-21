<?php
// Connects to the database
$db = mysqli_connect('','','','', 3306)
or die('Error connecting to MySQL server.');
?>

<?php
// Gets the session information if the user is logged in
session_start();
?>

<?php
// Gets the filtering type from the URL
$search = $_REQUEST["q"];
?>

<?php
// Pull vehicles from database
$query = "SELECT * FROM Vehicle WHERE ModelYr LIKE '%" . $search . "%' OR Make LIKE '%" . $search . "%' OR Model LIKE '%" . $search . "%'";
mysqli_query($db, $query) or die('Error querying database.');
$result = mysqli_query($db, $query);
// Sets up the layout table to display results in
echo "<table border=0 id='usedCarsTable'>";
while ($row = mysqli_fetch_array($result)) {
	// Gets the image from the CloudFront CDN
	$imgurl = "" . $row['StockID'] . ".jpg";
	echo "<tr><td class='rec_imgCell'>";
	// Put the car image in the cell
	echo "<img class='rec_carImg' src='" . $imgurl . "' onclick='recordPageView(" . $row['StockID'] . ");' /> </td>";
	// Put the car details in the next cell
	echo "<td class='rec_infoCell'><a class='bigText'>" . $row['ModelYr'] . " " . $row['Make'] . " " . $row['Model'] . "</a><br>";
	echo "<a class='smallrText'>No-haggle price:</a><a class='smallText'> $" . number_format($row['Price']) . "</a><br>
		<a class='smallrText'>Mileage: </a><a class='smallText'>" . substr($row['Mileage'], 0, -3) . "K<br>
		<button id='btnViewVehicle' onclick='recordPageView(" . $row['StockID'] . ");'>View</button></td></tr>";
}

// Closes the database connection
mysqli_close($db);
?>
</table>
