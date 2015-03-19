<?php

require_once('Abstract.php');

class Batch extends Tokyofr_Batch_Abstract {

	public function __construct () {

		parent::__construct();
	}

	public function main() {

		$dbh = Tokyofr_Lib_Db::getInstance('blog');
		$dbh->select()->from(array(), array());

	}
}

$class = new Batch();
$class->main();
