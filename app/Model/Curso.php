<?php
App::uses('AppModel', 'Model');
/**
 * Curso Model
 *
 * @property Categoria $Categoria
 * @property Lugar $Lugar
 * @property Sala $Sala
 * @property Instructor $Instructor
 */
class Curso extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
            'message' => 'El nombre de la curso ya existe'
        )
    ),
    'ordenamiento' => array(
        'rule1' => array(
            'rule'    => 'notEmpty',
            'message' => 'Campo Obligatorio',
            'last'    => false
         )
    )
);
    
    
    
    
    
    
    
    
}
