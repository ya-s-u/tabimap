<?php
 
class MapComponent extends Component {
	public $name = "Map";
	
	/**
	 * 全ての国を返す
	 * $dump[Code] = CountryNameJa
	 */
	function AllCountry() {
		$CountrySet  = $this->getCountrySetJa();
		
		return $CountrySet;
	}
	
	/**
	 * 全ての地域を返す
	 */
	function AllArea() {
		$AreaSet = $this->getAreaSet();
		
		$dump = array();
		foreach($AreaSet as $code => $country) {
			$dump[$code] = $country['ja'];
		}
		
		return $dump;
	}
	
	/**
	 * 全ての地域、国を返す
	 */
	function CountrySet() {
		$CountrySet = $this->getCountrySet();
		
		$dump = array();
		foreach($CountrySet as $area => $Country) {
			foreach($Country as $code => $country) {
				$dump[$area][$code] = $country['ja'];
			}
		}
		
		return $dump;
	}
	
	/**
	 * 指定したエリアの国を返す
	 * $dump[AreaCode] = AreaNameJa
	 */
	function CountryByArea($area) {
		$CountrySet  = $this->getCountrySet();
		
		$dump = array();
		foreach($CountrySet[$area] as $code => $country) {
			$dump[$code] = $country['ja'];
		}
		
		return $dump;
	}
	
