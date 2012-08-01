<?php
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
	
define('APP_PATH', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'berpola-development');
define('HOSTNAME', 'http://localhost/berpola-development');
define('LIBS_PATH', APP_PATH.DS.'Libs');
define('ASSETS_PATH', HOSTNAME.'/Assets');
define('VENDORS_PATH', APP_PATH.DS.'Vendors');

define('UPLOAD_DIR', APP_PATH.DS.'Assets'.DS.'files');

require_once(APP_PATH.DS.'DBConfig.php');
require_once(LIBS_PATH.DS.'DBConnection.php');
require_once(LIBS_PATH.DS.'Model.php');
require_once(LIBS_PATH.DS.'SessionHandler.php');
require_once(LIBS_PATH.DS.'View.php');
require_once(LIBS_PATH.DS.'Controller.php');

date_default_timezone_set('Asia/Jakarta');

function pr($iterable) {
	echo '<pre>';
	print_r($iterable);
	echo '</pre>';
}