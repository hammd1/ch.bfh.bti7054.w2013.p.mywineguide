<?php include_once 'includes/functions.php';?>

<?php 
if(isset($_COOKIE["language"])){
	$language = $_COOKIE["language"];
}else{
	$language ='de';
}

$menuItem [0] ["de"] = "Wein Suche";
$menuItem [1] ["de"] = "Suche Gericht";
$menuItem [2] ["de"] = "Mein Weinkeller";
$menuItem [0] ["en"] = "Wine Search";
$menuItem [1] ["en"] = "Dish Search";
$menuItem [2] ["en"] = "My Winecellar";
?>

<nav class="topNavigation">
	<ul>
		<li <?=echoActiveSiteNavigation("index.php?page=wineSearch")?>><a
			href="index.php?page=wineSearch"><?php echo $menuItem[0][$language];?></a></li>
		<li <?=echoActiveSiteNavigation("index.php?page=dishSearch")?>><a href="index.php?page=dishSearch">
				<?php echo $menuItem[1][$language];?></a></li>
		<li <?=echoActiveSiteNavigation("index.php?page=myWineCellar")?>><a
			href="index.php?page=myWineCellar"><?php echo $menuItem[2][$language];?></a></li>
	</ul>
</nav>
