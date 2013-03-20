<?php

class Filesm extends CI_Model 
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getpofiles($poid)
	{
		$query = $this->db->get_where('files', array('poid' => $poid));
		return $query->result();
	}
	
	function getfile($ufid)
	{
		$query = $this->db->get_where('files', array('ufid' => $ufid));
		return $query->row();
	}
	
	function deletefile($ufid)
	{
		$this->db->where('ufid', $ufid);
		$this->db->delete('files'); 
	}

	function update($ufid, $data)
	{
		$this->db->where('ufid', $ufid);
		$this->db->update('files', $data); 
		return $this->db->insert_id();
	}

	function insert($data)
	{
		$existingrec = 0;
		if (isset($data['ufid']))
		{
			$query = $this->db->get_where('files', array('ufid' => $data['ufid']) );
			$existingrec = count($query->result());
		}
		
		if ($existingrec == 0) {
			$this->db->insert('files', $data);
			
		} else {
			$this->db->where('ufid', $data['ufid']);
			$this->db->update('files', $data); 
			
		}
		
		return $this->db->insert_id();
	}
}
