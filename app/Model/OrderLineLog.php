<?php
App::uses('AppModel', 'Model');
/**
 * OrderLineLog Model
 *
 * @property OrderStatus $OrderStatus
 */
class OrderLineLog extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OrderStatus' => array(
			'className' => 'OrderStatus',
			'foreignKey' => 'order_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'attachment_id',
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
