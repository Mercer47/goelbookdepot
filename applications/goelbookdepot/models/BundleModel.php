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
}