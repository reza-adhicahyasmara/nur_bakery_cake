<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Profil_karyawan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function index(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');   

        if($id_karyawan != null){
            $data['pageTitle'] = "Profil Saya";
 
		    $data['edit'] = $this->Mod_karyawan->get_karyawan($id_karyawan);

            $this->load->view("backend/profil_karyawan/body_profil",$data);
        } 
        else{ 
            redirect('login');
        }   
    }

    function ubah_password(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan'); 

        if($id_karyawan != null){
            $data['pageTitle'] = "Ubah Password";
 
		    $data['edit'] = $this->Mod_karyawan->get_karyawan($id_karyawan);

            $this->load->view("backend/profil_karyawan/body_password",$data);
        }  
        else{ 
            redirect('login');
        }   
    }

    function edit_karyawan(){
        $id_karyawan = $this->input->post('id_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $alamat_karyawan = $this->input->post('alamat_karyawan');
        $kontak_karyawan = $this->input->post('kontak_karyawan');
        $username_karyawan_lama = $this->input->post('username_karyawan_lama');
        $username_karyawan_baru = $this->input->post('username_karyawan_baru');
        $foto_karyawan_lama = $this->input->post('foto_karyawan_lama');
    
        $config['upload_path'] = './assets/img/karyawan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);

        if($this->upload->do_upload('file')){  

            unlink('assets/img/karyawan/'.$foto_karyawan_lama);

            $data = array('upload_data' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $foto_karyawan = $data['upload_data']['file_name'];
        }else{
            $foto_karyawan = $this->input->post('foto_karyawan_lama');
        }

        $cek_username = $this->Mod_karyawan->get_username_karyawan($username_karyawan_baru);

        $data  = array( 
            'id_karyawan'           => $id_karyawan,
            'nama_karyawan'         => $nama_karyawan,
            'alamat_karyawan'       => $alamat_karyawan,
            'kontak_karyawan'       => $kontak_karyawan,
            'username_karyawan'     => $username_karyawan_baru,
            'foto_karyawan'         => $foto_karyawan
        );
                  
        if($username_karyawan_baru != $username_karyawan_lama){
            if($cek_username->num_rows() > 0){
                echo "Username sudah terdaftar..!!";
            }else{
                echo 1;
                $this->Mod_karyawan->update_karyawan($id_karyawan, $data); 
            }
        }   
        else{
            echo 1;
            $this->Mod_karyawan->update_karyawan($id_karyawan, $data);   
        }       
        
    }
    
    function reset_password(){
        $id_karyawan = $this->input->post('id_karyawan');
        $username_karyawan = $this->input->post('username_karyawan');
        $password = $this->input->post('password_lama');
        $password_baru_2 = $this->input->post('password_baru_2');

        $cek_password = $this->Mod_karyawan->auth_karyawan($username_karyawan, $password);
        if($cek_password->num_rows() > 0){

            echo 1;
            $save  = array(
                'username_karyawan'         => $username_karyawan,
                'password_karyawan'         => $password_baru_2
            );    
            $this->Mod_karyawan->update_karyawan($id_karyawan, $save);

        } else {
            
            echo "Password lama salah..!";
        }
    }

}