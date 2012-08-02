<?php
class SessionHandler {

	public function __construct() {
		register_shutdown_function('session_write_close');
	}

	public function start() {
		$status = false;
		
		if (headers_sent()) {
			if (empty($_SESSION)) {
				$_SESSION = array();
			}

			throw new Exception('Failed to start session because headers have already been sent');
		}

		if (!isset($_SESSION)) {
			session_cache_limiter("must-revalidate");
			
			if (session_start()) {
				$status = true;
			}
		}

		return $status;
	}

	public function getAll() {
		return $_SESSION;
	}

	public function clear() {
		$_SESSION = array();
		session_unset();
	}

	public function set($key,$data) {
		$_SESSION[$key] = $data;
	}

	public function get($key) {
		$return = null;

		if (isset($_SESSION[$key])) {
			$return = $_SESSION[$key];
			unset($_SESSION[$key]);

		} else {
			$return = false;
		}

		return $return;
	}

	public function save() {
		session_write_close();
	}
}