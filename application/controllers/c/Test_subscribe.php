<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_subscribe extends MY_Controller {
	protected $access = "Student";
	function __construct() {
		parent::__construct();
		$this->load->model("c/Test_subscribe_model", "test_subscribe");
	}
	public function index()
	{
		$data['test_name'] = $this->test_subscribe->getTestName();
		$this->load->view('c/test_subscribe_view', $data);
	}
	Public function save_test_subscription(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$test_data = array(
			'test_id' => $this->input->post('test_name'),
			'user_id' => $username,
		);
		$status=$this->test_subscribe->checkSubscription($this->input->post('test_name'), $username);
		$data['test_name'] = $this->test_subscribe->getTestName();
		if ($status==null||$status==''){
			$this->test_subscribe->saveTestSubscription($test_data);
			$data['success_msg'] = '<div class="alert alert-success text-center">You successfully registered for this!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/test_subscribe_view', $data);
		}
		else {
			$data['success_msg'] = '<div class="alert alert-warning text-center">You already subscribed for this!<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
			$this->load->view('c/test_subscribe_view', $data);
		}
	}

}
