<?php


class BundleModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns all the bundles
     *
     * @return mixed
     */
    public function getBundles()
    {
        return $this->db->get('bundles')->result();
    }

    /**
     * Returns a single Bundle
     *
     * @param $id
     * @return mixed
     */
    public function getBundle($id)
    {
        return $this->db->get_where('bundles', array('id' => $id))->first_row();
    }

    /**
     * gives the bundle cost
     * @param $id
     * @return mixed
     */
    public function getBundleCost($id)
    {
        $this->db->select('price');
        return $this->db->get_where('bundles',array('id' => $id))->first_row()->price;
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