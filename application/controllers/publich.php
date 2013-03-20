<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publich extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}

	public function index()
	{
		
		$this->template->write('title', 'Purchase Order Ignite - Welcome');

		$payload['menu'] = array(	
			/*
									array('name' => "My APIs", 'val' => array(	
										array('name' => "Versions", 'val' => "/apis/versions"),
										array('name' => "Builder", 'val' => "/apis/builder"),
									), 'align' => 'right'),
									array('name' => "Analytics", 'val' => array(	
										array('name' => "Requests", 'val' => "/analytics/requests"),
										array('name' => "Response Time", 'val' => "/analytics/responsetime"),
										array('name' => "Data", 'val' => "/analytics/data"),
										array('name' => "Errors", 'val' => "/analytics/errors"),
										array('name' => "Error Rate", 'val' => "/analytics/errorrate"),
										array('name' => "Users", 'val' => "/analytics/users"),
									), 'align' => 'right'),
									array('name' => "Policies", 'val' => array(	
										array('name' => "Profiles", 'val' => "/policies/profiles"),
										array('name' => "Status", 'val' => "/policies/status"),
									), 'align' => 'right'),
									array('name' => "Permissions", 'val' => array(	
										array('name' => "Users", 'val' => "/permissions/users"),
										array('name' => "Roles", 'val' => "/permissions/users"),
										array('name' => "OAuth 2", 'val' => "/permissions/oauth2"),
										array('name' => "HTTP Digest", 'val' => "/permissions/httpdigest"),
									), 'align' => 'right'),
									*/
									array(	'name' 		=> "Sign In", 
											'val' 		=> "/home", 
											'align' 	=> "right", 
											'login' 	=> "true"),
									
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


		$this->template->write_view('start', 'layouts/homepage', $payload);

		return $this->template->render();
	}
	
	public function logout()
	{
		unset($_SESSION['token']);
	}
}
