<?php
//define('SPARKPATH', getcwd()."/sparks/");
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/apiClient.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiCalendarService.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiOauth2Service.php";

class Googleapps {
	var $client;
	var $oauth2;
	
	function init()
	{
		global $client;
		
		if (!isset($_SESSION)) {
		  session_start();
		}
				
		$client = new apiClient();
		$client->setApplicationName('POignite');
		$this->oauth2 = new apiOauth2Service($client);

		$client->setScopes(array(
			"https://www.googleapis.com/auth/userinfo.profile",
			"https://www.googleapis.com/auth/userinfo.email",
			"http://www.google.com/m8/feeds/",
			"https://docs.google.com/feeds/",
			"https://docs.googleusercontent.com/",
			"https://spreadsheets.google.com/feeds/",
			)
		);

		
		$redirect2 = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		$redirect = str_replace("/index.php", "", $redirect2);
		
	  	$client->setRedirectUri($redirect);
		
		if (isset($_GET['code'])) {
			$client->setAccessToken(json_encode($_GET['code']));
			$client->authenticate();
			
			$_SESSION['token'] = $client->getAccessToken();
			$redirect2 = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			$redirect = str_replace("/index.php", "", $redirect2);
			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}
		
		if (isset($_REQUEST['logout'])) {
			unset($_SESSION['token']);
			$client->revokeToken();
		}
		
		$this->client = $client;
		
		$auth = $client->createAuthUrl();
		
		if (!$client->getAccessToken() || $client->getAccessToken() == NULL)
		{
			header('Location: ' . $auth);
		}
		
		$authUrl = NULL;
		$user = NULL;
		
		if ($client->getAccessToken()) {
		  $user = $this->oauth2->userinfo->get();
		  // The access token may have been updated lazily.
		  $_SESSION['token'] = $client->getAccessToken();
		} else {
		  $authUrl = $client->createAuthUrl();
		}
		
		if ($authUrl != NULL)
		{
			header("Location: ".$authUrl);
		}
		
		return $user;
		
		/*
		if (!$client->authenticate())
		{
			header('Location: ' . $auth);
			
		}
		*/
		
		//echo $client->getAccessToken();
		//} else {
		//    print "<a class=logout href='?logout'>Logout</a>";
		
	}
	
	public function logout()
	{
		session_start();

		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}

		// Finally, destroy the session.
		session_destroy();
		
		header("Location: ".'http://' . $_SERVER['HTTP_HOST']);
		/*
		if (isset($_SESSION['token']))
			unset($_SESSION['token']);
		
		$_SESSION = array();
		session_destroy();
		*/
		//$this->client->revokeToken();
	}
	
	public function getContacts()
	{
		$this->init();
		$client = $this->client;
		
//		$req = new apiHttpRequest("http://www.google.com/m8/feeds/contacts/andrei.oprisan%40lycos-inc.com/full/38aae2880addbb73");
		$req = new apiHttpRequest("http://www.google.com/m8/feeds/contacts/default/full?max-results=999999");
		$val = $client->getIo()->authenticatedRequest($req);
		$split = explode("</entry><entry>", $val->responseBody);
		
		$contacts = array();
		$first = 0;
		foreach($split as $contact)
		{
			if ($first == 0)
			{
				$first++;
				continue;
			}	
			
			$xmlify = simplexml_load_string("<xml>".str_replace(array("gd:", "gContact:", "</entry></feed>"), NULL, $contact)."</xml>");
			$c = json_decode(json_encode($xmlify), true);
			
			if (!isset($c['title']) || is_array($c['title']))
				continue;
				
			$contacts[$c['title']] = 
				array(
					'photo'	=>	$c['link'][0]['@attributes']['href'],
					'self'	=>	$c['link'][1]['@attributes']['href'],
					'edit'	=>	$c['link'][2]['@attributes']['href'],
				);
			
			if (isset($c['email'][0]))
				$contacts[$c['title']]['email'] = $c['email'][0]['@attributes']['address'];
			else if (isset($c['email']['@attributes']['address']))
				$contacts[$c['title']]['email'] = $c['email']['@attributes']['address'];
			
			if (isset($c['organization']))
			{
			if (isset($c['organization']['orgName']))
				$contacts[$c['title']]['orgName'] = $c['organization']['orgName'];
			
			if (isset($c['organization']['orgTitle']))
				$contacts[$c['title']]['orgTitle'] = $c['organization']['orgTitle'];
			}
			
			if (isset($c['phoneNumber']))
				$contacts[$c['title']]['phoneNumber'] = $c['phoneNumber'];
			
		}

		// The access token may have been updated lazily.
		$_SESSION['token'] = $client->getAccessToken();
		
		return $contacts;
	}
	
}
