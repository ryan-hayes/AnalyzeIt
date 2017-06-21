<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
    <!--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	-->
	<link rel="stylesheet" media="screen and (min-width: 900px)" href="assets/css/web900.css">
	<link rel="stylesheet" media="screen and (min-width: 1300px)" href="assets/css/web1300.css">
	<link rel="stylesheet" media="screen and (min-width: 1600px)" href="assets/css/web1600.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script>

	document.addEventListener("DOMContentLoaded", responsiveness_driver);
	// Populate the page with vehicles from inventory
	function populate() {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("usedVehicles").innerHTML = this.responseText;
                document.getElementById("web_body_results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getVehicles.php?filter=0", true);
        xmlhttp.send();
    }
    populate(); // Method call
    // Listener for the session banner (if the user is logged in already)
    document.addEventListener("DOMContentLoaded", applySessionBanner);
    // Apply filters to the vehicles being displayed
	function applyFilter(num) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("usedVehicles").innerHTML = this.responseText;
                document.getElementById("rec_content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getRecVehicles.php?filter=" + num, true);
        xmlhttp.send();
    }
    // Apply a keyword search to the vehicles being displayed
	function applySearch(txt) {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("usedVehicles").innerHTML = this.responseText;
                document.getElementById("web_body_results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "searchVehicles.php?q=" + txt, true);
        xmlhttp.send();
    }
    // Get recommendations for a logged-in user
	function applyRecs() {
        document.getElementById('rec_content').innerHTML = "";
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("myReccs").innerHTML = this.responseText;
                document.getElementById("rec_content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getRecommendations.php", true);
        xmlhttp.send();
    }
    // Apply the session banner for a logged-in user
	function applySessionBanner() {
        document.getElementById('user_banner').innerHTML = "";
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("user_banner").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "sessionHandler.php", true);
        xmlhttp.send();
    }
    // Set up the recommendations pane for a logged in user
	function switchToRecs() {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("web_body_recommendations").innerHTML = this.responseText;
                applyRecs();
            }
        };
        xmlhttp.open("GET", "switchToRecs.php", true);
        xmlhttp.send();
    }
    // Record the page view if a vehicle is clicked on
	function recordPageView(stockNumber) {
        $.ajax({
    		url: "recordPageView.php?sid=" + stockNumber,
    		data: stockNumber
		});
		alert("DEMO: You viewed vehicle #" + stockNumber + ". Your page view has been recorded.");
	applyRecs();
	window.scrollTo(0, 0);
    	}

    	document.addEventListener("DOMContentLoaded", switchToRecs);

	// Adjust the site based on the device that is connecting
	function responsiveness_driver() {
		if (window.innerWidth < 768) {
			window.location = "http://mobile.cm-analyze.net/";
		}
		else {
			// do nothing
		}
	}
    </script>
	<title>CM AnalyzeIT Demonstration</title>
	</head>

<body>

	<div id="web">
		<div id="web_header">
			<a href="index.php"><img id="web_header_logo" src="assets/img/CMlogo.png"/></a>
			<a id="user_banner" style="margin-right:20%;float:right; color: black; padding-top:0.75%;padding-bottom:0.75%;"></a>
		</div>
		<div id="web_subheader">
			Used Cars for Sale
		</div>
		<div id="web_body">
			<form id="web_body_search">
				<p>NARROW MATCHES BY:<p><br><br>
				<input id="web_body_txtSearch" type="text" name="keyword" value="Search All Cars by Make, Model, or Keyword" onfocus="if (this.value=='Search All Cars by Make, Model, or Keyword') this.value=''; " onfocusout="if (this.value=='') this.value='Search All Cars by Make, Model, or Keyword'; " onkeyup="applySearch(this.value);" >
			</form>
						<script>
				function switchToAuthPanel() {
					document.getElementById("where_to_start").style.display = "none";
					document.getElementById("auth").style.display = "block";
				}
				function switchBackToWelcome() {
					document.getElementById("where_to_start").style.display = "block";
					document.getElementById("auth").style.display = "none";
				}
				function btnFocus(id) {
					if (id === 1) {
						document.getElementById("btnSignIn").style.background = "#3672b3";
						document.getElementById("btnSignIn").style.color = "white";
						document.getElementById("btnRegister").style.background = "white";
						document.getElementById("btnRegister").style.color = "darkslategray";
						document.getElementById("frmSignIn").style.display = "block";
						document.getElementById("frmRegister").style.display = "none";
					}
					if (id === 2) {
						document.getElementById("btnRegister").style.background = "#3672b3";
						document.getElementById("btnRegister").style.color = "white";
						document.getElementById("btnSignIn").style.background = "white";
						document.getElementById("btnSignIn").style.color = "darkslategray";
						document.getElementById("frmSignIn").style.display = "none";
						document.getElementById("frmRegister").style.display = "block";
					}
				}
			</script>
			<section id="web_body_results" class="well"></section>
			<section id="web_body_recommendations" class="well"></section>
		</div>

	</div>
</body>
<script>
	var acc = document.getElementsByClassName("accord");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].onclick = function(){
	        /* Toggle between adding and removing the "active" class,
	        to highlight the button that controls the panel */
	        this.classList.toggle("active");

	        /* Toggle between hiding and showing the active panel */
	        var panel = this.nextElementSibling;
	        if (panel.style.display === "block") {
	            panel.style.display = "none";
	        } else {
	            panel.style.display = "block";
	        }
	    }
	}
	</script>
</html>
