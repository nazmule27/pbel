<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function selectContent()
    {
        $this->db->select("t.id, t.description, sb.sub_title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->order_by("sb.sub_title");
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
    public function getSubSection($section)
    {
        $this->db->select('id,sub_title');
        $this->db->from('c_sub_section');
        $this->db->where('tid',$section);
        $query = $this->db->get();
        return $query->result();
    }
    public function checkContent($description)
    {
        $this->db->select("*");
        $this->db->from("c_tutorial");
        $this->db->where('description', $description);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveContent($data)
    {
        $this->db->insert('c_tutorial', $data);
    }
    public function selectContentById($id)
    {
        $this->db->select("t.id, t.description, sb.id as sub_id, sb.sub_title, s.id as section_id");
        $this->db->from("c_tutorial t, c_sub_section sb, c_section s");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`section`=`s`.`id`');
        $this->db->where('`t`.`id`', $id);
        $this->db->order_by("sb.sub_title");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function updateContent($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('c_tutorial', $data);
    }
    public function getAllSubSection()
    {
        $arr=array();
        $this->db->select('id,sub_title');
        $this->db->from('c_sub_section');
        $this->db->order_by("sub_title");
        $query = $this->db->get();
        foreach($query->result_array() as $row){
            $arr[$row['id']]=$row['sub_title'];
        }
        return $arr;
    }
    public function checkQuestion($question)
    {
        $this->db->select("*");
        $this->db->from("c_mcq_practice");
        $this->db->where('question', $question);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveMcq($data)
    {
        $this->db->insert('c_mcq_practice', $data);
    }

    function __destruct() {
        $this->db->close();
    }
}