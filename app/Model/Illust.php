<?php
App::uses('AppModel', 'Model');
/**
 * Illust Model
 *
 * @property OrderLine $OrderLine
 */
class Illust extends AppModel {


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
		)
	);
}
