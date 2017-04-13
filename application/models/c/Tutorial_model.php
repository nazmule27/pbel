<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tutorial_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getContent1()
    {
        $this->db->select("t.id, sb.id as parent_id, sb.sub_title,  t.description as title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`id`>=22');
        $this->db->where('`t`.`id`<=55');
        $this->db->order_by("t.id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getContent2()
    {
        $this->db->select("t.id, sb.id as parent_id, sb.sub_title,  t.description as title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`id`>=56');
        $this->db->where('`t`.`id`<=70');
        $this->db->order_by("t.id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getContent5()
    {
        $this->db->select("t.id, sb.id as parent_id, sb.sub_title,  t.description as title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`id`>=1');
        $this->db->where('`t`.`id`<=21');
        $this->db->order_by("t.id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getFirstContent($id)
    {
        $this->db->select("t.id, sb.id as parent_id, sb.sub_title,  t.description as title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`id`', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function getContentById($id)
    {
        $this->db->select("CONCAT('<big>',sb.sub_title,'</big><br>' ,`t`.`description`) AS title");
        $this->db->from("c_tutorial t, c_sub_section sb");
        $this->db->where('`t`.`sub_section`=`sb`.`id`');
        $this->db->where('`t`.`id`', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->row()->title;
    }
    public function getQuestion($chapter)
    {
        $this->db->select("*");
        $this->db->from("c_mcq_practice");
        $this->db->where('chapter', $chapter);
        $this->db->order_by("id");
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function cleanMcqAnswer($username, $chapter)
    {
        $this->db->where('user', $username);
        $this->db->where('chapter', $chapter);
        $this->db->delete('c_mcq_answer');
    }
    public function questionLastId()
    {
        $this->db->select("id");
        $this->db->from("c_mcq_practice");
        $this->db->order_by("id desc");
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();

    }
    public function saveMcqAnswer($data)
    {
        $this->db->insert_batch('c_mcq_answer', $data);
        //SELECT q.id, q.`question`, q.`option`, q.`answer`, a.`answer` AS s_answer, CASE WHEN q.`answer`=a.`answer` THEN 'Correct' ELSE 'False' END AS result FROM `c_mcq_practice` q, `c_mcq_answer` a WHERE q.id=a.`q_id` AND `user`='Admin' AND a.chapter='1';
    }
    public function questionCount($chapter)
    {
        $this->db->select("COUNT(*) AS question_count");
        $this->db->from("c_mcq_practice");
        $this->db->where('chapter', $chapter);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function answerCount($username, $chapter)
    {
        $this->db->select("COUNT(answer) AS answered");
        $this->db->from("c_mcq_answer");
        $this->db->where('chapter',$chapter);
        $this->db->where('user',$username);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function correctCount($username, $chapter)
    {
        $query = $this->db->query("SELECT COUNT(ac.result) AS correct FROM
(SELECT q.id, CASE WHEN q.`answer`=a.`answer` THEN 'Correct' ELSE 'False' END AS result FROM `c_mcq_practice` q, `c_mcq_answer` a WHERE q.id=a.`q_id` AND `user`="."'".$username."'"." AND a.chapter="."'".$chapter."'".") ac
 WHERE ac.result='Correct'");
        return $result= $query->result();
    }

    function __destruct() {
        $this->db->close();
    }
}