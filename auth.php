<!DOCTYPE HTML>
<!--This page provides the layout and form for users to either log in or create a new account-->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AnalyzeIT Demonstration</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="assets/css/auth.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	// Show/hide function for the sign in and register panels
	function btnFocus(button) {
		// If the sign in button is clicked...
		if (button === 1) {
			document.getElementById("btnSignIn").style.background = "#c7e4ff";
			document.getElementById("btnRegister").style.background = "#f6f6f6";
			document.getElementById("frmSignIn").style.display = "block";
			document.getElementById("frmRegister").style.display = "none";
		}
		// If the register button is clicked...
		else {
			document.getElementById("btnSignIn").style.background = "#f6f6f6";
			document.getElementById("btnRegister").style.background = "#c7e4ff";
			document.getElementById("frmSignIn").style.display = "none";
			document.getElementById("frmRegister").style.display = "block";
		}
	}
	</script>
</head>

<body>
	<!--Page header-->
	<div id="header">
		<img id="logo" src="assets/img/logo.png">
	</div>
	<!--Authentication forms-->
	<div id="authBox">
		<h2 id="txt_title">My Account</h2>
		<p id="txt_description">Please sign in or register for your account</p>
		<!--Sign in/register buttons-->
		<form>
			<button id="btnSignIn" class="ui-button ui-widget ui-corner-all" type="button" onclick="btnFocus(1);">Sign In</button>
			<button id="btnRegister" class="ui-button ui-widget ui-corner-all" type="button" onclick="btnFocus(2);"">Register</button>
		</form>
		<hr>
		<!--Sign in form-->
		<form id="frmSignIn" name="frmSignIn" action="/verify.php" method="post">
			<input class="authInput" type="textbox" name="uid" value="Username" onfocus="if (this.value=='Username') this.value=''; " ></input>
			<input class="authInput" type="textbox" name="pwd" value="Password" onfocus="if (this.value=='Password') this.value='';"/>
			<button id="btnGo" class="ui-button ui-widget ui-corner-all" form="frmSignIn" type="submit">Go!</button>
		</form>
		<!--Register form-->
		<form id="frmRegister" name="frmRegister" action="/newUser.php" method="post" style="display:none;">
			<input class="authInput" type="textbox" name="fname" value="First Name" onfocus="if (this.value=='First Name') this.value=''; " style="width:27.5%;"></input>
			<input class="authInput" type="textbox" name="lname" value="Last Name" onfocus="if (this.value=='Last Name') this.value=''; " style="width:27.5%; display:inline" ></input>
			<input class="authInput" type="textbox" name="email" value="E-mail Address" onfocus="if (this.value=='E-mail Address') this.value=''; " ></input>
			<input class="authInput" type="textbox" name="newpass" value="Password" onfocus="if (this.value=='Password') this.value=''; " ></input>
			<button id="btnGo" class="ui-button ui-widget ui-corner-all" form="frmRegister" type="submit">Go!</button>
		</form>
	</div>

</body>
</html>
