<?php
/**
 * Generic DAO-interface to implement by DAO-classes
 *
 * */
interface BaseDAO{
	
	public function getAllElements($arguments, $value, $userID);
	public function getElementByID($id);
	public function deleteElementByID($id);
	public function insertElement($userID, $wineID, $numer);
	
	
	
}