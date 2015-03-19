<?php

class Tokyofr_Controller_Front extends Zend_Controller_Front
{
    /**
     * getInstance
     * 
     * Zend_Controller_Front を拡張する場合は必須
     *
     * @param  void
     * @return object Zend_Controller_Frontオブジェクト
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * init
     * 
     * 初期化処理
     *
     * @param  void
     * @return void
     */
    public function init() {}
}
