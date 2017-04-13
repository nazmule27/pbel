<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectTest()
    {
        $this->db->select("*");
        $this->db->from("c_online_test");
        $this->db->where("end_time <NOW()");
        $this->db->order_by("end_time desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectTestAnswer($tid)
    {
        $this->db->select("a.*, p.title");
        $this->db->from("c_test_answer a, c_test_problem p");
        $this->db->where ("a.test_id", $tid);
        $this->db->where ("a.test_pid=`p`.id");
        $this->db->order_by("a.update_at desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectSingleTestAnswer($aid)
    {
        $this->db->select("a.id, a.test_id, a.answer_code, p.title, a.output, p.sample_output, a.mark");
        $this->db->from("c_test_answer a, c_test_problem p");
        $this->db->where ("a.id", $aid);
        $this->db->where ("a.test_pid=`p`.id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectSingleStandardAnswer($aid)
    {
        $this->db->select("p.title, a.answer_code, s.solution_code, a.output, p.sample_output, p.mark");
        $this->db->from("c_test_problem p, c_test_solution s, c_test_answer a");
        $this->db->where ("`p`.id=`s`.pid");
        $this->db->where ("`p`.id=`a`.test_pid");
        $this->db->where ("a.id", $aid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function updateMark($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('c_test_answer', $data);
    }
    public function ExportData($id)
    {
        $this->db->select("test_id, ROUND(AVG(mark),2) AS mark, submitted_by");
        $this->db->from("c_test_answer");
        $this->db->where("test_id", $id);
        $this->db->group_by("submitted_by");
        $this->db->order_by("submitted_by");
        $query = $this->db->get();
        return $result = $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}