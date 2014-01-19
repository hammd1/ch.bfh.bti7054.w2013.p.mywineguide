<?php
include_once 'psl-config.php';
include_once 'baseDAO.php';
include_once 'constants.php';

/**  
 * DAO-Class to acces wineDB with defined userID (myWineCellar)
 * 
 * */
class MyWineDAO implements BaseDAO{
	
	private $userID;
	
	
	/**
	 * function to get wine from users winecellar
	 *
	 * @param $userID the users id
	 * @param $argument defines the search columns
	 * @param $values array with all search values
	 *
	 * @return array with all found elements
	 */
	public function getAllElements($argument, $values, $userID){

		$execResult = array();
		$execStmt = '';
		$userID;
				
		switch ($argument){
			
			//if search by country
			case Constants::COUNTRY_SEARCH: 
			
				$execStmt = "SELECT w.id, w.name, w.winetype, w.country, w.region, 
									w.description, w.year, w.imagepath, w.rating, uhw.number
								FROM wineguide.wine w 
								INNER JOIN wineguide.user_has_wine uhw ON w.id = uhw.wine_id 
								WHERE uhw.user_id = " . $userID . " AND (w.country = '" . $values [0] . "'";
				
				for($i = 1; $i < count ( $values ); $i ++) {
		
					$execStmt = $execStmt . " OR w.country = '" . $values [$i] . "'";
			
				}
				break;
			
			//if search by winetype
			case Constants::WINETYPE_SEARCH: 
									
				$execStmt = "SELECT w.id, w.name, w.winetype, w.country, w.region, 
									w.description, w.year, w.imagepath, w.rating, uhw.number
								FROM wineguide.wine w 
								INNER JOIN wineguide.user_has_wine uhw ON w.id = uhw.wine_id 
								WHERE uhw.user_id = " . $userID . " AND (w.winetype = '" . $values [0] . "'";

				for($i = 1; $i < count ( $values ); $i ++) {
				
					$execStmt = $execStmt . " OR w.winetype = '" . $values [$i] . "'";
				}
												
				break;
			
			//if search by dish
			case Constants::DISH_SEARCH:
				
				$execStmt = "SELECT w.id, w.name, w.winetype, w.country, w.region, 
									w.description, w.year, w.imagepath, w.rating, uhw.number
								FROM wineguide.wine w
								INNER JOIN wineguide.wine_has_dish wd ON w.id = wd.wine_id
								INNER JOIN wineguide.dish d ON d.id= wd.dish_id 
								WHERE d.name = '$values';";
				
				break;
				
			case Constants::TOP3_SEARCH:				
				
				$execStmt = "SELECT DISTINCT * FROM wineguide.wine ORDER BY rating DESC LIMIT 3";
				
				break;
		
		}
		
		// db connect;
		$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );
		
		$execStmt = $execStmt . ")";
		
		//ececute statement
		$res = $mysqli->query ($execStmt);
		
		//fetching rows
		if($res){
			for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
				$res->data_seek ( $row_no );
				$row = $res->fetch_assoc ();
				$execResult[$row_no] = $row;
			
			}
		}
		
		mysqli_close ($mysqli);
		
		return $execResult;
		
		
	}
	
	

	public function getElementByID($execStmt){}
	
	public function deleteElementByID($execStmt){}
	
	
	/**
	 * function to add a wine to a users winecellar
	 * 
	 * @param $userID the users id
	 * @param $wineID the wine id
	 * @param $number the number of wines to remove;
	 * 
	 * @return (echo) string with confirmation if insert/update was successfull or not
	 */
	public function insertElement($userID, $wineID, $number){
			
		// db connect;
		$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );
		
		/* create a prepared statement */
		if($execStmt = $mysqli->prepare("INSERT INTO wineguide.user_has_wine VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE number=(number + ?)")){
		
			/* bind parameters */
			$execStmt->bind_param('iiii', $userID, $wineID, $number, $number);
		
			/* execute query */
       		if($result = mysqli_stmt_execute($execStmt)){
       			if($mysqli->affected_rows > 0){
					echo "Der Wein wurde Ihrem Weinkeller hinzugef%FCgt.";
				}else{
					
					echo "Bitte geben Sie einen g%FCltigen Wert ein";
				}
       		}else{
       			
       			echo "$mysqli->error";
       		}
						
		}
				
		$mysqli->close();
	}

	/**
	 * function to remove wine from users winecellar
	 * 
	 * @param $userID the users id
	 * @param $wineID the wine id
	 * @param $number the number of wines to remove;
	 * 
	 * @return (echo) string with confirmation if remove was successfull or not
	 */
	public function removeWine($userID, $wineID, $number){
		
		// db connect;
		$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );
		
		/* create a prepared statement */
		if($execStmt = $mysqli->prepare("UPDATE wineguide.user_has_wine SET number = number - ? WHERE user_id = ? AND wine_id = ? AND number >= ?")){
		
			/* bind parameters */
			$execStmt->bind_param('iiii', $number, $userID, $wineID, $number);
		
			/* execute query */
			if($result = mysqli_stmt_execute($execStmt)){
				
				if($mysqli->affected_rows > 0){
					echo "Der Wein wurde aus Ihrem Weinkeller enfernt";
				}else{
					
					echo "Bitte machen Sie eine g%FCltige Eingabe.\n(In Ihrem Weinkeller sind evtl. nicht mehr gen%FCgend Weine)";
				}
				
				
			}else{
		
				echo $mysqli->error;
			}
		
			
		}
		
	}
}
?>