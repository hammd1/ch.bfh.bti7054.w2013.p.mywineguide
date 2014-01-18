<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';

sec_session_start();
?>

<!DOCTYPE html>
<html lang="en">
<html>

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
		<?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
	
		<div class="leftContent">
 			<div class="searchTerm">
				<header>
					<h3>Weinsuche</h3>
				</header>
				<content>
				<form>
					<input id="searchTermValue" type="text" size="19" maxlength="30" onsubmit="searchMyWine()">
				</form>
				<?php //TODO: Keyup function?>
				
				<a href="javascript:void(0)" onclick="searchMyWine()"> <img src="images/magnifier.png" />
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
						onclick="searchMyWine()">Argentinien<br> <input
						type="checkbox" name="country" value="frankreich"
						onclick="searchMyWine()">Frankreich<br> <input
						type="checkbox" name="country" value="schweiz"
						onclick="searchMyWine()">Schweiz<br> <input
						type="checkbox" name="country" value="italien"
						onclick="searchMyWine()">Italien<br>
				</form>
				<button type="button" id="selectWineType"
					onclick="showSelectionOption(this.id)">Weintyp</button>

				<form name="selectWineType" style="display: none">
					<input type="checkbox" name="wineType" value="rotwein" onclick="searchMyWine()">Rotwein<br>
					<input type="checkbox" name="wineType" value="weisswein" onclick="searchMyWine()">Weisswein<br>
					<input type="checkbox" name="wineType" value="rose" onclick="searchMyWine()">Rose<br> <input
						type="checkbox" name="wineType" value="schaumwein" onclick="searchMyWine()">Schaumwein<br>
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
				<script type="text/javascript">

				$(document).ready(function() 
					    { 
					        $("#resultList").tablesorter(); 
					    } 
					); 
			  </script>
				<script type="text/javascript">searchMyWineFirstLoad();</script>
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
	        <?php else : ?>
            <p>
                <span class="error">Bitte loggen Sie sich ein, um Ihren Weinkeller zu betreten.</span> <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
	
	
	</div>
	<?php 
	include 'includes/footer.php';
	?>
</body>
</html>