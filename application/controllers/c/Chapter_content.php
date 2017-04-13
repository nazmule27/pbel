<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapter_content extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Chapter_content_model", "Chapter_content");
		$this->load->model("c/Learning_model", "learning");
		$this->load->model("c/Problem_list_model", "problem_list");
	}
	public function index()
	{
		$data['chapter_content'] = $this->Chapter_content->getTopics();
		$data['all_problem'] = $this->Chapter_content->getProblems(1);
		$this->load->view('c/chapter_content/home_view', $data);
	}
	public function chapter_wise_problems($chapter_id)
	{
		$data['chapter_content'] = $this->Chapter_content->getTopics();
		$data['all_problem'] = $this->Chapter_content->getProblems($chapter_id);
		$this->load->view('c/chapter_content/home_view', $data);
	}
	public function single_view($pid)
	{
		$data['chapter_content'] = $this->Chapter_content->getTopics();
		$data['childes'] = $this->problem_list->getChildList($pid);
		$data['parent'] = $this->problem_list->getParentList($pid);
		$data['single_problem'] = $this->learning->singleProblemView($pid);
		$this->load->view('c/chapter_content/single_problem_view', $data);
	}

}


