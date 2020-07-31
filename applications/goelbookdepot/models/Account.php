<?php


class Account extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     *
     * Fetch all orders of a customer
     *
     * @param $userId
     * @return array
     */
    public function orders($userId)
    {
        error_reporting(0);
        $books = [];
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY Timestamp desc";
        $query = $this->db->query($sql, $userId);
//        $booksIds = $query->result();
//        foreach($booksIds as $id) {
//            $ids = json_decode($id->Items);
//            foreach($ids as $key => $value) {
//                $sql = 'SELECT * FROM books WHERE id = ?';
//                $query = $this->db->query($sql, $value);
//                $books[$value] = $query->first_row();
//                $books[$value]->date = $id->Timestamp;
//                $books[$value]->status = $id->Status;
//                $books[$value]->shipping_status = $id->shipping_status;
//            }
//        }
//        return $books;
        return $query->result();
    }

    /**
     *
     * Fetch Customer Information
     *
     * @param $userId
     * @return mixed
     */
    public function details($userId)
    {
        $query = $this->db->get_where('users', array('id' => $userId));
        return $query->first_row();
    }

    /**
     *
     * Fetch User Name to show in sidebar
     *
     * @param $userId
     * @return mixed
     */
    public function userName($userId)
    {
        $this->db->select('name');
        $query = $this->db->get_where('users', array('id' => $userId));
        return $query->first_row();
    }

    /**
     *
     * Updates details of a user
     *
     * @return mixed
     */
    public function update($user, $userId)
    {
        $this->db->where('id', $userId);
        return $this->db->update('users',$user);
    }

    public function updatePassword($user, $userId)
    {
        $this->db->where('id', $userId);
        return $this->db->update('users', $user);
    }

    public function confirmCurrentPassword($userId, $password)
    {
        $user = $this->db->get_where('users', array('id' => $userId))->first_row();
        return password_verify($password, $user->password);
    }
}