<?php
class View {
	private $templateExtension = '.tpl.php';
	private $contentType;
	private $controllerName;
	
	public function __construct($controllerName, $contentType) {
		$this->controllerName = $controllerName;
		$this->contentType = $contentType;
	}
	
	public function render($templateName, array $data = null) {
	
		switch ($this->contentType) {
			case 'html':
				$this->renderHTML($templateName, $data);
			break;
			
			case 'pdf_download':
				$this->renderPDF($templateName, $data, 'pdf_download');
			break;
			
			case 'pdf_preview':
				$this->renderPDF($templateName, $data, 'pdf_preview');
			break;
			
			case 'spreadsheet-excel':
				$this->renderSpreadsheet($templateName, $data, 'spreadsheet-excel');
			break;
			
			case 'spreadsheet-excel2007':
				$this->renderSpreadsheet($templateName, $data, 'spreadsheet-excel2007');
			break;
			
			case 'spreadsheet-ods':
				$this->renderSpreadsheet($templateName, $data, 'spreadsheet-ods');
			break;
			
			default:
				throw new Exception("Unknown view content type!");
		}
	}
	
	protected function renderHTML($templateName, $data = null) {
		$viewDir = trim(str_replace("controller","",strtolower($this->controllerName)));
		$complete_view_file_path = APP_PATH.DS.'Views'.DS.$viewDir.DS.$templateName.$this->templateExtension;
		
		if (!file_exists($complete_view_file_path)) {
			throw new Exception("View file named ".$templateName.$this->templateExtension." Doesn't Exists!");
		}
		
		if (!is_null($data)) {
			extract($data);
		}
		
		ob_start();
		include($complete_view_file_path);
		$content = ob_get_clean();

		// --- Check session data for flash message
		$session = new SessionHandler();
		$session->start();
		
		$flash_message = '';
		$sessionData = $session->get('message');

		if ($sessionData) {
			ob_start();
			$message = $sessionData['message'];

			if ($sessionData['type'] == 'error') {
				include(APP_PATH.DS.'Views'.DS.'main'.DS.'error_message.tpl.php');
			}

			if ($sessionData['type'] == 'success') {
				include(APP_PATH.DS.'Views'.DS.'main'.DS.'success_message.tpl.php');
			}

			$flash_message = ob_get_clean();
		}

		include(APP_PATH.DS.'Views'.DS.'main'.DS.'main.tpl.php');
	}
	
	/**
	 * Render type parameter
	 * String 'pdf_download'
	 * or
	 * String 'pdf_preview'
	 * Default is 'pdf_download'
	 */
	protected function renderPDF($templateName, array $data = null, $renderType = 'pdf_download') {
	
		if ($renderType == 'pdf_download') {
			header('Content-Description: File Transfer');
			header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0, max-age=1');
			header('Pragma: public');
			header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date masa lalu
			header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			
			// Jika PHP tidak dijalankan sebagai cgi
			if (strpos(php_sapi_name(), 'cgi') === false) {
				header('Content-Type: application/force-download');
				header('Content-Type: application/octet-stream', false);
				header('Content-Type: application/download', false);
				header('Content-Type: application/pdf', false);
				
			} else {
				header('Content-Type: application/pdf');
			}
			
			// Menggunakan HTTP header Content-Disposition untuk menentukan rekomendasi nama file
			header('Content-Disposition: attachment; filename="'.basename($templateName.'.pdf').'";');
			header('Content-Transfer-Encoding: binary');
		}
		
		if ($renderType == 'pdf_preview') {
			header('Content-Type: application/pdf');
			header('Cache-Control: private, must-revalidate, post-check=0, pre-check=0, max-age=1');
			header('Pragma: public');
			header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header('Content-Disposition: inline; filename="'.basename($templateName.'.pdf').'";');
		}
		
		if (!is_null($data)) {
			extract($data);
		}
		
		$defaultViewfileName = $templateName;
		
		$viewDir = trim(str_replace("controller","",strtolower($this->controllerName)));
		include(APP_PATH.DS.'Views'.DS.$viewDir.DS.'pdf'.DS.$templateName.$this->templateExtension);

		echo $data;
	}
	
	protected function renderSpreadsheet($templateName, $data, $spreadSheetType) {
		if ($spreadSheetType == 'spreadsheet-excel') {
			header('Content-Type: application/vnd.ms-excel');
		} else if ($spreadSheetType == 'spreadsheet-excel2007') {
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		}

		header('Content-Disposition: attachment; filename="'.basename($templateName.'.xls').'";');
		header('Cache-Control: max-age=0');

		if (!is_null($data)) {
			extract($data);
		}

		$defaultViewfileName = $templateName;
		
		$viewDir = trim(str_replace("controller","",strtolower($this->controllerName)));
		include(APP_PATH.DS.'Views'.DS.$viewDir.DS.'spreadsheet'.DS.$templateName.$this->templateExtension);
	}
}