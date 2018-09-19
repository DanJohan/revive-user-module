<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\Auth\OAuth2;
class GmailLogin {

	private $client_id = GMAIL_CLIENT_ID;
	private $client_secret = GMAIL_CLIENT_SECRET;
	private $access_token;
	private $api_key=GMAIL_API_KEY;


	public function __construct(){
		$this->client = new Google_Client();
		$this->client->setApplicationName('Login to Revive-car');
		$this->client->setClientId($this->client_id);
		$this->client->setClientSecret($this->client_secret);
		$this->client->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));
		$this->client->setDeveloperKey($this->api_key);
		$this->client->setRedirectUri(base_url()."user/gmailcallback");
		//$this->google_oauthV2 = new Google_Oauth2Service($this->client);
	}

	public function getLoginUrl(){
		return $this->client->createAuthUrl();
	}

	public function checkRedirectCode(){

		if(isset($_GET['code'])) {

			$this->client->authenticate($_GET['code']);
			$this->access_token = $this->client->getAccessToken();
			return true;
		}

		return false;
	}

	public function getUserData(){
		//dd($this->access_token);
		$google_oauthV2 = new \Google_Service_Oauth2($this->client);
		$userData = $google_oauthV2->userinfo->get();
		//dd($userData);
		return (!empty($userData)) ? $userData : null;
	
	}
}
?>