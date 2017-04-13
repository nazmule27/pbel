<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_set_model extends CI_Model
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
        $this->db->order_by('name');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['name'];
        }
        return $arr;
    }
    public function nextTestPid()
    {
        $this->db->select("id");
        $this->db->from("c_test_problem");
        $this->db->order_by("id","desc");
        $this->db->limit('1');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveProblem($data)
    {
        $this->db->insert('c_test_problem', $data);
    }
    public function saveSolution($data)
    {
        $this->db->insert('c_test_solution', $data);
    }

    public function saveCoverage($data)
    {
        $this->db->insert_batch('c_test_problem_coverage', $data);
    }
    public function getSL($test_id)
    {
        $this->db->select("IFNULL(COALESCE(MAX(test_problem_sl), test_problem_sl),0) AS test_problem_sl");
        $this->db->from("c_test_problem");
        $this->db->where('test_id', $test_id);
        $query = $this->db->get();
        return $result = $query->row()->test_problem_sl;
    }

    function __destruct() {
        $this->db->close();
    }
}