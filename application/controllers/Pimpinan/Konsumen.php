<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Konsumen extends CI_Controller {

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
            $data['pageTitle'] = "Data Konsumen";
            $this->load->view("backend/pimpinan/konsumen/body",$data);
        }
        else{ 
            redirect('login');
        } 
    }

    function load_data_konsumen(){
        $data['konsumen'] = $this->Mod_konsumen->get_all_konsumen();
        $this->load->view('backend/pimpinan/konsumen/load_data_konsumen', $data);
    }
}
