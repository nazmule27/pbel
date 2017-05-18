<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {
	protected $access = "Admin";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Test_model", "Test_model");
	}
	public function index()
	{
		$data['all_test'] = $this->Test_model->selectTest();
		$this->load->view('c/test/index_view', $data);
	}
	public function home($tid)
	{
		$data['test_problem'] = $this->Test_model->selectProblem($tid);
		$this->load->view('c/test/home_view', $data);

	}
	public function single_view($pid)
	{
		$data['single_problem'] = $this->Test_model->singleProblemView($pid);
		$this->load->view('c/test/single_problem_view', $data);

	}
	public function test_create()
	{
		$this->load->view('c/test/test_create_view');
	}
	Public function save_test(){
		$test_data = array(
			'name' => $this->input->post('test_name'),
			'start_time' => $this->input->post('start_time'),
			'end_time' => $this->input->post('end_time'),
			'subscription_start_time' => $this->input->post('subscription_start_time'),
			'subscription_end_time' => $this->input->post('subscription_end_time'),
		);
		$status=$this->Test_model->checkTest($this->input->post('test_name'));
		if ($status==null||$status==''){
			$this->Test_model->saveTest($test_data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Test successfully saved!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/test/test_create_view', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">Cant save already exist!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/test/test_create_view', $data);
		}
	}
	public function add_in_group_list()
	{
		$data['test_name'] = $this->Test_model->getTestName();
		$this->load->view('c/test/test_list_view', $data);
	}
	public function add_in_group()
	{
		$testid= $this->input->get('id');
		$data['child'] = $this->Test_model->getStudent($testid);
		$data['existChild'] = $this->Test_model->getExistgetStudent($testid);
		$this->load->view('c/test/add_in_group_view', $data);
	}
	Public function update_group_user($test_id){
		$subscription_data =array();
		for($i=0; $i <= 500; $i++) {
			$child_id=$this->input->post('child'.$i);
			if(isset($child_id)){
				$subscription_data[$i] = array(
					'test_id' => $test_id,
					'user_id' => $child_id,
				);
			}
		}
		$this->Test_model->deleteUserSubscription($test_id);
		$this->Test_model->saveUserSubscription($subscription_data);
		$this->load->view('c/success/subscription_submit');
	}

}
