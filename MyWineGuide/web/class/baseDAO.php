<?php
interface BaseDAO{
	
	public function getAllElements($arguments, $value);
	public function getElementByID($id);
	public function deleteElementByID($id);
	public function insertElement($values);
	
	
	
}