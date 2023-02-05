<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Karyawan extends CI_Controller {

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
            $data['pageTitle'] = "karyawan";
            $this->load->view("backend/pimpinan/karyawan/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_data_admin(){
        $data['admin'] = $this->Mod_karyawan->get_all_karyawan();
        $this->load->view('backend/pimpinan/karyawan/load_admin', $data);
    }

    function load_data_petugas(){
        $data['petugas'] = $this->Mod_karyawan->get_all_karyawan();
        $this->load->view('backend/pimpinan/karyawan/load_petugas', $data);
    }
    
    function form_tambah_karyawan(){
        $this->load->view("backend/pimpinan/karyawan/form_tambah_karyawan", NULL);
    }

    function form_edit_karyawan(){
        $id_karyawan = $this->input->post('id_karyawan');
		$data['data_karyawan'] = $this->Mod_karyawan->get_karyawan($id_karyawan)->row_array();
		$this->load->view("backend/pimpinan/karyawan/form_edit_karyawan", $data);
    }

    function tambah_edit_karyawan(){ 
        $jenis = $this->input->post('jenis');
        $id_karyawan = $this->input->post('id_karyawan');
        $level_karyawan = $this->input->post('level_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $alamat_karyawan = $this->input->post('alamat_karyawan');
        $kontak_karyawan = $this->input->post('kontak_karyawan');
        $username_karyawan_baru = $this->input->post('username_karyawan_baru');
        $username_karyawan_lama = $this->input->post('username_karyawan_lama');
        $password_karyawan = $this->input->post('password_karyawan');

        $config['upload_path'] = './assets/img/karyawan/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);

        $cek_id = $this->Mod_karyawan->get_karyawan($id_karyawan);
        $cek_username = $this->Mod_karyawan->get_username_karyawan($username_karyawan_baru);

        if($jenis == "Tambah"){

            if($cek_id->num_rows() > 0){
                echo "ID sudak ada..!!";
            }
            elseif($cek_username->num_rows() > 0){
                echo "Username sudah ada..!!";
            }
            else{
                if($this->upload->do_upload('file')){  
                    $data = array('upload_data' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 500;
        
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $foto_karyawan = $data['upload_data']['file_name'];
                }else{
                    $foto_karyawan = NULL;  
                }
                echo 1;   
                       
                $data  = array(
                    'id_karyawan'           => $id_karyawan,
                    'level_karyawan'        => $level_karyawan,
                    'nama_karyawan'         => $nama_karyawan,
                    'alamat_karyawan'       => $alamat_karyawan,
                    'kontak_karyawan'       => $kontak_karyawan,
                    'foto_karyawan'         => $foto_karyawan,
                    'username_karyawan'     => $username_karyawan_baru,
                    'password_karyawan'     => $password_karyawan             
                );
                $this->Mod_karyawan->insert_karyawan($data);                   
            }
        }
        elseif($jenis == "Edit"){

            if($username_karyawan_lama == $username_karyawan_baru){
                echo 1;         
                    
                if($this->upload->do_upload('file')){      
                    $foto_karyawan_lama = $this->input->post('foto_karyawan_lama');  
                    if($foto_karyawan_lama != NULL){
                        unlink('assets/img/karyawan/'.$foto_karyawan_lama);
                    }

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

                $data  = array(
                    'id_karyawan'           => $id_karyawan,
                    'level_karyawan'        => $level_karyawan,
                    'nama_karyawan'         => $nama_karyawan,
                    'alamat_karyawan'       => $alamat_karyawan,
                    'kontak_karyawan'       => $kontak_karyawan,
                    'foto_karyawan'         => $foto_karyawan,
                    'username_karyawan'     => $username_karyawan_baru,
                    'password_karyawan'     => $password_karyawan             
                );
                
                $this->Mod_karyawan->update_karyawan($id_karyawan, $data);             
            }
            else{
                if($cek_username->num_rows() > 0){
                    echo "Username sudah ada..!!";
                }
                else{
                    
                    if($this->upload->do_upload('file')){      
                        $foto_karyawan_lama = $this->input->post('foto_karyawan_lama'); 
                        if($foto_karyawan_lama != NULL){
                            unlink('assets/img/karyawan/'.$foto_karyawan_lama);
                        }

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

                    echo 1;
                    
                    $data  = array(
                        'id_karyawan'           => $id_karyawan,
                        'level_karyawan'        => $level_karyawan,
                        'nama_karyawan'         => $nama_karyawan,
                        'alamat_karyawan'       => $alamat_karyawan,
                        'kontak_karyawan'       => $kontak_karyawan,
                        'foto_karyawan'         => $foto_karyawan,
                        'username_karyawan'     => $username_karyawan_baru,
                        'password_karyawan'     => $password_karyawan             
                    );

                    $this->Mod_karyawan->update_karyawan($id_karyawan, $data); 
                }
            }
        }
    }

    function hapus_karyawan(){
        $id_karyawan = $this->input->post('id_karyawan');
        $foto_karyawan = $this->input->post('foto_karyawan');
        unlink('assets/img/karyawan/'.$foto_karyawan);
        $this->Mod_karyawan->delete_karyawan($id_karyawan);
    } 
}
