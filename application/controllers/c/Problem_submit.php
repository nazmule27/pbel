<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_submit extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Problem_submit_model", "problem_submit");
	}
	public function index()
	{
		$data['type'] = $this->problem_submit->getProblemType();
		$data['level'] = $this->problem_submit->getProblemLevel();
		$data['coverages'] = $this->problem_submit->getCoverage();
		$this->load->view('c/problem_submit_view', $data);
	}
	Public function save(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');

		$pid=$this->problem_submit->nextPid();
		$pid=($pid[0]->id)+1;
		$data = array(
			'id' => $pid,
			'title' => $this->input->post('title'),
			'type' => $this->input->post('type'),
			'description' => $this->input->post('description'),
			'learning_outcome' => $this->input->post('learning_outcome'),
			'reference_guide' => $this->input->post('reference_guide'),
			'keywords' => $this->input->post('keywords'),
			'level' => $this->input->post('level'),
			'sample_input' => $this->input->post('sample_input'),
			'sample_output' => $this->input->post('sample_output'),
			'hint' => $this->input->post('hint'),
			'created_by' => $username,
		);
		$solution_data = array(
			'pid' => $pid,
			'type' => $this->input->post('type'),
			'solution_code' => $this->input->post('solution_code'),
			'submitted_by' => $username,
		);
		$coverage_data =array();
		for($i=0; $i < count($this->input->post('coverage')); $i++) {
			$coverage_data[$i] = array(
				'pid' => $pid,
				'cid' => $this->input->post('coverage')[$i],
			);
		}
		$this->problem_submit->saveProblem($data);
		$this->problem_submit->saveSolution($solution_data);
		$this->problem_submit->saveCoverage($coverage_data);
		$data['success_msg'] = '<div class="alert alert-success text-center">Your problem  was successfully uploaded!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
		$data['type'] = $this->problem_submit->getProblemType();
		$data['level'] = $this->problem_submit->getProblemLevel();
		$data['coverages'] = $this->problem_submit->getCoverage();
		$this->load->view('c/problem_submit_view', $data);
	}
	public function coverage()
	{
		$this->load->view('c/coverage_view');
	}
	Public function save_coverage(){
		$coverage_data = array(
			'title' => $this->input->post('coverage'),
		);
		$status=$this->problem_submit->checkCoverage($this->input->post('coverage'));
		if ($status==null||$status==''){
			$this->problem_submit->saveCoverageContent($coverage_data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Coverage was successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/coverage_view', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/coverage_view', $data);
		}
	}

}
