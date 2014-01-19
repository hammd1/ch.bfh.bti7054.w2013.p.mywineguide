
<?php
// now we will see our code in action
require 'includes/wineModel.php';
require 'includes/wineModelObserver.php';
$wineList[0]['name'] = 'Don Rudolfo';
$wineList[0]['country'] = 'italy';
$wineList[0]['year'] = 2008;
// Subject got a life
$wineModel = new wineModel($wineList);
$observer = new wineModelObserver();
$wineModel->attachObserver ('changed', $observer);
$wineModel->wineSearch('country', 'argentina');
?>


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
