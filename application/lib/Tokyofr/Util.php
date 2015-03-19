<?php
class Tokyofr_Util {

	public static function formatZipcode($zipcode) {
		
		if ( strlen($zipcode) !== 7 ) {
			return "";
		}

		$zipA = substr($zipcode, 0, 3);
		$zipB = substr($zipcode, 3, 4);

		return $zipA . "-" . $zipB;
	}
}
