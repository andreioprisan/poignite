<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('SPARKPATH', getcwd()."/sparks/");
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/apiClient.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiCalendarService.php";
require_once SPARKPATH . "GoogleAPIClient/0.5.0/src/contrib/apiOauth2Service.php";

class Po extends CI_Controller {
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
		
		$this->googleapps->init();
		$this->userdata = $this->session->userdata('userdata');
		$this->author_email = strtolower($this->userdata['email']);
		$this->uid = $this->session->userdata('uid');
		
//		$_SESSION['currentpo']['step1']['author_email'] = $this->userdata['email'];

		$this->menu = array(	
									array('name' => "New", 'val' => "/po/newpo", 'align' => 'right'),
									array('name' => "View All", 'val' => "/po/history", 'align' => 'right'),
									array('name' => "Review", 'val' => "/po/review", 'align' => 'right'),
									array('name' => "Reports", 'val' => "/po/reports", 'align' => 'right'),
									array('name' => $this->userdata['name'], 'val' => array(	
										array('name' => "Log out", 'val' => "/home/logout"),
									), 'align' => 'right'),
								);

		$this->css = array(	"prettify", 
									"bootstrap.min",
									"bootstrap-responsive.min",
									"font-awesome",
									"apignite",
									"jquery-ui/jquery-ui-1.8.16.custom",
									"jquery-ui/jquery.ui.1.8.16.ie",
									"../js/dateranger/css/ui.daterangepicker",
									);
		$this->js = array(	"jquery-1.7.min", 
								"jquery-ui-1.8.16.custom.min",
								"jquery.tablesorter", 
								"bootstrap.min",
								"application",
								"prettify",
								"dateranger/js/date",
								"dateranger/js/daterangepicker.jQuery",
								);
		
	}
	
	public function contactsSelector($id)
	{
		if (!isset($this->contacts) || count($this->contacts) == 0)
		{
			$this->googleapps->init();
			$this->contacts = $this->googleapps->getContacts();
			ksort($this->contacts);
		}
		
		$a = "<select  class='input-xlarge' id='".$id."' name='".$id."'>";
		$a .= "<option value=''></option>";
		foreach($this->contacts as $contact => $cdata)
		{
			if (!isset($cdata['email']))
				continue;
			
			$selected = "";
			if (isset($_SESSION['currentpo']['step'.$this->step][$id]))
				if ($_SESSION['currentpo']['step'.$this->step][$id] == $cdata['email'])
					$selected = "selected";
			
			if ($this->step == "4")
				if ($_SESSION['currentpo']['step'.$this->step][strtolower($id)] == strtolower($cdata['email']))
					$selected = "selected";
			
			$a .= "<option value='".$cdata['email']."' ".$selected.">".$contact." (".$cdata['email'].")</option>";
		}
		$a .= "<select>";
		
		return $a;
	}

	public function history()
	{
		$pos_list = $this->posm->getpos($this->uid);

		$payload['pos_list'] = $pos_list;
		
		// template info
		$payload['menu'] = $this->menu;
		$payload['css'] = $this->css;
		$payload['js'] = $this->js;
		$payload['instance'] =& get_instance(); 

		$this->template->write_view('start', 'layouts/viewall', $payload);

		return $this->template->render();
	}
	
	public function newpo()
	{
		//$_SESSION['currentpo'] = NULL;
		if (!isset($this->contacts) || count($this->contacts) == 0)
		{
			$this->contacts = $this->googleapps->getContacts();
			ksort($this->contacts);
		}
		
		$step = "1";
		if (isset($_GET['step']))
			$step = $_GET['step'];

		if (isset($_POST['step']))
			$step = $_POST['step'];
		
		$this->step = $step;
		
		if (isset($_POST) && count($_POST) > 0)
		{
			if (isset($_SESSION))
			{
				$_SESSION['currentpo']['step'.$step] = $_POST;
			}
		}
		
		if (isset($_POST['nextstep']))
			$step = $_POST['nextstep'];
		
		$payload['userdetails'] = $this->contacts[$this->userdata['name']];
		$payload['userdata'] = $this->userdata;
		
		if (!isset($this->userdata['name']))
			die("unable to read user data");
		
		$this->load->library('template');

		// template info
		$payload['menu'] = $this->menu;
		$payload['css'] = $this->css;
		$payload['js'] = $this->js;
		
		$payload['finalreadonly'] = false;
		
		if ($step == "1")
		{
			// step 1
			// date for pulldowns
			$payload['submitTo1'] = $this->contactsSelector("submitTo1");
			$payload['submitCc1'] = $this->contactsSelector("submitCc1");
			$payload['submitCc2'] = $this->contactsSelector("submitCc2");
			$payload['submitCc3'] = $this->contactsSelector("submitCc3");
			$payload['submitCc4'] = $this->contactsSelector("submitCc4");
			$payload['submitCc5'] = $this->contactsSelector("submitCc5");

		
		} else if ($step == "4") {
			$payload['sendToReviewer'] = $this->contactsSelector("sendToReviewer");
		
		} else if ($step == "5") {
			$payload['finalreadonly'] = true;
			$this->template->write_view('start', 'layouts/newpo_step5', $payload);
			$this->template->write_view('start', 'layouts/newpo_step1', $payload);
			$this->template->write_view('start', 'layouts/newpo_step2', $payload);
			$this->template->write_view('start', 'layouts/newpo_step3', $payload);
			$this->template->write_view('start', 'layouts/newpo_step4', $payload);
			$this->template->write_view('start', 'layouts/newpo_step5_2', $payload);
			
		}
		
		if ($step != "5")
		{
			$this->template->write_view('start', 'layouts/newpo_step'.$step, $payload);
		}
		
		//$a = $this->template->render();
		
		if (isset($_POST['sendemail']))
		{
			$a = $this->template->render(NULL, FALSE, TRUE);
		
			$to      = 'andrei.oprisan@mac.com';
			$subject = '[poignite] - purchase order request #'.substr($_SESSION['currentpo']['step4']['pouniqueid'], 0, 6).' by '.$_SESSION['currentpo']['step1']['author_email'];
			
			$message = $a;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: pos@poignite.com' . "\r\n" .
			    'Reply-To: '.$_SESSION['currentpo']['step1']['author_email'] . "\r\n" .
			    'X-Mailer: POIgnite 1.0';

			mail($to, $subject, $message, $headers);
		} else {
			return $this->template->render();
		}
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
	
	public function insertPO()
	{
		$this->pouid = $_SESSION['currentpo']['step4']['pouniqueid'];
		
		$payload['submitTo1'] = $this->contactsSelector("submitTo1");
		$payload['submitCc1'] = $this->contactsSelector("submitCc1");
		$payload['submitCc2'] = $this->contactsSelector("submitCc2");
		$payload['submitCc3'] = $this->contactsSelector("submitCc3");
		$payload['submitCc4'] = $this->contactsSelector("submitCc4");
		$payload['submitCc5'] = $this->contactsSelector("submitCc5");
		
		$approvers_email = array(	$_SESSION['currentpo']['step1']['submitTo1']);
		
		if ($_SESSION['currentpo']['step1']['submitCc1'] != "")
			array_push($approvers_email, $_SESSION['currentpo']['step1']['submitCc1']);
		if ($_SESSION['currentpo']['step1']['submitCc2'] != "")
			array_push($approvers_email, $_SESSION['currentpo']['step1']['submitCc2']);
		if ($_SESSION['currentpo']['step1']['submitCc3'] != "")
			array_push($approvers_email, $_SESSION['currentpo']['step1']['submitCc3']);
		if ($_SESSION['currentpo']['step1']['submitCc4'] != "")
			array_push($approvers_email, $_SESSION['currentpo']['step1']['submitCc4']);
		if ($_SESSION['currentpo']['step1']['submitCc5'] != "")
			array_push($approvers_email, $_SESSION['currentpo']['step1']['submitCc5']);
		
		
		$po = array('pouid'				=>	$this->pouid,
					'content'			=>	json_encode($_SESSION['currentpo']),
					'uid'				=>	$this->uid,
					'approvers_email'	=>	json_encode($approvers_email),
					'next_email'		=>	strtolower($_SESSION['currentpo']['step4']['sendtoreviewer'])
					);
		
		$this->poid = $this->posm->insert($po);
	}
	
	public function uploadFiles()
	{
		// upload path
		$fileupload_path = getcwd()."/files/".$this->pouid;
		// make po files upload dir
		if (!is_dir($fileupload_path))
		{
			mkdir($fileupload_path);
		}
		
		$files_db = array();
		foreach ($_FILES['attachments']['name'] as $file_iterator => $filename)
		{
			$ufid = md5($filename.$_FILES['attachments']['size'].$_FILES['attachments']['type']);
			$files_db[] = array(
				'ufid'		=>		$ufid,
				'filename'	=>		$filename,
				'size'		=>		$_FILES['attachments']['size'][$file_iterator],
				'type'		=>		$_FILES['attachments']['type'][$file_iterator],
				'poid'		=>		$this->poid,
			);
			
			move_uploaded_file($_FILES['attachments']["tmp_name"][$file_iterator], $fileupload_path."/".$ufid);
		}

		foreach($files_db as $file_db)
		{
			$this->filesm->insert($file_db);
		}
	}

	// edit pos
	public function loadpo($pouid)
	{
		$currentpo = $this->posm->getpouid($pouid);
		$this_po = get_object_vars(json_decode($currentpo->content));

		foreach ($this_po as $i => $j)
		{
			$this_po[$i] = get_object_vars($j);
		}
		
		$_SESSION['currentpo'] = $this_po;
		
		$this->newpo();
	}

	// view pos on the last step
	public function viewpo($pouid)
	{
		$currentpo = $this->posm->getpouid($pouid);
		$this_po = get_object_vars(json_decode($currentpo->content));

		foreach ($this_po as $i => $j)
		{
			$this_po[$i] = get_object_vars($j);
		}
		
		$_SESSION['currentpo'] = $this_po;
		
		$_POST['step'] = "5";
		$_POST['cantsubmit'] = "1";
		$this->newpo();
	}
	
	public function sendemailpo($pouid)
	{
		$_POST['sendemail'] = "1";
		$this->viewpo($pouid);
	}

	public function savepo()
	{
		$this->insertAuthorData();
		$this->insertPO();
		$this->uploadFiles();
		
		header("Location: http://www.poignite.com/po/history");
	}
}
