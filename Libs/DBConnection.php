<?php
class DBConnection {
	private $connection = null;
	private $DBDriver = '';
	private $DBHost = '';
	private $DBUser = '';
	private $DBPassword = '';
	private $DBName = '';
	
	public function __construct($connInfo = array()) {
		if (!is_array($connInfo)) {
			throw new Exception('DBConnection class Constructor for the connection information parameter must be an array data type');
		}
		
		$this->DBDriver = $connInfo['dbdriver'];
		$this->DBHost = $connInfo['dbhost'];
		$this->DBUser = $connInfo['dbusername'];
		$this->DBPassword = $connInfo['dbpassword'];
		$this->DBName = $connInfo['dbname'];
	}
	
	public function connect() {
		try {
			if ($this->connection == null) {
				$this->connection = new PDO($this->DBDriver.':host='.$this->DBHost.';dbname='.$this->DBName, $this->DBUser, $this->DBPassword);
			}
			
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		} catch (PDOException $excp) {
			echo $excp->getMessage();
			$excp->getTrace();
			
			$this->connection = null;
		}
		
		return $this->connection;
	}
}