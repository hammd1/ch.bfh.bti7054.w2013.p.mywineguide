<?php
include_once 'psl-config.php';
include '../class/wineDAO.php';

$searchResult = NULL;
$tempResult = NULL;

$searchCountryResult = NULL;
$searchWineTypeResult = NULL;
$searchDishResult = NULL;

$wineDAO = new WineDAO();

//create statement  if searchCountry is set
if (isset($_POST['searchCountry'])) {
	
	$searchCountry = json_decode ( $_POST ['searchCountry'] );
	
	if (!empty($searchCountry)) {
		
		$searchCountryResult = $wineDAO->getAllElements(Constants::COUNTRY_SEARCH, $searchCountry);
	}
}

//select from table if winetype is set
if (isset($_POST['searchWineType'])) {
	
	$searchWineType = json_decode ( $_POST ['searchWineType'] );
	
	if (!empty($searchWineType)) {

		$searchWineTypeResult = $wineDAO->getAllElements(Constants::WINETYPE_SEARCH, $searchWineType);
		
	}
}
//select from table if winetype is set
if (isset($_POST['searchDish'])) {
	
	$searchDish = $_POST ['searchDish'];
	
	if (!empty($searchDish)) {
	
		$searchDishResult = $wineDAO->getAllElements(Constants::DISH_SEARCH, $searchDish);		
	
	}
	
}


// die drei Resultatmengen mergen
if(isset($searchCountryResult)){
	
	$searchResult = $searchCountryResult;

}

if(isset($searchWineTypeResult)){
		
	if(isset($searchResult) && count($searchResult) > 0){
		
		$arrayPos = 0;		
		for($i = 0; $i < count($searchResult); $i++){
	
			for($y = 0; $y < count($searchWineTypeResult); $y++){
					
				if($searchResult[$i]['id'] == $searchWineTypeResult[$y]['id']){
					$tempResult[$arrayPos] = $searchWineTypeResult[$y];
					$arrayPos++;
									
				}
			}
				
		}
		
		$searchResult = $tempResult;
		
	}else{
		
		$searchResult = $searchWineTypeResult;
				
	}	
}
if(isset($searchDishResult)){

	if(isset($searchResult) && count($searchResult) > 0){

		$arrayPos = 0;
		for($i = 0; $i < count($searchResult); $i++){

			for($y = 0; $y < count($searchDishResult); $y++){
					
				
				if($searchResult[$i]['id'] == $searchDishResult[$y]['id']){
					
					$tempResult[$arrayPos] = $searchDishResult[$y];
					$arrayPos++;
				}
			}
				
			$searchResult = $tempResult;
				
		}
	}else{

		$searchResult = $searchDishResult;

	}
}


if (is_null($searchResult)) {

		
	$searchResult = $wineDAO->getAllElements(Constants::TOP3_SEARCH, NULL);		

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
if(isset($searchResult)){
for($row_no = 0; $row_no < count($searchResult); $row_no ++) {	
	$row = $searchResult[$row_no];
	echo "<tr>";
	echo "<td><img src=\"images/wine/". $row ['imagepath'] . "\"/><h6>" . $row ['name'] . "</h6><content>" . $row ['description'] . "</content><options><a href=\"javascript:void(0)\" onclick=\"addWine(" . $row ['id'] . ")\"><img src=\"images/button_plus.png\"/></a><form>
				<input id=\"countWine" . $row ['id'] . "\" type=\"text\" size=\"1\" maxlength=\"2\"></form></options></td>";
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
?>