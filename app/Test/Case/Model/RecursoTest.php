<?php
App::uses('Recurso', 'Model');

/**
 * Recurso Test Case
 *
 */
class RecursoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recurso'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recurso = ClassRegistry::init('Recurso');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recurso);

		parent::tearDown();
	}

}
