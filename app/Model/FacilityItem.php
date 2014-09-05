<?php
App::uses('AppModel', 'Model');
/**
 * FacilityItem Model
 *
 * @property FacilityItem $ParentFacilityItem
 * @property FacilityItem $ChildFacilityItem
 */
class FacilityItem extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
    var $actsAs = array('ScopedTree'); 

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
/*
	public $belongsTo = array(
		'ParentFacilityItem' => array(
			'className' => 'FacilityItem',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
*/
/**
 * hasMany associations
 *
 * @var array
 */
 /*
	public $hasMany = array(
		'ChildFacilityItem' => array(
			'className' => 'FacilityItem',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    
    */

}
