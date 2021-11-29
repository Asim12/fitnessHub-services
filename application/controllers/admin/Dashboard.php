<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct(){
		parent :: __construct();

        ini_set("display_errors", 1);
        error_reporting(1); 
        $this->load->model('Mod_login');  
	}

    public function index(){
        $this->Mod_login->is_user_login();
        $this->session->set_userdata('tabName', 'Dashboard');
        $token =  getToken();
		$req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"      =>  "POST",
			"collectionName" => 'activity',
			"token"     =>  $token,
            "status"    =>  "activity", 
            'search'    =>  []
		];
		$count = dynamicHitPagination($req);
		$config['base_url'] = SURL . 'index.php/admin/Dashboard/index';
        $config['total_rows'] = $count['count'];
        $config['per_page'] = 9;
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
			"url"    =>  "http://3.120.159.133:3001/api/admin/getRecentActivity", 
			"type"   =>  "POST",
			"token"  =>  $token
		];
		$payload =[
			'limit' =>  intval( $config['per_page']), 
			'skip'  =>  $page,
		];
		$dataReturn = dynamicHit($req, $payload);
        $data['activities'] = $dataReturn['activities'];

        //get flag users
        $reqNew = [
			"url"    =>  "http://3.120.159.133:3001/api/admin/getAllFlagUsers", 
			"type"   =>  "POST",
			"token"  =>  $token
		];
        $search['is_flag'] = ['$exists' => true] ;

        $payloadNew =[

            'search'=>  $search
		];
        $dataReturn = dynamicHit($reqNew, $payloadNew);

        $data['flagUsers'] = $dataReturn['flagUsers'];

        //get Last 30 days payment
        $reqData = [];
        $payloadData =[
            'search'=>  ''
		];
        $dataPayment = dynamicHit($reqData, $payloadData);

        $data['payment'] = $dataPayment['data'][0]['total'];

        //get Active incative user count
        $req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/getActiveInactiveUsers",
			"type"      =>  "POST",
			"collectionName" => '',
			"token"     =>  $token,
            "status"    =>  "", 
            'search'    =>  []
		];
		$dataRes = dynamicHitPagination($req);

        $data['totalUser'] =  $dataRes['data']['totalUsers'];
        // echo "<pre>";
        // print_r($dataRes['data']);exit;
        $this->load->view('admin/admin_dashboard', $data);
    }

    public function markAllReadss(){

        $token =  getToken();
		$req = [
			"url"       =>  "http://3.120.159.133:3001/api/admin/getAllSignupUsersCount",
			"type"      =>  "POST",
			"collectionName" => 'admin_notification',
			"token"     =>  $token,
            "status"    =>  "readAll", 
            'search'    =>  []
		];
		dynamicHitPagination($req);
        return true;
    }//end 
}