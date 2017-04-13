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
    public function getStudent()
    {
        $query = $this->db->query('SELECT username as id, full_name as title FROM users where role="Student"');
        return $result = $query->result();
    }
    public function getExistgetStudent()
    {
        $query = $this->db->query('SELECT username as id, full_name as title FROM users where role="Student"');
        return $result = $query->result();
    }
    function __destruct() {
        $this->db->close();
    }
}