<?php 
//ini wajib dipanggil paling atas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//ini sesuaikan foldernya ke file 3 ini
require 'assets/plugins/PHPMailer/src/Exception.php';
require 'assets/plugins/PHPMailer/src/PHPMailer.php';
require 'assets/plugins/PHPMailer/src/SMTP.php';

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
            echo 1;
        }
        elseif($cek->num_rows() > 0){
            echo 2;
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
                        
                     
                //SIMPAN EVENT DISKON       
                $data  = array(
                    'kode_diskon'            => $kode_diskon,
                    'nama_diskon'            => $nama_diskon,
                    'deskripsi_diskon'       => $deskripsi_diskon,  
                    'tanggal_awal_diskon'    => $tanggal_awal_diskon,
                    'tanggal_akhir_diskon'   => $tanggal_akhir_diskon,
                    'gambar_diskon'          => $gambar_diskon
                );
                            
                $this->Mod_master->insert_diskon($data);    

                
                //SIMPAN ITEM DISKON
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

                //KIRIM EMAIL
                $data_konsumen = $this->Mod_konsumen->get_all_konsumen()->result();

                foreach($data_konsumen as $row){
                //SETTING FORM
                    // $nama_file = $_FILES['file']['name'];
                    // $file_tmp = $_FILES['file']['tmp_name'];    
            
                    // move_uploaded_file($file_tmp, '../../file/'.$nama_file);

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    //Server settings
                    $mail->SMTPDebug = 2;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'bakerycake791@gmail.com';                     //SMTP username
                    $mail->Password   = 'ditbxtyshpivffsz';                               //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //pengirim
                    $mail->setFrom('bakerycake791@gmail.com', 'Nur Cake & Bakery');
                    $mail->addAddress($row->email_konsumen);     //Add a recipient
                    $mail->AddEmbeddedImage('assets/img/diskon/'.$gambar_diskon, 'Gambar');

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $nama_diskon;
                    $mail->Body    = 'Yth '. $row->nama_konsumen.' konsumen Nur Bakery & Cake. Berikut kami kirimkan informasi Diskon Produk. <br><br>'.
                                    '<img src="cid:Gambar"/><br>'.
                                    'Berlaku '.$tanggal_awal_diskon.' s.d '.$tanggal_akhir_diskon.'<br>'.
                                    $deskripsi_diskon.'<br><br>
                                    <a href="http://localhost/nur_bakery_cake/home/detail_acara_diskon/'.$kode_diskon.'">Klik disini</a> untuk melihat informasi lebih lanjut.
                                    Terima Kasih.';
                    // $mail->addAttachment('../../file/'.$nama_file);
                    $mail->AltBody = ''; //abaikan jika tidak ada logo
                    //$mail->addAttachment(''); 

                    $mail->send();
                  
                }

            }else{
                echo 3; 
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
