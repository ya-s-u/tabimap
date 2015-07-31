<?php
App::uses('AppHelper', 'View/Helper');

class TwitterHelper extends AppHelper {

	/*
	 * サムネイルをリサイズ
	 */
	public function resizeThumb($url) {
		 return preg_replace("/normal/","200x200",$url,1);
	}

}