<?php

class TwitterComponent extends Component {
	public $name = "Twitter";
	
	public function beforeFileter() {
	}

	/**
	* [OAuth]プロフィール(ユーザー名、使用言語、プロフィール画像URL)を更新
	*/
	public function changeProfile($id) {
		$model = ClassRegistry::init('User');

		//ユーザーDBからアクセストークン取得
		$access_token = $this->controllers->getAccessToken($id);

		//TwitterOAuthオブジェクト生成
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['twitter_oauth_token'], $access_token['twitter_oauth_token_secret']);

		//ユーザー情報を取得し、連想配列にする
		$content = $connection->get('account/verify_credentials');
		$content = (array) $content;

		//プロフィール画像をパラメータのみ取得
		/*$subject = $content['profile_image_url_https'];
		$pattern = '/https:\/\/pbs.twimg.com\/profile_images\/(.*?)_(.*?)';
		preg_match($pattern, $subject, $matches);
		$twitter_image_url = $matches[1];*/
		$twitter_image_url=$content['profile_image_url_https'];

		//ユーザーDBへ上書きする
		$this->User->updateProfile($content);

		return true;
	}

}
?>
