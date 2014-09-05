<?php
App::uses('FacilityHierarchyItem', 'Model');

/**
 * FacilityHierarchyItem Test Case
 *
 */
class FacilityHierarchyItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.facility_hierarchy_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FacilityHierarchyItem = ClassRegistry::init('FacilityHierarchyItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FacilityHierarchyItem);

		parent::tearDown();
	}

}
