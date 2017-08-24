<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pick_problem extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Pick_problem_model", "pick_problem");
		$this->load->model("c/Problem_list_model", "problem_list");
	}
	public function index()
	{
		$data['all_problem'] = $this->pick_problem->selectProblem();
		$this->load->view('c/pick_problem/index_view', $data);
	}
	public function pick($pid){
		$data['single_problem'] = $this->problem_list->singleProblemView($pid);
		$data['problem_coverage'] = $this->pick_problem->singleProblemCoverages($pid);
		$data['problem_solution'] = $this->pick_problem->singleProblemSolution($pid);
		$data['type'] = $this->problem_list->getProblemType();
		$data['level'] = $this->problem_list->getProblemLevel();
		$data['coverages'] = $this->pick_problem->getCoverage();
		$data['test_name'] = $this->pick_problem->getTestName();
		$this->load->view('c/pick_problem/set_view', $data);
	}
}
