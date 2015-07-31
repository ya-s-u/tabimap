<?php
class PagesController extends AppController {
	public $name = 'Pages';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','news','help','terms','policy','contact','thanks');
	}
	
	/**
	 * LPページ
	 */
	public function index() {
		$this->set('title_for_layout','ようこそ');
		
		//エリア名
		$Area = $this->Map->AllArea();
		$this->set('Area',$Area);
		
		//国セット
		$CountrySet = $this->Map->CountrySet();
		$this->set('CountrySet',$CountrySet);
		
		$Country = $this->Map->AllCountry();
		$this->set('Country',$Country);
		
		//変更
		if($this->request->isPost()) {
			//セッション開始
			CakeSession::start();

			//フォームデータをセッションに一時保存
			$this->Session->write('create', $this->request->data['Pages']);

			//TwitterOAuth認証
			$this->redirect(array('controller'=>'twitters','action'=>'redirect1'));
		}
	}

	/**
	 * ヘルプ
	 */
	public function help() {
		$this->set('title_for_layout','ヘルプ');
	}
	
	/**
	 * 利用規約
	 */
	public function terms() {
		$this->set('title_for_layout','利用規約');
	}
	
	/**
	 * プライバシーポリシー
	 */
	public function policy() {
		$this->set('title_for_layout','プライバシーポリシー');
	}

}