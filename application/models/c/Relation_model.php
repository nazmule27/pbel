<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relation_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function deleteChildRelation($pid)
    {
        $this->db->where("pid", $pid);
        $this->db->delete('c_child_problem');
    }
    public function deleteParentRelation($pid)
    {
        $this->db->where("pid", $pid);
        $this->db->delete('c_parent_problem');
    }
    public function getChild($level, $pid)
    {
        $query = $this->db->query('SELECT id, title FROM c_problem where level='.$level.' and id not in (SELECT child_id FROM c_child_problem WHERE pid='.$pid.')');
        return $result = $query->result();
    }
    public function getParent($level, $pid)
    {
        $query = $this->db->query('SELECT id, title FROM c_problem where level='.$level.' and id not in (SELECT parent_id FROM c_parent_problem WHERE pid='.$pid.')');
        return $result = $query->result();
    }

    public function getExistChild($pid)
    {
        $this->db->select("p.id, p.title");
        $this->db->from("c_child_problem c, c_problem p");
        $this->db->where("`p`.`id`=`c`.`child_id`");
        $this->db->where("c.pid", $pid);
        $this->db->order_by("p.id","asc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getExistParent($pid)
    {
        $this->db->select("p.id, p.title");
        $this->db->from("c_parent_problem c, c_problem p");
        $this->db->where("`p`.`id`=`c`.`parent_id`");
        $this->db->where("c.pid", $pid);
        $this->db->order_by("p.id","asc");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function saveChildRelation($child_data)
    {
        if($child_data) {
            $this->db->insert_batch('c_child_problem', $child_data);
        }
    }
    public function saveParentRelation($parent_data)
    {
        if($parent_data){
            $this->db->insert_batch('c_parent_problem', $parent_data);
        }
    }

    function __destruct() {
        $this->db->close();
    }
}