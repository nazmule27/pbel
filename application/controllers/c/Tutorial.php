<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("c/Tutorial_model", "tutorial");
	}
	public function index($id)
	{
		$data['content1'] = $this->tutorial->getContent1();
		$data['content2'] = $this->tutorial->getContent2();
		$data['content5'] = $this->tutorial->getContent5();
		$data['first_content'] = $this->tutorial->getFirstContent($id);
		$this->load->view('c/tutorial/home_view', $data);
	}
	public function content_view()
	{
		$data['ajax_req'] = TRUE;
		$code=$this->input->post('code');
		$getAnswer=$this->tutorial->getContentById($code);
		echo $getAnswer;
	}
	public function practice()
	{
		$chapter=$_GET['chap'];
		$data['questions'] = $this->tutorial->getQuestion($chapter);
		$this->load->view('c/mcq/question_page', $data);
	}
	Public function mcq_answer_save(){
		$CI = &get_instance();
		$username = $CI->session->userdata('username');
		$chapter=$this->input->post('chapter');
		$question_last_id = $this->tutorial->questionLastId($chapter);
		$question_last_id=$question_last_id[0]->id;

		$answer_data =array();
		for($i=1; $i <=$question_last_id; $i++) {
			if($this->input->post('q'.$i)!=null){
				$answer_data[$i] = array(
					'q_id' => $this->input->post('q_id'.$i),
					'answer' => $this->input->post('q'.$i),
					'user' => $username,
					'chapter' => $chapter,
				);
			}
		}
		$this->tutorial->cleanMcqAnswer($username, $chapter);
		$this->tutorial->saveMcqAnswer($answer_data);
		$question_count = $this->tutorial->questionCount($chapter);
		$answered_count = $this->tutorial->answerCount($username, $chapter);
		$correct_count = $this->tutorial->correctCount($username, $chapter);
		$data['success_msg'] = '<div class="alert alert-success text-center">Your answer  was successfully submitted! Total question: '.$question_count[0]->question_count.'; You answered: '.$answered_count[0]->answered.'; Your correct answer: '.$correct_count[0]->correct.'<strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">&times;</a> </strong></div>';
		$data['questions'] = $this->tutorial->getQuestion($chapter);
		$this->load->view('c/mcq/question_page', $data);
	}

}


