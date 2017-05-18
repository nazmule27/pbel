<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectTest()
    {
        $this->db->select("*");
        $this->db->from("c_online_test");
        $this->db->order_by("end_time desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function singleProblemView($pid)
    {
        $this->db->select("*");
        $this->db->from("c_test_problem");
        $this->db->where('id', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectProblem($tid)
    {
        $this->db->select("p.*, t.name, t.end_time");
        $this->db->from("c_test_problem p, c_online_test t, c_test_subscription ts");
        $this->db->where('p.`test_id`=t.`id`');
        $this->db->where('ts.`test_id`=t.`id`');
        $this->db->where('t.`id`',$tid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function checkTest($name)
    {
        $this->db->select("*");
        $this->db->from("c_online_test");
        $this->db->where('name', $name);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveTest($data)
    {
        $this->db->insert('c_online_test', $data);
    }

    public function getTestName()
    {
        $this->db->select('*');
        $this->db->from('c_online_test');
        $this->db->order_by('name');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getStudent($testid)
    {
        $query = $this->db->query('SELECT username AS id, full_name AS title FROM users WHERE role="Student" AND username NOT IN (SELECT u.username FROM users u, c_test_subscription s WHERE u.username=s.user_id AND u.role="Student" AND s.test_id='.$testid.')');
        return $result = $query->result();
    }
    public function getExistgetStudent($testid)
    {
        $query = $this->db->query('SELECT u.username AS id, u.full_name AS title FROM users u, c_test_subscription s WHERE u.username=s.user_id AND u.role="Student" AND s.test_id='.$testid.'');
        return $result = $query->result();
    }
    public function deleteUserSubscription($test_id)
    {
        $this->db->where("test_id", $test_id);
        $this->db->delete('c_test_subscription');
    }
    public function saveUserSubscription($subscription_data)
    {
        if($subscription_data) {
            $this->db->insert_batch('c_test_subscription', $subscription_data);
        }
    }
    function __destruct() {
        $this->db->close();
    }
}