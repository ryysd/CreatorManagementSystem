<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property User $User
 * @property OrderLine $OrderLine
 */
class Attachment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $actsAs = array(
	    'Upload.Upload' => array(
		'photo' => array(
		    'thumbnailSizes' => array(
			'thumb150' => '150x150',
			'thumb80' => '80x80',
		    ),
		    'thumbnailMethod' => 'php',
		    'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
		    'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
		    'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
		    'maxSize' => 2097152, //2MB
		),
	    ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OrderLine' => array(
			'className' => 'OrderLine',
			'foreignKey' => 'foreign_key',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
