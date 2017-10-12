<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeC extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		
	}



	public function index()
	{
		//instruct.txt step 3~7
		$this->load->view('homeV');
	}

	public function about()
	{
		//instruct.txt step 3~7
		$this->load->view('aboutV');	
	}

	public function contact()
	{
		//instruct.txt step 3~7	
		$this->load->view('contactV');
	}

	public function order()
	{
		//instruct.txt step 3~7
		$this->load->view('orderV');	
	}

	public function signin()
	{
		$this->load->view('signinV');
	}

	function signin_validation()
	{	
			// set variables from the form
			$username = $this->input->post('username'); //echo $username; echo '<br>';
			$password = $this->input->post('password'); //echo $password; echo '<br>';
			$user_id = $this->user_model->get_user_id($username, $password); 
			if($user_id > 0)
			 {
				// set session user datas
				$_SESSION['user_id']      = (int)$user_id;
				$_SESSION['username']     = (string)$username;
				$_SESSION['logged_in']    = (bool)true;
				
				// user login ok
				$this->load->view('signinOK');	
			} else {
				
				// login failed
				 $this->session->set_flashdata('error', 'Invalid Username or Password');
				
				// send error to the view
				$this->load->view('signinV');				
			}
			
	}
    
	public function signup()
	{	

		$this->load->view('signupV');	
	}

	function signup_validation()
	{
		// create the data object
		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');


			
			// set variables from the form
			$username = $this->input->post('username'); //echo $username; echo '<br>';
			$email    = $this->input->post('email');  //echo $email; echo '<br>';
			$password = $this->input->post('password');  //echo $password; echo '<br>';
			
			if ($this->user_model->create_user($username, $email, $password)) {
				$this->load->view('signupOK', $data);
			} else {

				 $this->session->set_flashdata('error', 'Invalid Username or Password');
				
				// send error to the view
				$this->load->view('signupV');	
				
				// user creation failed, this should never happen
				//$data->error = 'There was a problem creating your new account. Please try again.';
				//$this->load->view('signup', $data);
			}

		//$this->load->view('signupV');	
	}



}
