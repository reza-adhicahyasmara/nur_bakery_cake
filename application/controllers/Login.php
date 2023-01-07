<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Mod_karyawan')); 
    }

    public function index(){   
        $this->load->view('backend/login'); 
    }

    
    public function proses(){   
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $auth_karyawan = $this->Mod_karyawan->auth_karyawan($username, $password);

        if($auth_karyawan->num_rows() > 0){
            $data=$auth_karyawan->row_array();
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses',$data['level_karyawan']);
            $this->session->set_userdata('ses_id_karyawan',$data['id_karyawan']);
            if($data['level_karyawan']=='Admin'){
                echo "admin/dashboard";
            }
            elseif($data['level_karyawan']=='Pimpinan'){ 
                echo "pimpinan/dashboard";
            } 
        }     
        else{
            echo "1";
        }
    }
    
	
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}