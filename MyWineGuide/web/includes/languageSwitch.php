<?php		
	$lang = $_POST['lang']; 	
	setcookie("language", $lang, time()+3600, '/', NULL);
	echo "changed";
	//echo "The current page name is ".$currentLocation;
?>