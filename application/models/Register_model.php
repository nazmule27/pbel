<?php
class Register_model extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
	//insert into user table
	function insertUser($data)
    {
		return $this->db->insert('users', $data);
	}
	
	//send verification email to user's email id
	function sendEmail($to_email)
	{
		$from_email = 'pbel.info@gmail.com';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/pbel/Register/verify/' . sha1($to_email) . '<br /><br /><br />Thanks<br />PBeL Team';
		
		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'nlNazmul27'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);
		
		//send mail
		$this->email->from($from_email, 'PBeL');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	
	//activate user account
	function verifyEmailID($key)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('sha1(username)', $key);
		$query = $this->db->get();
		return $result = $query->result();
	}
	function validateEmailID($key)
	{
		$data = array('status' => 1);
		$this->db->where('sha1(username)', $key);
		return $this->db->update('users', $data);
	}


	public function updateToken($username, $data)
	{
		$this->db->where('username', $username);
		return $this->db->update('users', $data);
	}

	function sendForgotEmail($to_email, $token)
	{
		$from_email = 'pbel.info@gmail.com';
		$subject = 'Reset Password';
		$message = 'Dear User,<br /><br />Please click on the below link to update your password.<br /><br /> http://localhost/pbel/Register/resetPassword/?key='.$token.'<br /><br /><br />Thanks<br />PBeL Team';

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'nlNazmul27'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);

		//send mail
		$this->email->from($from_email, 'PBeL');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	function verifyToken($userid, $key)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('username', $userid);
		$this->db->where('token', $key);
		$query = $this->db->get();
		return $result = $query->result();
	}
	public function updatePassword($username, $data)
	{
		$this->db->where('username', $username);
		return $this->db->update('users', $data);
	}
}