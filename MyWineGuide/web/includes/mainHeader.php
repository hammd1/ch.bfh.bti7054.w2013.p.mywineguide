<?php include_once 'includes/functions.php';?>
<?php initCookies();?>
<?php $language = $_COOKIE["language"]?>
<?php
$menuItem[0]["de"] = "Startseite"; 
$menuItem[1]["de"] = "Impressum";
$menuItem[2]["de"] = "Kontakt";
$menuItem[3]["de"] = "Login";
$menuItem[0]["en"] = "Home";
$menuItem[1]["en"] = "About";
$menuItem[2]["en"] = "Contact";
$menuItem[3]["en"] = "Login";
?>
<script src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
function languageSwitch(language){
	
	$.ajax({
		  type: 'post',
		  url: 'includes/languageSwitch.php',
		  data: {lang: language},
  
    success: function(msg) {
        if( msg == "changed"){
            location.reload();
    }
        }
});
	}
</script>

<header class="mainHeader">
	<a href="index.php"><img src="images/logo.jpg"></a>
	<nav>
		<ul>
			<li <?=echoActiveSiteNavigation("index")?>><a href="index.php"><?php echo $menuItem[0][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("about")?>><a href="about.php"><?php echo $menuItem[1][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("contact")?>><a href="contact.php"><?php echo $menuItem[2][$language];?></a></li>
			<li <?=echoActiveSiteNavigation("login")?>><a href="login.php"><?php echo $menuItem[3][$language];?></a></li>
			<li><a href="javascript:void(0)" onclick="languageSwitch('de')">DE</a></li>
			<li>/</li>
			<li><a href="javascript:void(0)" onclick="languageSwitch('en')">EN</a></li>

		</ul>
	</nav>
	<h1>My Wineguide</h1>

</header>