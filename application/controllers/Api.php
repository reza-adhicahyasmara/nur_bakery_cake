<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

	public function login_konsumen(){
        $kontak_email_konsumen=$this->input->post('kontak_email_konsumen');
        $password_konsumen=$this->input->post('password_konsumen');
  
        if(is_numeric($kontak_email_konsumen) == 1){

            $data_konsumen = $this->Mod_konsumen->auth_hp_konsumen($kontak_email_konsumen, $password_konsumen)->row();
            if($data_konsumen){
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                        'login'=>true,
                        'data'=>$data_konsumen,
                        'message'=>'Berhasil Login'
                )));
            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                        'login'=>false,
                        'message' => 'Kontak atau Password salah',                   
                )));
            }
            
        }else{
            $data_konsumen = $this->Mod_konsumen->auth_email_konsumen($kontak_email_konsumen, $password_konsumen)->row();
            if($data_konsumen){
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                        'login'=>true,
                        'data'=>$data_konsumen,
                        'message'=>'Berhasil Login'
                )));
            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                        'login'=>false,
                        'message' => 'Email atau Password salah',                   
                )));
            }

        }
	}


    
    public function pendaftaran_konsumen(){
        $config['upload_path'] = './assets/img/konsumen/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;
		
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
            $foto_konsumen= $data['upload_data']['file_name'];
        }else{
            $foto_konsumen=0;
        }
        
        $nama_konsumen = $this->input->post('nama_konsumen');
        $kode_provinsi = $this->input->post('kode_provinsi');
        $kode_kabupaten = $this->input->post('kode_kabupaten');
        $kode_kecamatan = $this->input->post('kode_kecamatan');
        $kode_desa = $this->input->post('kode_desa');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $alamat = $this->input->post('alamat');
        $email_konsumen = $this->input->post('email_konsumen');
        $kontak_konsumen = $this->input->post('kontak_konsumen');
        $password_konsumen = $this->input->post('password22');

        $id_konsumen = md5($email_konsumen.$kontak_konsumen);
        if($this->Mod_konsumen->get_kontak_konsumen($kontak_konsumen)->num_rows() > 0){
            echo "Kontak sudah terdaftar..!!";
        } 
        else if($this->Mod_konsumen->get_email_konsumen($email_konsumen)->num_rows() > 0){
            echo "Email sudah terdaftar..!!";
        } 
        else{
            
            $data  = array(
                'id_konsumen'           => $id_konsumen,
                'nama_konsumen'         => $nama_konsumen,
                'kode_provinsi'         => $kode_provinsi,
                'kode_kabupaten'        => $kode_kabupaten,
                'kode_kecamatan'        => $kode_kecamatan,
                'kode_desa'             => $kode_desa,
                'alamat_konsumen'       => $alamat.'-'.$rt.'-'.$rw,
                'kontak_konsumen'       => $kontak_konsumen,
                'email_konsumen'        => $email_konsumen,
                'password_konsumen'     => $password_konsumen,
                'status_konsumen'       => "Aktif",
                'poin_konsumen'         => 0,
                'foto_konsumen'         => $foto_konsumen,
                'daftar_konsumen'       => date("Y-m-d")
            );  

            $id=$this->Mod_konsumen->insert_konsumen($data);
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'success'=>true,
                    'id'=>$id,
                    'data'=>$data
            )));
        }
    }

    public function get_provinsi(){
        $data = $this->Mod_master->get_all_provinsi()->result();
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode(array(
                'success'=>true,
                'data'=>$data,
        )));
    }

    public function get_kabupaten(){
        $kode_provinsi=$this->input->post('kode_provinsi');
        $data = $this->Mod_master->get_kabupaten($kode_provinsi)->result();;
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode(array(
                'success'=>true,
                'data'=>$data,
        )));
    }

    public function get_kecamatan(){
        $kode_kabupaten=$this->input->post('kode_kabupaten');
        $data = $this->Mod_master->get_kecamatan($kode_kabupaten)->result();
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode(array(
                'success'=>true,
                'data'=>$data,
        )));
    }

    public function get_desa(){
        $kode_kecamatan=$this->input->post('kode_kecamatan');
        $data = $this->Mod_master->get_desa($kode_kecamatan)->result();
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode(array(
                'success'=>true,
                'data'=>$data,
        )));
    }
}