	/**
	 * 国定義(日本語昇順)
	 */
	private function getCountrySetJa() {
		$Set = array(
			'IS' => 'アイスランド',
			'IE' => 'アイルランド',
			'AZ' => 'アゼルバイジャン',
			'AF' => 'アフガニスタン',
			'US' => 'アメリカ合衆国',
			'AE' => 'アラブ首長国連邦',
			'DZ' => 'アルジェリア',
			'AR' => 'アルゼンチン',
			'AL' => 'アルバニア',
			'AM' => 'アルメニア',
			'AG' => 'アンティグア・バーブーダ',
			'AD' => 'アンドラ',
			'YE' => 'イエメン',
			'GB' => 'イギリス',
			'IL' => 'イスラエル',
			'IT' => 'イタリア',
			'IQ' => 'イラク',
			'IR' => 'イラン',
			'IN' => 'インド',
			'ID' => 'インドネシア',
			'UG' => 'ウガンダ',
			'UA' => 'ウクライナ',
			'UZ' => 'ウズベキスタン',
			'UY' => 'ウルグアイ',
			'EC' => 'エクアドル',
			'EG' => 'エジプト',
			'EE' => 'エストニア',
			'ET' => 'エチオピア',
			'ER' => 'エリトリア',
			'SV' => 'エルサルバドル',
			'OM' => 'オマーン',
			'NL' => 'オランダ',
			'AU' => 'オーストラリア',
			'AT' => 'オーストリア',
			'KZ' => 'カザフスタン',
			'QA' => 'カタール',
			'CA' => 'カナダ',
			'CM' => 'カメルーン',
			'KH' => 'カンボジア',
			'CV' => 'カーボベルデ',
			'GY' => 'ガイアナ',
			'GA' => 'ガボン',
			'GM' => 'ガンビア',
			'GH' => 'ガーナ',
			'CY' => 'キプロス',
			'CU' => 'キューバ',
			'KI' => 'キリバス',
			'KG' => 'キルギス',
			'GN' => 'ギニア',
			'GW' => 'ギニアビサウ',
			'GR' => 'ギリシャ',
			'KW' => 'クウェート',
			'HR' => 'クロアチア',
			'GT' => 'グアテマラ',
			'GE' => 'グルジア',
			'GD' => 'グレナダ',
			'KE' => 'ケニア',
			'CR' => 'コスタリカ',
			'KO' => 'コソボ',
			'KM' => 'コモロ',
			'CO' => 'コロンビア',
			'CG' => 'コンゴ共和国',
			'CD' => 'コンゴ民主共和国',
			'CI' => 'コートジボワール',
			'SA' => 'サウジアラビア',
			'WS' => 'サモア',
			'ST' => 'サントメ・プリンシペ',
			'SM' => 'サンマリノ',
			'ZM' => 'ザンビア',
			'SL' => 'シェラレオネ',
			'SY' => 'シリア',
			'SG' => 'シンガポール',
			'DJ' => 'ジブチ',
			'JM' => 'ジャマイカ',
			'ZW' => 'ジンバブエ',
			'CH' => 'スイス',
			'SE' => 'スウェーデン',
			'ES' => 'スペイン',
			'SR' => 'スリナム',
			'LK' => 'スリランカ',
			'SK' => 'スロバキア',
			'SI' => 'スロベニア',
			'SZ' => 'スワジランド',
			'SD' => 'スーダン',
			'SN' => 'セネガル',
			'RS' => 'セルビア',
			'KN' => 'セントクリストファー・ネイビス',
			'VC' => 'セントビンセントおよびグレナディーン諸島',
			'LC' => 'セントルシア',
			'SC' => 'セーシェル',
			'SO' => 'ソマリア',
			'SB' => 'ソロモン諸島',
			'TH' => 'タイ',
			'TJ' => 'タジキスタン',
			'TZ' => 'タンザニア',
			'CZ' => 'チェコ',
			'TD' => 'チャド',
			'TN' => 'チュニジア',
			'CL' => 'チリ',
			'TV' => 'ツバル',
			'DK' => 'デンマーク',
			'TT' => 'トリニダード・トバゴ',
			'TM' => 'トルクメニスタン',
			'TR' => 'トルコ',
			'TO' => 'トンガ',
			'TG' => 'トーゴ',
			'DE' => 'ドイツ',
			'DM' => 'ドミニカ',
			'DO' => 'ドミニカ共和国',
			'NG' => 'ナイジェリア',
			'NR' => 'ナウル',
			'NA' => 'ナミビア',
			'NI' => 'ニカラグア',
			'NE' => 'ニジェール',
			'NZ' => 'ニュージーランド',
			'NP' => 'ネパール',
			'NO' => 'ノルウェー',
			'HT' => 'ハイチ',
			'HU' => 'ハンガリー',
			'VA' => 'バチカン市国',
			'VU' => 'バヌアツ',
			'BS' => 'バハマ',
			'BB' => 'バルバドス',
			'BD' => 'バングラデシュ',
			'BH' => 'バーレーン',
			'PK' => 'パキスタン',
			'PA' => 'パナマ',
			'PG' => 'パプアニューギニア',
			'PW' => 'パラオ',
			'PY' => 'パラグアイ',
			'FJ' => 'フィジー',
			'PH' => 'フィリピン',
			'FI' => 'フィンランド',
			'FR' => 'フランス',
			'BR' => 'ブラジル',
			'BG' => 'ブルガリア',
			'BF' => 'ブルキナファソ',
			'BN' => 'ブルネイ',
			'BI' => 'ブルンジ',
			'BT' => 'ブータン',
			'VN' => 'ベトナム',
			'BJ' => 'ベナン',
			'VE' => 'ベネズエラ',
			'BY' => 'ベラルーシ',
			'BZ' => 'ベリーズ',
			'BE' => 'ベルギー',
			'PE' => 'ペルー',
			'HN' => 'ホンジュラス',
			'BA' => 'ボスニア・ヘルツェゴビナ',
			'BW' => 'ボツワナ',
			'BO' => 'ボリビア',
			'PT' => 'ポルトガル',
			'PL' => 'ポーランド',
			'MK' => 'マケドニア',
			'MG' => 'マダガスカル',
			'MW' => 'マラウイ',
			'ML' => 'マリ',
			'MT' => 'マルタ',
			'MY' => 'マレーシア',
			'MH' => 'マーシャル諸島',
			'FM' => 'ミクロネシア',
			'MM' => 'ミャンマー',
			'MX' => 'メキシコ',
			'MZ' => 'モザンビーク',
			'MC' => 'モナコ',
			'MV' => 'モルディブ',
			'MD' => 'モルドバ',
			'MA' => 'モロッコ',
			'MN' => 'モンゴル',
			'ME' => 'モンテネグロ',
			'MU' => 'モーリシャス',
			'MR' => 'モーリタニア',
			'JO' => 'ヨルダン',
			'LA' => 'ラオス',
			'LV' => 'ラトビア',
			'LT' => 'リトアニア',
			'LI' => 'リヒテンシュタイン',
			'LY' => 'リビア',
			'LR' => 'リベリア',
			'LU' => 'ルクセンブルク',
			'RW' => 'ルワンダ',
			'RO' => 'ルーマニア',
			'LS' => 'レソト',
			'LB' => 'レバノン',
			'RU' => 'ロシア連邦',
			'CF' => '中央アフリカ共和国',
			'CN' => '中華人民共和国',
			'ZA' => '南アフリカ共和国',
			'SS' => '南スーダン',
			'TW' => '台湾',
			'KR' => '大韓民国',
			'JP' => '日本',
			'KP' => '朝鮮民主主義人民共和国',
			'TL' => '東ティモール',
			'GQ' => '赤道ギニア',
		);
		
		return $Set;
	}
	
