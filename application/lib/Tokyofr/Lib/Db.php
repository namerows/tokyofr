<?php
require_once(realpath(dirname(__FILE__)) . '/../../../configs/config.php');

class Tokyofr_Lib_Db {

	private static $_instance = null;

	private function __construct($db) {

		set_include_path(implode(PATH_SEPARATOR, array(get_include_path(), ZF_DIR)));

		require_once ZF_DIR . 'Zend/Config/Ini.php';

		$config = new Zend_Config_Ini(INSTALL_DIR . 'application/configs/config.ini', 'production');

        self::$_instance = Zend_Db::factory($config->database->$db->adapter, array(
            "host" => $config->database->$db->host,
            "dbname" => $config->database->$db->name,
            "username" => $config->database->$db->user,
            "password" => $config->database->$db->pass,
        ));

        try {
            self::$_instance->getConnection();
        } catch (Zend_Db_Adapter_Exception $e) {
            die("ID かパスワードが間違っている、あるいは RDBMS が起動していないなど……\n");
        } catch (Zend_Exception $e) {
            die("factory() が指定したアダプタクラスを読み込めなかったなど……\n");
        }
        self::$_instance->closeConnection();



	}

	public static function getInstance($db) {

		if (is_null(self::$_instance) === true ) {
			self::$_instance = new self($db);
		}
		return self::$_instance;
	}
}
