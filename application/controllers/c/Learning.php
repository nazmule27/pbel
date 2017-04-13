<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learning extends MY_Controller {
	protected $access = "Admin, Student";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Learning_model", "learning");
		$this->load->model("c/Problem_list_model", "problem_list");
	}
	public function index()
	{
		$data['parent'] = $this->learning->getParent(3);
		$this->load->view('c/learning/home', $data);
	}
	public function all_problem()
	{
		$data['all_problem'] = $this->learning->selectProblem();
		$this->load->view('c/learning/problem_list_view', $data);
	}
	public function single_view($pid)
	{
		$data['childes'] = $this->problem_list->getChildList($pid);
		$data['parent'] = $this->problem_list->getParentList($pid);
		$data['single_problem'] = $this->learning->singleProblemView($pid);
		$this->load->view('c/learning/single_problem_view', $data);
	}
	public function level_wise_problem($level)
	{
		$data['all_problem'] = $this->learning->selectLevelProblem($level);
		$this->load->view('c/learning/problem_list_view.php', $data);
	}
	public function hint()
	{
		$data['ajax_req'] = TRUE;
		$pid=$this->input->post('pid');
		$getAnswer=$this->learning->getHint($pid);
		echo $getAnswer;
	}
	public function complete_code()
	{
		$data['ajax_req'] = TRUE;
		$pid=$this->input->post('pid');
		$getAnswer=$this->learning->getCompleteCode($pid);
		echo $getAnswer;
	}

}


