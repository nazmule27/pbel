<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chapter_content_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getTopics()
    {
        $this->db->select("*");
        $this->db->from("c_topics");
        $this->db->order_by("id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getProblems($chapter)
    {
        $this->db->select("*");
        $this->db->from("c_problem");
        $this->db->where('chapter_id', $chapter);
        $query = $this->db->get();
        return $result = $query->result();
    }
    function __destruct() {
        $this->db->close();
    }
}