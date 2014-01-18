<?php
include_once 'includes/functions.php';
include_once 'includes/register.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>My Wine Guide</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/formshash.js"></script>

</head>
<body class="body">

	<?php include 'includes/mainHeader.php';?>		
	<?php include 'includes/topNavigation.php';?>		

        <?php
								if (! empty ( $error_msg )) {
									echo $error_msg;
								}
								?>
        <ul>
		<li>Usernames may contain only digits, upper and lower case letters
			and underscores</li>
		<li>Emails must have a valid email format</li>
		<li>Passwords must be at least 6 characters long</li>
		<li>Passwords must contain
			<ul>
				<li>At least one upper case letter (A..Z)</li>
				<li>At least one lower case letter (a..z)</li>
				<li>At least one number (0..9)</li>
			</ul>
		</li>
		<li>Your password and confirmation must match exactly</li>
	</ul>
	<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"
		method="post" name="registration_form">
		Username: <input type='text' name='username' id='username' /><br>
		Email: <input type="text" name="email" id="email" /><br> Password: <input
			type="password" name="password" id="password" /><br> Confirm
		password: <input type="password" name="confirmpwd" id="confirmpwd" /><br>
		<input type="button" value="Register"
			onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" />
	</form>
	<p>
		Return to the <a href="login.php">login page</a>.
	</p>
	<?php
	include 'includes/footer.php';
	?>
</body>
</html>