<?php
// Get the global variables
session_start();

// If the session exists...
if (is_numeric($_SESSION['currentUser'])) {
	// Set global variables for recommendations
	$user_id = $_SESSION['currentUser'];
	$last_name = "";
	$first_name = "";
	$num_vehicles = 0;
	$ext_color = ""; //
	$int_color = ""; //
	$avg_miles = 0;
	$avg_price = 0;
	$avg_size = 0;
	//$pref_brand = "";
	$pref_year = 0;
	// Connection string to database
	$db = mysqli_connect('','','','', 3306)
	or die('Error connecting to MySQL server.');
	// STEP 1 - Get the basic information
	$query = "SELECT LastName, FirstName FROM Customer WHERE " . $user_id . " = CustomerID";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$last_name = $row['LastName'];
		$first_name = $row['FirstName'];
		//echo $last_name;
		//echo "<br>" . $first_name;
	}
	// STEP 2 - Get the number of vehicles they have viewed
	$query = "SELECT COUNT(CustomerID) FROM PageView WHERE " . $user_id . " = CustomerID";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$num_vehicles = $row['COUNT(CustomerID)'];
		//echo "<br>" . $num_vehicles;
	}
	// STEP 3 - Get the exterior color preference
	$query = "SELECT ColorExt, COUNT(ColorExt) AS 'value_occurrence' FROM Vehicle INNER JOIN PageView ON Vehicle.StockID=PageView.StockID INNER JOIN Customer ON PageView.CustomerID=Customer.CustomerID WHERE Customer.CustomerID='3107' GROUP BY ColorExt ORDER BY value_occurrence DESC LIMIT 1 ";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$ext_color = $row['ColorExt'];
		//echo "<br>" . $ext_color;
	}
	// STEP 4 - Get the interior color preference
	$query = "SELECT ColorInt, COUNT(ColorInt) AS 'value_occurrence' FROM Vehicle INNER JOIN PageView ON Vehicle.StockID=PageView.StockID INNER JOIN Customer ON PageView.CustomerID=Customer.CustomerID WHERE Customer.CustomerID='3107' GROUP BY ColorInt ORDER BY value_occurrence DESC LIMIT 1 ";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$int_color = $row['ColorInt'];
		//echo "<br>" . $int_color;
	}
	// STEP 5 - Get the average miles/price/size and minimum model yr
	$query = "SELECT DISTINCT AVG(Vehicle.Mileage) AS 'Mileage - Avg', avg(Vehicle.Price) AS 'Mean - Price', AVG(Vehicle.Engine) AS 'Avg - Size', MIN(Vehicle.ModelYr) FROM Vehicle INNER JOIN PageView ON Vehicle.StockID=PageView.StockID INNER JOIN Customer ON PageView.CustomerID=Customer.CustomerID WHERE Customer.CustomerID='3107'";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$avg_miles = $row['Mileage - Avg'];
		$avg_price = $row['Mean - Price'];
		$avg_size = $row['Avg - Size'];
		$pref_year = $row['MIN(Vehicle.ModelYr)'];
		//echo "<br>" . $avg_miles . "<br>" . $avg_price . "<br>" . $avg_size . "<br>" . $pref_year;
	}
	// STEP 6 - Get the brand preference
	$query = "SELECT Make, COUNT(Make) AS 'value_occurrence' FROM Vehicle INNER JOIN PageView ON Vehicle.StockID=PageView.StockID INNER JOIN Customer ON PageView.CustomerID=Customer.CustomerID WHERE Customer.CustomerID='3107' GROUP BY Make ORDER BY value_occurrence DESC LIMIT 1 ";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)) {
		$pref_brand = $row['Make'];
		//echo "<br>" . $pref_brand;
	}
	// STEP 7 - Get some recommendations
	$query = "SELECT * FROM Vehicle WHERE ColorExt LIKE '" . $ext_color . "' AND
		ColorInt LIKE '" . $int_color . "'

		AND
		((Mileage > ('" . $avg_miles ."' - 20000)) AND
		(Mileage < ('" . $avg_miles ."' + 20000)))

		AND
		((Price > ('" . $avg_price ."' - 10000)) AND
		(Price < ('" . $avg_price ."' + 10000)))

		AND
		((Engine > ('" . $avg_size ."' - 2)) AND
		(Engine < ('" . $avg_size ."' + 2)))

		AND
		ModelYr >= '" . $pref_year . "' ORDER BY RAND() LIMIT 10";
	mysqli_query($db, $query) or die('Error querying database.');
	$result = mysqli_query($db, $query);
	// STEP 8 - Print them out to the screen
	setlocale(LC_MONETARY,"en_US");
	echo "<div class='container' style='width:100%'>
  		<button type='button' class='btn btn-basic' data-toggle='collapse' data-target='#demo'
			style='background:#fdde58; color: black; font-size: 14pt; width: 100%; margin-left:0%'>Recommendations</button>
  		<div id='demo' class='collapse'>
   			 <br>Based on the vehicles you've viewed, we found some you might be interested in.<br>" .
   			 "Exterior Color: <b>" . $ext_color . "</b><br>" .
   			 "Interior Color: <b>" . $int_color . "</b><br>" .
   			 "Mileage: <b>" . number_format($avg_miles) . "</b><br>" .
   			 "Price: <b>$" . number_format($avg_price,2) . "</b><br>" .
   			 "Size: <b>" . $avg_size . "</b><br>
  		</div>
		</div>";
	echo "<table border=0 id='usedCarsTable' style='margin-top:4%'>";
	while ($row = mysqli_fetch_array($result)) {
		// Gets the image from the CloudFront CDN
		$imgurl = "http://d3nvmyy5qbpxn2.cloudfront.net/img/" . $row['StockID'] . ".jpg";
		echo "<tr><td class='rec_imgCell' style='width:45%; padding-bottom: 5%; outline: none; border: none; border-radius: 0px'; >";
		// Put the car image in the cell
		echo "<img class='rec_carImg' src='" . $imgurl . "' onclick='recordPageView(" . $row['StockID'] . ");' /> </td>";
		// Put the car details in the next cell
		$in = $row['Make'] . " " . $row['Model'];
		$limit = 25;
		$out = strlen($in) > $limit ? substr($in,0,$limit)."..." : $in;
		echo "<td class='rec_infoCell'><a class='bigText' style='font-size:15pt;'>" . $out . "</a><br>";
		echo "<a class='recc-smallText' style='color:black;'>" . $row['ModelYr'] . "</a>
			<a class='rec_pricemile'> | </a>
			<a class='recc-smallText' style='color:black;'> $" . number_format($row['Price']) . "</a>
			<a class='rec_pricemile'> | </a>
			<a class='recc-smallText' style='color:black;'>" . substr($row['Mileage'], 0, -3) . "K
			<br>
			<button id='btnViewVehicle' style='padding: 2% 10% 2% 10%; width: 60%' class='btn btn-warning' onclick='recordPageView(" . $row['StockID'] . ");'>View</button></td></tr>";
		}
	// Close out the database connection
	mysqli_close($db);
}

