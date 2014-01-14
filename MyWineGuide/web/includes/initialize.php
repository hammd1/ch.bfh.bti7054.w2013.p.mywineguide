<?php

function initCookies(){

	if( ! isset( $_COOKIE["language"])){

		setcookie("language", "de", time()+3600, '/', NULL);
	}
}
?>