<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_section_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectSubSection()
    {
        $this->db->select("s.title, sb.sub_title");
        $this->db->from("c_section s, c_sub_section sb");
        $this->db->where('s.`id`=sb.`tid`');
        $this->db->order_by("s.title");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getSection()
    {
        $arr=array();
        $this->db->select('*');
        $this->db->from('c_section');
        $this->db->order_by('title');
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['title'];
        }
        return $arr;
    }
    public function checkSubSection($title)
    {
        $this->db->select("*");
        $this->db->from("c_sub_section");
        $this->db->where('sub_title', $title);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveSubSection($data)
    {
        $this->db->insert('c_sub_section', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}