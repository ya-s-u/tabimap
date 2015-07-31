<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $uses = array('User','Following');
	public $helpers = array('Html','Form','Session','Class','Twitter','Style');
	public $components = array(
		'Session',
		'Map',
		'Twitter',
		'Cookie',
		'Auth' => array(
	        'authenticate' => array(
	            'Form' => array(
	                'userModel' => 'User',
	                'passwordHasher' => array(
                        'className' => 'None'
                    ),
	                'fields' => array('username' => 'twitter_oauth_token' , 'password'=>'twitter_oauth_token_secret'),
	            ),
	        ),
	        'loginError' => 'パスワードもしくはログインIDをご確認下さい。',
	        'authError' => 'ご利用されるにはログインが必要です。',
	        'loginAction' => array('controller' => 'users', 'action' => 'create'),
	        'loginRedirect' => array('controller' => 'friends', 'action' => 'index'),
	        'logoutRedirect' => array('controller' => 'users', 'action' => 'create'),
	    ),
	);
	public $layout = 'Common';

	public function beforeFilter() {
		$auth_id = $this->Auth->user('user_id');
		
		if($auth_id) {
			$auth = $this->User->getUser($auth_id);
			$this->set('auth',$auth);
		}
		
		$useragents = array(
            'iPhone',
            'iPod',
            'Android'
        );
        $pattern = '/'.implode('|', $useragents).'/i';
        if($_ua = preg_match($pattern, $_SERVER['HTTP_USER_AGENT'])){
        	$this->set('is_mobile', true);
        }else{
        	$this->set('is_mobile', false);
        }
	}
}
