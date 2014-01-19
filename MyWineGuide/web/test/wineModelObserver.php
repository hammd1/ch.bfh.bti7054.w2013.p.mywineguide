<?php
require 'observer.php';
class WineModelObserver implements Observer {
	
	public function update (Observable $args) {
		if($args instanceof  WineModel){
			$wineModel = $args;
// 			$activity = "Wine named '{$args[1]->name}'  by '$cd_->band' was just purchased.";
// 			echo $activity;
			$wineList = $wineModel->getWineList();
			echo $wineList[0]['name'];
			
			createWineList();
		}
	}
	public function createWineList(){
		
	}
}
?>