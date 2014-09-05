<?php
App::uses('AppModel', 'Model');
/**
 * Puesto Model
 *
 * @property Usuario $Usuario
 */
class Puesto extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


 public $validate = array(
    'name' => array(
        'rule1' => array(
            'rule'    => 'notEmpty',
            'message' => 'Campo Obligatorio',
            'last'    => false
         )
    ),
    'code' => array(
        'rule1' => array(
            'rule'    => 'notEmpty',
            'message' => 'Campo Obligatorio',
            'last'    => false
         )
    )
);


}
