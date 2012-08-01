<?php
class Model {

	private $DBConnection = null;
	private $DBHandler = null;
	
	public function getConnection() {		
		try {
			$this->DBConnection = new DBConnection(DBConfig::connInfo());
			$this->DBHandler = $this->DBConnection->connect();
			
		} catch (PDOException $PDOExcp) {
			echo $PDOExcp->getMessage();
			$PDOExcp->getTrace();
			
		} catch (Exception $excp) {
			echo $excp->getMessage();
			$excp->getTrace();
		}
		
		return $this->DBHandler;
	}
}