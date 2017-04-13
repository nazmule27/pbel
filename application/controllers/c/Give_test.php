<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Give_test extends MY_Controller {
	protected $access = "Admin, Student";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Give_test_model", "Give_test_model");
		$this->load->model("c/Problem_submit_model", "problem_submit");
	}
	public function index()
	{
		$CI = &get_instance();
		$user_id = $CI->session->userdata('username');
		$data['all_test'] = $this->Give_test_model->selectTest($user_id);
		$this->load->view('c/give_test/index_view', $data);
	}
	public function home($tid)
	{
		$CI = &get_instance();
		$user_id = $CI->session->userdata('username');
		$data['test'] = $this->Give_test_model->onlineTestDetail($tid, $user_id);
		$data['test_problem'] = $this->Give_test_model->selectProblem($tid, $user_id);
		$time_range=$this->Give_test_model->onlineTestDetail($tid, $user_id);
		if(($time_range[0]->start_time)>date('Y-m-d H:i:s')){
			$this->load->view('c/success/info_yet', $data);
		}
		else if(($time_range[0]->end_time)<date('Y-m-d H:i:s')){
			redirect("c/Give_test/info_expired");
		}
		else {
			$this->load->view('c/give_test/home_view', $data);
		}

	}
	public function info_expired()
	{
		$this->load->view('c/success/info_expired');
	}
	public function single_view($tid, $pid)
	{
		$CI = &get_instance();
		$user_id = $CI->session->userdata('username');
		$data['test'] = $this->Give_test_model->onlineTestDetail($tid, $user_id);
		$data['single_problem'] = $this->Give_test_model->singleProblemView($tid, $pid);
		$time_range=$this->Give_test_model->onlineTestDetail($tid, $user_id);
		if(($time_range[0]->start_time)>date('Y-m-d H:i:s')){
			$this->load->view('success/info_yet', $data);
		}
		else if(($time_range[0]->end_time)<date('Y-m-d H:i:s')){
			redirect("c/Give_test/info_expired");
		}
		else {
			$this->load->view('c/give_test/single_problem_view', $data);
		}

	}
	Public function answer_submit_view(){
		$CI = &get_instance();
		$user_id = $CI->session->userdata('username');
		$tid=$this->input->get('test_id');
		$data['test_problem'] = $this->Give_test_model->testProblems($tid);
		$data['test'] = $this->Give_test_model->onlineTestDetail($tid, $user_id);
		$time_range=$this->Give_test_model->onlineTestDetail($tid, $user_id);
		if(($time_range[0]->start_time)>date('Y-m-d H:i:s')){
			$this->load->view('success/info_yet', $data);
		}
		else if(($time_range[0]->end_time)<date('Y-m-d H:i:s')){
			redirect("c/Give_test/info_expired");
		}
		else {
			$data['type'] = $this->problem_submit->getProblemType();
			$data['level'] = $this->problem_submit->getProblemLevel();
			$this->load->view('c/give_test/solution_submit_view', $data);
		}
	}
	Public function test_solution_save(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');

		$data = array(
			'pid' => $this->input->post('pid'),
			'type' => $this->input->post('type'),
			'solution_code' => $this->input->post('solution_code'),
			'submitted_by' => $username,
		);
		$status=$this->Give_test_model->checkTestSolution($this->input->post('solution_code'), $this->input->post('test_id'));
		if ($status==null||$status==''){
			$this->Give_test_model->saveTestSolution($data);
			$this->load->view('c/success/test_solution_submit');
		}
		else {
			$this->session->set_flashdata("error", '<div class="alert alert-warning text-center">Can not save, this solution code is already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>');
			redirect('c/Contest_home/solution_submit_view/?pid='.$this->input->post('pid').'&title='.$this->input->post('title').'&test_id='.$this->input->post('test_id'));
		}

	}
	Public function save_test_answer($test_id, $pid){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data = array(
			'test_id' => $test_id,
			'test_pid' => $pid,
			'answer_code' => $this->input->post('solution_code'),
			'output' => $this->input->post('outputSet'),
			'submitted_by' => $username,
			'update_at' => date('Y-m-d H:i:s'),
		);
		$status=$this->Give_test_model->checkTestAnswer($test_id, $pid, $username);
		if ($status==null||$status==''){
			$this->Give_test_model->saveTestAnswer($data);
			$this->load->view('c/success/test_answer_solution_submit');
		}
		else {
			$statusCode=$this->Give_test_model->checkTestAnswerCode($test_id, $pid, $this->input->post('solution_code'), $username);
			if($statusCode==null||$statusCode==''){
				$this->Give_test_model->updateTestAnswer($test_id, $pid, $username, $data);
				$this->load->view('c/success/test_answer_solution_submit');
			}
			else {
				$this->session->set_flashdata("error", '<div class="alert alert-warning text-center">Please edit, this solution code is already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>');
				redirect('c/Give_test/answer_submit_view?test_id='.$test_id.'&pid='.$pid.'&title='.$this->input->post('title').'&description='.$this->input->post('description').'&answer_code='.$this->input->post('solution_code'));
			}
		}
	}
	Public function save_test_answer_js($test_id, $pid){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data = array(
			'test_id' => $test_id,
			'test_pid' => $pid,
			'answer_code' => $this->input->post('solution_code'),
			'output' => $this->input->post('outputSet'),
			'submitted_by' => $username,
			'update_at' => date('Y-m-d H:i:s'),
		);
		$status=$this->Give_test_model->checkTestAnswer($test_id, $pid, $username);
		if ($status==null||$status==''){
			$this->Give_test_model->saveTestAnswer($data);
		}
		else {
			$statusCode=$this->Give_test_model->checkTestAnswerCode($test_id, $pid, $this->input->post('solution_code'), $username);
			if($statusCode==null||$statusCode==''){
				$this->Give_test_model->updateTestAnswer($test_id, $pid, $username, $data);
			}
		}
	}
}
