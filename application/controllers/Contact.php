<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed 
 * for (all) non logged in users
 */
class Contact extends CI_Controller {
	public function index()
	{
		$this->load->view("contact");
	}

}