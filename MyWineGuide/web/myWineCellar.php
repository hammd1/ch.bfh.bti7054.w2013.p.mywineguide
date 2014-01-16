<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';

sec_session_start();
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
<body class="body">

	<?php include 'includes/mainHeader.php';?>		
	<?php include 'includes/topNavigation.php';?>		

	<div class="mainContent">
	
	<?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page.
            </p>
            <p>Return to <a href="login.php">login page</a></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
    </div>
	<?php 
	include 'includes/footer.php';
	?>
</body>
</html>