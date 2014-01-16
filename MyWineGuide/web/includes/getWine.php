<?php
include_once 'psl-config.php';
$error_msg = "";
$return;
$conditionCountry;
$addToCondition = TRUE;

// db connect;
$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );

// get forms
// $selectCountry = $_POST ['selectCountry'];
// // $selectCountry = json_decode($selectWineType,true);
// $selectWineType = $_POST ['selectWineType'];
// $selectWineType = json_decode($selectWineType,true);


$stmt = "SELECT name, winetype, country, region, description, year, imagepath, rating FROM wineguide.wine";

//create statement
if (isset($_POST['searchCountry'])) {
	$searchCountry = json_decode ( $_POST ['searchCountry'] );
	
	if ($searchCountry != null) {
		$stmt = $stmt . " WHERE country = '" . $searchCountry [0] . "'";
		$count = count ( $searchCountry );
		for($i = 1; $i < count ( $searchCountry ); $i ++) {
			
			$stmt = $stmt . " OR country = '" . $searchCountry [$i] . "'";
		}
	}
}
// }else if($selectWineType != NULL){
	
// }
$res = $mysqli->query ($stmt);

echo "
<thead> 
<tr>
<th width=\"50%\">Name</th>
<th>Weintyp</th>
<th>Land</th>
<th>Region</th>
<th>Jahr</th>
<th>Rating</th>
		</tr>
</thead><tbody>";

for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
	$res->data_seek ( $row_no );
	$row = $res->fetch_assoc ();
	
	echo "<tr>";
	echo "<td><img src=\"images/wine/". $row ['imagepath'] . "\"/><h6>" . $row ['name'] . "</h6><content>" . $row ['description'] . "</content><options><img src=\"images/button_plus.png\"/><img src=\"images/button_minus.png\"/></options></td>";
	echo "<td>" . $row ['winetype'] . "</td>";
	echo "<td>" . $row ['country'] . "</td>";
	echo "<td>" . $row ['region'] . "</td>";
	echo "<td>" . $row ['year'] . "</td>";
	echo "<td>" . $row ['rating'] . "</td>";
	echo "</tr>";
}
echo "</tbody>";
// $return [$row_no] ['name'] = $row ['name'];
// $return [$row_no] ['country'] = $row ['country'];
// $return [$row_no] ['year'] = $row ['year'];

// } else {
// $error_msg .= '<p class="error">Database error</p>';
mysqli_close ( $mysqli );
?>