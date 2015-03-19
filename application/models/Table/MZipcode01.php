<?php

class Table_MZipcode01 extends Table_Base_Abstract {

	/* テーブル名*/
	protected $_name = 'm_zipcode_01';

	/* プライマリ */
	protected $_primary = "zipcode_id";

	/**
	 * 市区町村大字データを全て返却する
	 *
	 * @param   object  $dbh  DBリソース
	 * @return  array   $data 都道府県情報
	 */
	public static function getAddressAll($dbh) {

		$select = $dbh->select();
		$select->from(array('zip'=>'m_zipcode_01'), array(
			"city" => "zip.city",//市区町村
			"region" => "zip.region",//大字・町名
		));
		$select->where('zip.delete_flg = 0');
		$data = $select->query()->fetchAll();

		return $data;
	}
}
