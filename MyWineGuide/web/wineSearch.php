<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';

sec_session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>My Wine Guide</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery/jquery-latest.js"></script> 
<script type="text/javascript" src="js/jquery/jquery.tablesorter.js"></script> 

<script type="text/javascript" src="js/functions.js"></script> 

</head>


<body class="body">
	<?php include 'includes/mainHeader.php';?>
	<?php include 'includes/topNavigation.php';?>
	
	
	<div class="mainContent">
		<div class="leftContent">
 			<div class="searchTerm">
				<header>
					<h3>Gew&uumlnschte Speise</h3>
				</header>
				<content>
				<form>
					<input id="searchTermValue" type="text" size="19" maxlength="30" onsubmit="searchWine()">
				</form>
				<?php //TODO: Wait Popup?>
				<?php //TODO: Keyup function / tablesort?>
				
				<a href="javascript:void(0)" onclick="searchWine()"> <img src="images/magnifier.png" />
				</a>
				</content>
			</div>

			<div class="selectionCriteria">
				<header>
					<h3>Weinkriterien</h3>
				</header>
				<content>
				<button type="button" id="selectCountry"
					onclick="showSelectionOption(this.id)">Land</button>

				<form name="selectCountry" style="display: none">
					<input type="checkbox" name="country" value="argentinien"
						onclick="searchWine()">Argentinien<br> <input
						type="checkbox" name="country" value="frankreich"
						onclick="searchWine()">Frankreich<br> <input
						type="checkbox" name="country" value="schweiz"
						onclick="searchWine()">Schweiz<br> <input
						type="checkbox" name="country" value="italien"
						onclick="searchWine()">Italien<br>
				</form>
				<button type="button" id="selectWineType"
					onclick="showSelectionOption(this.id)">Weintyp</button>

				<form name="selectWineType" style="display: none">
					<input type="checkbox" name="wineType" value="rotwein" onclick="searchWine()">Rotwein<br>
					<input type="checkbox" name="wineType" value="weisswein" onclick="searchWine()">Weisswein<br>
					<input type="checkbox" name="wineType" value="rose" onclick="searchWine()">Rose<br> <input
						type="checkbox" name="wineType" value="schaumwein" onclick="searchWine()">Schaumwein<br>
				</form>
				</content>
			</div>
			
		</div>
		<div class="middleContent">

			<div class="resultList">
				<header>
					<h3>Gefundene Weine</h3>
				</header>
				<table border = "1" id="resultList" class="tablesorter"></table>
				<script type="text/javascript">searchWineFirstLoad();</script>
			</div>
		</div>

		<div class="rightContent">

			<div class="advertiseShop">
				<header>
					<h3>TODO</h3>
				</header>
				<aside class="top-sidebar"></aside>
				<aside class="middle-sidebar"></aside>
				<aside class="bottom-sidebar"></aside>
			</div>
		</div>
	</div>	
	<?php include 'includes/footer.php';?>
</body>
</html>


