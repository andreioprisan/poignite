<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('filesm');
		$this->load->model('posm');

	}
	
	// view pos on the last step
	public function download($pouid, $ufid)
	{
		$poid = $this->posm->getpouid($pouid);
		$file = $this->filesm->getfile($ufid);

		$fullfilepath = getcwd()."/files/".$pouid."/".$ufid;

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers 
		header("Content-Description: File Transfer");
		header("Content-Type: ".$file->type);
		header("Content-Disposition: attachment; filename=\"".$file->filename."\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$file->size);
		
		readfile("$fullfilepath");
		exit();
	}

	public function delete($pouid, $ufid, $sig = NULL)
	{
		$poid = $this->posm->getpouid($pouid);
		$file = $this->filesm->getfile($ufid);

		if ($sig != md5($pouid.$ufid))
		{
			echo "unauthorized";
		}

		$fullfilepath = getcwd()."/files/".$pouid."/".$ufid;

		if (file_exists($fullfilepath))
		{
			unlink($fullfilepath);
		}

		$this->filesm->deletefile($ufid);

	}
}
