<?php
session_start();

// if the session exists...
if (is_numeric($_SESSION['currentUser'])) {
    // Connects to the database
		$db = mysqli_connect('','','','', 3306)
    or die('Error connecting to MySQL server.');
    // Pull current user from the database
    $query = "SELECT CustomerID, LastName, FirstName FROM Customer WHERE CustomerID='" . $_SESSION['currentUser'] . "'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo "<b>MyCarMax</b>
        <br><span style='font-size:10pt, color: black;'>Welcome back, " . $row['FirstName'] . " " . $row['LastName'] . "</span><br>";
    }
    // Closes the database connection
    mysqli_close($db);
}
?>
</table>
