<?php
include_once 'psl-config.php';
// prevent direct access
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
	$user_error = 'Access denied - not an AJAX request...';
	trigger_error($user_error, E_USER_ERROR);
}

// get what user typed in autocomplete input
$term = trim($_GET['term']);

$a_json = array();
$a_json_row = array();

$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
$json_invalid = json_encode($a_json_invalid);

// replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);

// SECURITY HOLE ***************************************************************
// allow space, any unicode letter and digit, underscore and dash
if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
	print $json_invalid;
	exit;
}
// *****************************************************************************

// database connection
$conn = new mysqli(HOST, USER, PASSWORD, 'wineguide' );

if($conn->connect_error) {
	echo 'Database connection failed...' . 'Error: ' . $conn->connect_errno . ' ' . $conn->connect_error;
	exit;
} else {
	$conn->set_charset('utf8');
}

$parts = explode(' ', $term);
$p = count($parts);

/**
 * Create SQL
*/
$sql = 'SELECT name FROM dish WHERE name is not null ';
for($i = 0; $i < $p; $i++) {
	$sql .= ' AND name LIKE ' . "'%" . $conn->real_escape_string($parts[$i]) . "%'";
}

$rs = $conn->query($sql);
if($rs === false) {
	$user_error = 'Wrong SQL: ' . $sql . 'Error: ' . $conn->errno . ' ' . $conn->error;
	trigger_error($user_error, E_USER_ERROR);
}

while($row = $rs->fetch_assoc()) {
	$a_json_row["id"] = $row['name'];
	$a_json_row["value"] = $row['name'];
	$a_json_row["label"] = $row['name'];
	array_push($a_json, $a_json_row);
}

// highlight search results
$a_json = apply_highlight($a_json, $parts);

$json = json_encode($a_json);
print $json;
?>