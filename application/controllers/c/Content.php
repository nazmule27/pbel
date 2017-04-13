<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Content_model", "Content_model");
	}
	public function index()
	{
		$data['all_content'] = $this->Content_model->selectContent();
		$this->load->view('c/tutorial/content_index_view', $data);
	}
	public function create()
	{
		$data['section'] = $this->Content_model->getSection();
		$this->load->view('c/tutorial/content_create_view', $data);
	}
	public function get_sub_content()
	{
		$section=$this->input->post('id');
		$districtData['districtDrop']=$this->Content_model->getSubSection($section);
		$output = '<option value="">Select Sub Section</option>';
		foreach ($districtData['districtDrop'] as $row)
		{
		 $output .= "<option value='".$row->id."'>".$row->sub_title."</option>";
		}
		echo $output;
    }
	Public function save(){
		$data = array(
			'section' => $this->input->post('section'),
			'sub_section' => $this->input->post('sub_section'),
			'description' => $this->input->post('description'),
		);
		$status=$this->Content_model->checkContent($this->input->post('description'));

		if ($status==null||$status==''){
			$this->Content_model->saveContent($data);
			$data['section'] = $this->Content_model->getSection();
			$data['success_msg'] = '<div class="alert alert-success text-center">Content successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/content_create_view', $data);
		}
		else {
			$data['section'] = $this->Content_model->getSection();
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/content_create_view', $data);
		}
	}
	Public function edit($id){
		$data['section'] = $this->Content_model->getSection();
		$data['content'] = $this->Content_model->selectContentById($id);
		$this->load->view('c/tutorial/content_edit_view', $data);
	}
	Public function updateContentById(){
		$data = array(
			'section' => $this->input->post('section'),
			'sub_section' => $this->input->post('sub_section'),
			'description' => $this->input->post('description'),
		);
		$this->Content_model->updateContent($this->input->post('id'), $data);
		redirect('c/Content');
	}

	public function add_mcq()
	{
		$data['sub_section']=$this->Content_model->getAllSubSection();
		$this->load->view('c/tutorial/mcq_create_view', $data);
	}
	Public function save_mcq(){
		$options=$this->input->post('option1').';'.$this->input->post('option2').';'.$this->input->post('option3').';'.$this->input->post('option4');
		$data = array(
			'question' => $this->input->post('question'),
			'option' => $options,
			'answer' => $this->input->post('answer'),
			'chapter' => $this->input->post('sub_section'),
		);
		$status=$this->Content_model->checkQuestion($this->input->post('question'));

		if ($status==null||$status==''){
			$this->Content_model->saveMcq($data);
			$data['sub_section']=$this->Content_model->getAllSubSection();
			$data['success_msg'] = '<div class="alert alert-success text-center">Question successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/mcq_create_view', $data);
		}
		else {
			$data['sub_section']=$this->Content_model->getAllSubSection();
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/tutorial/mcq_create_view', $data);
		}
	}

}
