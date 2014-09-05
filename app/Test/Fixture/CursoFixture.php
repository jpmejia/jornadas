<?php
/**
 * CursoFixture
 *
 */
class CursoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'id_en_plataforma' => array('type' => 'integer', 'null' => false, 'default' => null),
		'horas_de_curso' => array('type' => 'integer', 'null' => false, 'default' => null),
		'calificacion_aprobatoria' => array('type' => 'integer', 'null' => false, 'default' => null),
		'ordenamiento' => array('type' => 'integer', 'null' => false, 'default' => null),
		'cumplimiento' => array('type' => 'integer', 'null' => false, 'default' => null),
		'fecha_de_inicio' => array('type' => 'date', 'null' => false, 'default' => null),
		'fecha_de_fin' => array('type' => 'date', 'null' => false, 'default' => null),
		'total_de_clases' => array('type' => 'integer', 'null' => false, 'default' => null),
		'asistencias_necesarias' => array('type' => 'integer', 'null' => false, 'default' => null),
		'curso_calificable' => array('type' => 'integer', 'null' => false, 'default' => null),
		'lugar_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sala_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'instructor_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'categoria_id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'id_en_plataforma' => 1,
			'horas_de_curso' => 1,
			'calificacion_aprobatoria' => 1,
			'ordenamiento' => 1,
			'cumplimiento' => 1,
			'fecha_de_inicio' => '2013-04-17',
			'fecha_de_fin' => '2013-04-17',
			'total_de_clases' => 1,
			'asistencias_necesarias' => 1,
			'curso_calificable' => 1,
			'lugar_id' => 1,
			'sala_id' => 1,
			'instructor_id' => 1
		),
	);

}
