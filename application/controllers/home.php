<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('SPARKPATH', getcwd()."/sparks/");
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/apiClient.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiCalendarService.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiOauth2Service.php";

class Home extends CI_Controller {
	var $apiClient;
	var $client = "abc";
	var $oauth2;
	var $oauth_access_token;

	var $userdata;
	var $step;
	var $uid;
	var $poid;
	var $pouid;
	var $author_email;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library("Googleapps");

		$this->load->model('filesm');
		$this->load->model('posm');
		$this->load->model('usersm');
		
		$userData = $this->googleapps->init();
		$this->userdata = $userData;
		$this->insertAuthorData();
//				$this->userdata = $this->session->userdata('userdata');

		/*
		$this->contacts = $this->googleapps->getContacts();
		ksort($this->contacts);
		*/
		
		$this->author_email = strtolower($this->userdata['email']);
		$_SESSION['currentpo']['step1']['author_email'] = $this->userdata['email'];
		
		$this->session->set_userdata('author_email', $this->author_email);
		$this->session->set_userdata('userdata', $this->userdata);
		$this->session->set_userdata('uid', $this->uid);
		
	}
	
	public function logout()
	{
		$this->googleapps->logout();
		header("Location: http://www.poignite.com");
	}
	
	public function insertAuthorData()
	{
		$userdata = array(
			'googleid'			=>		$this->userdata['id'],
			'given_name'		=>		$this->userdata['given_name'],
			'family_name'		=>		$this->userdata['family_name'],
			'name'				=>		$this->userdata['name'],
			'email'				=>		strtolower($this->userdata['email']),
		);
		
		$this->uid = $this->usersm->insert($userdata);
	}
	
	
	public function index()
	{
//		$a = $this->googleapps->getContacts();
//		var_dump($a);

		
		$this->load->library('template');
		
		
		/*
		foreach($contacts['entry'] as $contact)
		{
			//var_dump($contact);
			echo $contact['title'];
			var_dump($contact['title']);
		}
		*/
		
		$payload['menu'] = array(	
									array('name' => "New", 'val' => "/po/newpo", 'align' => 'right'),
									array('name' => "View All", 'val' => "/po/history", 'align' => 'right'),
									array('name' => "Review", 'val' => "/po/review", 'align' => 'right'),
									array('name' => "Reports", 'val' => "/po/reports", 'align' => 'right'),
									array('name' => $this->userdata['name'], 'val' => array(	
										array('name' => "Log out", 'val' => "/home/logout"),
									), 'align' => 'right'),
								);

		$payload['css'] = array(	"prettify", 
									"bootstrap.min",
									"bootstrap-responsive.min",
									"font-awesome",
									"apignite",
									);
		$payload['js'] = array(	"jquery-1.7.min", 
								"jquery.tablesorter", 
								"bootstrap.min",
								"application",
								"prettify",
								);

		$payload['userdata'] = $this->userdata;
		$this->template->write_view('homepage', 'layouts/dashboard', $payload);

		return $this->template->render();
	}
}
