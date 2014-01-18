<?php
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
include_once 'psl-config.php';

// sec_session_start();
$userID = intval($_COOKIE['userid']);


if ($userID!= NULL){
	
	$number = intval($_POST['number']);
	$wineID = intval($_POST['wineID']);
	$userID= intval($_COOKIE['userid']);

	// db connect;
	$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );
	
	/* create a prepared statement */
	if($execStmt = $mysqli->prepare("INSERT INTO wineguide.user_has_wine VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE number=(number + ?)")){
		
		/* bind parameters */
		$execStmt->bind_param('iiii', $userID, $wineID, $number, $number);
		
		/* execute query */
		$execStmt->execute();
	}

	$execStmt = $execStmt->mysqli_prepare();
	$result = $execStmt->mysqli_stmt_execute();
	
	
	echo "add";
	
	

}

?>
