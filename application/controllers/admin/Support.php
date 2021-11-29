<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Support extends CI_Controller {

	function __construct() {
		parent::__construct();
		ini_set("display_errors", 1);
        error_reporting(1);
		$this->load->model('Mod_login');  
	}

	public function tickets(){

		$this->Mod_login->is_user_login();
        $this->session->set_userdata('tabName', 'Support');

		if($this->input->post()){
			$postData['filterDataSupport'] = $this->input->post();
			$this->session->set_userdata($postData);
		}

		$filterDataSupport =  $this->session->userdata('filterDataSupport');
		$search = [];
		if(!empty($filterDataSupport['start_date']) && !empty($filterDataSupport['end_date']) ){

			$search['start_date'] = $filterDataSupport['start_date'];
			$search['end_date'] = $filterDataSupport['end_date'];
		}
		$search['created_date'] = ['$exists' => true];
		$userToken =  getToken();

		$req = [
			"url"   =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"  => "POST",
			"collectionName" => 'support',
			"token"  => $userToken,
			'status' => '',
			'search' => $search
		];
		
		$userCount = dynamicHitPagination($req);
		$config['base_url'] = SURL . 'index.php/admin/Support/index';
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
			"url"   =>  "http://3.120.159.133:3001/api/admin/getSupport",
			"type"  => "POST",
			"token" => $userToken
		];
		$payload =[
			'limit' =>  intval( $config['per_page']), 
			'skip'  =>  $page,
			'search'=>  $search
		];

		$dataReturn = dynamicHit($req, $payload);
		$data['data'] = $dataReturn['data'];
		$this->load->view('support/support', $data);
	}//end

	public function resetFilter(){
		$this->Mod_login->is_user_login();
		$this->session->unset_userdata('filterDataSupport');
		$this->index();
	}//end

	public function index(){
        $this->Mod_login->is_user_login();
		$this->session->set_userdata('tabName', 'support');
		$token =  getToken();

        if($this->input->get('roleId') == '2'){

            $search['roleId'] = 2;
            $this->session->set_userdata('tab', 'trainee');  
        }else{
            $this->session->set_userdata('tab', 'user');
            $search['roleId'] = 3;
        }

		$req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"      =>  "POST",
			"collectionName" => 'tickets',
			"token"     =>  $token,
            "status"    =>  "", 
            'search'    =>  []
		];
		$count = dynamicHitPagination($req);

        $config['base_url']         =   SURL . 'index.php/admin/Support/index';
        $config['total_rows']       =   $count['count'];
        $config['per_page']         =   15;
        $config['num_links']        =   2;
        $config['use_page_numbers'] =   TRUE;
        $config['uri_segment']      =   4;
        $config['reuse_query_string'] = TRUE;
        $config["first_tag_open"]   =   '<li>';
        $config["first_tag_close"]  =   '</li>';
        $config["last_tag_open"]    =   '<li>';
        $config["last_tag_close"]   =   '</li>';
        $config['next_link']        =   'Next<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open']    =   '<li>';
        $config['next_tag_close']   =   '</li>';
        $config['prev_link']        =   '<i class="fa fa-long-arrow-left"></i>Previous';
        $config['prev_tag_open']    =   '<li>';
        $config['prev_tag_close']   =   '</li>';
        $config['full_tag_open']    =   '<ul class="pagination">';
        $config['full_tag_close']   =   '</ul>';
        $config['cur_tag_open']     =   '<li class="active"><a href="#"><b>';
        $config['cur_tag_close']    =   '</b></a></li>';
        $config['num_tag_open']     =   '<li>';
        $config['num_tag_close']    =   '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        if($page !=0) 
        {
        $page = ($page-1) * $config['per_page'];
        }
        $data["links"] = $this->pagination->create_links();

		//get tickets
		$req = [
			"url"    =>  "http://3.120.159.133:3001/api/ticket/getTicketsForAdmin", 
			"type"   =>  "POST",
			"token"  =>  $token
		];
		$payload =[
			'limit' =>  intval( $config['per_page']), 
			'skip'  =>  $page,
			'search' => $search
		];

		$dataRes = dynamicHit($req, $payload);

		// echo "<pre>"; print_r($dataRes);exit;

        $data['tickets'] = $dataRes;
        $this->load->view('support/ticket', $data);
    }//end
    
    public function getMessages(){
        $this->Mod_login->is_user_login();
		$token =  getToken();
		
		$search = [

        	'ticketId'  =>  (string)$this->input->post('ticketId')
		];
		$req = [
			"url"    =>  "http://3.120.159.133:3001/api/ticket/getMessagesForAdmin", 
			"type"   =>  "POST",
			"token"  =>  $token
		];
		$payload =[
			'limit' =>  '', 
			'skip'  =>  '',
			'search' => $search
		];

		$dataRes = dynamicHit($req, $payload);
		
        $messagesData = json_encode((array)$dataRes);
		// echo "<pre>";print_r($dataRes); 
        echo $messagesData;
        exit;
    }//end

    public function sendMessage(){
        $this->Mod_login->is_user_login();
		$token =  getToken();
		echo $_FILES['file'];
		$user_data = $this->session->userdata('adminData');
		$admin_id =  $user_data['userData'][0]['_id'];

		if($this->input->post('ticketId')){

			$tickerReply = [
				'ticket_id'    =>  (string)$this->input->post('ticketId'),
				'message'      =>  (string)$this->input->post('sendMessage'),
				'admin_id'     =>  $admin_id,
			];

			$req = [
				"url"       =>  "http://3.120.159.133:3001/api/ticket/sendReplyAdmin",
				"type"      =>  "POST",
				"collectionName" => '',
				"token"     =>  $token,
				"status"    =>  "message", 
				'search'    =>  $tickerReply
			];
			dynamicHitPagination($req);
		}
        return true;
    }//end message

    public function imageSendUpload(){
		$this->Mod_login->is_user_login();
		$token =  getToken();
        if($_FILES['image']['name'] != '' && $this->input->post('ticketId') ){
			$uploadImagePath = FCPATH.'assets/uploads';
			$orignal_file_name = $_FILES['image']['name'];
			
			$config['upload_path']   = $uploadImagePath;
			$config['allowed_types'] = 'jpg|jpeg|gif|tiff|tif|png';
			$config['max_size']	     = '6000';
			$config['overwrite']     = true;
            $config['encrypt_name']  =  TRUE;
			$config['file_name']     = $orignal_file_name;
			$this->load->library('upload', $config);
            $this->upload->initialize($config);
			
			if(!$this->upload->do_upload('image')){
				$error_file_arr = array('error' => $this->upload->display_errors());
				print_r($error_file_arr);
				return $error_file_arr;
				
			}else{
			
                $data = array('upload_data' => $this->upload->data());
			    $imagePath = $data['upload_data']['full_path'];
                $imagePath = str_replace("/var/www/html/","http://3.120.159.133/", $imagePath);
				$user_data = $this->session->userdata('adminData');
				$admin_id =  $user_data['userData'][0]['_id'];
				$tickerReply = [
                    'image'        =>  $imagePath,
                    'ticket_id'    =>  (string)$this->input->post('ticketId'),
                    'admin_id'     =>  $admin_id,
                ];


				$req = [
					"url"       =>  "http://3.120.159.133:3001/api/ticket/sendReplyAdmin",
					"type"      =>  "POST",
					"collectionName" => '',
					"token"     =>  $token,
					"status"    =>  "image", 
					'search'    =>  $tickerReply
				];
				dynamicHitPagination($req);
				print_r($imagePath);
                return $imagePath;
		        exit;
            }
        }
    }//end
    
    public function fileSendUpload(){
		$this->Mod_login->is_user_login();
		$token =  getToken();
        if($_FILES['file']['name'] != '' && $this->input->post('ticketId') ){
			
            $fileUploadPath = FCPATH.'assets/uploads';
			$orignal_file_name = $_FILES['file']['name'];

			$config['upload_path']   = $fileUploadPath;
			$config['allowed_types'] = 'pdf|doc|csv|ppt|docx|txt|tex';
			$config['max_size']	     = '6000';
			$config['overwrite']     = true;
            $config['encrypt_name']  =  TRUE;
			$config['file_name']     = $orignal_file_name;
			$this->load->library('upload', $config);
            $this->upload->initialize($config);

			if(!$this->upload->do_upload('file')){
				$error_file_arr = array('error' => $this->upload->display_errors());
				print_r($error_file_arr);
				return $error_file_arr;

			}else{
			
                $data = array('upload_data' => $this->upload->data());
			    $filePathFinal = $data['upload_data']['full_path'];

                $filePathFinal = str_replace("/var/www/html/", "http://3.120.159.133/", $filePathFinal);

				$user_data = $this->session->userdata('adminData');
				$admin_id =  $user_data['userData'][0]['_id'];

				$tickerReply = [
                    'file'        =>  $filePathFinal,
                    'ticket_id'    =>  (string)$this->input->post('ticketId'),
                    'admin_id'     =>  $admin_id,
                ];

				$req = [
					"url"       =>  "http://3.120.159.133:3001/api/ticket/sendReplyAdmin",
					"type"      =>  "POST",
					"collectionName" => '',
					"token"     =>  $token,
					"status"    =>  "file", 
					'search'    =>  $tickerReply
				];
				dynamicHitPagination($req);
				print_r($filePathFinal);
                return $filePathFinal;
		        exit;
            }
        }
    }//end
} 