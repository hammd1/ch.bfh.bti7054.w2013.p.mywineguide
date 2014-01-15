<?php include 'includes/functions.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>My Wine Guide</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
				<form action="input_text.htm">
					<input name="searchTermValue" type="text" size="21" maxlength="30" onsubmit="searchWine()">
				</form>
				<a href="javascript:void(0)" onclick="searchWine()"> <img
					src="images/magnifier.png" />
				</a>

			</div>

			<div class="selctionCriteria">
				<header>
					<h3>Weinkriterien</h3>
				</header>
				<button type="button" id="selectCountry"
					onclick="showSelectionOption(this.id)">Land</button>

				<form name="selectCountry" style="display: none">
					<input type="checkbox" name="country" value="argentina"
						onclick="searchWine()">Argentinien<br> <input
						type="checkbox" name="country" value="french"
						onclick="searchWine()">Frankreich<br> <input
						type="checkbox" name="country" value="swiss"
						onclick="searchWine()">Schweiz<br> <input
						type="checkbox" name="country" value="italy"
						onclick="searchWine()">Italien<br>
				</form>
				<button type="button" id="selectWineType"
					onclick="showSelectionOption(this.id)">Weintyp</button>

				<form name="selectWineType" style="display: none">
					<input type="checkbox" name="wineType" value="redWine">Rotwein<br>
					<input type="checkbox" name="wineType" value="whiteWine">Weisswein<br>
					<input type="checkbox" name="wineType" value="roseWine">Rose<br> <input
						type="checkbox" name="wineType" value="sparklingWine">Schaumwein<br>
				</form>
			</div>
		</div>
		<div class="middleContent">

			<div class="resultList">
				<header>
					<h3>Gefundene Weine</h3>
				</header>
				<table border = "1" id="resultList"></table>
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


