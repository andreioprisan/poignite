<?php

class Oauth2callback extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}
	
	function index()
	{
		if (isset($_GET['code']))
		{
			$_SESSION['oauth_access_token'] = $_GET['code'];
		}
		
		header("Location: http://".$_SERVER['HTTP_HOST']."/test");
	}
}




