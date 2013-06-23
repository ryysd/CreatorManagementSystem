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
			'thumb560' => '560x420',
		    ),
		    'thumbnailMethod' => 'php',
		    'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
		    'mimetypes' => array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'),
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

	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'attachment_id',
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
}
