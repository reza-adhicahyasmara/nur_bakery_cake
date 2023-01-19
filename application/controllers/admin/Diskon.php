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

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Diskon";
            $this->load->view("backend/admin/diskon/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_diskon(){
        $data['idiskon'] = $this->Mod_master->get_all_idiskon();
        $data['diskon'] = $this->Mod_master->get_all_diskon();
        $this->load->view('backend/admin/diskon/load_data_diskon', $data);
    }

    function form_tambah_diskon(){
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $this->load->view("backend/admin/diskon/form_tambah_diskon", $data);
    }


    function tambah_diskon(){ 
        $nama_diskon = $this->input->post('nama_diskon');
        $deskripsi_diskon = $this->input->post('deskripsi_diskon');
        $tanggal_awal_diskon = $this->input->post('tanggal_awal_diskon');
        $tanggal_akhir_diskon = $this->input->post('tanggal_akhir_diskon');
        $t = time();
        $kode_diskon = "PRM.".$t;

        $config['upload_path'] = './assets/img/diskon/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);
 
        $cek = $this->Mod_master->cek_diskon($nama_diskon);
        $cek1 = $this->Mod_master->cek_idiskon0();
        
        if($cek1->num_rows() == 0){
            echo "Produk kosong..!!";
        }
        elseif($cek->num_rows() > 0){
            echo "Nama diskon sudah ada..!!";
        }
        else{

            if($this->upload->do_upload('file')){  
                $data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;
    
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar_diskon = $data['upload_data']['file_name'];
                        
                echo 1;
                            
                $data  = array(
                    'kode_diskon'            => $kode_diskon,
                    'nama_diskon'            => $nama_diskon,
                    'deskripsi_diskon'       => $deskripsi_diskon,  
                    'tanggal_awal_diskon'    => $tanggal_awal_diskon,
                    'tanggal_akhir_diskon'   => $tanggal_akhir_diskon,
                    'gambar_diskon'          => $gambar_diskon
                );
                            
                $this->Mod_master->insert_diskon($data);    

                
                $item = $this->Mod_master->cek_idiskon0()->result();

                foreach($item as $row){
                    $kode_idiskon = $row->kode_idiskon;
                    if ($row->kode_diskon == NULL){

                        $data = array(
                            'kode_idiskon'     => $row->kode_idiskon,
                            'kode_diskon'      => $kode_diskon
                        );
                        
                        $this->Mod_master->update_idiskon($kode_idiskon, $data); 
                    }
                }
            }else{
                echo "Gambar tidak boleh kosong"; 
            } 
        }
    }

    function hapus_diskon(){
        $kode_diskon = $this->input->post('kode_diskon');
        $gambar_diskon = $this->input->post('gambar_diskon');
        
        $this->Mod_master->delete_diskon($kode_diskon);
        $this->Mod_master->delete_all_idiskon($kode_diskon);
        unlink('assets/img/diskon/'.$gambar_diskon);
    } 

    
    ////////////////////-----diskon LIST-----////////////////////

    function load_data_idiskon(){
        $data['idiskon'] = $this->Mod_master->get_all_idiskon1();
        $this->load->view('backend/admin/diskon/load_data_idiskon', $data);
    }

    function tambah_idiskon(){ 
        $kode_ukuran = $this->input->post('kode_ukuran');
        $potongan_idiskon = $this->input->post('potongan_idiskon');
        
        $cek1 = $this->Mod_master->cek_idiskon1($kode_ukuran);
        if($cek1->num_rows() > 0){
            echo "Produk sudah ada..!!";
        }elseif($kode_ukuran == ""){
            echo "Produk kosong..!!";
        }elseif($potongan_idiskon == ""){
            echo "Potongan harga kosong..!!";
        }
        else {
            echo 1;
                        
            $data  = array(
                'kode_ukuran'        => $kode_ukuran,
                'potongan_idiskon'       => $potongan_idiskon,  
            );
                        
            $this->Mod_master->insert_idiskon($data);    
        }               
    }

    function hapus_idiskon(){
        $kode_idiskon = $this->input->post('kode_idiskon');
        $this->Mod_master->delete_idiskon($kode_idiskon);
    } 



}
