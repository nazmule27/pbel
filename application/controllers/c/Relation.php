<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relation extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Relation_model", "relation");
	}
	public function index()
	{
		$data['child'] = $this->relation->getChild($this->input->get('level')-1, $this->input->get('pid'));
		$data['existChild'] = $this->relation->getExistChild($this->input->get('pid'));

		$data['parent'] = $this->relation->getParent($this->input->get('level')+1, $this->input->get('pid'));
		$data['existParent'] = $this->relation->getExistParent($this->input->get('pid'));
		$this->load->view('c/relation/relation_submit_view', $data);
	}

	Public function save($pid){

		$child_data =array();
		for($i=0; $i <= 5; $i++) {
			$child_id=$this->input->post('child'.$i);
			if(isset($child_id)){
				$child_data[$i] = array(
					'pid' => $pid,
					'child_id' => $child_id,
				);
			}
		}

		$parent_data =array();
		for($i=0; $i <= 5; $i++) {
			$parent_id=$this->input->post('parent'.$i);
			if(isset($parent_id)){
				$parent_data[$i] = array(
					'pid' => $pid,
					'parent_id' => $parent_id,
				);
			}
		}

		$this->relation->deleteChildRelation($pid);
		$this->relation->deleteParentRelation($pid);

		$this->relation->saveChildRelation($child_data);
		$this->relation->saveParentRelation($parent_data);
		$this->load->view('c/success/relation_submit');
	}

}
