<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerBackend.php';

class Chat extends BaseControllerBackend {

    public function __construct() {
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
            $data['pageTitle'] = "Chat";
            $this->load->view("backend/admin/chat/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function detail(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Chat";
            $this->load->view("backend/admin/chat/detail",$data);
        }
        else{ 
            redirect('login');
        }  
    }

    function load_chat(){
        $id_konsumen = $this->input->post('id_konsumen');
        $nama_chat = $this->input->post('nama_chat');
        $kontak_chat = $this->input->post('kontak_chat');
        $foto_konsumen = $this->input->post('foto_konsumen');
        if($id_konsumen != ""){
            $data['id_konsumen'] = $id_konsumen;
            $data['nama_chat'] = $nama_chat;
            $data['kontak_chat'] = $kontak_chat;
            $data['foto_konsumen'] = $foto_konsumen;
            $data['chat'] = $this->Mod_master->get_chat_konsumen($id_konsumen)->result();
        }else{
            $data['id_konsumen'] = "";
            $data['nama_chat'] = $nama_chat;
            $data['kontak_chat'] = $kontak_chat;
            $data['foto_konsumen'] = "";
            $data['chat'] = $this->Mod_master->get_chat_nonkonsumen($kontak_chat)->result();
        }
        $this->load->view('backend/admin/chat/load_chat', $data);
    }

    function load_kontak(){
        $data['chat'] = $this->Mod_master->get_all_kontak();
        $this->load->view('backend/admin/chat/load_kontak', $data);
    }

    function kirim_pesan(){
        $id_karyawan = $this->session->userdata('ses_id_karyawan'); 
        $nama_chat = $this->input->post('nama_chat');
        $kontak_chat = $this->input->post('kontak_chat');
        $id_konsumen = $this->input->post('id_konsumen');
        $chat = $this->input->post('chat');

        if($chat == "" || $chat == NULL){
            echo 2;
        } else {
            echo 1;
                            
            $data  = array(
                'id_karyawan'       => $id_karyawan,
                'id_konsumen'       => $id_konsumen,
                'tanggal_chat'      => date("Y-m-d H:i:s"),
                'chat'              => $chat,
                'status_chat'       => '2',
                'pengirim_chat'     => 'admin',
                'nama_chat'         => $nama_chat,
                'kontak_chat'       => $kontak_chat        
            );
                        
            $this->Mod_master->insert_chat($data);   

        }
    }
}