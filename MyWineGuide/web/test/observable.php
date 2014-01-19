<?php
// the observable interface
interface Observable {
	public function attachObserver($type, Observer $observer);
	//public function removeObserver();
	public function notifyObserver($type);
}
