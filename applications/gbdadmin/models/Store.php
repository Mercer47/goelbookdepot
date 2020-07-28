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

	function fetchorders()
	{
		$query=$this->db->query('SELECT * FROM orders ORDER BY Timestamp DESC');
		$result=$query->result();
		return $result;
	}

	function fetchinvoicedata($id)
	{
		$sql='SELECT * FROM orders WHERE OrderId=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	function getbooks()
	{
		$sql=$this->db->query('SELECT * FROM books ORDER BY Timestamp DESC');
		$result=$sql->result();
		return $result;
	}

		function getcategories()
	{
		$query=$this->db->query('SELECT * FROM bookcat');
		$result=$query->result();
		return $result;
	}

	function insertbook($data)
	{
		$this->db->insert('books',$data);
	}

	function getbookdetails($id)
	{
		$sql='SELECT * FROM books WHERE id=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	function updatebook($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('books',$data);
	}

	function deletebook($id)
	{
		$sql='DELETE FROM books WHERE id=?';
		$query=$this->db->query($sql,$id);
	}

	function loadClasses($id){
	    $sql='SELECT * FROM booksubsub WHERE subno = ?';
	    $query = $this->db->query($sql,$id);
	    $result=$query->result();
	    return $result;
    }

    function loadSubjects($id){
        $sql='SELECT * FROM subject WHERE subno = ?';
        $query = $this->db->query($sql,$id);
        $result=$query->result();
        return $result;
    }

    function addNewCategory($data){
	    $this->db->insert('bookcat',$data);
    }

    function addnewClass($data){
	    $this->db->insert('booksubsub',$data);
    }

    function addnewSubject($data){
        $this->db->insert('subject',$data);
    }

    function deleteSubject($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('subject');
    }

    function deleteClass($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('booksubsub');

        $this->db->where('subno',$id);
        $this->db->delete('subject');
    }

    function deleteCategory($id){
        $sql='SELECT * FROM booksubsub WHERE subno = ?';
        $query=$this->db->query($sql,$id);
        $result=$query->result();

        foreach($result as $row){
           $this->deleteClass($row->id);
        }

        $this -> db -> where('id', $id);
        $this -> db -> delete('bookcat');
    }

    public function changeShippingStatus($status, $orderId)
    {
        $this->db->set('shipping_status', $status);
        $this->db->where('OrderId', $orderId);
        $this->db->update('orders');
    }

    public function createBundle($bundle)
    {
        $this->db->insert('bundles', $bundle);
    }

    public function getBundles()
    {
        $query = $this->db->get('bundles');
        return $query->result();
    }

    public function getBundle($id)
    {
        $query = $this->db->get_where('bundles',array('id' => $id));
        return $query->first_row();
    }

    public function getBookCost($id)
    {
        $this->db->select('MRP');
        $query = $this->db->get_where('books',array('id' => $id));
        $book = $query->first_row();
        return $book->MRP;
    }

    public function deleteBundle($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bundles');
    }

}

?>