// If the session doesn't exist...
else {
	echo "
        <div id='where_to_start'>
            <img id='wts-lightbulb' src='assets/img/lightbulb.png'>
            <h2>Where to Start?</h2>
            <p>Sign in or create an account to get personalized vehicle recommendations.</p>
            <input id='wts-go' class='btn btn-warning' type='button' value='Go' onclick='switchToAuthPanel();' />
        </div>
        <!-- Main auth panel -->
        <div id='auth' style='display:none'>
            <h2 id='txtMyCM_title' align='center'>MyCM</h2>
            <p id='txtMyCM_description'>Sign in or create an account to get personalized vehicle recommendations.</p>
            <!--Sign in/register buttons-->
            <form>
                <button class='btn btn-warning' id='btnSignIn' type='button' onclick='btnFocus(1);'>Sign In</button>
                <button class='btn btn-default' id='btnRegister' type='button' onclick='btnFocus(2);'>Register</button>
            </form>
            <!--Sign in form-->
            <form id='frmSignIn' name='frmSignIn' action='/verify.php' method='post'>
                <input id='auth-textbox' class='form-control' type='textbox' name='uid' value='Username' onfocus='if (this.value=='Username') this.value=''; ' onblur='if (this.value=='') this.value='Username'; '/>
                <input id='auth-textbox' class='form-control' type='password' name='pwd' value='Password' onfocus='if (this.value=='Password') this.value='';' onblur='if (this.value=='') this.value='Password'; '/>
                <button class='btn btn-primary' form='frmSignIn' type='submit' style='margin-top: 8%; margin-bottom: 15%'>Go!</button>
            </form>
            <!--Register form-->
            <form id='frmRegister' name='frmRegister' action='/newUser.php' method='post' style='display:none;'>
                <input id='auth-textbox' class='form-control' type='textbox' name='fname' value='First Name' onfocus='if (this.value=='First Name') this.value=''; ' onfocusout='if (this.value=='') this.value='First Name'; '></input>
                <input id='auth-textbox' class='form-control' type='textbox' name='lname' value='Last Name' onfocus='if (this.value=='Last Name') this.value=''; ' onfocusout='if (this.value=='') this.value='Last Name'; ' ></input>
                <input id='auth-textbox' class='form-control' type='textbox' name='email' value='E-mail Address' onfocus='if (this.value=='E-mail Address') this.value=''; ' onfocusout='if (this.value=='') this.value='E-mail Address'; ' ></input>
                <input id='auth-textbox' class='form-control' type='password' name='newpass' value='Password' onfocus='if (this.value=='Password') this.value=''; ' onfocusout='if (this.value=='') this.value='Password'; '></input>
                <button class='btn btn-primary' id='btnGo' class='ui-button ui-widget ui-corner-all' form='frmRegister' type='submit' style='margin-top: 8%; margin-bottom: 15%;'>Go!</button>
            </form>
        </div>";
}
?>
