<?php

class Table_MPref extends Table_Base_Abstract {

	protected $_name = 'm_pref';
	protected $_Primary = "pref_id";

	public static function getPrefAll($dbh) {

		$select = $dbh->select();
		$select->from(array('pref'=>'m_pref'), array(
			"pref_id" => "pref.pref_id",
			"pref" => "pref.pref",
		));
		$select->where('pref.delete_flg = 0');
		$data = $select->query()->fetchAll();

		return $data;
	}
}
