<?php
// Connects to the database
$db = mysqli_connect('','','','', 3306)
or die('Error connecting to MySQL server.');
?>

<?php
// Gets the session information if the user is logged in
session_start();
//echo $_SESSION['currentUser'];
?>

<?php
// Send the query
$query = "SELECT MAX(ViewID) FROM PageView";
mysqli_query($db, $query) or die('Error querying database.');
$result = mysqli_query($db, $query);

echo $result;

// Closes the database connection
mysqli_close($db);
?>
</table>
