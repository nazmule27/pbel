<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_subscribe_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getTestName()
    {
        $arr=array();
        $this->db->select('*');
        $this->db->from('c_online_test');
        $this->db->where("subscription_end_time >NOW()");
        $this->db->order_by('name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['name'];
        }
        return $arr;
    }
    public function checkSubscription($test_td, $username)
    {
        $this->db->select("*");
        $this->db->from("c_test_subscription");
        $this->db->where('test_id', $test_td);
        $this->db->where('user_id', $username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveTestSubscription($data)
    {
        $this->db->insert('c_test_subscription', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}