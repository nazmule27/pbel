<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pick_problem_model extends CI_Model
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
    public function singleProblemCoverages($pid)
    {
        $arr=array();
        $this->db->select('c.id, c.title');
        $this->db->from('c_problem_coverage pc, c_coverage c');
        $this->db->where('pc.pid', $pid);
        $this->db->where('`pc`.`cid`=`c`.`id`');
        /*$this->db->order_by('title');*/
        $this->db->order_by('id');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function singleProblemSolution($pid)
    {
        $this->db->select("*");
        $this->db->from("c_solution");
        $this->db->where('pid', $pid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}