<?php include_once 'includes/functions.php';?>
<header class="mainHeader">
	<a href="index.php"><img src="images/logo.jpg"></a>
	<nav>
		<ul>
			<li <?=echoActiveSiteNavigation("index")?>><a href="index.php">Home</a></li>
			<li <?=echoActiveSiteNavigation("about")?>><a href="about.php">About</a></li>
			<li <?=echoActiveSiteNavigation("contact")?>><a href="contact.php">Kontakt</a></li>
			<li <?=echoActiveSiteNavigation("login")?>><a href="login.php">Login</a></li>				
		</ul>
	</nav>
	<h1>My Wineguide</h1>
	
</header>