<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solution_submit extends MY_Controller {
	protected $access = "Admin, Student";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Solution_submit_model", "solution_submit");
		$this->load->model("c/Problem_submit_model", "problem_submit"); //for saveSolution
	}
	/*public function index()
	{
		$data['all_problem'] = $this->solution_submit->selectProblem();
		$this->load->view('problem_list_view.php', $data);
	}*/

	public function run_solution()
	{
		$code=$this->input->post('code');
		$getAnswer=$this->solution_submit->getresult($code);
	}
	Public function solution_save(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');

		$data = array(
			'pid' => $this->input->post('pid'),
			'type' => $this->input->post('type'),
			'solution_code' => $this->input->post('solution_code'),
			'submitted_by' => $username,
		);
		$status=$this->solution_submit->checkSolution($this->input->post('solution_code'));
		if ($status==null||$status==''){
			$this->problem_submit->saveSolution($data);
			$this->load->view('c/success/solution_submit');
		}
		else {
			$this->session->set_flashdata("error", '<div class="alert alert-warning text-center">Can not save, this solution code is already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>');
			redirect('c/Problem_list/solution_submit_view/?pid='.$this->input->post('pid').'&title='.$this->input->post('title'));
		}

	}
	Public function answer_solution($pid){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');

		$data = array(
			'pid' => $pid,
			'answer_code' => $this->input->post('solution_code'),
			'output' => $this->input->post('outputSet'),
			'submitted_by' => $username,
			'update_at' => date('Y-m-d H:i:s'),
		);
		$status=$this->solution_submit->checkAnswer($pid, $username);
		if ($status==null||$status==''){
			$this->solution_submit->saveAnswer($data);
			$this->load->view('c/success/solution_submit');
		}
		else {
			$statusCode=$this->solution_submit->checkAnswerCode($pid, $this->input->post('solution_code'), $username);
			if($statusCode==null||$statusCode==''){
				$this->solution_submit->updateAnswer($pid, $username, $data);
				$this->load->view('c/success/answer_submit');
			}
			else {
				$this->session->set_flashdata("error", '<div class="alert alert-warning text-center">Can update your code, this solution code is already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>');
				redirect('c/Learning/single_view/'.$pid);
			}
		}
	}

}


