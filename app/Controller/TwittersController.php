<?php
require_once("../Vendor/twitteroauth/twitteroauth.php");
require_once("../Vendor/twitteroauth/OAuth.php");

class TwittersController extends AppController {
	public $name = 'Twitters';
	public $autoRender = false;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('redirect1','callback'));
	}

	/**
	 * リクエストトークンを取得
	 */
	public function redirect1() {
		//セッション開始
		CakeSession::start();

		//TwitterOAuthオブジェクト生成
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

		//リクエストトークンを取得しセッションに保存
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
		$this->Session->write('oauth_token', $request_token['oauth_token']);
		$this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);

		//アクセストークンを取得
		if($connection->http_code == 200) {
			$url = $connection->getAuthorizeURL($request_token['oauth_token']);
			$this->redirect($url);
		} else {
			$this->redirect('//'.$_SERVER["HTTP_HOST"]);
		}
	}

	/**
	 * コールバック
	 */
	public function callback() {
		//セッション開始
		CakeSession::start();

		//TwitterOAuthオブジェクト生成
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $this->Session->read('oauth_token'), $this->Session->read('oauth_token_secret'));

		//セッションからリクエストトークンを削除
		$this->Session->delete('oauth_token');
		$this->Session->delete('oauth_token_secret');

		//アクセストークンを取得
		$access_token = $connection->getAccessToken($this->request->query['oauth_verifier']);

		//未登録ユーザーなら新規登録
		if(!$this->User->checkTwitterUserId($access_token['user_id'])) {
			CakeSession::start();
			$check = $this->Session->read('create');
			if($check) {
				$this->User->newUser($access_token);
				$NewUser = 1;
			} else {
				$this->redirect('//'.$_SERVER["HTTP_HOST"]);
			}
		} else {
			$NewUser = 0;
		}

		//ログイン
		$this->request->data['User'] = array(
            'twitter_oauth_token' => $access_token['oauth_token'],
            'twitter_oauth_token_secret' => $access_token['oauth_token_secret']
        );

        if($this->Auth->login()) {
			$id = $this->Auth->user('user_id');

			//プロフィールを更新
			$this->changeProfile($id);

			//訪問国を更新(新規登録時のみ)
			if($NewUser) {
				$this->changeCountry($id);
			}

			//友達を更新
			$this->changeFriend($id);

			$this->redirect('//'.$_SERVER["HTTP_HOST"].'/home');
		} else {
			echo '作成失敗';
		}

	}

	/**
	 * [OAuth]プロフィール(ユーザー名、使用言語、プロフィール画像URL)を最新に更新
	 */
	public function changeProfile($id) {
		//ユーザーDBからアクセストークン取得
		$access_token = $this->User->getAccessToken($id);

		//TwitterOAuthオブジェクト生成
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['twitter_oauth_token'], $access_token['twitter_oauth_token_secret']);

		//ユーザー情報を取得し、連想配列にする
		$content = $connection->get('account/verify_credentials');
		$content = (array) $content;

		//ユーザーDBへ上書きする
		$this->User->updateProfile($id,$content);

		return true;
	}

	/**
	 * [OAuth]訪問国を更新(初回登録時は性別と年齢)
	 */
	public function changeCountry($id) {
		//セッションからフォームを読み込み、セッションを削除
		CakeSession::start();
		$countries = $this->Session->read('create');
		$this->Session->delete('create');

		if($countries) {
			//年齢validation
			if(isset($countries['age'])) {
				if (preg_match("/^\d{2}$/", $countries['age'])) {
					$countries['age'] = date('Y',mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')-$countries['age']-1));
				} else {
					$countries['age'] = null;
				}
			}
			
			//性別validation
			if(isset($countries['sex'])) {
				switch($countries['sex']) {
					case 'man': $countries['sex'] = 1; break;
					case 'woman': $countries['sex'] = -1; break;
					default: $countries['sex'] = null;
				}
			}
			
			//ユーザーDBへ上書きする
			$this->User->updateCountry($id,$countries);
		}

		return;
	}

	/**
	 * [OAuth]友達を最新に更新 ※自分友達両方
	 */
	public function changeFriend($id) {
		//ユーザーDBからアクセストークン取得
		$access_token = $this->User->getAccessToken($id);

		//TwitterOAuthオブジェクト生成
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['twitter_oauth_token'], $access_token['twitter_oauth_token_secret']);

		/*** Twitterでフォローしている人かつまだ友達関係でない人を友達関係に追加 ***/
		//フォローしている人を取得し、twitter_idを連想配列にする
		$content = $connection->get('friends/ids');
		$content = (array) $content;

		if(!$content) return;

		foreach($content['ids'] as $i => $data) {
			$FriendsTwitterId[$i] = $data;
		}

		//フォローしていて、tabimapユーザーのIDを取得
		$UserId = $this->User->getFriendsId($FriendsTwitterId);

		//既に友達のIDを取得
		$alreadyFollowingId = $this->Following->getfromId($id);

		//Twitterでフォローしている人かつまだ友達関係でない人のリストを作成
		$newFriends = array_diff($UserId, $alreadyFollowingId);

		//新規登録
		foreach($newFriends as $friend) {
			$this->Following->saveFriend($id,$friend);
		}
		/*** ここまで ***/

		/*** Twitterで自分のフォロワーを友達関係に追加 ***/
		//フォロワーを取得し、twitter_idを連想配列にする
		$content = $connection->get('followers/ids');
		$content = (array) $content;
		
		if(!$content) return;

		foreach($content['ids'] as $i => $data) {
			$FriendsTwitterId[$i] = $data;
		}

		//フォロワーで、tabimapユーザーのIDを取得
		$UserId = $this->User->getFriendsId($FriendsTwitterId);

		//既に友達のIDを取得
		$alreadyFollowingId = $this->Following->getToId($id);

		//Twitterでフォローされている人かつまだ友達関係でない人のリストを作成
		$newFriends = array_diff($UserId, $alreadyFollowingId);

		//新規登録
		foreach($newFriends as $friend) {
			$this->Following->saveFriend($friend,$id);
		}
		/*** ここまで ***/

		return true;
	}
	
	/**
	 * [OAuth]ツイート
	 */
	public function postTweet($text) {
		

		return;
	}

}
