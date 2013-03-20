<?php

class Usersm extends CI_Model 
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function getuid($googleid)
	{
		$query = $this->db->get_where('users', array('googleid' => $googleid));
		return $query->row()->uid;
	}
	
	function getid($ufid)
	{
		$query = $this->db->get_where('users', array('ufid' => $ufid));
		return $query->row();
	}

	function getbyid($uid)
	{
		$query = $this->db->get_where('users', array('uid' => $uid));
		return $query->row();
	}
	
	function update($uid, $data)
	{
		$this->db->where('uid', $uid);
		$this->db->update('users', $data); 
		return $this->db->insert_id();
	}

	function insert($data)
	{
		$existingrec = 0;
		if (isset($data['googleid']))
		{
			$query = $this->db->get_where('users', array('googleid' => $data['googleid']) );
			$existingrec = count($query->result());
		}
	
		if ($existingrec == 0) {
			$this->db->insert('users', $data);
			return $this->db->insert_id();
		} else {
			$this->db->where('googleid', $data['googleid']);
			$this->db->update('users', $data); 
			return $this->getuid($data['googleid']);
		}
	}
}
