<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Diskon extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function index(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Pimpinan'){
            $data['pageTitle'] = "Diskon";
            $this->load->view("backend/pimpinan/diskon/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_diskon(){
        $data['idiskon'] = $this->Mod_master->get_all_idiskon();
        $data['diskon'] = $this->Mod_master->get_all_diskon();
        $this->load->view('backend/pimpinan/diskon/load_data_diskon', $data);
    }

}
