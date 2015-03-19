<?php

class Tokyofr_Controller_Action extends Zend_Controller_Action {

	private $_config = null;
    private $_db = null;

	public function init() {

        $this->_config = Zend_Registry::get(ZF_CONFIG_NAME);
        $this->_InitDb();
		$this->_InitSmarty();
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

	private function _InitSmarty() {

#		$this->view = new Tokyofr_View_Smarty($this->_config->smarty->templates_dir, $this->_config->smarty);
	}

	public function preDispatch() {

		$this->view->request = $this->getRequest();
	}

	public function postDispatch() {
    }

	protected function dump($var, $label=null, $echo=true) {

		Zend_Debug::dump($var, $label, $echo);
	}
}
