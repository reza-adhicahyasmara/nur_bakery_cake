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

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Data Konsumen";
            $this->load->view("backend/admin/konsumen/body",$data);
        }
        else{ 
            redirect('login');
        } 
    }

    function load_data_konsumen(){
        $data['konsumen'] = $this->Mod_konsumen->get_all_konsumen();
        $this->load->view('backend/admin/konsumen/load_data_konsumen', $data);
    }

    function form_tambah_konsumen(){
        $this->load->view("backend/admin/konsumen/form_tambah_konsumen", NULL);
    }

    function form_edit_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
		$data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        $data['provinsi'] = $this->Mod_master->get_all_provinsi();
        $data['kabupaten'] = $this->Mod_master->get_all_kabupaten();
        $data['kecamatan'] = $this->Mod_master->get_all_kecamatan();
        $data['desa'] = $this->Mod_master->get_all_desa();
		$this->load->view("backend/admin/konsumen/form_edit_konsumen", $data);
    }
    
    function edit_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
        $nama_konsumen = $this->input->post('nama_konsumen');
        $kode_provinsi = $this->input->post('kode_provinsi');
        $kode_kabupaten = $this->input->post('kode_kabupaten');
        $kode_kecamatan = $this->input->post('kode_kecamatan');
        $kode_desa = $this->input->post('kode_desa');
        $alamat = $this->input->post('alamat');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $email_konsumen_baru = $this->input->post('email_konsumen_baru');
        $email_konsumen_lama = $this->input->post('email_konsumen_lama');
        $kontak_konsumen_baru = $this->input->post('kontak_konsumen_baru');
        $kontak_konsumen_lama = $this->input->post('kontak_konsumen_lama');
        $password_konsumen = $this->input->post('password_konsumen'); 
        $status_konsumen = $this->input->post('status_konsumen'); 


        $config['upload_path'] = './assets/img/konsumen/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);
        if($this->upload->do_upload('file')){      
            $foto_konsumen_lama = $this->input->post('foto_konsumen_lama');  
            if($foto_konsumen_lama != NULL){
                unlink('assets/img/konsumen/'.$foto_konsumen_lama);
            }

            $data = array('upload_data' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $foto_konsumen = $data['upload_data']['file_name'];
        }else{
            $foto_konsumen = $this->input->post('foto_konsumen_lama');
        }

        $data  = array( 
            'id_konsumen'               => $id_konsumen,
            'nama_konsumen'             => $nama_konsumen,
            'alamat_konsumen'           => $alamat.'-'.$rt.'-'.$rw,
            'kode_provinsi'             => $kode_provinsi,
            'kode_kabupaten'            => $kode_kabupaten,
            'kode_kecamatan'            => $kode_kecamatan,
            'kode_desa'                 => $kode_desa,
            'kontak_konsumen'           => $kontak_konsumen_baru,
            'email_konsumen'            => $email_konsumen_baru,
            'password_konsumen'         => $password_konsumen,
            'foto_konsumen'             => $foto_konsumen,
            'status_konsumen'           => $status_konsumen
        );  
    
        if($kontak_konsumen_baru != $kontak_konsumen_lama){
            if($this->Mod_konsumen->get_kontak_konsumen($kontak_konsumen_baru)->num_rows() > 0){
                echo "Kontak sudah terdaftar..!!";
            }else{
                echo 1;
                $this->Mod_konsumen->update_konsumen($id_konsumen, $data);    
            }
        }
        elseif($email_konsumen_baru != $email_konsumen_lama){
            if($this->Mod_konsumen->get_email_konsumen($email_konsumen_baru)->num_rows() > 0){
                echo "Email sudah terdaftar..!!";
            }else{

                echo 1;
                $this->Mod_konsumen->update_konsumen($id_konsumen, $data);    
            }   
        }
        else{
            echo 1;
            $this->Mod_konsumen->update_konsumen($id_konsumen, $data);  
        }      
    }

    function hapus_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
        $foto_konsumen = $this->input->post('foto_konsumen');

        $this->Mod_konsumen->delete_konsumen($id_konsumen);

        unlink('assets/img/konsumen/'.$foto_konsumen);
    }   
}
