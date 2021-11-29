

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_login extends CI_Model {
    function __construct() {

        parent::__construct();
        
    }
    public function is_user_login(){

        $adminData = $this->session->userdata('adminData');
        if( !empty($adminData) ) {
            
            return true;
        }else{

            redirect(base_url() . 'index.php/admin/Login');
        }
    }
}
