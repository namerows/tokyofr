<?php

class Tokyofr_Lib_Geocoding {

	public static function getPrefAll($dbh) {

		return Table_MPref::getPrefAll($dbh);
	}

	public static function getPrefAddress($pref_id, $dbh) {
		
		$class_name = 'Table_MZipcode' . sprintf("%02d", $pref_id);
		return $class_name::getAddressAll($dbh);
	}
}
