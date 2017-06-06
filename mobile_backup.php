<!--<div id="mobile">
		<!--Page Header-->
		<div id="header">
			<a href="index.php"><img id="carmaxlogo" src="assets/img/carmaxlogo.png"/></a>
		</div>
		<div id="user"></div>
		<!--Page Content-->
		<form style="text-align:center; margin-top:4%;">
			<button id="btnUsed" class="ui-button ui-widget ui-corner-all" type="button" onclick="btnFocus(1);" style="background:#b4cae2">Used Vehicles</button>
			<button id="btnRecc" class="ui-button ui-widget ui-corner-all" type="button" onclick="btnFocus(2); applyRecs();">My Recommendations</button>
		</form>
		<!--Used Vehicles Keyword Search-->
		<div id="keywordSrch">
			<form >	
				<input class="authInput" type="text" name="keyword" value="Search All Cars by Make, Model, or Keyword" onfocus="if (this.value=='Search All Cars by Make, Model, or Keyword') this.value=''; " onchange="applySearch(this.value);" style="width:100%;" >
			</form>
		</div>
		<!--Used Vehicles AJAX + Panel-->
		<div id="usedVehSort" style="display:none;">
			<form>	
				<select id="cmbFilter" onchange="applyFilter(this.value);"">
				  <option value="1">Price: Low to High</option>
				  <option value="2">Price: High to Low</option>
				  <option value="3">Miles: Low to High</option>
				  <option value="4">Miles: High to Low</option>
				  <option value="5">Year: New to Old</option>
				  <option value="6">Year: Old to New</option>
				  <option value="7">Make: A to Z</option>
				  <option value="8">MPG City: Highest First</option>
				  <option value="9">MPG Highway: Highest First</option>
				</select>
			</form>
		</div>
		<div id="usedVehicles"><!--filled by the AJAX request--></div>
		<!--My Recommendations Panel-->
		<div id="myReccs" style="display:none;">
			<img src="/assets/img/lightbulb.png" id="lightbulb" />
			<h2 style="font-weight:normal">Where to Start?</h2>
			<p style="margin-left:3%; margin-right:3%;">Sign into MyCarMax or create an account to get customized vehicle recommendations!</p>
			<form action="auth.php">
				<button class="ui-button ui-widget ui-corner-all" type="submit" style="margin-top:6%;">Go</button>
			</form>
		</div>
	</div>