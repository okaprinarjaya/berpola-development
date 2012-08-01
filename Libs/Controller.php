<?php
class Controller {

	public function renderTemplate($templateName, array $data = null, $contentType = 'html') {
		try {
			$viewObject = new View(get_called_class(), $contentType);
			$viewObject->render($templateName, $data);
			
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function setFlashMessage($message,$type) {
		try {
			$session = new SessionHandler();
			$session->start();

			$session->set('message', array('message' => $message, 'type' => $type));
			$session->save();

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function redirect($location = null) {
		$url = '';
		
		/*
		* Pattern for String passed
		* String => 'controller/action'
		*/
		if (is_string($location)) {
			$locationPieces = explode('/',$location);
			$url = $locationPieces[0].'.php?act='.$locationPieces[1];
		}
		
		/*
		* Pattern for Array passed
		* Array => Array (
		*	'controller'	=>	'controller name'
		*	'action'	=>	'action name'
		* )
		*/
		if (is_array($location)) {
			$url = $location['controller'].'.php?act='.$location['action'];
		}
		
		header('Location:'.$url);
	}
	
	public function getAction() {
		$action = 'index';
		
		if (isset($_GET['act'])) {
			$action = trim($_GET['act']);
		}
		
		return $action;
	}

	public function paging() {
		require_once(LIBS_PATH.DS.'Model.php');

		$start = $_GET['start'];

		$model = new Model();
		$dbh = $model->getConnection();
		$sth = $dbh->query("SELECT * FROM testost LIMIT $start,10");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		$data = array();
		while ($row = $sth->fetch()) {
			$item = array();
			$item['field'] = $row['field'];

			array_push($data, $item);
		}

		return $data;
	}
}