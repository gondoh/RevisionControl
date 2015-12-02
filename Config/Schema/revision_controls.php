<?php
class RevisionControlsSchema extends CakeSchema {

	public $file = 'revision_controls.php';

	public $connection = 'plugin';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $revision_controls = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified'),
		'model_name' => array('type' => 'string', 'length' => 10, 'null' => true, 'default' => null),
		'model_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 8),
		'revision' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 8),
		'deta_object' => array('type' => 'text', 'null' => true, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 8),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
