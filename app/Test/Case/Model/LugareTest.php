<?php
App::uses('Lugare', 'Model');

/**
 * Lugare Test Case
 *
 */
class LugareTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lugare'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lugare = ClassRegistry::init('Lugare');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lugare);

		parent::tearDown();
	}

}
