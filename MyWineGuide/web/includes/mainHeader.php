<?php 
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
?>

<script type="text/javascript" src="js/functions.js"></script>
<script src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js" type="text/javascript"></script>
 
<?php 
if(isset($_COOKIE["language"])){
	$language = $_COOKIE["language"];
}else{
	$language ='de';
}
if(isset($_COOKIE["login"])){
	$login = $_COOKIE["login"];
}else{
	$login = FALSE;
}

$menuItem [0] ["de"] = "Startseite";
$menuItem [1] ["de"] = "Impressum";
$menuItem [2] ["de"] = "Kontakt";
$menuItem [3] ["de"] = "Login";
$menuItem [4] ["de"] = "Logout";
$menuItem [0] ["en"] = "Home";
$menuItem [1] ["en"] = "About";
$menuItem [2] ["en"] = "Contact";
$menuItem [3] ["en"] = "Login";
$menuItem [4] ["en"] = "Logout";
?>


<header class="mainHeader">
	<a href="index.php"><img src="images/logo.jpg"></a>
	<nav>
		<ul>
			<li <?=echoActiveSiteNavigation("index")?>><a href="index.php"><?php echo $menuItem[0][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("about")?>><a href="about.php"><?php echo $menuItem[1][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("contact")?>><a href="contact.php"><?php echo $menuItem[2][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("login")?>><a href="login.php"><?php if ($login){echo $menuItem[4][$language];}else{echo $menuItem[3][$language];}?></a></li>
			<li><a href="javascript:void(0)" onclick="languageSwitch('de')"
				style="padding: 2px">DE</a></li>
			<li>/</li>
			<li><a href="javascript:void(0)" onclick="languageSwitch('en')"
				style="padding: 2px">EN</a></li>

		</ul>
	</nav>
	<h1>My Wineguide</h1>

</header>