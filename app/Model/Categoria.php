<?php
App::uses('AppModel', 'Model');
class Categoria extends AppModel {

	public $displayField = 'name';

	public $hasMany = array(
		'Curso' => array(
			'className' => 'Curso',
			'foreignKey' => 'categoria_id',
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
    
    
    public $validate = array(
    'name' => array(
        'rule1' => array(
            'rule'    => 'notEmpty',
            'message' => 'Campo Obligatorio',
            'last'    => false
         ),
        'rule2' => array(
            'rule'    => 'isUnique',
            'message' => 'El nombre de la categoria ya existe'
        )
    ),
    'ordenamiento' => array(
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
         ),
         'rule1' => array(
            'rule'    => 'isUnique',
            'message' => 'Id en uso',
            'last'    => false
         )
    )
);
    
    
    
    

}
