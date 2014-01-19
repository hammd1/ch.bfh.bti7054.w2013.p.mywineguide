<?php
include_once 'psl-config.php';
include_once 'baseDAO.php';
include_once 'constants.php';

/**
 * DAO-Class to acces wineDB without defined userID (wineSearch)
 *
 * */
class WineDAO implements BaseDAO{
	
	/**
	 * function to get wine from database
	 *
	 * @param $argument defines the search columns
	 * @param $values array with all search values
	 *
	 * @param $userID is NULL
	 *
	 * @return array with all found elements
	 */
	public function getAllElements($argument, $values, $userID){

		$execResult = array();
		$execStmt = '';
		
		switch ($argument){
			
			//if search by country
			case Constants::COUNTRY_SEARCH: 
			
				$execStmt = "SELECT * FROM wineguide.wine WHERE country = '" . $values [0] . "'";

				for($i = 1; $i < count ( $values ); $i ++) {
		
					$execStmt = $execStmt . " OR country = '" . $values [$i] . "'";
			
				}
				break;
				
			//if search by winetype
			case Constants::WINETYPE_SEARCH: 
									
				$execStmt = "SELECT * FROM wineguide.wine WHERE winetype = '" . $values [0] . "'";

				for($i = 1; $i < count ( $values ); $i ++) {
				
					$execStmt = $execStmt . " OR winetype = '" . $values [$i] . "'";
				}
												
				break;
			
			//if search by dish
			case Constants::DISH_SEARCH:
				
				$execStmt = "SELECT w.id, w.name, w.winetype, w.country, w.region, 
									w.description, w.year, w.imagepath, w.rating 
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
				
		
		//ececute statement
		$res = $mysqli->query ($execStmt);
		
		//fetching rows
		for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
			$res->data_seek ( $row_no );
			$row = $res->fetch_assoc ();
			$execResult[$row_no] = $row;
		
		}
		
		
		mysqli_close ($mysqli);
		
		return $execResult;
		
		
	}
	
	

	public function getElementByID($execStmt){}
	
	public function deleteElementByID($execStmt){}
	
	
	public function insertElement($userID, $wineID, $numer){}
	
	
}
?>