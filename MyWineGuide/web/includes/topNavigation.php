<?php include_once 'includes/functions.php';?>

<?php 
$language = $_COOKIE["language"];


$menuItem [0] ["de"] = "Wein Suche";
$menuItem [1] ["de"] = "Suche Gericht";
$menuItem [2] ["de"] = "Mein Weinkeller";
$menuItem [0] ["en"] = "Wine Search";
$menuItem [1] ["en"] = "Dish Search";
$menuItem [2] ["en"] = "My Winecellar";
?>

<nav class="topNavigation">
	<ul>
		<li <?=echoActiveSiteNavigation("wineSearch")?>><a
			href="wineSearch.php"><?php echo $menuItem[0][$language];?></a></li>
		<li <?=echoActiveSiteNavigation("foodSearch")?>><a href="foodSearch.php">
				<?php echo $menuItem[1][$language];?></a></li>
		<li <?=echoActiveSiteNavigation("myWineCellar")?>><a
			href="myWineCellar.php"><?php echo $menuItem[2][$language];?></a></li>
	</ul>
</nav>
