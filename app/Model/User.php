<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Authority $Authority
 * @property OrderLine $OrderLine
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Authority' => array(
			'className' => 'Authority',
			'foreignKey' => 'authority_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OrderLine' => array(
			'className' => 'OrderLine',
			'foreignKey' => 'order_line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
