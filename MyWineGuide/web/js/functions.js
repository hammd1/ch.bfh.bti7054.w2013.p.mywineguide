function languageSwitch(language){
	$.ajax({
		  type: 'post',
		  url: 'languageSwitch.php',
		  data: {language: language}
		});
}