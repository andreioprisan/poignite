<?php

class Posm extends CI_Model 
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function getpos($uid)
	{
		$query = $this->db->get_where('pos', array('uid' => $uid));
		return $query->result();
	}
	
	function getpoid($pouid)
	{
		$query = $this->db->get_where('pos', array('pouid' => $pouid));
		return $query->row()->poid;
	}
	
	function getpouid($pouid)
	{
		$query = $this->db->get_where('pos', array('pouid' => $pouid));
		return $query->row();
	}
	
	
	function getfile($pouid)
	{
		$query = $this->db->get_where('pos', array('pouid' => $pouid));
		return $query->row();
	}
	
	function update($pouid, $data)
	{
		$this->db->where('pouid', $pouid);
		$this->db->update('pos', $data); 
		return $this->db->insert_id();
	}

	function insert($data)
	{
		$existingrec = 0;
		if (isset($data['pouid']))
		{
			$query = $this->db->get_where('pos', array('pouid' => $data['pouid']) );
			$existingrec = count($query->result());
		}
		
		if ($existingrec == 0) {
			$this->db->insert('pos', $data);
			return $this->db->insert_id();
		} else {
			$this->db->where('pouid', $data['pouid']);
			$this->db->update('pos', $data); 
			return $this->getpoid($data['pouid']);
		}
		
	}
}
