<?php


class StatsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Retrieves the dates for Graph acc to given Start Date and End Date
     *
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function getOrderStats($startDate, $endDate)
    {
        $output = array();
        $dates = [];
        $diff = date_diff(date_create($startDate), date_create($endDate));
        for($i=0; $i<= $diff->days; $i++)
        {
            $dates[] = date("Y-m-d",strtotime($startDate));
            $startDate = date("Y-m-d",strtotime("+1 day",strtotime($startDate)));
        }
        foreach ($dates as $date) {
            $output[$date] = $this->getOrderDateRange($date." 00:00:00",$date." 23:59:59");
        }
        return $output;
    }

    /**
     *
     * Retrieves no. of orders for a given duration
     *
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getOrderDateRange($start, $end)
    {
        $sql = 'SELECT * FROM orders WHERE Timestamp > ? AND Timestamp < ?';
        $query = $this->db->query($sql, array($start, $end));
        return $query->num_rows();
    }

    /**
     *
     * Retrieves Dates for Customer acquisition graph
     *
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function getCustomerData($startDate, $endDate)
    {
        $output = array();
        $dates = [];
        $diff = date_diff(date_create($startDate), date_create($endDate));
        for($i=0; $i<= $diff->days; $i++)
        {
            $dates[] = date("Y-m-d",strtotime($startDate));
            $startDate = date("Y-m-d",strtotime("+1 day",strtotime($startDate)));
        }
        foreach ($dates as $date) {
            $output[$date] = $this->getCustomerDateRange($date." 00:00:00",$date." 23:59:59");
        }
        return $output;
    }

    /**
     *
     * Retrieves no. of customers acquired in a duration
     *
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getCustomerDateRange($start, $end)
    {
        $sql = 'SELECT * FROM users WHERE created_at > ? AND created_at < ?';
        $query = $this->db->query($sql, array($start, $end));
        return $query->num_rows();
    }

    /**
     *
     * Prepares Data for Sales Graph
     *
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public function getSalesData($startDate, $endDate)
    {
        $output = array();
        $dates = [];
        $diff = date_diff(date_create($startDate), date_create($endDate));
        for($i=0; $i<= $diff->days; $i++)
        {
            $dates[] = date("Y-m-d",strtotime($startDate));
            $startDate = date("Y-m-d",strtotime("+1 day",strtotime($startDate)));
        }
        foreach ($dates as $date) {
            $output[$date] = $this->getSalesDateRange($date." 00:00:00",$date." 23:59:59");
        }
        return $output;
    }

    /**
     *
     * Retrieves Sales made by particular day for a given duration
     *
     * @param $start
     * @param $end
     * @return int
     */
    public function getSalesDateRange($start, $end)
    {
        $sql = 'SELECT SUM(Total) FROM orders WHERE Timestamp > ? AND Timestamp < ?';
        $query = $this->db->query($sql, array($start, $end));
        $total = 0;
        foreach ($query->result_array() as $row) {
            $total = $row['SUM(Total)'];
        }
        return $total ? $total : 0;
    }
}