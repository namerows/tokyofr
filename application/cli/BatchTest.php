<?php

require_once('Abstract.php');

class Geocoding extends Tokyofr_Batch_Abstract {

	public function __construct () {

		parent::__construct();
	}

	public function main() {

		$config = Zend_Registry::get('config');
		$dbh = Zend_Registry::get($config->database->miscdb->registry);
echo get_include_path(); exit();

#		$contents = file_get_contents('data/test.json');
#		$json_format = Zend_Json::decode($contents);

		$table = new Table_MPref();
	}
}

$class = new Geocoding();
$class->main();
