<?php
App::uses('Puesto', 'Model');

/**
 * Puesto Test Case
 *
 */
class PuestoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.puesto',
		'app.usuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Puesto = ClassRegistry::init('Puesto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Puesto);

		parent::tearDown();
	}

}
