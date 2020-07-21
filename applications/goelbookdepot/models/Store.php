<?php

/**
 * 
 */
class Store extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function getcategories()
	{
		$query=$this->db->query('SELECT * FROM bookcat');
		$result=$query->result();
		return $result;
	}

	function loadsubcategories($id)
	{
		$sql='SELECT * FROM booksubsub WHERE subno=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	function loadtopic($id)
	{
		$sql="SELECT * FROM subject WHERE subno=?";
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	function loadbooks($id,$subno)
	{
		$sql="SELECT * FROM books WHERE subno=? AND catno=? AND availability=TRUE";
		$query=$this->db->query($sql,array($id,$subno));
		$result=$query->result();
		return $result;

	}

	function loadbook($id)
	{
		$sql='SELECT * FROM books WHERE id=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;

	}

	function addOrder($data){
	    $this->db->insert('orders',$data);
    }
}

?>