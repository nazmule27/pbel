<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Contest_home_model", "contest_home");
		$this->load->model("c/Problem_submit_model", "problem_submit");
	}
	public function index()
	{
		$data['all_test_problem'] = $this->contest_home->selectProblem();
		$this->load->view('c/problem_set/index_view', $data);
	}
	public function problem_list()
	{
		$data['all_test_problem'] = $this->contest_home->selectProblem();
		$this->load->view('c/problem_set/index_view', $data);
	}
	public function single_view($pid)
	{
		$data['single_problem'] = $this->contest_home->singleProblemView($pid);
		$data['solutions'] = $this->contest_home->singleProblemSolutionView($pid);
		$this->load->view('c/problem_set/single_problem_view', $data);
	}
	Public function solution_submit_view(){
		$data['type'] = $this->problem_submit->getProblemType();
		$data['level'] = $this->problem_submit->getProblemLevel();
		$this->load->view('c/problem_set/solution_submit_view', $data);
	}
}
