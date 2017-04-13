<?php
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_model');
	}
	
	function index()
	{
		//set validation rules
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[3]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('username', 'Email ID', 'trim|required|valid_email|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

		//validate form input
		if ($this->form_validation->run() == FALSE)
		{
			// fails
			$this->load->view('user_registration_view');
		}
		else
		{
			//insert the user registration details into database
			$data = array(
				'full_name' => $this->input->post('full_name'),
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'role' => 'Student'
			);

			// insert form data into database
			if ($this->Register_model->insertUser($data))
			{
				// send email
				if ($this->Register_model->sendEmail($this->input->post('username')))
				{
					// successfully sent mail
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
					redirect('Register');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Email Error.  Please try again later!!!</div>');
					redirect('Register');
				}
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect('Register');
			}
		}

	}
	
	function verify($hash)
	{
		$status=$this->Register_model->verifyEmailID($hash);
		if ($status==null||$status=='')
		{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
			redirect('Register');
		}
		else
		{
			$this->Register_model->validateEmailID($hash);
			$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account! <a href="'.base_url().'auth"> Login</a> </div>');
			redirect('Register');
		}
	}

	function forgot()
	{
		//set validation rules
		$this->form_validation->set_rules('username', 'Email ID', 'trim|required|valid_email');

		//validate form input
		if ($this->form_validation->run() == FALSE)
		{
			// fails
			$this->load->view('forgot_view');
		}
		else
		{
			$token=sha1(date());
			$data = array(
				'token' => $token,
			);
			$email_status=$this->Register_model->verifyEmailID(sha1($this->input->post('username')));
			if ($email_status==null||$email_status=='') {
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error. Email not found. Please try again later!!!</div>');
				redirect('Register/forgot');
			}
			// insert form data into database
			if ($this->Register_model->updateToken($this->input->post('username'), $data))
			{
				// send email
				if ($this->Register_model->sendForgotEmail($this->input->post('username'), $token))
				{
					// successfully sent mail
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">A reset link sent to your email! Please confirm from your email!!!</div>');
					redirect('Register/forgot');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Email Error.  Please try again later!!!</div>');
					redirect('Register/forgot');
				}
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect('Register/forgot');
			}
		}
	}
	function resetPassword()
	{
		//set validation rules
		$this->form_validation->set_rules('username', 'Email ID', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

		$data['key']=$this->input->get('key');
		if ($this->form_validation->run() == FALSE)
		{
			// fails
			$this->load->view('reset_view', $data);
		}

		else
		{
			$token_status=$this->Register_model->verifyToken($this->input->post('username'),  $this->input->get('key'));
			if ($token_status==null||$token_status=='')
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  wrong token or user id!!!</div>');
				redirect('Register/resetPassword');
			}
			else {
				$data = array(
					'password' => sha1($this->input->post('password')),
				);
				if ($this->Register_model->updatePassword($this->input->post('username'), $data))
				{
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Password updated successfully. Please login <a href="'.base_url().'auth"> Login</a></div>');
					redirect('Register/resetPassword');
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
					redirect('Register/resetPassword');
				}

			}
		}
	}
}