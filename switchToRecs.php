<?php
session_start();

// if the session exists...
if (is_numeric($_SESSION['currentUser'])) {
    // Connects to the database
$db = mysqli_connect('cm-database.czvehxkx0tve.us-west-2.rds.amazonaws.com','hayes1rp','carmaxroot','carmaxDB', 3306)
    or die('Error connecting to MySQL server.');
    // Pull current user from the database
    $query = "SELECT CustomerID, LastName, FirstName FROM Customer WHERE CustomerID='" . $_SESSION['currentUser'] . "'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo "
            <div id='rec_content'>
                <h2>Recommendations</h2>
            </div>
        ";
    }
    // Closes the database connection
    mysqli_close($db);
}
else {
    echo "
        <div id='where_to_start'>
            <img src='assets/img/lightbulb.png'>
            <h2>Where to Start?</h2>
            <p>Sign in to MyCarMax or create an account to get personalized vehicle recommendations</p>
            <input id='wts-button' class='swapPanel' type='button' value='Go' onclick='switchToAuthPanel();' />
        </div>
        <!-- Main auth panel -->
        <div id='auth' style='display:none'>
            <div id='btnBack' onclick='switchBackToWelcome();'>Back</div>
            <h2 id='txtMyCarMax_title' align='center'>MyCarMax</h2>
            <p id='txtMyCarMax_description' style='font-weight: normal;'>Please sign in or register for your MyCarMax account</p>
            <!--Sign in/register buttons-->
            <form>
                <button class='swapPanel' id='btnSignIn' type='button' onclick='btnFocus(1);' style='background: #3672b3; color: white'>Sign In</button>
                <button class='swapPanel' id='btnRegister' type='button' onclick='btnFocus(2);'>Register</button>
            </form>
            <!--Sign in form-->
            <form id='frmSignIn' name='frmSignIn' action='/verify.php' method='post'>
                <input class='authInput' type='textbox' name='uid' value='Username' onfocus='if (this.value=='Username') this.value=''; ' onfocusout='if (this.value=='') this.value='Username'; '></input>
                <input class='authInput' type='password' name='pwd' value='Password' onfocus='if (this.value=='Password') this.value='';' onfocusout='if (this.value=='') this.value='Password'; '/>
                <button  class='btn btn-default' id='btnGo' form='frmSignIn' type='submit' style='margin-top: 8%; margin-bottom: 15%'>Go!</button>
            </form>
            <!--Register form-->
            <form id='frmRegister' name='frmRegister' action='/newUser.php' method='post' style='display:none;'>
                <input class='authInput' type='textbox' name='fname' value='First Name' onfocus='if (this.value=='First Name') this.value=''; ' onfocusout='if (this.value=='') this.value='First Name'; ' ></input>
                <input class='authInput' type='textbox' name='lname' value='Last Name' onfocus='if (this.value=='Last Name') this.value=''; ' onfocusout='if (this.value=='') this.value='Last Name'; ' ></input>
                <input class='authInput' type='textbox' name='email' value='E-mail Address' onfocus='if (this.value=='E-mail Address') this.value=''; ' onfocusout='if (this.value=='') this.value='E-mail Address'; ' ></input>
                <input class='authInput' type='password' name='newpass' value='Password' onfocus='if (this.value=='Password') this.value=''; ' onfocusout='if (this.value=='') this.value='Password'; '></input>
                <button class='btn btn-default' id='btnGo' class='ui-button ui-widget ui-corner-all' form='frmRegister' type='submit' style='margin-top: 8%; margin-bottom: 15%;'>Go!</button>
            </form>
        </div>";
}
?>