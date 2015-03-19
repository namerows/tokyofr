<?php


class IndexController extends Tokyofr_Controller_Action
{

	/**
	 * @todo 都道府県を選択してからランダムver
	 * @todo AppController的な基底コントローラー
	 * @todo Dao的な
	 *
	 */
	public function indexAction()
	{
		$config = Zend_Registry::get(ZF_CONFIG_NAME);
		$dbh = Zend_Registry::get($config->database->miscdb->registry);

		// 都道府県を取得
		$select = $dbh->select();
		$select->from(array('pref' => 'm_pref'), array(
			'pref_id' => new Zend_Db_Expr('LPAD(pref.pref_id, 2, "0")'),//都道府県コード
			'pref' => 'pref.pref',//都道府県
		));
		$select->where('pref.delete_flg = 0');
		$select->order("rand()");
		$select->limit(1);
		$pref = $select->query()->fetch();

		// 選択された都道府県テーブルをランダムで一件取得
		$table_name = sprintf("m_zipcode_%s", $pref['pref_id']);
		$select = $dbh->select();
		$select->from(array('zip' => $table_name), array(
			'zipcode' => 'zip.zipcode',//郵便番号
			'city' => 'zip.city',//市区町村
			'region' => 'zip.region',//町名
		));
		$select->order("rand()");
		$select->limit(1);
		$city = $select->query()->fetch();

		$this->view->zipcode = Tokyofr_Util::formatZipcode($city['zipcode']);
		$this->view->prefecture = $pref['pref'];
		$this->view->city= $city['city'];
		$this->view->region= $city['region'];
	}
}
