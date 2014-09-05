<?php
App::uses('AppModel', 'Model');
/**
 * FacilityHierarchyItem Model
 *
 * @property FacilityHierarchyItem $ParentFacilityHierarchyItem
 * @property FacilityHierarchyItem $ChildFacilityHierarchyItem
 */
class FacilityHierarchyItem extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    var $actsAs = array('Tree');
	//The Associations below have been created with all possible keys, those that are not needed can be removed


}
