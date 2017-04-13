<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_submit_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getCoverage()
    {
        $arr=array();
        $this->db->select('*');
        $this->db->from('c_coverage');
        /*$this->db->order_by('title');*/
        $this->db->order_by('id');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function getProblemType()
    {
        $arr=array();
        $this->db->select('*');
        $this->db->from('c_problem_type');
        $this->db->order_by('type');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['type']]=$row['type'];
        }
        return $arr;
    }
    public function getProblemLevel()
    {
        $arr=array();
        $this->db->select('*');
        $this->db->from('c_problem_level');
        $this->db->order_by('level');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['level']]=$row['level'];
        }
        return $arr;
    }
    public function nextPid()
    {
        $this->db->select("id");
        $this->db->from("c_problem");
        $this->db->order_by("id","desc");
        $this->db->limit('1');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveProblem($data)
    {
        $this->db->insert('c_problem', $data);
    }
    public function saveSolution($data)
    {
        $this->db->insert('c_solution', $data);
    }
    public function saveCoverage($data)
    {
        $this->db->insert_batch('c_problem_coverage', $data);
    }
    public function checkCoverage($title)
    {
        $this->db->select("*");
        $this->db->from("c_coverage");
        $this->db->where('title', $title);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveCoverageContent($data)
    {
        $this->db->insert('c_coverage', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}