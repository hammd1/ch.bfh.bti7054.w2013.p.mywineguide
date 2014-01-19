<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 sec_session_start ();

if (login_check ( $mysqli ) == true) {
	$logged = '';	
} else {
	$logged = 'nicht';
}
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
<title>My Wine Guide</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<script type="text/javascript" src="js/formshash.js"></script>
<script type="text/javascript" src="js/sha512.js"></script>

<body class="body">

	<?php include 'includes/mainHeader.php';?>		
	<?php include 'includes/topNavigation.php';?>		

       <p>Sie sind momentan <?php echo $logged ?> eingeloggt.</p>
       
        <?php
			if (isset ( $_GET ['error'] )) {
				echo '<p class="error">Error Logging In!</p>';
				}
		?> 
        <form action="includes/process_login.php" method="post"
		name="login_form">
		Email: <input type="text" name="email" /> Password: <input
			type="password" name="password" id="password" /> <input type="button"
			value="Login" onclick="formhash(this.form, this.form.password);" />
	</form>
	       	<p>
		Falls Sie noch kein Login besitzen, <a href="register.php">registrieren</a> Sie sich bitte zuerst
		</p>
	<p>
		Bitte klicken Sie auf <a href="includes/logout.php">log out</a> um sich auszuloggen.
	</p>

	<?php
	include 'includes/footer.php';
	?>
</body>
</html>