<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Section_model", "Section_model");
	}
	public function index()
	{
		$data['all_section'] = $this->Section_model->selectSection();
		$this->load->view('c/tutorial/section_index_view', $data);
	}
	public function create()
	{
		$this->load->view('c/tutorial/section_create_view');

	}
	Public function save(){
		$data = array(
			'title' => $this->input->post('title'),
		);
		$status=$this->Section_model->checkSection($this->input->post('title'));
		if ($status==null||$status==''){
			$this->Section_model->saveSection($data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Section successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/section_create_view', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/section_create_view', $data);
		}
	}

}
