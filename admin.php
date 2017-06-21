<html>

<head>
	<meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	-->
	<link rel="stylesheet" media="screen and (min-width: 767px)" href="assets/css/web.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<title>ADMIN: AnalyzeIT Demonstration</title>

	<script>
	function openCity(evt, cityName) {
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the button that opened the tab
	    document.getElementById(cityName).style.display = "block";
	    evt.currentTarget.className += " active";
	}
	function populate(id) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("admin_content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "adminSupport.php?type=" + id, true);
        xmlhttp.send();
    }
	</script>
	</head>

<body>

	<div id="web">
		<div id="web_header">
			<a href="index.php"><img id="web_header_logo" src="assets/img/CMlogo.png"/></a>
		</div>
		<div id="admin_web_subheader">
			Administrative Tools
		</div>
		<div id="web_body">
			<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'Customers'); populate(0);">Customers</button>
			  <button class="tablinks" onclick="openCity(event, 'Vehicles'); populate(1);">Vehicles</button>
			  <button class="tablinks" onclick="openCity(event, 'Page Views'); populate(2);">Page Views</button>
			</div>

			<div id="Customers" class="tabcontent">
			  <h2>Customers</h2>
			  <div id="admin_content"></div>
			</div>

			<div id="Vehicles" class="tabcontent">
			  <h2>Vehicles</h2>
			  <div id="admin_content"></div>
			</div>

			<div id="Page Views" class="tabcontent">
			  <h2>Page Views</h2>
			  <div id="admin_content"></div>
			</div>
		</div>
</html>
