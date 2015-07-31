<?php
class AreasController extends AppController {
	public $name = 'Areas';

	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	 * エリアごとのページ(デフォルト：アジア)
	 */
	public function index() {
		$this->set('title_for_layout','Asia');

		//エリア名
		$Area = $this->Map->AllArea();
		$this->set('Area',$Area);

		//指定エリア
		$Country = $this->Map->CountryByArea('Asia');

		$id = $this->Auth->user('user_id');

		//[DB]ユーザー情報
		$user = $this->User->getuser($id);

		//[DB]フレンド情報
		$Friends = $this->Following->getFriends($id);

		//国
		foreach($Country as $code => $country) {
			$i = 0;
			$sum = 0;
			$Country[$code] = array();
			$Country[$code]['ja'] = $country;
			$Country[$code]['users'] = array();
			foreach($Friends as $friend) {
				if($friend['User'][$code] == 1) {
					$Country[$code]['users'][$i++] = array(
						'twitter_screen_name' => $friend['User']['twitter_screen_name'],
						'username' => $friend['User']['username'],
						'twitter_image_url' => $friend['User']['twitter_image_url'],
					);
					$Country[$code]['count'] = ++$sum;
				}
			}
		}
		
		//訪れた人数で降順にソート
		foreach ($Country as $code => $data){
			$key[$code] = count($data['users']);
		}
		array_multisort ($key, SORT_DESC, $Country);
		
		$this->set('Country',$Country);

		$this->render('view');
	}

	/**
	* エリアごとのページ
	*/
	public function view($area) {
		$this->set('title_for_layout',$area);

		//エリア名
		$Area = $this->Map->AllArea();
		$this->set('Area',$Area);

		//指定エリア
		$Country = $this->Map->CountryByArea($area);

		$id = $this->Auth->user('user_id');

		//[DB]ユーザー情報
		$user = $this->User->getUser($id);

		//[DB]フレンド情報
		$Friends = $this->Following->getFriends($id);

		//国
		foreach($Country as $code => $country) {
			$i = 0;
			$Country[$code] = array();
			$Country[$code]['ja'] = $country;
			$Country[$code]['users'] = array();
			foreach($Friends as $friend) {
				if($friend['User'][$code] == 1) {
					$Country[$code]['users'][$i++] = array(
						'twitter_screen_name' => $friend['User']['twitter_screen_name'],
						'username' => $friend['User']['username'],
						'twitter_image_url' => $friend['User']['twitter_image_url'],
					);
				}
			}
		}
		
		//訪れた人数で降順にソート
		foreach ($Country as $code => $data){
			$key[$code] = count($data['users']);
		}
		array_multisort ($key, SORT_DESC, $Country);
		
		$this->set('Country',$Country);
	}

}
