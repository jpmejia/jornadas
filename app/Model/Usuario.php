<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property Puesto $Puesto
 * @property Project $Project
 */
class Usuario extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Puesto' => array(
			'className' => 'Puesto',
			'foreignKey' => 'puesto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
