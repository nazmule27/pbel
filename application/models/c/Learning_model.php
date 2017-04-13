<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learning_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectProblem()
    {
        $query = $this->db->get('c_problem');
        return $result = $query->result();
    }
    public function singleProblemView($pid)
    {
        $this->db->select("*");
        $this->db->from("c_problem");
        $this->db->where('id', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectLevelProblem($level)
    {
        $this->db->select("*");
        $this->db->from("c_problem");
        $this->db->where('level', $level);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getParent($level)
    {
        $query = $this->db->query('SELECT id, title FROM c_problem WHERE id IN (SELECT DISTINCT parent_id FROM `c_parent_problem`) AND LEVEL ='.$level);
        return $result= $query->result();
    }
    public function getHint($pid)
    {
        $this->db->select("hint");
        $this->db->from("c_problem");
        $this->db->where('id', $pid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->row()->hint;
    }
    public function getCompleteCode($pid)
    {
        $this->db->select("solution_code");
        $this->db->from("c_solution");
        $this->db->where('pid', $pid);
        $this->db->order_by('id');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->row()->solution_code;
    }

    function __destruct() {
        $this->db->close();
    }
}