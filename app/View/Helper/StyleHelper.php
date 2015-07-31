<?php
App::uses('AppHelper', 'View/Helper');

class StyleHelper extends AppHelper {

	/*
	 * マップサイズ
	 */
	public function MapWidth($is_mobile) {
		if($is_mobile) {
			return 320;
		} else {
			return 1200;
		}
	}
	
	/*
	 * マップサイズ
	 */
	public function MapHeight($is_mobile) {
		if($is_mobile) {
			return 200;
		} else {
			return 700;
		}
	}

}