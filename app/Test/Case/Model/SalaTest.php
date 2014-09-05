<?php
App::uses('Sala', 'Model');

/**
 * Sala Test Case
 *
 */
class SalaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sala',
		'app.curso',
		'app.categoria',
		'app.lugar',
		'app.instructor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sala = ClassRegistry::init('Sala');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sala);

		parent::tearDown();
	}

}
