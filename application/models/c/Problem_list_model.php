<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_list_model extends CI_Model
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
    public function singleProblemView($pid)
    {
        $this->db->select("*");
        $this->db->from("c_problem");
        $this->db->where('id', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function singleProblemSolutionView($pid)
    {
        $this->db->select("*");
        $this->db->from("c_solution");
        $this->db->where('pid', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function singleProblemContentCoverage($pid)
    {
        $this->db->select("p.id, c.title");
        $this->db->from("c_problem p, c_problem_coverage pc, c_coverage c");
        $this->db->where('p.id', $pid);
        $this->db->where('p.id=pc.pid');
        $this->db->where('pc.cid=c.id');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getChildList($pid)
    {
        $this->db->select("p.id, p.title");
        $this->db->from("c_child_problem c, c_problem p");
        $this->db->where('c.pid', $pid);
        $this->db->where('c.child_id=p.id');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getParentList($pid)
    {
        $this->db->select("p.id, p.title");
        $this->db->from("c_parent_problem c, c_problem p");
        $this->db->where('c.pid', $pid);
        $this->db->where('c.parent_id=p.id');
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function problemUpdate($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('c_problem', $data);
        return true;
    }
    public function singleSolutionView($sid)
    {
        $this->db->select("*");
        $this->db->from("c_solution");
        $this->db->where('id', $sid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function solutionUpdate($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('c_solution', $data);
        return true;
    }
    function __destruct() {
        $this->db->close();
    }
}