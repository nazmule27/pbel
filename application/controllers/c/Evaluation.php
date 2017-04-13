<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Evaluation_model", "Evaluation_model");
		//$this->load->library('export');
	}
	public function index()
	{
		$data['all_test'] = $this->Evaluation_model->selectTest();
		$this->load->view('c/evaluation/index_view', $data);
	}
	public function test_answer_list($tid)
	{
		$data['test_answer'] = $this->Evaluation_model->selectTestAnswer($tid);
		$this->load->view('c/evaluation/test_answer', $data);
	}
	public function compare($aid)
	{
		$data['single_test_answer'] = $this->Evaluation_model->selectSingleTestAnswer($aid);
		$data['single_standard_answer'] = $this->Evaluation_model->selectSingleStandardAnswer($aid);
		$this->load->view('c/evaluation/compare_answer', $data);
	}
	Public function save_mark(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$data = array(
			'mark' => $this->input->post('mark'),
			'evaluation_status' => 'Yes',
			'evaluated_by' => $username,
		);
		$this->Evaluation_model->updateMark($this->input->post('answer_id'), $data);
		redirect('c/Evaluation/test_answer_list/'.$this->input->post('test_id'));
	}
	public function export()
	{
		$data['all_test'] = $this->Evaluation_model->selectTest();
		$this->load->view('c/evaluation/export_home', $data);
	}
	public function export_result($id, $name)
	{
		$sql = $this->Evaluation_model->ExportData($id);
		header('Content-type: text/csv');
		header('Content-disposition: attachment;filename='.$name.'.csv');
		echo "Roll No, Mark".PHP_EOL;
		for ($i = 0; $i < count($sql); ++$i) {
			echo $sql[$i]->submitted_by.", ".$sql[$i]->mark.PHP_EOL;
		}
	}

}
