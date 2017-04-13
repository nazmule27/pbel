<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_home_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectProblem()
    {
        $this->db->select("p.*, t.name");
        $this->db->from("c_test_problem p, c_online_test t");
        $this->db->where('p.`test_id`=t.`id`');
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
    public function singleProblemSolutionView($pid)
    {
        $this->db->select("*");
        $this->db->from("c_test_solution");
        $this->db->where('pid', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}