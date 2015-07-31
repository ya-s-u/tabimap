<?php
class FriendsController extends AppController {
	public $name = 'Friends';

	public function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	 * 全ての友達
	 */
	public function index() {
		$this->set('title_for_layout','すべての友達');

		$id = $this->Auth->user('user_id');
		$screen_name = $this->Auth->user('twitter_screen_name');

		//[DB]ユーザー情報取得
		$user = $this->User->getUser($screen_name);
		$this->set('user',$user);

		//[DB]フレンド情報取得
		//$Friends = $this->Following->getFriends($id);
		
		$Friends = $this->User->getAllUser($id); //!!!temporary!!!
		$this->set('Friends',$Friends);

		//友達の数
		$this->set('friend_sum',count($Friends));

		//全ての国を取得
		$Country = $this->Map->AllCountry();
		$this->set('Country',$Country);

		//友達の色を塗る国
		$FlagsOthers = array();
		foreach($Country as $code => $country) {
			foreach($Friends as $friend) {
				if($friend['User'][$code] == 1) {
					$FlagsOthers[$code] = $country;
				}
			}
		}
		$this->set('FlagsOthers',$FlagsOthers);

		//自分の色を塗る国
		$FlagsMe = array();
		foreach($Country as $code => $country) {
			if($user['User'][$code] == 1) {
				$FlagsMe[$code] = $country;
			}
		}
		$this->set('FlagsMe',$FlagsMe);

		//自分友達合わせた国数
		$country_sum = 0;
		foreach($Country as $code => $country) {
			if(array_key_exists($code,$FlagsOthers) || array_key_exists($code,$FlagsMe)) {
				$country_sum++;
			}
		}
		$this->set('country_sum',$country_sum);
	}

}
