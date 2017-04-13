<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_section extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Sub_section_model", "Sub_section_model");
	}
	public function index()
	{
		$data['all_sub_section'] = $this->Sub_section_model->selectSubSection();
		$this->load->view('c/tutorial/sub_section_index_view', $data);
	}
	public function create()
	{
		$data['section'] = $this->Sub_section_model->getSection();
		$this->load->view('c/tutorial/sub_section_create_view', $data);
	}
	Public function save(){
		$data = array(
			'tid' => $this->input->post('section'),
			'sub_title' => $this->input->post('sub_title'),
		);
		$status=$this->Sub_section_model->checkSubSection($this->input->post('sub_title'));
		if ($status==null||$status==''){
			$this->Sub_section_model->saveSubSection($data);
			$data['section'] = $this->Sub_section_model->getSection();
			$data['success_msg'] = '<div class="alert alert-success text-center">Sub section successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/sub_section_create_view', $data);
		}
		else {
			$data['section'] = $this->Sub_section_model->getSection();
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/sub_section_create_view', $data);
		}
	}

}
