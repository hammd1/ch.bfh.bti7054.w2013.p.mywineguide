<?php
include_once 'db_connect.php';
include_once 'functions.php';

if (login_check ( $mysqli ) == true) {
	$logged = 'in';
} else {
	$logged = 'out';
}
?>
<script type="text/javascript" src="js/forms.js"></script>
<script type="text/javascript" src="js/sha512.js"></script>

	<?php include 'includes/mainHeader.php';?>		
	<?php include 'includes/topNavigation.php';?>		

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
		If you don't have a login, please <a href="register.php">register</a>
	</p>
	<p>
		If you are done, please <a href="includes/logout.php">log out</a>.
	</p>
	<p>You are currently logged <?php echo $logged ?>.</p>
	<?php
	include 'includes/footer.php';
	?>
