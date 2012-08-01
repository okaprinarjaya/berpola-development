<?php
include('Bootstrap.php');
require_once(APP_PATH.DS.'Controllers'.DS.'HomepageController.php');

$homepage = new HomepageController();
$action = $homepage->getAction();

switch ($action) {	
	case 'index':		
		$homepage->index();
	break;
	
	default:
		echo "Unknown action";
}
?>