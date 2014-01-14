<?php include 'includes/functions.php';?>
<form action="<?php languageSwitch() ?>" method="post">
	<select name="language">
		<option value="de" selected=<?php if( $_COOKIE["language"] == "de" ) { echo " selected"; }?>>DE</option>
		<option value="en" selected=<?php if( $_COOKIE["language"] == "en" ) { echo " selected"; }?>>EN</option>
	</select> <input type="submit" value="Select Language">
</form>

<p>Language: <?php if( isset( $_COOKIE["language"] ) ) { echo $_COOKIE["language"]; } else { echo "<em>not set</em>"; } ?></p>