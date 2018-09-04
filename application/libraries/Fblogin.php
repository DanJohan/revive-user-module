<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fblogin {
	private $fb;
	private $app_id=FB_APP_ID;
	private $app_secret=FB_SECRET_KEY;
	private $version=FB_VERSION;
	private $access_token;

	public function __construct(){
		$this->fb = new Facebook\Facebook([
			'app_id' => $this->app_id ,
			'app_secret'=>$this->app_secret,
			'default_graph_version'=>$this->version 
		]);
	}

	public function getLoginUrl(){
		$helper = $this->fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl(base_url().'user/fbcallback', $permissions);
		return $loginUrl;
	}

	private function getAccessToken() {
		$helper = $this->fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (! isset($accessToken)) {
		  if ($helper->getError()) {
		    header('HTTP/1.0 401 Unauthorized');
		    echo "Error: " . $helper->getError() . "\n";
		    echo "Error Code: " . $helper->getErrorCode() . "\n";
		    echo "Error Reason: " . $helper->getErrorReason() . "\n";
		    echo "Error Description: " . $helper->getErrorDescription() . "\n";
		  } else {
		    header('HTTP/1.0 400 Bad Request');
		    echo 'Bad request';
		  }
		  exit;
		}

		$oAuth2Client = $this->fb->getOAuth2Client();

		if (! $accessToken->isLongLived()) {
		  // Exchanges a short-lived access token for a long-lived one
		  try {
		    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {
		    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
		    exit;
		  }
		}

		$this->access_token= $accessToken->getValue();

	}

	public function getUser(){
		$this->getAccessToken();
		try {
		  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
		  // If you provided a 'default_access_token', the '{access-token}' is optional.
		  $response = $this->fb->get('/me', $this->access_token);
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		$me = $response->getGraphUser();
		return $me;
	}

}
?>