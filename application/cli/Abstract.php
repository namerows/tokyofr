<?php
require_once(realpath(dirname(__FILE__)) . '/../configs/config.php');

// インクルードパスの設定
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    ZF_DIR,
    SMARTY_DIR,
    LIB_DIR,
    COMMON_LIB_DIR,
	INSTALL_DIR . 'application/models/',
)));

require_once ZF_DIR . 'Zend/Config/Ini.php';


class Tokyofr_Batch_Abstract {

	private $_config = null;
	private $_db = null;

	public function __construct() {

		// 設定ファイル読み込み
		$this->_config = new Zend_Config_Ini(INSTALL_DIR . 'application/configs/config.ini', 'production');

		// Zend_Loader の設定（ファイル自動読み込み）
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();
		$loader->setFallbackAutoloader(true);

		Zend_Registry::set($this->_config->registry->config, $this->_config);

		$this->_initDb();
	}

    private function _initDb() {

        $this->_db = Zend_Db::factory($this->_config->database->miscdb->adapter, array(
            "host" => $this->_config->database->miscdb->host,
            "dbname" => $this->_config->database->miscdb->name,
            "username" => $this->_config->database->miscdb->user,
            "password" => $this->_config->database->miscdb->pass,
        ));

        try {
            $this->_db->getConnection();
        } catch (Zend_Db_Adapter_Exception $e) {
            die("ID かパスワードが間違っている、あるいは RDBMS が起動していないなど……\n");
        } catch (Zend_Exception $e) {
            die("factory() が指定したアダプタクラスを読み込めなかったなど……\n");
        }
        $this->_db->closeConnection();

        Zend_Registry::set($this->_config->database->miscdb->registry, $this->_db);
    }
}
