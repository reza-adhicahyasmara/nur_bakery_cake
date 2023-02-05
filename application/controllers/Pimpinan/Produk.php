<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk extends CI_Controller {

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
            $data['pageTitle'] = "Data Produk";
            $this->load->view("backend/pimpinan/produk/body",$data,"backend/pimpinan/produk/footer");
        }
        else{ 
            redirect('login');
        } 
    }

    function load_data_produk(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $this->load->view('backend/pimpinan/produk/load_data_produk', $data);
    }

   
}