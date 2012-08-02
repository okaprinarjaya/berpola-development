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
		$this->_session->set('method','Test Driven Development');
		$this->_session->save();

		$all_data_keys = array_keys($this->_session->getAll());

		$this->assertContains('testkey', $all_data_keys);
		$this->assertContains('testdata', $this->_session->getAll());
		$this->assertContains('nicekey', $all_data_keys);
		$this->assertContains('nicedata', $this->_session->getAll());
	}

	public function testGetSpesificSessionData() {
		$expected = 'Test Driven Development';
		$actual = $this->_session->get('method');

		$this->assertEquals($expected, $actual);
	}

	public function testStopAndClearSession() {
		$this->_session->clear();

		$expected1 = 'testdata';
		$actual1 = $this->_session->get('testkey');

		$expected2 = 'nicedata';
		$actual2 = $this->_session->get('nicekey');

		$expected3 = 'Test Driven Development';
		$actual3 = $this->_session->get('method');

		$this->assertFalse($this->_session->get('testkey'));
		$this->assertFalse($this->_session->get('nicekey'));
		$this->assertFalse($this->_session->get('method'));
	}
}