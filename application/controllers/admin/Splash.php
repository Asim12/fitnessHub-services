<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Splash extends CI_Controller {
	
	function __construct() {

		parent::__construct();
		// ini_set("display_errors", 1);
        // error_reporting(1);
		$this->load->model('Mod_login');  
	}

	public function index(){
		$this->Mod_login->is_user_login();
        $this->session->set_userdata('tabName', 'Splash');
        $token =  getToken();
		$req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"      =>  "POST",
			"collectionName" => 'splash_data',
			"token"     =>  $token,
            "status"    =>  "", 
            'search'    =>  []
		];
		$count = dynamicHitPagination($req);

		$config['base_url'] = SURL . 'index.php/admin/Splash/index';
        $config['total_rows'] = $count['count'];
        $config['per_page'] = 6;
        $config['num_links'] = 2;
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
			"url"    =>  "http://3.120.159.133:3001/api/admin/getSplashData", 
			"type"   =>  "POST",
			"token"  =>  $token
		];
		$payload =[
			'limit' =>  intval( $config['per_page']), 
			'skip'  =>  $page,
		];
		$dataReturn = dynamicHit($req, $payload);
        // echo "<pre>";print_r($dataReturn['data']);exit;
        $data['splashData'] = $dataReturn['data'];
		$this->load->view('splashScreen/splash', $data);
    }

	public function uploadData(){
        $this->Mod_login->is_user_login();
        if($this->input->post()){
    
            $config['upload_path']          =   FCPATH.'assets/uploads';
            $config['allowed_types']        =   'gif|jpg|jpeg|png|pdf|bmp';
            $config['max_size']             =   $_FILES['file']['size'];
            $config['max_width']            =   1024;
            $config['max_height']           =   768;
            $config['encrypt_name']         =   TRUE;
        
            $this->load->library('upload', $config);
        
            if ( ! $this->upload->do_upload('file')){

                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
            }
            else{

                $data = array('upload_data' => $this->upload->data());
                $imagePath =  str_replace("/var/www/html/impressions-services/","", $data['upload_data']['full_path']);
                $insertArray = [
                    'image'         =>  $imagePath,
                    'date'    		=> $this->input->post('date'),
                    'collectionName' => 'splash_data',
                    'publication'   =>  $this->input->post('status') 
                ];
                saveImageData($insertArray);
                $this->session->set_flashdata('message', 'successfully submitted!');
            }
        }
        $this->index();
        
    }//end

    public function deleteSplash(){
        $this->Mod_login->is_user_login();

        $token =  getToken();
		$req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/deleteSplashRecord",
			"type"      =>  "POST",
			"collectionName" => $this->input->post('id'),
			"token"     =>  $token,
            "status"    =>  "", 
            'search'    =>  []
		];
		$count = dynamicHitPagination($req);
        // return true;
        $this->index();
    }//end
}
