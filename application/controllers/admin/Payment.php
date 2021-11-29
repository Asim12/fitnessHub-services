<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	
	function __construct() {

		parent::__construct();
		// ini_set("display_errors", 1);
        // error_reporting(1);
		$this->load->model('Mod_login');  
	}

	public function index(){
		
		$this->Mod_login->is_user_login();
        $this->session->set_userdata('tabName', 'Payments');

		if($this->input->post()){
			$postData['filterDataInput'] = $this->input->post();
			$this->session->set_userdata($postData);
		}

		$filterData =  $this->session->userdata('filterDataInput');
		$search = [];
		if(!empty($filterData['start_date']) &&  !empty($filterData['end_date'])){

			$search['start_date'] = $filterData['start_date'];
			$search['end_date'] = $filterData['end_date'];
		}
		$search['price'] = ['$exists' => true];
		$userToken =  getToken();

		$req = [
			"url"   =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"  => "POST",
			"collectionName" => 'packages',
			"token" => $userToken,
			'status' => '',
			'search' =>  $search
		];
		
		$userCount = dynamicHitPagination($req);
		$config['base_url'] = SURL . 'index.php/admin/Payment/index';
        $config['total_rows'] = $userCount['count'];
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['reuse_query_string'] = TRUE;
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = 'Next<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    
        if($page !=0) 
        {
          $page = ($page-1) * $config['per_page'];
        }
        $data["links"] = $this->pagination->create_links();
		$req = [
			"url"   =>  "http://3.120.159.133:3001/api/admin/getTrasections",
			"type"  => "POST",
			"token" => $userToken
		];
		$payload =[
			'limit' =>  intval( $config['per_page']), 
			'skip'  =>  $page,
			'search'=>  $search
		];

		$dataReturn = dynamicHit($req, $payload);
		$data['trasections'] = $dataReturn['users'];
		$this->load->view('payments/payment', $data);
	}

	public function resetFilter(){
		$this->Mod_login->is_user_login();
		$this->session->unset_userdata('filterDataInput');
		$this->index();
	}
} 