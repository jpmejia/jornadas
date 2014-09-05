<?php
App::uses('FacilityItem', 'Model');

/**
 * FacilityItem Test Case
 *
 */
class FacilityItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facility_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacilityItem = ClassRegistry::init('FacilityItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacilityItem);

		parent::tearDown();
	}

}
