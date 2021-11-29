<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Login extends CI_Controller {
	
	function __construct() {

		parent::__construct();
		// ini_set("display_errors", 1);
        // error_reporting(1);
		$this->load->helper('cookie');
	}

	public function index(){
		$adminData = $this->session->userdata('adminData');
        if( !empty($adminData) ) {

            redirect(base_url() . 'index.php/admin/Dashboard/index');
        }else{

			$this->load->view('admin/login');
        }
	}

	public function VerifyLogin(){
	
		$payload = [
			"email_address" => $this->input->post('email'),
			"password"      => $this->input->post('password')
		];

		$data = hitCurlRequest($payload);

		if($data['type'] == 200 ){

			$this->session->set_userdata('adminData', $data);

			redirect(base_url() . 'index.php/admin/Dashboard/index');	
		}else{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												Invalid Credentials.
											</div>');
			$this->load->view('admin/login');
		}
	}

	public function logoutUser(){
		
		$this->session->unset_userdata('adminData');		
		redirect(base_url() . 'index.php/admin/Login');
	}
}