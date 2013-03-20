<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apis extends CI_Controller {
	var $api_heuristics;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		
		$this->load->model('apiedit', 'apiedit');
		
	}
	
	public function builder()
	{
		
		$this->template->write('title', 'apignite - api builder');

		$payload['menu'] = array(	
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
									
									array(	'name' 		=> "Sign In", 
											'val' 		=> "/login", 
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
								"prettify",
								"application",
								
								);
		
		$api_id = "1";
		$this->api_heuristics = $this->getapiheuristic($api_id);
		
		$html = $this->htmlapisidelist($api_id);
		$payload['apisidemenu'] = $html;
		
		if ($this->uri->segment(3) === FALSE)
		{
		    $category_id_r = 1;
			$method_id_r = 3;
		}
		else
		{
		    $uid = $this->uri->segment(4);
			$method = $this->apiedit->method_get_uid($uid);
			if ($method)
			{
				$category_id_r = $method->category_id;
				$method_id_r = $method->method_id;
			} else {
				//error catch
			}
		}
		
		$method = $this->htmlapimethod($category_id_r, $method_id_r);
		$payload['apimethodslide'] = $method;
		
		$params = $this->apiedit->param_get($method_id_r);
		$payload['apiparams'] = $params;

		
		
		$this->template->write_view('start', 'layouts/builder', $payload);
		
		
		return $this->template->render();
	}
	
	public function getapiheuristic($api_id = "1")
	{
		$categories = $this->apiedit->category_get($api_id);
		$result = array('categories'	=>	NULL);
		foreach($categories as $category)
		{
			$result['categories'][$category->category_id] = 
										array(	'name'			=>	$category->c_name,
												'description'	=>	$category->c_description
											);
			
			$methods = $this->apiedit->method_get($category->category_id);
			
			$methods_arr = array();
			foreach($methods as $method)
			{
				$methods_arr[$method->method_id] = array(	'type'			=>	$method->m_type,
															'name'			=>	$method->m_name,
															'description'	=>	$method->m_description,
															'uid'			=>	$method->m_uid,
															);
				
				$params = $this->apiedit->param_get($method->method_id);

				$params_arr = array();
				foreach($params as $param)
				{
					$params_arr[$param->param_id] = array(	'type'			=>	$param->type,
															'name'			=>	$param->name,
															'value'			=>	$param->value,
															'description'	=>	$param->description,
															);
				}
				
				$methods_arr[$method->method_id]['params'] = $params_arr;
				
				$result['categories'][$category->category_id]['methods'] = $methods_arr;
				
			}
			
			$result['categories'][$category->category_id]['methods'] = $methods_arr;
			
		}
		
		return($result);
	}
	
	public function htmlapisidelist()
	{
		$api = $this->api_heuristics;
		
		$parent = "/apis/builder";
		
		$html = "";
		foreach($api['categories'] as $category_id => $category_data)
		{
			$html .= '<li class="nav-header" style="font-size: 15px; position:relative; left:-20px">'.$category_data['name'].'</li>';
			
			foreach($category_data['methods'] as $method_id => $method_data)
			{
				if ($method_data['type'] == "get")
				{
					$html .= '<li style="position:relative; left: -20px"><a href="'.$parent."/method/".$method_data['uid'].'"><span class="label label-success" style="position:relative; top: -3px; margin-right: 17px; left:0px">get</span> '.$method_data['name'].'</a></li>';
				} else 	if ($method_data['type'] == "post")
				{
					$html .= '<li style="position:relative; left: -20px"><a href="'.$parent."/method/".$method_data['uid'].'"><span class="label label-info" style="position:relative; top: -3px; margin-right: 10px">post</span> '.$method_data['name'].'</a></li>';

				} else	if ($method_data['type'] == "put")
				{
	              $html .= '<li style="position:relative; left: -20px"><a href="'.$parent."/method/".$method_data['uid'].'"><span class="label label-warning" style="position:relative; top: -3px; margin-right: 16px">put</span> '.$method_data['name'].'</a></li>';

				} else	if ($method_data['type'] == "delete")
				{
	              $html .= '<li style="position:relative; left: -20px"><a href="'.$parent."/method/".$method_data['uid'].'"><span class="label label-important" style="position:relative; top: -3px; margin-right: 2px;">delete</span> '.$method_data['name'].'</a></li>';
				} 
              

			}
		}
		
		return $html;
	}
	
	public function htmlapimethod($category_id_r, $method_id_r)
	{
		$api = $this->api_heuristics;
		
		$html = "";
		foreach($api['categories'] as $category_id => $category_data)
		{
			if ($category_id != $category_id_r)
				continue;
				
			foreach($category_data['methods'] as $method_id => $method_data)
			{
				if ($method_id != $method_id_r)
					continue;
				
				if ($method_data['type'] == "get")
				{
					$html .= '<div class="alert alert-success" style="font-size:18px"><strong>get</strong> '.$method_data['name'].' <a style="float:right"><span class="badge badge-inverse" style="position:relative; top:-3px">'.count($method_data['params']).' parameters</span></a></div>';
				} else 	if ($method_data['type'] == "post")
				{
					$html .= '<div class="alert alert-info" style="font-size:18px"><strong>post</strong> '.$method_data['name'].' <a style="float:right"><span class="badge badge-inverse" style="position:relative; top:-3px">'.count($method_data['params']).' parameters</span></a></div>';

				} else	if ($method_data['type'] == "delete")
				{
	              $html .= '<div class="alert alert-error" style="font-size:18px"><strong>delete</strong> '.$method_data['name'].' <a style="float:right"><span class="badge badge-inverse" style="position:relative; top:-3px">'.count($method_data['params']).' parameters</span></a></div>';

				} else	if ($method_data['type'] == "put")
				{
	              $html .= '<div class="alert" style="font-size:18px"><strong>put</strong> '.$method_data['name'].' <a style="float:right"><span class="badge badge-inverse" style="position:relative; top:-3px">'.count($method_data['params']).' parameters</span></a></div>';
				} 
              

			}
		}
		
		return $html;
	}
}
