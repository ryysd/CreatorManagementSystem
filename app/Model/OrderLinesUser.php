<?php
App::uses('AppModel', 'Model');
/**
 * OrderLinesUser Model
 *
 * @property OrderLine $OrderLine
 * @property User $User
 */
class OrderLinesUser extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OrderLine' => array(
			'className' => 'OrderLine',
			'foreignKey' => 'order_line_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
