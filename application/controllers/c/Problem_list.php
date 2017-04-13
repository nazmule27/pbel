<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_list extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Problem_list_model", "problem_list");
	}
	public function index()
	{
		$data['all_problem'] = $this->problem_list->selectProblem();
		$this->load->view('c/problem_list/index_view', $data);
	}
	public function single_view($pid)
	{
		$data['single_problem'] = $this->problem_list->singleProblemView($pid);
		$data['solutions'] = $this->problem_list->singleProblemSolutionView($pid);
		$data['con_coverage'] = $this->problem_list->singleProblemContentCoverage($pid);
		$data['childes'] = $this->problem_list->getChildList($pid);
		$data['parent'] = $this->problem_list->getParentList($pid);
		$this->load->view('c/problem_list/single_problem_view', $data);
	}
	Public function solution_submit_view(){
		$data['type'] = $this->problem_list->getProblemType();
		$data['level'] = $this->problem_list->getProblemLevel();
		$this->load->view('c/problem_list/solution_submit_view', $data);
	}
	public function edit($pid){
		$data['single_problem'] = $this->problem_list->singleProblemView($pid);
		$data['type'] = $this->problem_list->getProblemType();
		$data['level'] = $this->problem_list->getProblemLevel();
		$this->load->view('c/problem_list/problem_edit_view', $data);
	}
	public function update($pid) {
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data = array(
			'title' => $this->input->post('title'),
			'type' => $this->input->post('type'),
			'level' => $this->input->post('level'),
			'description' => $this->input->post('description'),
			'learning_outcome' => $this->input->post('learning_outcome'),
			'reference_guide' => $this->input->post('reference_guide'),
			'keywords' => $this->input->post('keywords'),
			'sample_input' => $this->input->post('sample_input'),
			'sample_output' => $this->input->post('sample_output'),
			'hint' => $this->input->post('hint'),
			'created_by' => $username,
		);
		if(($this->problem_list->problemUpdate($pid, $data))){
			$data['success_msg'] = '<div class="alert alert-success text-center">Your problem  was successfully Updated!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
		}
		else {
			$data['success_msg'] = '<div class="alert alert-danger text-center">Your problem  cannot  Updated!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
		}
		$data['single_problem'] = $this->problem_list->singleProblemView($pid);
		$data['type'] = $this->problem_list->getProblemType();
		$data['level'] = $this->problem_list->getProblemLevel();
		$this->load->view('c/problem_list/problem_edit_view', $data);
	}
	public function solution_edit($sid){
		$data['single_solution'] = $this->problem_list->singleSolutionView($sid);
		$this->load->view('c/problem_list/solution_submit_edit', $data);
	}
	public function solution_save($sid)
	{
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data = array(
			'solution_code' => $this->input->post('solution_code'),
			'updated_at' => date('Y-m-d H:i:s'),
			'submitted_by' => $username,
		);
		$this->problem_list->solutionUpdate($sid, $data);
		redirect('c/Problem_list');
	}
}
