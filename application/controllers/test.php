<?php

class Test extends CI_Controller {
	var $client = "abc";
	var $passer = "test";
	var $oauth2;
	
	public function __construct()
	{
		parent::__construct();
		
	}
	
	function index()
	{
		global $apiConfig;
		global $client;
		
		require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/apiClient.php";
		require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiCalendarService.php";
		require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiOauth2Service.php";
		
		session_start();
		
		
		$client = new apiClient();
		$client->setApplicationName("Google UserInfo PHP Starter Application");
		// Visit https://code.google.com/apis/console?api=plus to generate your
		// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
		// $client->setClientId('insert_your_oauth2_client_id');
		// $client->setClientSecret('insert_your_oauth2_client_secret');
		// $client->setRedirectUri('insert_your_redirect_uri');
		// $client->setDeveloperKey('insert_your_developer_key');
		$oauth2 = new apiOauth2Service($client);

		if (isset($_GET['code'])) {
		  $client->authenticate();
		  $_SESSION['token'] = $client->getAccessToken();
		  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) {
		 $client->setAccessToken($_SESSION['token']);
		}

		if (isset($_REQUEST['logout'])) {
		  unset($_SESSION['token']);
		  $client->revokeToken();
		}

		$authUrl = NULL;
		if ($client->getAccessToken()) 
		{
		  $user = $oauth2->userinfo->get();
		
		  // These fields are currently filtered through the PHP sanitize filters.
		  // See http://www.php.net/manual/en/filter.filters.sanitize.php
		  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
		  $personMarkup = "$email<div><img src='$img?sz=50'></div>";

		  // The access token may have been updated lazily.
		  $_SESSION['token'] = $client->getAccessToken();
		} else {
		  $authUrl = $client->createAuthUrl();
		}
		
		if ($authUrl != NULL)
		{
			header("Location: ".$authUrl);
		}
		
	}
}