	/**
	 * エリア定義
	 */
	private function getAreaSet() {
		$AreaSet = array(
			'Asia' => array(
				'en' => 'Asia',
				'ja' => 'アジア',
			),
			'Oceania' => array(
				'en' => 'Oceania',
				'ja' => 'オセアニア',
			),
			'Europe' => array(
				'en' => 'Europe',
				'ja' => 'ヨーロッパ',
			),
			'MiddleEast' => array(
				'en' => 'MiddleEast',
				'ja' => '中東',
			),
			'Africa' => array(
				'en' => 'Africa',
				'ja' => 'アフリカ',
			),
			'NorthAmerica' => array(
				'en' => 'NorthAmerica',
				'ja' => '北アメリカ',
			),
			'SouthAmerica' => array(
				'en' => 'SouthAmerica',
				'ja' => '南アメリカ',
			),
		);
		
		return $AreaSet;
	}
	

	/**
	 * 国定義
	 */	
	private function getCountrySet() {
		$CountrySet = array(
		    'Asia' => array(
		        'SG' => array(
		            'en' => 'Singapore',
		            'ja' => 'シンガポール',
		        ),
		        'AM' => array(
		            'en' => 'Armenia',
		            'ja' => 'アルメニア',
		        ),
		        'AZ' => array(
		            'en' => 'Azerbaijan',
		            'ja' => 'アゼルバイジャン',
		        ),
		        'BD' => array(
		            'en' => 'Bangladesh',
		            'ja' => 'バングラデシュ',
		        ),
		        'BN' => array(
		            'en' => 'Brunei',
		            'ja' => 'ブルネイ',
		        ),
		        'BT' => array(
		            'en' => 'Bhutan',
		            'ja' => 'ブータン',
		        ),
		        'CN' => array(
		            'en' => 'China',
		            'ja' => '中華人民共和国',
		        ),
		        'CY' => array(
		            'en' => 'Cyprus',
		            'ja' => 'キプロス',
		        ),
		        'GE' => array(
		            'en' => 'Georgia',
		            'ja' => 'グルジア',
		        ),
		        'ID' => array(
		            'en' => 'Indonesia',
		            'ja' => 'インドネシア',
		        ),
		        'IN' => array(
		            'en' => 'India',
		            'ja' => 'インド',
		        ),
		        'JP' => array(
		            'en' => 'Japan',
		            'ja' => '日本',
		        ),
		        'KG' => array(
		            'en' => 'Kyrgyzstan',
		            'ja' => 'キルギス',
		        ),
		        'KH' => array(
		            'en' => 'Cambodia',
		            'ja' => 'カンボジア',
		        ),
		        'KP' => array(
		            'en' => 'North Korea',
		            'ja' => '朝鮮民主主義人民共和国',
		        ),
		        'KR' => array(
		            'en' => 'South Korea',
		            'ja' => '大韓民国',
		        ),
		        'KZ' => array(
		            'en' => 'Kazakhstan',
		            'ja' => 'カザフスタン',
		        ),
		        'LA' => array(
		            'en' => 'Laos',
		            'ja' => 'ラオス',
		        ),
		        'LK' => array(
		            'en' => 'Sri Lanka',
		            'ja' => 'スリランカ',
		        ),
		        'MM' => array(
		            'en' => 'Myanmar',
		            'ja' => 'ミャンマー',
		        ),
		        'MN' => array(
		            'en' => 'Mongolia',
		            'ja' => 'モンゴル',
		        ),
		        'MV' => array(
		            'en' => 'Maldives',
		            'ja' => 'モルディブ',
		        ),
		        'MY' => array(
		            'en' => 'Malaysia',
		            'ja' => 'マレーシア',
		        ),
		        'NP' => array(
		            'en' => 'Nepal',
		            'ja' => 'ネパール',
		        ),
		        'PH' => array(
		            'en' => 'Philippines',
		            'ja' => 'フィリピン',
		        ),
		        'PK' => array(
		            'en' => 'Pakistan',
		            'ja' => 'パキスタン',
		        ),
		        'TH' => array(
		            'en' => 'Thailand',
		            'ja' => 'タイ',
		        ),
		        'TJ' => array(
		            'en' => 'Tajikistan',
		            'ja' => 'タジキスタン',
		        ),
		        'TL' => array(
		            'en' => 'East Timor',
		            'ja' => '東ティモール',
		        ),
		        'TM' => array(
		            'en' => 'Turkmenistan',
		            'ja' => 'トルクメニスタン',
		        ),
		        'TW' => array(
		            'en' => 'Taiwan',
		            'ja' => '台湾',
		        ),
		        'UZ' => array(
		            'en' => 'Uzbekistan',
		            'ja' => 'ウズベキスタン',
		        ),
		        'VN' => array(
		            'en' => 'Vietnam',
		            'ja' => 'ベトナム',
		        ),
		    ),
		    'Oceania' => array(
		        'FM' => array(
		            'en' => 'Micronesia',
		            'ja' => 'ミクロネシア',
		        ),
		        'KI' => array(
		            'en' => 'Kiribati',
		            'ja' => 'キリバス',
		        ),
		        'MH' => array(
		            'en' => 'Marshall Islands',
		            'ja' => 'マーシャル諸島',
		        ),
		        'NR' => array(
		            'en' => 'Nauru',
		            'ja' => 'ナウル',
		        ),
		        'PW' => array(
		            'en' => 'Palau',
		            'ja' => 'パラオ',
		        ),
		        'TO' => array(
		            'en' => 'Tonga',
		            'ja' => 'トンガ',
		        ),
		        'TV' => array(
		            'en' => 'Tuvalu',
		            'ja' => 'ツバル',
		        ),
		        'AU' => array(
		            'en' => 'Australia',
		            'ja' => 'オーストラリア',
		        ),
		        'FJ' => array(
		            'en' => 'Fiji',
		            'ja' => 'フィジー',
		        ),
		        'NZ' => array(
		            'en' => 'New Zealand',
		            'ja' => 'ニュージーランド',
		        ),
		        'PG' => array(
		            'en' => 'Papua New Guinea',
		            'ja' => 'パプアニューギニア',
		        ),
		        'SB' => array(
		            'en' => 'Solomon Islands',
		            'ja' => 'ソロモン諸島',
		        ),
		        'VU' => array(
		            'en' => 'Vanuatu',
		            'ja' => 'バヌアツ',
		        ),
		        'WS' => array(
		            'en' => 'Samoa',
		            'ja' => 'サモア',
		        ),
		    ),
		    'Europe' => array(
		        'AD' => array(
		            'en' => 'Andorra',
		            'ja' => 'アンドラ',
		        ),
		        'LI' => array(
		            'en' => 'Liechtenstein',
		            'ja' => 'リヒテンシュタイン',
		        ),
		        'LU' => array(
		            'en' => 'Luxembourg',
		            'ja' => 'ルクセンブルク',
		        ),
		        'MC' => array(
		            'en' => 'Monaco',
		            'ja' => 'モナコ',
		        ),
		        'ME' => array(
		            'en' => 'Montenegro',
		            'ja' => 'モンテネグロ',
		        ),
		        'VA' => array(
		            'en' => 'Vatican City',
		            'ja' => 'バチカン市国',
		        ),
		        'AL' => array(
		            'en' => 'Albania',
		            'ja' => 'アルバニア',
		        ),
		        'AT' => array(
		            'en' => 'Austria',
		            'ja' => 'オーストリア',
		        ),
		        'BA' => array(
		            'en' => 'Bosnia and Herzegovina',
		            'ja' => 'ボスニア・ヘルツェゴビナ',
		        ),
		        'BE' => array(
		            'en' => 'Belgium',
		            'ja' => 'ベルギー',
		        ),
		        'BG' => array(
		            'en' => 'Bulgaria',
		            'ja' => 'ブルガリア',
		        ),
		        'BY' => array(
		            'en' => 'Belarus',
		            'ja' => 'ベラルーシ',
		        ),
		        'CH' => array(
		            'en' => 'Switzerland',
		            'ja' => 'スイス',
		        ),
		        'CZ' => array(
		            'en' => 'Czech Republic',
		            'ja' => 'チェコ',
		        ),
		        'DE' => array(
		            'en' => 'Germany',
		            'ja' => 'ドイツ',
		        ),
		        'DK' => array(
		            'en' => 'Denmark',
		            'ja' => 'デンマーク',
		        ),
		        'EE' => array(
		            'en' => 'Estonia',
		            'ja' => 'エストニア',
		        ),
		        'ES' => array(
		            'en' => 'Spain',
		            'ja' => 'スペイン',
		        ),
		        'FI' => array(
		            'en' => 'Finland',
		            'ja' => 'フィンランド',
		        ),
		        'FR' => array(
		            'en' => 'France',
		            'ja' => 'フランス',
		        ),
		        'GB' => array(
		            'en' => 'United Kingdom',
		            'ja' => 'イギリス',
		        ),
		        'GR' => array(
		            'en' => 'Greece',
		            'ja' => 'ギリシャ',
		        ),
		        'HR' => array(
		            'en' => 'Croatia',
		            'ja' => 'クロアチア',
		        ),
		        'HU' => array(
		            'en' => 'Hungary',
		            'ja' => 'ハンガリー',
		        ),
		        'IE' => array(
		            'en' => 'Ireland',
		            'ja' => 'アイルランド',
		        ),
		        'IS' => array(
		            'en' => 'Iceland',
		            'ja' => 'アイスランド',
		        ),
		        'IT' => array(
		            'en' => 'Italy',
		            'ja' => 'イタリア',
		        ),
		        'LT' => array(
		            'en' => 'Lithuania',
		            'ja' => 'リトアニア',
		        ),
		        'LV' => array(
		            'en' => 'Latvia',
		            'ja' => 'ラトビア',
		        ),
		        'MD' => array(
		            'en' => 'Moldova',
		            'ja' => 'モルドバ',
		        ),
		        'MK' => array(
		            'en' => 'Macedonia',
		            'ja' => 'マケドニア',
		        ),
		        'MT' => array(
		            'en' => 'Malta',
		            'ja' => 'マルタ',
		        ),
		        'NL' => array(
		            'en' => 'Netherlands',
		            'ja' => 'オランダ',
		        ),
		        'NO' => array(
		            'en' => 'Norway',
		            'ja' => 'ノルウェー',
		        ),
		        'PL' => array(
		            'en' => 'Poland',
		            'ja' => 'ポーランド',
		        ),
		        'PT' => array(
		            'en' => 'Portugal',
		            'ja' => 'ポルトガル',
		        ),
		        'RO' => array(
		            'en' => 'Romania',
		            'ja' => 'ルーマニア',
		        ),
		        'RS' => array(
		            'en' => 'Serbia',
		            'ja' => 'セルビア',
		        ),
		        'RU' => array(
		            'en' => 'Russia',
		            'ja' => 'ロシア連邦',
		        ),
		        'SE' => array(
		            'en' => 'Sweden',
		            'ja' => 'スウェーデン',
		        ),
		        'SI' => array(
		            'en' => 'Slovenia',
		            'ja' => 'スロベニア',
		        ),
		        'SK' => array(
		            'en' => 'Slovakia',
		            'ja' => 'スロバキア',
		        ),
		        'UA' => array(
		            'en' => 'Ukraine',
		            'ja' => 'ウクライナ',
		        ),
		        'KO' => array(
		            'en' => 'kosovo',
		            'ja' => 'コソボ',
		        ),
		    ),
		    'MiddleEast' => array(
		        'BH' => array(
		            'en' => 'Bahrain',
		            'ja' => 'バーレーン',
		        ),
		        'AE' => array(
		            'en' => 'United Arab Emirates',
		            'ja' => 'アラブ首長国連邦',
		        ),
		        'AF' => array(
		            'en' => 'Afghanistan',
		            'ja' => 'アフガニスタン',
		        ),
		        'IL' => array(
		            'en' => 'Israel',
		            'ja' => 'イスラエル',
		        ),
		        'IQ' => array(
		            'en' => 'Iraq',
		            'ja' => 'イラク',
		        ),
		        'IR' => array(
		            'en' => 'Iran',
		            'ja' => 'イラン',
		        ),
		        'JO' => array(
		            'en' => 'Jordan',
		            'ja' => 'ヨルダン',
		        ),
		        'KW' => array(
		            'en' => 'Kuwait',
		            'ja' => 'クウェート',
		        ),
		        'LB' => array(
		            'en' => 'Lebanon',
		            'ja' => 'レバノン',
		        ),
		        'OM' => array(
		            'en' => 'Oman',
		            'ja' => 'オマーン',
		        ),
		        'QA' => array(
		            'en' => 'Qatar',
		            'ja' => 'カタール',
		        ),
		        'SA' => array(
		            'en' => 'Saudi Arabia',
		            'ja' => 'サウジアラビア',
		        ),
		        'SY' => array(
		            'en' => 'Syria',
		            'ja' => 'シリア',
		        ),
		        'YE' => array(
		            'en' => 'Yemen',
		            'ja' => 'イエメン',
		        ),
		        'TR' => array(
		            'en' => 'Turkey',
		            'ja' => 'トルコ',
		        ),
		        'EG' => array(
		            'en' => 'Egypt',
		            'ja' => 'エジプト',
		        ),
		    ),
		    'Africa' => array(
		        'SM' => array(
		            'en' => 'San Marino',
		            'ja' => 'サンマリノ',
		        ),
		        'SS' => array(
		            'en' => 'South Sudan',
		            'ja' => '南スーダン',
		        ),
		        'BF' => array(
		            'en' => 'Burkina Faso',
		            'ja' => 'ブルキナファソ',
		        ),
		        'BI' => array(
		            'en' => 'Burundi',
		            'ja' => 'ブルンジ',
		        ),
		        'BJ' => array(
		            'en' => 'Benin',
		            'ja' => 'ベナン',
		        ),
		        'BW' => array(
		            'en' => 'Botswana',
		            'ja' => 'ボツワナ',
		        ),
		        'CD' => array(
		            'en' => 'Democratic Republic of the Congo',
		            'ja' => 'コンゴ民主共和国',
		        ),
		        'CF' => array(
		            'en' => 'Central African Republic',
		            'ja' => '中央アフリカ共和国',
		        ),
		        'CG' => array(
		            'en' => 'Republic of the Congo',
		            'ja' => 'コンゴ共和国',
		        ),
		        'CI' => array(
		            'en' => "Cote d'Ivoire",
		            'ja' => 'コートジボワール',
		        ),
		        'CM' => array(
		            'en' => 'Cameroon',
		            'ja' => 'カメルーン',
		        ),
		        'CV' => array(
		            'en' => 'Cape Verde',
		            'ja' => 'カーボベルデ',
		        ),
		        'DJ' => array(
		            'en' => 'Djibouti',
		            'ja' => 'ジブチ',
		        ),
		        'DZ' => array(
		            'en' => 'Algeria',
		            'ja' => 'アルジェリア',
		        ),
		        'ER' => array(
		            'en' => 'Eritrea',
		            'ja' => 'エリトリア',
		        ),
		        'ET' => array(
		            'en' => 'Ethiopia',
		            'ja' => 'エチオピア',
		        ),
		        'GA' => array(
		            'en' => 'Gabon',
		            'ja' => 'ガボン',
		        ),
		        'GH' => array(
		            'en' => 'Ghana',
		            'ja' => 'ガーナ',
		        ),
		        'GM' => array(
		            'en' => 'Gambia',
		            'ja' => 'ガンビア',
		        ),
		        'GN' => array(
		            'en' => 'Guinea',
		            'ja' => 'ギニア',
		        ),
		        'GQ' => array(
		            'en' => 'Equatorial Guinea',
		            'ja' => '赤道ギニア',
		        ),
		        'GW' => array(
		            'en' => 'Guinea Bissau',
		            'ja' => 'ギニアビサウ',
		        ),
		        'KE' => array(
		            'en' => 'Kenya',
		            'ja' => 'ケニア',
		        ),
		        'KM' => array(
		            'en' => 'Comoros',
		            'ja' => 'コモロ',
		        ),
		        'LR' => array(
		            'en' => 'Liberia',
		            'ja' => 'リベリア',
		        ),
		        'LS' => array(
		            'en' => 'Lesotho',
		            'ja' => 'レソト',
		        ),
		        'LY' => array(
		            'en' => 'Libya',
		            'ja' => 'リビア',
		        ),
		        'MA' => array(
		            'en' => 'Morocco',
		            'ja' => 'モロッコ',
		        ),
		        'MG' => array(
		            'en' => 'Madagascar',
		            'ja' => 'マダガスカル',
		        ),
		        'ML' => array(
		            'en' => 'Mali',
		            'ja' => 'マリ',
		        ),
		        'MR' => array(
		            'en' => 'Mauritania',
		            'ja' => 'モーリタニア',
		        ),
		        'MU' => array(
		            'en' => 'Mauritius',
		            'ja' => 'モーリシャス',
		        ),
		        'MW' => array(
		            'en' => 'Malawi',
		            'ja' => 'マラウイ',
		        ),
		        'MZ' => array(
		            'en' => 'Mozambique',
		            'ja' => 'モザンビーク',
		        ),
		        'NA' => array(
		            'en' => 'Namibia',
		            'ja' => 'ナミビア',
		        ),
		        'NE' => array(
		            'en' => 'Niger',
		            'ja' => 'ニジェール',
		        ),
		        'NG' => array(
		            'en' => 'Nigeria',
		            'ja' => 'ナイジェリア',
		        ),
		        'RW' => array(
		            'en' => 'Rwanda',
		            'ja' => 'ルワンダ',
		        ),
		        'SC' => array(
		            'en' => 'Seychelles',
		            'ja' => 'セーシェル',
		        ),
		        'SD' => array(
		            'en' => 'Sudan',
		            'ja' => 'スーダン',
		        ),
		        'SL' => array(
		            'en' => 'Sierra Leone',
		            'ja' => 'シェラレオネ',
		        ),
		        'SN' => array(
		            'en' => 'Senegal',
		            'ja' => 'セネガル',
		        ),
		        'SO' => array(
		            'en' => 'Somalia',
		            'ja' => 'ソマリア',
		        ),
		        'ST' => array(
		            'en' => 'Sao Tome and Principe',
		            'ja' => 'サントメ・プリンシペ',
		        ),
		        'SZ' => array(
		            'en' => 'Swaziland',
		            'ja' => 'スワジランド',
		        ),
		        'TD' => array(
		            'en' => 'Chad',
		            'ja' => 'チャド',
		        ),
		        'TG' => array(
		            'en' => 'Togo',
		            'ja' => 'トーゴ',
		        ),
		        'TN' => array(
		            'en' => 'Tunisia',
		            'ja' => 'チュニジア',
		        ),
		        'TZ' => array(
		            'en' => 'Tanzania',
		            'ja' => 'タンザニア',
		        ),
		        'UG' => array(
		            'en' => 'Uganda',
		            'ja' => 'ウガンダ',
		        ),
		        'ZA' => array(
		            'en' => 'South Africa',
		            'ja' => '南アフリカ共和国',
		        ),
		        'ZM' => array(
		            'en' => 'Zambia',
		            'ja' => 'ザンビア',
		        ),
		        'ZW' => array(
		            'en' => 'Zimbabwe',
		            'ja' => 'ジンバブエ',
		        ),
		    ),
		    'NorthAmerica' => array(
		        'VC' => array(
		            'en' => 'Saint Vincent and the Grenadines',
		            'ja' => 'セントビンセントおよびグレナディーン諸島',
		        ),
		        'AG' => array(
		            'en' => 'Antigua and Barbuda',
		            'ja' => 'アンティグア・バーブーダ',
		        ),
		        'BB' => array(
		            'en' => 'Barbados',
		            'ja' => 'バルバドス',
		        ),
		        'BS' => array(
		            'en' => 'The Bahamas',
		            'ja' => 'バハマ',
		        ),
		        'BZ' => array(
		            'en' => 'Belize',
		            'ja' => 'ベリーズ',
		        ),
		        'CA' => array(
		            'en' => 'Canada',
		            'ja' => 'カナダ',
		        ),
		        'CR' => array(
		            'en' => 'Costa Rica',
		            'ja' => 'コスタリカ',
		        ),
		        'CU' => array(
		            'en' => 'Cuba',
		            'ja' => 'キューバ',
		        ),
		        'DM' => array(
		            'en' => 'Dominica',
		            'ja' => 'ドミニカ',
		        ),
		        'DO' => array(
		            'en' => 'Dominican Republic',
		            'ja' => 'ドミニカ共和国',
		        ),
		        'GD' => array(
		            'en' => 'Grenada',
		            'ja' => 'グレナダ',
		        ),
		        'GT' => array(
		            'en' => 'Guatemala',
		            'ja' => 'グアテマラ',
		        ),
		        'HN' => array(
		            'en' => 'Honduras',
		            'ja' => 'ホンジュラス',
		        ),
		        'HT' => array(
		            'en' => 'Haiti',
		            'ja' => 'ハイチ',
		        ),
		        'JM' => array(
		            'en' => 'Jamaica',
		            'ja' => 'ジャマイカ',
		        ),
		        'KN' => array(
		            'en' => 'Saint Kitts and Nevis',
		            'ja' => 'セントクリストファー・ネイビス',
		        ),
		        'LC' => array(
		            'en' => 'Saint Lucia',
		            'ja' => 'セントルシア',
		        ),
		        'MX' => array(
		            'en' => 'Mexico',
		            'ja' => 'メキシコ',
		        ),
		        'NI' => array(
		            'en' => 'Nicaragua',
		            'ja' => 'ニカラグア',
		        ),
		        'PA' => array(
		            'en' => 'Panama',
		            'ja' => 'パナマ',
		        ),
		        'SV' => array(
		            'en' => 'El Salvador',
		            'ja' => 'エルサルバドル',
		        ),
		        'TT' => array(
		            'en' => 'Trinidad and Tobago',
		            'ja' => 'トリニダード・トバゴ',
		        ),
		        'US' => array(
		            'en' => 'United States of America',
		            'ja' => 'アメリカ合衆国',
		        ),
		    ),
		    'SouthAmerica' => array(
		        'AR' => array(
		            'en' => 'Argentina',
		            'ja' => 'アルゼンチン',
		        ),
		        'BO' => array(
		            'en' => 'Bolivia',
		            'ja' => 'ボリビア',
		        ),
		        'BR' => array(
		            'en' => 'Brazil',
		            'ja' => 'ブラジル',
		        ),
		        'CL' => array(
		            'en' => 'Chile',
		            'ja' => 'チリ',
		        ),
		        'CO' => array(
		            'en' => 'Colombia',
		            'ja' => 'コロンビア',
		        ),
		        'EC' => array(
		            'en' => 'Ecuador',
		            'ja' => 'エクアドル',
		        ),
		        'GY' => array(
		            'en' => 'Guyana',
		            'ja' => 'ガイアナ',
		        ),
		        'PE' => array(
		            'en' => 'Peru',
		            'ja' => 'ペルー',
		        ),
		        'PY' => array(
		            'en' => 'Paraguay',
		            'ja' => 'パラグアイ',
		        ),
		        'SR' => array(
		            'en' => 'Suriname',
		            'ja' => 'スリナム',
		        ),
		        'UY' => array(
		            'en' => 'Uruguay',
		            'ja' => 'ウルグアイ',
		        ),
		        'VE' => array(
		            'en' => 'Venezuela',
		            'ja' => 'ベネズエラ',
		        ),
		    ),
		);
		return $CountrySet;
	}
}
?>