<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

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

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $kode_pengaturan = 1; 
            $data['pageTitle'] = "Data Pengaturan";
            $data['edit'] = $this->Mod_master->get_pengaturan($kode_pengaturan)->row_array();
            $data['data_kabupaten'] = $this->Mod_master->get_all_kabupaten()->result();
            $this->load->view("backend/admin/pengaturan/body",$data,"backend/admin/pengaturan/footer");
        }
        else{ 
            redirect('login');
        } 
    }

    
    function edit_pengaturan(){
        $kode_pengaturan = 1;        

        echo 1;
        $data  = array( 
            'kode_pengaturan'       => $kode_pengaturan,
            'potongan_pengaturan'   => $this->input->post('potongan_pengaturan'),
            'rek1_pengaturan'       => $this->input->post('no1')."-".$this->input->post('an1')."-".$this->input->post('fin1'),
            'rek2_pengaturan'       => $this->input->post('no2')."-".$this->input->post('an2')."-".$this->input->post('fin2'),
            'rek3_pengaturan'       => $this->input->post('no3')."-".$this->input->post('an3')."-".$this->input->post('fin3'),
            'rek4_pengaturan'       => $this->input->post('no4')."-".$this->input->post('an4')."-".$this->input->post('fin4'),
        );
        $this->Mod_master->update_pengaturan($kode_pengaturan, $data);     
           
    }   

    function load_data_kecamatan(){
        $kode_kabupaten = $this->input->post('kode_kabupaten');
        $data['data_kecamatan'] = $this->Mod_master->get_kecamatan($kode_kabupaten);
        $this->load->view('backend/admin/pengaturan/load_kecamatan', $data);
    }

    function form_edit_kecamatan(){
        $data['kode_kecamatan'] = $this->input->post('kode_kecamatan');
        $data['ongkos_kecamatan'] = $this->input->post('ongkos_kecamatan');
		$this->load->view("backend/admin/pengaturan/form_edit_kecamatan", $data);
    }

    function edit_kecamatan(){ 
        $kode_kecamatan = $this->input->post('kode_kecamatan');
        $ongkos_kecamatan = $this->input->post('ongkos_kecamatan');
        
        echo 1;
        $data  = array(
            'kode_kecamatan'               => $kode_kecamatan,
            'ongkos_kecamatan'               => $ongkos_kecamatan,         
        );  
        $this->Mod_master->update_kecamatan($kode_kecamatan, $data); 
    }
}
