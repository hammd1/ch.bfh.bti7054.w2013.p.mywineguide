<?php
include_once 'psl-config.php';
include '../class/wineDAO.php';

// db connect;
$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );

//init Statement if nothing is selected
$defaultStmt = "SELECT DISTINCT * FROM wineguide.wine ORDER BY year ASC LIMIT 3";
$stmt = "SELECT * FROM wineguide.wine";
$execStmt = $defaultStmt;
$tempResult = NULL;
$searchCountryResult = NULL;
$searchWineTypeResult = NULL;
$searchDishResult = NULL;


//get default values
if ($searchCountryResult == NULL) {

	$res = $mysqli->query ( $defaultStmt );
	for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
		$res->data_seek ( $row_no );
		$row = $res->fetch_assoc ();
		$searchCountryResult [$row_no] = $row;

	}
}

//create statement  if searchCountry is set
if (isset($_POST['searchCountry'])) {
	$searchCountry = json_decode ( $_POST ['searchCountry'] );
	$stmt = "SELECT * FROM wineguide.wine";
	if ($searchCountry != null) {
		$searchCountryResult = null;
		$execStmt = $stmt . " WHERE country = '" . $searchCountry [0] . "'";
		$count = count ( $searchCountry );
		for($i = 1; $i < count ( $searchCountry ); $i ++) {
			
			$execStmt = $execStmt . " OR country = '" . $searchCountry [$i] . "'";
		}
		
		$res = $mysqli->query ($execStmt);
		
		for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
			$res->data_seek ( $row_no );
			$row = $res->fetch_assoc ();
			$searchCountryResult[$row_no] = $row;
			
		}
		
	}
}
//select from table if winetype is set
if (isset($_POST['searchWineType'])) {
	$searchWineType = json_decode ( $_POST ['searchWineType'] );
	$stmt = "SELECT * FROM wineguide.wine";
	if ($searchWineType != null) {
		$searchCountryResult = NULL;
		$execStmt = $stmt . " WHERE winetype = '" . $searchWineType [0] . "'";
		$count = count ( $searchWineType );
		for($i = 1; $i < count ( $searchWineType ); $i ++) {
				
			$execStmt = $execStmt . " OR winetype = '" . $searchWineType [$i] . "'";
		}

		$res = $mysqli->query ($execStmt);

		for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
			$res->data_seek ( $row_no );
			$row = $res->fetch_assoc ();
			$searchWineTypeResult[$row_no] = $row;
							
		}
		//merge if $searchCountryResult > 0
		if($searchCountryResult != null && count($searchCountryResult > 0)){
			
			for($i = 0; $i < count($searchCountryResult); $i++){
				
				for($y = 0; $y < count($searchWineTypeResult); $y++){
					
					if($searchCountryResult[$i]['id'] == $searchWineTypeResult[$y]['id']){
						$tempResult[$i] = $searchCountryResult[$i]['id'];
					}
				}
			}
			
			if($tempResult != null){
				$searchCountryResult = $tempResult;
			}
				
		}else{
			
			$searchCountryResult = $searchWineTypeResult;
		
		}
		
		
	}
}
//select from table if winetype is set
if (isset($_POST['searchDish'])) {
	$searchDish = $_POST ['searchDish'];
	
	$searchCountryResult = NULL;
	
	$execStmt = "SELECT w.id, w.name, w.winetype, w.country, w.region, w.description, w.year, w.imagepath, w.rating FROM wineguide.wine w 
				INNER JOIN wineguide.wine_has_dish wd ON w.id = wd.wine_id
				INNER JOIN wineguide.dish d ON d.id= wd.dish_id WHERE d.name = '$searchDish';";
		
	$res = $mysqli->query ($execStmt);

		for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
			$res->data_seek ( $row_no );
			$row = $res->fetch_assoc ();
			$searchDishResult[$row_no] = $row;
							
		}
		//merge if $searchCountryResult > 0
		if($searchCountryResult != null && count($searchCountryResult > 0)){
			
			for($i = 0; $i < count($searchCountryResult); $i++){
				
				for($y = 0; $y < count($searchDishResult); $y++){
					
					if($searchCountryResult[$i]['id'] == $searchDishResult[$y]['id']){
						$tempResult[$i] = $searchCountryResult[$i]['id'];
					}
				}
			}
			
			if($tempResult != null){
				$searchCountryResult = $tempResult;
			}
				
		}else{
			
			$searchCountryResult = $searchDishResult;
		
		}		
	
}



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
if($searchCountryResult != NULL){
for($row_no = 0; $row_no < count($searchCountryResult); $row_no ++) {	
	$row = $searchCountryResult[$row_no];
	echo "<tr>";
	echo "<td><img src=\"images/wine/". $row ['imagepath'] . "\"/><h6>" . $row ['name'] . "</h6><content>" . $row ['description'] . "</content><options><img src=\"images/button_plus.png\"/><img src=\"images/button_minus.png\"/></options></td>";
	echo "<td>" . $row ['winetype'] . "</td>";
	echo "<td>" . $row ['country'] . "</td>";
	echo "<td>" . $row ['region'] . "</td>";
	echo "<td>" . $row ['year'] . "</td>";
	echo "<td>" . $row ['rating'] . "</td>";
	echo "</tr>";
}
}

echo "</tbody>";
// $return [$row_no] ['name'] = $row ['name'];
// $return [$row_no] ['country'] = $row ['country'];
// $return [$row_no] ['year'] = $row ['year'];

// } else {
// $error_msg .= '<p class="error">Database error</p>';
mysqli_close ( $mysqli );
?>