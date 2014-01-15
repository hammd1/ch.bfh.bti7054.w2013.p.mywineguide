
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