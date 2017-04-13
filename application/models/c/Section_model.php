<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectSection()
    {
        $this->db->select("*");
        $this->db->from("c_section");
        $this->db->order_by("id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function checkSection($title)
    {
        $this->db->select("*");
        $this->db->from("c_section");
        $this->db->where('title', $title);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveSection($data)
    {
        $this->db->insert('c_section', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}