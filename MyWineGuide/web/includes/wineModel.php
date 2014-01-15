<?php
require 'observable.php';
/**
 *
 * @author dimitri.haemmerli
 *        
 */
class WineModel implements Observable {
	private $wineList;
	private $_observers = array ();
	
	public function __construct() {
		$attribute = "country";
		$value = "argentina";
		$test= gettype($attribute);
		echo 'bluber';
		$this->wineSearch ($attribute, $value);
	}
	public function attachObserver($type_, Observer $observer_) {
		$this->_observers [$type_] [] = $observer_;
	}
	public function notifyObserver($type_) {
		if (isset ( $this->_observers [$type_] )) {
			foreach ( $this->_observers [$type_] as $observer ) {
				$observer->update ( $this );
				
				// $observer->update($this) passed the Observable object. So, observable can use it. Pull model!
				// If we have implemented like this, then Push Model
				// $observer->update(data1, data2); // Push Model
			}
		}
	}
	public function wineSearch(string $attribute, string $value) {
		$this->getWineList($attribute, $value);
		$this->notifyObserver('changed');
	}
	
	public function getWineList(string $attribute, string $value) {
		
		// DB requeast
		include_once 'psl-config.php';
		$error_msg = "";
				
		// db connect;
		$mysqli = new mysqli ( HOST, USER, PASSWORD, 'wineguide' );
		
		// get attribute and value
		$attribute = $_POST ['attribut'];
		$value = $_POST ['value'];
				
		$res = $mysqli->query ( "SELECT name, country, region, year FROM wineguide.wine WHERE $attribute = '$value'" );
		
		for($row_no = 0; $row_no < $res->num_rows; $row_no ++) {
			$res->data_seek ( $row_no );
			$row = $res->fetch_assoc ();
			$wineList [$row_no] ['name'] = $row ['name'];
			$wineList [$row_no] ['country'] = $row ['country'];
			$wineList [$row_no] ['year'] = $row ['year'];
			
			echo $row_no;
		}
	}
}
