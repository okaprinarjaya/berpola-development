<?php
ob_start();
require_once "../Libs/SessionHandler.php";

class SessionHandlerTest extends PHPUnit_Framework_TestCase {
	protected $_session;

	public function setUp() {
		$this->_session = new SessionHandler();
	}

	public function tearDown() {
		$this->_session->clear();
		unset($this->_session);
	}

	public function testFirstStartSession() {
		$this->assertTrue($this->_session->start());
	}

	public function testSecondStartSession() {
		$this->assertFalse($this->_session->start());
	}

	public function testSetAndGetSessionData() {
		$this->_session->set('testkey','testdata');
		$this->_session->set('nicekey','nicedata');
		$this->_session->save();

		$all_data_keys = array_keys($this->_session->getAll());

		$this->assertContains('testkey', $all_data_keys);
		$this->assertContains('testdata', $this->_session->getAll());
		$this->assertContains('nicekey', $all_data_keys);
		$this->assertContains('nicedata', $this->_session->getAll());
	}

	public function testSetThenGetSpesificSessionData() {
		$this->_session->set('method','Test Driven Development');
		$this->_session->save();
		
		$expected = 'Test Driven Development';
		$actual = $this->_session->get('method');

		$this->assertEquals($expected, $actual);
	}

	public function testStopAndClearSession() {
		$this->_session->clear();

		$actual1 = $this->_session->get('testkey');
		$actual2 = $this->_session->get('nicekey');
		$actual3 = $this->_session->get('method');

		$this->assertFalse($actual1);
		$this->assertFalse($actual2);
		$this->assertFalse($actual3);
	}
}