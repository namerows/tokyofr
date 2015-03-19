<?php
require_once(realpath(dirname(__FILE__)) . '/configs/config.php');

// インクルードパスの設定
set_include_path(implode(PATH_SEPARATOR, array(
	get_include_path(),
	ZF_DIR,
	SMARTY_DIR,
	LIB_DIR,
	COMMON_LIB_DIR,
)));


require_once ZF_DIR . 'Zend/Config/Ini.php';
#require_once 'Zend/Controller/Action.php';
#require_once 'Zend/Registry.php';
#require_once 'Zend/Cache.php';
#require_once 'Zend/Db.php';
#require_once 'Zend/Log.php';
#require_once 'Zend/Log/Writer/Stream.php';
#require_once 'Zend/Date.php';
#require_once 'Zend/View/Interface.php';
#require_once 'Zend/Controller/Action/Helper/ViewRenderer.php';
#require_once 'Zend/Exception.php';
#require_once(CONTENTS_APP_DIR . 'lib/Controller/Front.php');
#require_once(CONTENTS_APP_DIR . 'lib/Controller/Action.php');


class Bootstrap {

	public static function run() {
#echo get_include_path();
#exit();
		try {

			// 設定ファイル読み込み
	        $config = new Zend_Config_Ini(INSTALL_DIR . 'application/configs/config.ini', 'production');

			// Zend_Loader の設定（ファイル自動読み込み）
			require_once 'Zend/Loader/Autoloader.php';
			$loader = Zend_Loader_Autoloader::getInstance();
			$loader->setFallbackAutoloader(true);

			Zend_Registry::set($config->registry->config, $config);

			$view = new Tokyofr_View_Smarty($config->smarty->template_dir, $config->smarty->toArray());
			$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
			$viewRenderer->setView($view)->setViewBasePathSpec($view->getEngine()->template_dir[0]);
			$viewRenderer->setViewScriptPathSpec(':controller/:action.:suffix');
			$viewRenderer->setViewScriptPathNoControllerSpec(':action.:suffix');
			$viewRenderer->setViewSuffix('phtml');

			Tokyofr_Controller_Front::run($config->path->controller);

		}
		catch ( Zend_Exception $e ) {
//var_dump($e->getMessage());
			exit("error.");
		}
		catch ( Exception $e ) {
//var_dump($e->getMessage());
			exit('error02');
		}
	}
}
