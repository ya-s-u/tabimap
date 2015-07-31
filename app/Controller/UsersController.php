
<?php
class UsersController extends AppController {
	public $name = 'Users';

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('create');
	}

	/**
	 * ログインユーザーのプロフィールページ
	 */
	public function index() {
		$this->set('title_for_layout','マイページ');
		$id = $this->Auth->user('user_id');
		$screen_name = $this->Auth->user('twitter_screen_name');

		//[DB]ユーザー情報
		$user = $this->User->getuser($screen_name);
		$this->set('user',$user);

		$Country = $this->Map->AllCountry();
		$this->set('Country',$Country);

		//色を塗る国
		$Flags = array();
		foreach($Country as $code => $country) {
			if($user['User'][$code] == 1) {
				$Flags[$code] = $country;
			}
		}
		$this->set('Flags',$Flags);

		//国数
		$num = count($Flags);
		$this->set('num',$num);

		//変更
		if($this->request->isPost()) {
			$this->request->data['User'] += array('modified' => "'".date('Y-m-d H:i:s')."'");

			//ユーザーDBへ上書きする
			$this->User->updateCountry($id,$this->request->data['User']);

			$this->redirect('/users');
		}
	}

	/**
	* 友達のプロフィールページ
	*/
	public function view($screen_name) {

		//[DB]自分のユーザー情報
		$me = $this->User->getUser($this->Auth->user('twitter_screen_name'));
		$this->set('me',$me);

		//[DB]友達のユーザー情報
		$user = $this->User->getUser($screen_name);
		$this->set('user',$user);

		$this->set('title_for_layout',$user['User']['username']);
		
		//国名セット
		$Country = $this->Map->AllCountry();
		
		//自分も訪れたことのある国と自分がまだ訪れたことのない国
		$MeFlags = array();
		$OthersFlags = array();
		
		foreach($Country as $code => $country) {
			if($me['User'][$code] == 1 && $user['User'][$code] == 1) {
				$MeFlags[$code] = $country;
			} else if($me['User'][$code] == 0 && $user['User'][$code] == 1) {
				$OthersFlags[$code] = $country;
			}
		}
		$this->set('MeFlags',$MeFlags);
		$this->set('OthersFlags',$OthersFlags);

		//国数
		$num = count($MeFlags) + count($OthersFlags);
		$this->set('num',$num);
	}

	/**
	* ユーザー新規作成
	*/
	public function create() {
		$this->set('title_for_layout','ようこそ');
		
		if($this->Auth->user('user_id')) {
			$this->redirect('//'.$_SERVER["HTTP_HOST"].'/home');
		}
		
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
			$this->Session->write('create', $this->request->data['User']);

			//TwitterOAuth認証
			$this->redirect(array('controller'=>'twitters','action'=>'redirect1'));
		}
	}

	/**
	* ログアウト
	*/
	public function logout() {
		$this->set('title_for_layout','ログアウト');

		$this->Auth->logout();
		$this->Cookie->delete('Auth');
		$this->redirect('//'.$_SERVER["HTTP_HOST"]);
	}
	
	/**
	 * ログインユーザーのプロフィールページ
	 */
	public function delete() {
		$this->set('title_for_layout','退会する');
		$id = $this->Auth->user('user_id');
		
		if($this->request->isPost()) {
			$this->User->deleteUser($id);
			$this->Following->deleteUser($id);
			$this->Auth->logout();
			$this->redirect('//'.$_SERVER["HTTP_HOST"]);
		}
	}

}
