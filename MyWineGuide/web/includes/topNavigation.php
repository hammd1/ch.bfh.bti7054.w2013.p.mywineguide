<?php include_once 'includes/functions.php';?>
<nav class="topNavigation">
	<ul>
		<li <?=echoActiveSiteNavigation("wineSearch")?>><a
			href="wineSearch.php">Wein Suche</a></li>
		<li <?=echoActiveSiteNavigation("foodSearch")?>><a href="foodSearch.php">Suche
				Gericht</a></li>
		<li <?=echoActiveSiteNavigation("myWineCellar")?>><a
			href="myWineCellar.php">Mein Weinkeller</a></li>
	</ul>
</nav>
