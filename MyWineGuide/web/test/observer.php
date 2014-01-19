<?php
// This observer interface, will watching for changes on a subject class.
// It will be notified whenever a change occurs in subject class (for example "wineModel" changes).
interface Observer {
	public function update(Observable $args);
}
