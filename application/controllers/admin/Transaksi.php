<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function ambil_sendiri() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Ambil Sendiri";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_ambil_sendiri",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function antar_cepat() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Antar Cepat";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_antar_cepat",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function antar_ekspedisi() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Antar Ekspedisi";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_antar_ekspedisi",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function detail($kode_pemesanan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 
        
        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Detail Transaksi";
            
            $data['data_detail'] = $this->Mod_pemesanan->get_detail_pemesanan($kode_pemesanan)->row_array();
            $data['list_produk'] = $this->Mod_pemesanan->get_all_list_pembelian($kode_pemesanan)->result();
            $data['data_karyawan'] = $this->Mod_karyawan->get_all_karyawan()->result();

            $this->load->view("backend/admin/transaksi/body_detail",$data);
        }
        else{  
            redirect('login');
        }
    }




    
    function proses_transaksi(){
        $id_karyawan = $this->input->post('id_karyawan');
        $kode_pemesanan = $this->input->post('kode_pemesanan');
        $noresi_pemesanan = $this->input->post('noresi_pemesanan');
        $metode_pby_pemesanan = $this->input->post('metode_pby_pemesanan');
        $status_pby_pemesanan = $this->input->post('status_pby_pemesanan');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $keterangan_pemesanan = $this->input->post('keterangan_pemesanan');

        echo 1;         
        $data1  = array( 
            'kode_pemesanan'        => $kode_pemesanan,
            'id_karyawan'           => $id_karyawan,
            'noresi_pemesanan'      => $noresi_pemesanan,
            'status_pby_pemesanan'  => $status_pby_pemesanan,
            'status_pemesanan'      => $status_pemesanan,
            'keterangan_pemesanan'  => $keterangan_pemesanan
        );
                    
        $this->Mod_pemesanan->update_pemesanan($kode_pemesanan, $data1);    
        

        //UPDATE STATUS KARYAWAN
        if($status_pemesanan == 4 && $metode_pby_pemesanan == "Antar Cepat"){
            
            $data2  = array(
                'id_karyawan'         => $id_karyawan,
                'status_karyawan'     => 'Tidak'    
            );      
            $this->Mod_karyawan->update_karyawan($id_karyawan, $data2);  
        }


        //UPDATE STATUS IPEMESANAN DAN STOK PRODUK
        $data_ipemesanan = $this->Mod_pemesanan->get_all_list_pembelian($kode_pemesanan)->result();
        if($status_pemesanan == 4){
            
            foreach($data_ipemesanan as $data){
                $kode_ipemesanan = $data->kode_ipemesanan; 
                
                $data3 = array(
                    'kode_ipemesanan'       => $kode_ipemesanan,
                    'status_ipemesanan'     => '3'
                );

                $this->Mod_pemesanan->update_ipemesanan($kode_ipemesanan, $data3); 
            }
        }
    
    }




    function download(){
        $this->load->helper('download');
        if($this->uri->segment(4)){
            $data   = file_get_contents('./assets/img/pemesanan/'.$this->uri->segment(4));
        }
        $name   = $this->uri->segment(4);
        force_download($name, $data);
    }

}