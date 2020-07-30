<?php

/**
 * 
 */
class Store extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function fetchorders()
	{
		$query=$this->db->query('SELECT * FROM orders ORDER BY Timestamp DESC');
		$result=$query->result();
		return $result;
	}

	public function fetchinvoicedata($id)
	{
		$sql='SELECT * FROM orders WHERE OrderId=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	public function getbooks()
	{
		$sql=$this->db->query('SELECT * FROM books ORDER BY Timestamp DESC');
		$result=$sql->result();
		return $result;
	}

	public function getcategories()
	{
		$query=$this->db->query('SELECT * FROM bookcat');
		$result=$query->result();
		return $result;
	}

	public function insertbook($data)
	{
		$this->db->insert('books',$data);
	}

	public function getbookdetails($id)
	{
		$sql='SELECT * FROM books WHERE id=?';
		$query=$this->db->query($sql,$id);
		$result=$query->result();
		return $result;
	}

	public function updatebook($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('books',$data);
	}

	public function deletebook($id)
	{
		$sql='DELETE FROM books WHERE id=?';
		$query=$this->db->query($sql,$id);
	}

	public function loadClasses($id){
	    $sql='SELECT * FROM booksubsub WHERE subno = ?';
	    $query = $this->db->query($sql,$id);
	    $result=$query->result();
	    return $result;
    }

    public function loadSubjects($id){
        $sql='SELECT * FROM subject WHERE subno = ?';
        $query = $this->db->query($sql,$id);
        $result=$query->result();
        return $result;
    }

    public function addNewCategory($data){
	    $this->db->insert('bookcat',$data);
    }

    public function addnewClass($data){
	    $this->db->insert('booksubsub',$data);
    }

    public function addnewSubject($data){
        $this->db->insert('subject',$data);
    }

    public function deleteSubject($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('subject');
    }

    public function deleteClass($id){
        $this -> db -> where('id', $id);
        $this -> db -> delete('booksubsub');

        $this->db->where('subno',$id);
        $this->db->delete('subject');
    }

    public function deleteCategory($id){
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
        $this->addBundleToBooks($bundle);
    }

    public function addBundleToBooks($bundle)
    {
        $bundleAsBook = array(
            'title' => $bundle['name'],
            'MRP' => $bundle['price'],
            'Discount' => $bundle['discount'],
            'image' => $bundle['image'],
        );

        $this->insertbook($bundleAsBook);
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
        $bundleAsBook = $this->getReferredData($id);
        $this->deletebook($bundleAsBook->id);
        $this->db->where('id', $id);
        $this->db->delete('bundles');
    }

    /**
     *
     * Gets the respective row from the books table
     *
     * @param $id
     * @return mixed
     */
    public  function getReferredData($id)
    {
        $sql = 'SELECT books.id,books.availability FROM books,bundles WHERE books.title = bundles.name AND bundles.id = ?';
        $query = $this->db->query($sql,$id);
        return $query->first_row();
    }

}

?>