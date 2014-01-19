<?php 

//get requested page
$page = ''; 
if(isset($_GET['page'])){
	
	$page = $_GET['page'];
}

include_once 'html/headInformation.html';


if($page=='wineSearch'){
	?>
	<?php
	include_once 'includes/functions.php';
	include_once 'includes/db_connect.php';
	
	sec_session_start();
	?>
	
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
<?php 
}elseif($page=='myWineCellar'){
?>
	<?php
	include_once 'includes/functions.php';
	include_once 'includes/db_connect.php';
	
	sec_session_start();
	?>
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
	                <span class="error">Bitte loggen Sie sich ein, um Ihren Weinkeller zu betreten.</span> <a href="index.php?page=login">login</a>.
	            </p>
	        <?php endif; ?>
		
		
		</div>
		<?php 
		include 'includes/footer.php';
		?>
	</body>
	</html>
<?php 
}elseif($page == "login"){
?>
	<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	 sec_session_start ();
	
	if (login_check ( $mysqli ) == true) {
		$logged = '';	
	} else {
		$logged = 'nicht';
	}
	?>
	<body class="body">
	
		<script type="text/javascript" src="js/formshash.js"></script>
		<script type="text/javascript" src="js/sha512.js"></script>
		
		<?php include 'includes/mainHeader.php';?>		
		<?php include 'includes/topNavigation.php';?>		
	
	       <p>Sie sind momentan <?php echo $logged ?> eingeloggt.</p>
	       
	        <?php
				if (isset ( $_GET ['error'] )) {
					echo '<p class="error">Error Logging In!</p>';
					}
			?> 
	        <form action="includes/process_login.php" method="post"
			name="login_form">
			Email: <input type="text" name="email" /> Password: <input
				type="password" name="password" id="password" /> <input type="button"
				value="Login" onclick="formhash(this.form, this.form.password);" />
		</form>
		       	<p>
			Falls Sie noch kein Login besitzen, <a href="index.php?page=register">registrieren</a> Sie sich bitte zuerst
			</p>
		<p>
			Bitte klicken Sie auf <a href="includes/logout.php">log out</a> um sich auszuloggen.
		</p>
	
		<?php
		include 'includes/footer.php';
		?>
	</body>

<?php 
}elseif($page == "register"){
?>

	<?php
	include_once 'includes/functions.php';
	include_once 'includes/register.inc.php';
	?>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/formshash.js"></script>
	
	<body class="body">

	<?php include 'includes/mainHeader.php';?>		
	<?php include 'includes/topNavigation.php';?>		

    <?php
		if (! empty ( $error_msg )) {
			echo $error_msg;
		}
	?>
	<div id="register">
	
		<div id="registerForm">
		    <ul>
				<li>Benutzernamen d&uumlrfen nur aus Zahlen, Klein- / Grossbuchstaben und "_" bestehen</li>
				<li>Emails bitte in einem g&uumlltigen Format eingeben</li>
				<li>Das Passwort muss mindestens aus 6 Zeichen bestehen und folgendes beinhalten:</li>
					<ul>
						<li>Mindestens ein Grossbuchstabe (A..Z)</li>
						<li>Mindestens ein Kleinbuchstabe (a..z)</li>
						<li>Mindestens eine Nummer (0..9)</li>
					</ul>
				</li>
				<li>Das Passwort und die Passwortbest&aumltigung m&uumlssen &uumlbereinstimmen</li>
			</ul>
			<form action="<?php echo "index.php?page=register" ?>"
				method="post" name="registration_form">
				<ul>
					<li>Benutzername:</li>
					<li>Email:</li>
					<li>Passwort:</li>
					<li>Passwortbest&aumltigung:</li>
					
				</ul>
				<ul>
					<li><input type='text' name='username' id='username' /></li>
					<li><input type="text" name="email" id="email" /></li>
					<li><input type="password" name="password" id="password" /></li>
					<li><input type="password" name="confirmpwd" id="confirmpwd" /></li>
					<li><input type="button" value="Register" 
							onclick="return regformhash(this.form,
		                    	this.form.username,
		                        this.form.email,
		                        this.form.password,
		                        this.form.confirmpwd);"/> </li>
				</ul>		
			</form>
		</div>
		
		<p>
			Zur&uumlck zu der <a href="index.php?page=login">login Seite</a>.
		</p>
	</div>
	<?php
	include 'includes/footer.php';
	?>
</body>
	

<?php 
}else{
?>
	<?php
	include_once 'includes/functions.php';
	include_once 'includes/db_connect.php';
	?>
	<body class="body">
		<?php include 'includes/mainHeader.php';?>		
		<div class="mainContent">
			<div class="navigationContent">
			<nav>
				<ul>
					<li>
						<a href="index.php?page=wineSearch"><img src="images/wineSearch.jpg" /></a>
						<header>
							<h2><a href="index.php?page=wineSearch" title="wine search">Weinsuche</a></h2>
						</header>
						
						<footer>Zu jedem Gericht den passenden Wein finden</footer>
						<content>
						</content>
					</li>
					<li>
					<?php //TODO: change image?>
						<a href="index.php?page=dishSearch"><img src="images/dishSearch.jpg" /></a>
						<header>
							<h2><a href="index.php?page=dishSearch" title="dish search">Suche nach Gerichten</a></h2>
						</header>
						<footer>Zu jedem Wein das passende Gericht</footer>
						<content>

						</content>
					
					</li>
					<li>
						<a href="index.php?page=myWineCellar"><img src="images/wineCellar.jpg"/></a>
						<header>
							<h2><a href="index.php?page=myWineCellar" title="wine cellar">Mein Weinkeller</a></h2>
						</header>
						
						<footer>Loggen Sie sich in Ihren virtuellen Weinkeller ein</footer>
					</li>
				</ul>
			</nav>
			</div>
		</div>	
		<?php include 'includes/footer.php';?>
	</body>
	</html>
<?php 
}
?>
