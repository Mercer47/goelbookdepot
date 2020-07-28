<?php


class Account extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function orders($userId)
    {
        error_reporting(0);
        $books = [];
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY Timestamp desc";
        $query = $this->db->query($sql, $userId);
        $booksIds = $query->result();
        foreach($booksIds as $id) {
            $ids = json_decode($id->Items);
            foreach($ids as $key => $value) {
                $sql = 'SELECT * FROM books WHERE id = ?';
                $query = $this->db->query($sql, $value);
                $books[$value] = $query->first_row();
                $books[$value]->date = $id->Timestamp;
                $books[$value]->status = $id->Status;
                $books[$value]->shipping_status = $id->shipping_status;
            }
        }
        return $books;
    }

    public function details($userId)
    {
        $query = $this->db->get_where('users', array('id' => $userId));
        return $query->first_row();
    }

    public function userName($userId)
    {
        $this->db->select('name');
        $query = $this->db->get_where('users', array('id' => $userId));
        return $query->first_row();
    }
}