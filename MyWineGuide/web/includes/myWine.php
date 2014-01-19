<?php
include_once 'db_connect.php';
include_once 'functions.php';
include '../class/myWineDAO.php';


$userID;

//start new session /check if user is logged in
sec_session_start();


if (login_check ($mysqli) == true) {
	
	$userID = $_SESSION['user_id'];
	setcookie("login", TRUE, time()+600, '/', NULL);
	
	
	if(isset($_POST['method'])){
	
		$method = $_POST['method'];
	}
	
	if($method == "select"){
	
		getWine();
	
	}
	elseif($method == "add"){
	
		addWine();
	}
	elseif($method == "remove"){
	
		removeWine();
	}
	
	
	
} else {
	
	echo 'Um Weine ihrem Weinkeller hinzuzuf%FCgen, m%FCssen Sie eingeloggt sein';
}

/**
 * searches the wine a user has in his "winecellar"
 * echo the found wine
 * 
 * */
function getWine(){
	
	$searchResult = NULL;
	$tempResult = NULL;
	$searchCountryResult = NULL;
	$searchWineTypeResult = NULL;
	$searchDishResult = NULL;
	$myWineDAO = new MyWineDAO();	
	$userID;
	
	$userID = $_SESSION['user_id'];
	
	//create statement  if searchCountry is set
	if (isset($_POST['searchCountry'])) {
		
		$searchCountry = json_decode ( $_POST ['searchCountry'] );
		
		if (!empty($searchCountry)) {
			
			$searchCountryResult = $myWineDAO->getAllElements(Constants::COUNTRY_SEARCH, $searchCountry, $userID);
		}
	}
	
	//select from table if winetype is set
	if (isset($_POST['searchWineType'])) {
		
		$searchWineType = json_decode ( $_POST ['searchWineType'] );
		
		if (!empty($searchWineType)) {
	
			$searchWineTypeResult = $myWineDAO->getAllElements(Constants::WINETYPE_SEARCH, $searchWineType, $userID);
			
		}
	}
	//select from table if dish is set
	if (isset($_POST['searchDish'])) {
		
		$searchDish = $_POST ['searchDish'];
		
		if (!empty($searchDish)) {
				
			$searchDishResult = $myWineDAO->getAllElements(Constants::DISH_SEARCH, $searchDish, $userID);		
		
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
	
	// 	$myWineDAO->setUserID($userID);
	// 	$searchResult = $myWineDAO->getAllElements(Constants::TOP3_SEARCH, NULL);		
	
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
	<th>Anzahl</th>
			</tr>
	</thead><tbody>";
	if(isset($searchResult)){
	for($row_no = 0; $row_no < count($searchResult); $row_no ++) {	
		$row = $searchResult[$row_no];
		echo "<tr>";
		echo "<td><img src=\"images/wine/". $row ['imagepath'] . "\"/><h6>" . $row ['name'] . "</h6><content>" . $row ['description'] . "</content><options><a href=\"javascript:void(0)\" onclick=\"addMyWine(" . $row ['id'] . ")\"><img src=\"images/button_plus.png\"/></a><a href=\"javascript:void(0)\" onclick=\"removeWine(" . $row ['id'] . ")\"><img src=\"images/button_minus.png\"/></a><form>
					<input id=\"countWine" . $row ['id'] . "\" type=\"text\" size=\"1\" maxlength=\"2\"></form></options></td>";
		echo "<td>" . $row ['winetype'] . "</td>";
		echo "<td>" . $row ['country'] . "</td>";
		echo "<td>" . $row ['region'] . "</td>";
		echo "<td>" . $row ['year'] . "</td>";
		echo "<td>" . $row ['rating'] . "</td>";
		echo "<td>" . $row ['number'] . "</td>";
		echo "</tr>";
	}
	}
	
	echo "</tbody>";
}
/**
 * adds a wine to the users winecellar
 *
 * */

function addWine(){
	
	$number = intval($_POST['number']);
	$wineID = intval($_POST['wineID']);
	$userID= intval($_SESSION['user_id']);
	
	$myWineDAO = new MyWineDAO();
	
	
	$searchResult = $myWineDAO->insertElement($userID, $wineID, $number);
		
}

/**
 * removes wine from the users winecellar
 *
 * */
function removeWine(){

	$number = intval($_POST['number']);
	$wineID = intval($_POST['wineID']);
	$userID= intval($_SESSION['user_id']);
	$myWineDAO = new MyWineDAO();


	$searchResult = $myWineDAO->removeWine($userID, $wineID, $number);

}

// } else {
// $error_msg .= '<p class="error">Database error</p>';
?>