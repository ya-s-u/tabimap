<?php
App::uses('AppHelper', 'View/Helper');

class ClassHelper extends AppHelper {

	/*
	 * コントローラー名を判定しactiveクラスをつける
	 */
	public function addClassByController($controller) {
		if($this->params["controller"] == $controller) {
			return 'class="active"';
		}
	}

	/*
	 * コントローラー名とアクション名を判定しactiveクラスをつける
	 */
	public function addClassByControllerAndAction($controller, $action) {
		if($this->params["controller"] == $controller && $this->params["action"] == $action) {
			return 'class="active"';
		}
	}
	
	/*
	 * コントローラー名とアクション名を判定する
	 */
	public function checkControllerAndAction($controller, $action) {
		if($this->params["controller"] == $controller && $this->params["action"] == $action) {
			return true;
		} else {
			return false;
		}
	}

}