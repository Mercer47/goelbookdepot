<?php


class Credentials extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function validate($username,$password){
		$sql='SELECT * FROM admin WHERE Username = ?';
		$query=$this->db->query($sql,$username);
		if ($query->num_rows()<1){
			return false;
		}
		else{
			$result=$query->result();
			foreach ($result as $row){
				$db_pass=$row->Password;
			}
			if (password_verify($password,$db_pass)){
				return $result;
			}
			else{
				return false;
			}
		}

	}
}
