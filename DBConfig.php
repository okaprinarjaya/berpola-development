<?php
class DBConfig {
	public static function connInfo() {
		$database = array(
			'dbdriver' => 'mysql',
			'dbhost' => 'localhost',
			'dbusername' => 'root',
			'dbpassword' => '',
			'dbname' => 'dbname_kamu'
		);
		
		return $database;
	}
}