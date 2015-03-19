<?php

require_once('Abstract.php');

class Geocoding extends Tokyofr_Batch_Abstract {

	public function __construct ()
	{
		parent::__construct();
	}

	public function main()
	{
		$config = Zend_Registry::get('config');
		$dbh = Zend_Registry::get($config->database->miscdb->registry);

		//すべての都道府県を取得
		$pref = Tokyofr_Lib_Geocoding::getPrefAll($dbh);

		foreach ( $pref as $key => $value ) {
			
			// 都道府県の住所を取得
			$address = Tokyofr_Lib_Geocoding::getPrefAddress($value['pref_id'], $dbh);

			foreach ( $address as $index => $val ) {

				// とりあえず無視
				if ( strcmp($val['region'], '以下に掲載がない場合') === 0 ) {
					continue;
				}

				$address_name = $value['pref'].  $val['city'] . $val['region'];
				$api = 'http://www.geocoding.jp/api/?q=' . $address_name;

				try {
					$contents = file_get_contents($api);

					// APIエラーが良く発生する
					//@todo APIがXMLで返すからXMLパース
					//@todo APIエラー時のリトライ処理
					//@todo 正常なデータが返却された時のデータ投入

					$xml = simplexml_load_string($contents);
					$lng = $xml->coordinate->lng[0];
					$lat = $xml->coordinate->lat[0];

					echo ($lng);
					echo ($lat);
					exit();	
				}
				catch ( Exception $e ) {

					var_dump($e);
					exit();
				}
				echo "\n";
			}

			exit();
		}
	}
}

$class = new Geocoding();
$class->main();
