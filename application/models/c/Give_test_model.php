<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Give_test_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectTest($user_id)
    {
        $this->db->select("t.*");
        $this->db->from("c_online_test t, c_test_subscription ts");
        $this->db->where('ts.`test_id`=t.`id`');
        $this->db->where('ts.`user_id`',$user_id);
        $this->db->where("end_time >NOW()");
        $this->db->order_by("end_time desc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function onlineTestDetail($tid, $user_id)
    {
        $this->db->select("t.*");
        $this->db->from("c_online_test t, c_test_subscription ts");
        $this->db->where('ts.`test_id`=t.`id`');
        $this->db->where('t.`id`',$tid);
        $this->db->where('ts.`user_id`',$user_id);
        $this->db->order_by('t.start_time desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function testProblems($tid)
    {
        $CI = &get_instance();
        $user_id = $CI->session->userdata('username');
        $this->db->select("tp.*, ta.answer_code");
        $this->db->from("c_test_problem tp");
        $this->db->join('c_test_answer ta', 'tp.test_id = ta.test_id and tp.id = ta.test_pid and ta.submitted_by="'.$user_id.'"', 'left');
        $this->db->where('tp.`test_id`',$tid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function selectProblem($tid, $user_id)
    {
        $this->db->select("p.*, t.name, t.end_time, ta.answer_code");
        $this->db->from("c_test_problem p, c_online_test t, c_test_subscription ts");
        $this->db->join('c_test_answer ta', 'p.test_id = ta.test_id and p.id = ta.test_pid and ta.submitted_by="'.$user_id.'"', 'left');
        $this->db->where('p.`test_id`=t.`id`');
        $this->db->where('ts.`test_id`=t.`id`');
        $this->db->where("t.end_time >NOW()");
        $this->db->where('t.`id`',$tid);
        $this->db->where('ts.`user_id`',$user_id);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function singleProblemView($tid, $pid)
    {
        $CI = &get_instance();
        $user_id = $CI->session->userdata('username');
        $this->db->select("tp.*, ta.answer_code");
        $this->db->from("c_test_problem tp");
        $this->db->join('c_test_answer ta', 'tp.test_id = ta.test_id and tp.id = ta.test_pid and ta.submitted_by="'.$user_id.'"', 'left');
        $this->db->where('tp.test_id', $tid);
        $this->db->where('tp.id', $pid);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function checkTestSolution($s_code, $tid)
    {
        $this->db->select("*");
        $this->db->from("test_solution");
        $this->db->where('solution_code', $s_code);
        $this->db->where('test_id', $tid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveTestSolution($data)
    {
        $this->db->insert('test_solution', $data);
    }

    public function checkTestAnswer($test_id, $pid, $username)
    {
        $this->db->select("*");
        $this->db->from("c_test_answer");
        $this->db->where('test_id', $test_id);
        $this->db->where('test_pid', $pid);
        $this->db->where('submitted_by', $username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveTestAnswer($data)
    {
        $this->db->insert('c_test_answer', $data);
    }
    public function checkTestAnswerCode($test_id, $pid, $code, $username)
    {
        $this->db->select("*");
        $this->db->from("c_test_answer");
        $this->db->where('test_id', $test_id);
        $this->db->where('test_pid', $pid);
        $this->db->where('answer_code', $code);
        $this->db->where('submitted_by', $username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function updateTestAnswer($test_id, $pid, $user, $data)
    {
        $this->db->where('test_id', $test_id);
        $this->db->where('test_pid', $pid);
        $this->db->where('submitted_by', $user);
        $this->db->update('c_test_answer', $data);
    }


    function __destruct() {
        $this->db->close();
    }
}