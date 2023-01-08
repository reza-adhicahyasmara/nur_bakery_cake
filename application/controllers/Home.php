<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function index(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        $data['data_produk'] = $this->Mod_master->get_all_produk()->result();
        $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
        $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
        $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
        $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
        $data['data_promo'] = $this->Mod_master->get_display_promo()->result();
        $data['data_ipromo'] = $this->Mod_master->get_display_ipromo()->result();
      
        $data['pageTitle'] = "Home";
        
        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/home/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/home/body",$data);
        }
    }

    public function login(){
        $email_hp_login = $this->input->post('email_hp_login');
        $password_konsumen = $this->input->post('password_login');
        
        if(is_numeric($email_hp_login) == 1){
            $cek_hp_konsumen = $this->Mod_konsumen->auth_hp_konsumen($email_hp_login, $password_konsumen);
            if($cek_hp_konsumen->num_rows() > 0){
                $data=$cek_hp_konsumen->row_array();
                $this->session->set_userdata('masuk',TRUE);
                $this->session->set_userdata('ses_akses','Konsumen');
                $this->session->set_userdata('ses_id_konsumen',$data['id_konsumen']);
                echo 1;         
            }  
            else{
                echo 'Kontak Email atau Password salah..!';
            } 
        }else{
            $cek_email_konsumen = $this->Mod_konsumen->auth_email_konsumen($email_hp_login, $password_konsumen);
            if($cek_email_konsumen->num_rows() > 0){
                $data=$cek_email_konsumen->row_array();
                $this->session->set_userdata('masuk',TRUE);
                $this->session->set_userdata('ses_akses','Konsumen');
                $this->session->set_userdata('ses_id_konsumen',$data['id_konsumen']);
                echo 1;         
            }  
            else{
                echo 'Kontak Email atau Password salah..!';
            } 
        }       
    }

    function reset_password(){
        $id_konsumen = $this->input->post('id_konsumen');
        $kontak_konsumen = $this->input->post('kontak_konsumen');
        $password_lama_konsumen = $this->input->post('password_lama_konsumen');
        $password_baru_konsumen = $this->input->post('password_baru_konsumen');

        $cek_hp_konsumen = $this->Mod_konsumen->auth_hp_konsumen($kontak_konsumen, $password_lama_konsumen);
        if($cek_hp_konsumen->num_rows() > 0){

            echo 1;
            $data  = array(
                'id_konsumen'               => $id_konsumen,
                'password_konsumen'         => $password_baru_konsumen
            );    
            $this->Mod_konsumen->update_konsumen($id_konsumen, $data);

        } else {
            
            echo "Password lama salah..!";
        }
    }




    //PRODUK

    function cari_kategori(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses'); 
        
        $kode_kategori = $this->input->post('kode_kategori');
        $nama_kategori = $this->input->post('nama_kategori');

        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();

        if($kode_kategori == 'Semua'){
            $data['nama_kategori'] = $nama_kategori;
            $data['list_produk'] = $this->Mod_master->get_all_produk()->result();
            $data['ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
        }else{
            $data['nama_kategori'] = $nama_kategori;
            $data['list_produk'] = $this->Mod_master->get_cari_kategori($kode_kategori)->result();
            $data['ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
        }

        $this->load->view('frontend/konsumen/home/load_data_produk', $data);
    }
    
    function cari_produk(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        $cari_produk1 = "%".$_POST['cari_produk']."%";
        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['produk'] = $this->Mod_master->get_cari_produk($cari_produk1)->result();
        $data['ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();

        $data['pageTitle'] = "Cari Produk";
        
        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/cari_produk/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/cari_produk/body",$data);
        }
    }

    function detail_produk($kode_produk){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['data_produk'] = $this->Mod_master->get_detail_produk($kode_produk)->row_array();
        $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
        $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
        $data['data_ipromo'] = $this->Mod_master->get_display_ipromo()->result();
        $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
        $data['data_produk_all'] = $this->Mod_master->get_all_produk()->result();

        $data['pageTitle'] = "Detail Produk";
        
        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/detail_produk/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/detail_produk/body",$data);
        }
    }





    //KERANJANG

    function keranjang(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');   

        $data['pageTitle'] = "Keranjang";

        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();    
		$data['keranjang'] = $this->Mod_pemesanan->get_all_ipemesanan_konsumen($id_konsumen);
		$data['potongan'] = $this->Mod_pemesanan->get_potongan_ipemesanan_konsumen($id_konsumen);
		$data['kurir'] = $this->Mod_master->get_all_kurir();
		$data['rekening'] = $this->Mod_master->get_all_rekening();

        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/keranjang/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/keranjang/body",$data);
        }
    }

    function tambah_keranjang(){
        $id_konsumen = $this->input->post('id_konsumen');
        $kode_produk = $this->input->post('kode_produk');
        $jumlah_ipemesanan = $this->input->post('jumlah_ipemesanan');
        $status_ipemesanan = 1;

        $cek_produk = $this->Mod_pemesanan->cek_ipemesanan($id_konsumen, $kode_produk);
        if($cek_produk->num_rows() > 0){
            echo "Produk sudah ada..!!";
        } else if($jumlah_ipemesanan == 0){
            echo "Item tidak boleh kosong";
        } else {
            echo 1;
                            
            $data  = array(
                'id_konsumen'           => $id_konsumen,
                'kode_produk'           => $kode_produk,
                'jumlah_ipemesanan'     => $jumlah_ipemesanan,
                'status_ipemesanan'     => $status_ipemesanan        
            );
                        
            $this->Mod_pemesanan->insert_ipemesanan($data);   
        }
    }

    function hapus_keranjang(){
        $kode_ipemesanan = $this->input->post('kode_ipemesanan');
        $this->Mod_pemesanan->delete_ipemesanan($kode_ipemesanan);
    } 





    //PESANAN
    
    function checkout(){
        //DATA PESANAN
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $kode_rekening = $this->input->post('kode_rekening');
        $id_kurir = $this->input->post('id_kurir');
        $total_belanja_pemesanan = $this->input->post('total_belanja_pemesanan');
        $tarif_pemesanan = $this->input->post('tarif_pemesanan');
        $potongan_pemesanan = $this->input->post('potongan_pemesanan');
        $total_tagihan_pemesanan = $this->input->post('total_tagihan_pemesanan');
        $metode_pemesanan = $this->input->post('metode_pemesanan');
        $tanggal_pemesanan = date("Y-m-d H:i:s");
        $kode_pemesanan = "INV-".date("Ymd-His")."-".$id_konsumen;
        $status_pemesanan = "1";
        $status_pby_pemesanan = "Belum Dibayarkan";
              
        $data1  = array(
            'kode_pemesanan'              => $kode_pemesanan,
            'kode_rekening'             => $kode_rekening,
            'id_kurir'                  => $id_kurir,
            'id_konsumen'                 => $id_konsumen,
            'total_belanja_pemesanan'     => $total_belanja_pemesanan,
            'tarif_pemesanan'             => $tarif_pemesanan,
            'potongan_pemesanan'          => $potongan_pemesanan,
            'total_tagihan_pemesanan'     => $total_tagihan_pemesanan,
            'metode_pemesanan'            => $metode_pemesanan, 
            'tanggal_pemesanan'           => $tanggal_pemesanan,
            'status_pemesanan'            => $status_pemesanan,
            'status_pby_pemesanan'        => $status_pby_pemesanan        
        );  
        
        
        //DATA Ipemesanan
        $table_tmp = $this->Mod_pemesanan->get_all_ipemesanan_konsumen($id_konsumen)->result();


        //CONFIG EMAIL
        $data_konsumen = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'flash.gallery.kuningan@gmail.com',
            'smtp_pass' => 'bukadong19',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
    
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($data_konsumen['email_konsumen']);

        if($metode_pemesanan == "Pesan Antar" && $total_belanja_pemesanan < 99999){
            echo "Total belanja anda kurang dari Rp. 100.000";
        } else if($metode_pemesanan == "Pesan Ambil" && $total_belanja_pemesanan < 99999){
            echo "Total belanja anda kurang dari Rp. 100.000";
        } else{
            $this->email->subject('Pesanan Telah Dibuat');
            $this->email->message(
                'Kode pesanan : '.$kode_pemesanan.'<br>'.
                'Tanggal pesanan : '.$tanggal_pemesanan.'<br>'.
                'Metode pesanan : '.$metode_pemesanan.'<br>'.
                'Total Tagihan : Rp '.number_format($total_belanja_pemesanan, 0, ".", ".").'<br><br><br>'.
                'Silahkan melakukan pembayaran sesuai dengan tagihan dan rekening yang anda pilih. Selanjutnya upload bukti pembayaran ke dalam sistem kami.<br>'.
                'Info Lebih Lanjut Klik dibawah ini<br>http://localhost/flash_gallery/transaksi/detail/'.$kode_pemesanan.
                'Terima kasih'
            );
            
            if($this->email->send()){
                echo 1;

                $this->Mod_pemesanan->insert_pemesanan($data1);  
    
                foreach($table_tmp as $data){
                    if($data->kode_pemesanan == ""){
                        $kode_ipemesanan = $data->kode_ipemesanan;
                        $harga_ipemesanan = $data->harga_jual_produk; 
                        $promo_ipemesanan = $data->promo_produk; 
                        $jumlah_ipemesanan = $data->jumlah_ipemesanan; 
                        $subtotal_ipemesanan = $harga_ipemesanan * $jumlah_ipemesanan;

    
                        $data = array(
                            'kode_ipemesanan'       => $kode_ipemesanan,
                            'kode_pemesanan'        => $kode_pemesanan,
                            'harga_ipemesanan'      => $harga_ipemesanan,
                            'promo_ipemesanan'      => $promo_ipemesanan,
                            'subtotal_ipemesanan'   => $subtotal_ipemesanan,
                            'status_ipemesanan'     => '2'
                        );
                        
                        $this->Mod_pemesanan->update_ipemesanan($kode_ipemesanan, $data); 
                    }
                }
            }else{
                echo "Gagal, tidak ada koneksi internet, silahkan coba lagi.";
            }
        }  
    }










    //CHAT
    
    function load_chat(){ 
        $ses_akses = $this->session->userdata('ses_akses'); 
        $nonkonsumen_kontak_chat = $this->input->post('nonkonsumen_kontak_chat');

        if($ses_akses == "konsumen"){
            $id_konsumen = $this->session->userdata('ses_id_konsumen');
            $data['profil'] = $this->Mod_konsumen->get_konsumen($id_konsumen);
            $data['chat_konsumen'] = $this->Mod_master->get_chat_konsumen($id_konsumen);
        }elseif($ses_akses == "Nonkonsumen"){
            $nonkonsumen_kontak_chat = $this->session->userdata('ses_nonkonsumen_kontak_chat');
            $data['profil_konsumen'] = $this->Mod_master->get_chat_konsumen($nonkonsumen_kontak_chat);
            $data['chat_konsumen'] = $this->Mod_master->get_chat_konsumen($nonkonsumen_kontak_chat);
        }elseif($nonkonsumen_kontak_chat != ""){
            $data['profil_konsumen'] = $this->Mod_master->get_chat_konsumen($nonkonsumen_kontak_chat);
            $data['chat_konsumen'] = $this->Mod_master->get_chat_konsumen($nonkonsumen_kontak_chat);
        }
        $this->load->view('frontend/konsumen/chat/load_chat', $data);
    }

    function kirim_pesan_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
        $chat = $this->input->post('chat');
        $tanggal_chat = date("Y-m-d H:i:s");
        $status_chat = '1';
        $pengirim_chat = 'konsumen';

        if($chat == "" || $chat == NULL){
            echo 2;
        } else {
            echo 1;
                            
            $data  = array(
                'id_konsumen'         => $id_konsumen,
                'tanggal_chat'  => $tanggal_chat,
                'chat'              => $chat,
                'status_chat'       => $status_chat,
                'pengirim_chat'     => $pengirim_chat        
            );
                        
            $this->Mod_master->insert_chat($data);   

        }
    }

    function kirim_pesan_nonkonsumen(){
        $nonkonsumen_nama_chat = $this->input->post('nonkonsumen_nama_chat');
        $nonkonsumen_kontak_chat = $this->input->post('nonkonsumen_kontak_chat');
        $id_konsumen = $this->input->post('nonkonsumen_kontak_chat');
        $chat = $this->input->post('chat');
        $tanggal_chat = date("Y-m-d H:i:s");
        $status_chat = '1';
        $pengirim_chat = 'konsumen';

        if($chat == "" || $chat == NULL){
            echo 2;
        } else {
            echo 1;
                            
            $data  = array(
                'id_konsumen'                 => $id_konsumen,
                'tanggal_chat'          => $tanggal_chat,
                'chat'                      => $chat,
                'status_chat'               => $status_chat,
                'pengirim_chat'             => $pengirim_chat,
                'nonkonsumen_nama_chat'       => $nonkonsumen_nama_chat,
                'nonkonsumen_kontak_chat'     => $nonkonsumen_kontak_chat        
            );
                        
            $this->Mod_master->insert_chat($data);   

        }
    }

    function mulai_chat(){
        $nonkonsumen_nama_chat = $this->input->post('nonkonsumen_nama_chat');
        $nonkonsumen_kontak_chat = $this->input->post('nonkonsumen_kontak_chat');
        $id_konsumen = $this->input->post('nonkonsumen_kontak_chat');
        $chat = "Hai. Ada yang bisa saya bantu";
        $tanggal_chat = date("Y-m-d H:i:s");
        $status_chat = '2';
        $pengirim_chat = 'admin';

        $cek = $this->Mod_master->cek_chat($nonkonsumen_kontak_chat);

        if($nonkonsumen_nama_chat == NULL){
            echo 2;
        } else if($nonkonsumen_kontak_chat == NULL){
            echo 2;
        } else if($cek->num_rows() > 0) {
            echo 1;
            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses','Nonkonsumen');
            $this->session->set_userdata('ses_nonkonsumen_kontak_chat',$nonkonsumen_kontak_chat);
        } else {
            echo 1;
                            
            $data  = array(
                'id_konsumen'                 => $id_konsumen,
                'tanggal_chat'              => $tanggal_chat,
                'chat'                      => $chat,
                'status_chat'               => $status_chat,
                'pengirim_chat'             => $pengirim_chat,
                'nonkonsumen_nama_chat'       => $nonkonsumen_nama_chat,
                'nonkonsumen_kontak_chat'     => $nonkonsumen_kontak_chat     
            );
                        
            $this->Mod_master->insert_chat($data);   

        }
    }
    
    
    
    






    //DATA USER KONSUMEN
    function daftar(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        $data['pageTitle'] = "Daftar";

        $data['provinsi'] = $this->Mod_master->get_all_provinsi();

        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/daftar/body",$data);
        }
        else{
            $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/daftar/body",$data);
        }
    }

    function berhasil(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 

        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        $data['pageTitle'] = "Berhasil Daftar";
        $this->load->view("frontend/konsumen/berhasil/body",$data);
    }

    function verifikasi_email(){
        $data_konsumen = $this->Mod_konsumen->get_konsumen($this->uri->segment(3))->result();

        $data['pageTitle'] = "Verifikasi Email";
        $this->load->view("frontend/konsumen/verifikasi_email/body",$data);
      
    }
    
    function update_status_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
        $status_konsumen = "Aktif";

        echo 1;         
        $data  = array(
            'id_konsumen'                 => $id_konsumen,
            'status_konsumen'             => $status_konsumen,
        );    
        $this->Mod_konsumen->update_konsumen($id_konsumen, $data);
    }

    function profil(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  
        
        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();  
        $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
        $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($this->session->userdata('ses_id_konsumen'))->row_array();
        $data['provinsi'] = $this->Mod_master->get_all_provinsi();
        $data['kabupaten'] = $this->Mod_master->get_all_kabupaten();
        $data['kecamatan'] = $this->Mod_master->get_all_kecamatan();
        $data['desa'] = $this->Mod_master->get_all_desa();

        $data['pageTitle'] = "Profil";
        
        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/profil/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/home/body",$data);
        }
    }

    function tambah_konsumen(){
        $nama_konsumen = $this->input->post('nama_konsumen');
        $kode_provinsi = $this->input->post('kode_provinsi');
        $kode_kabupaten = $this->input->post('kode_kabupaten');
        $kode_kecamatan = $this->input->post('kode_kecamatan');
        $kode_desa = $this->input->post('kode_desa');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $alamat = $this->input->post('alamat');
        $email_konsumen = $this->input->post('email_konsumen_daftar');
        $kontak_konsumen = $this->input->post('kontak_konsumen_daftar');
        $password_konsumen = $this->input->post('password22');

        $id_konsumen = md5($email_konsumen.$kontak_konsumen);
        if($this->Mod_konsumen->get_kontak_konsumen($kontak_konsumen)->num_rows() > 0){
            echo "Kontak sudah terdaftar..!!";
        } 
        else if($this->Mod_konsumen->get_email_konsumen($email_konsumen)->num_rows() > 0){
            echo "Email sudah terdaftar..!!";
        } 
        else{
            $config['upload_path'] = './assets/img/konsumen/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){  
                $data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;
    
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $foto_konsumen = $data['upload_data']['file_name'];

                echo 1;         
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
                    'foto_konsumen'         => $foto_konsumen,
                    'daftar_konsumen'       => date("Y-m-d")
                );    
                $this->Mod_konsumen->insert_konsumen($data);

                
                $this->session->set_userdata('masuk',TRUE);
                $this->session->set_userdata('ses_akses','Konsumen');
                $this->session->set_userdata('ses_id_konsumen', $id_konsumen);
            }else{
                echo "Gambar harus diisi";
            }
        }
    }

    function edit_konsumen(){
        $id_konsumen = $this->input->post('id_konsumen');
        $nama_konsumen = $this->input->post('nama_konsumen');
        $kode_provinsi = $this->input->post('kode_provinsi');
        $kode_kabupaten = $this->input->post('kode_kabupaten');
        $kode_kecamatan = $this->input->post('kode_kecamatan');
        $kode_desa = $this->input->post('kode_desa');
        $rt = $this->input->post('rt');
        $rw = $this->input->post('rw');
        $alamat = $this->input->post('alamat');
        $email_konsumen_baru = $this->input->post('email_konsumen_baru');
        $email_konsumen_lama = $this->input->post('email_konsumen_lama');
        $kontak_konsumen_baru = $this->input->post('kontak_konsumen_baru');
        $kontak_konsumen_lama = $this->input->post('kontak_konsumen_lama');

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
            'id_konsumen'           => $id_konsumen,
            'nama_konsumen'         => $nama_konsumen,
            'kode_provinsi'         => $kode_provinsi,
            'kode_kabupaten'        => $kode_kabupaten,
            'kode_kecamatan'        => $kode_kecamatan,
            'kode_desa'             => $kode_desa,
            'alamat_konsumen'       => $alamat.'-'.$rt.'-'.$rw,
            'kontak_konsumen'       => $kontak_konsumen_baru,
            'email_konsumen'        => $email_konsumen_baru,
            'foto_konsumen'         => $foto_konsumen
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

    
    function logout(){
        echo 1; 
        $this->session->sess_destroy();
    }





    





    //TAMPILAN LAIN

    function select_kabupaten(){
		$kode_provinsi = $this->input->post('kode_provinsi');
        $data = $this->Mod_master->get_kabupaten($kode_provinsi)->result();
        echo json_encode($data);
    }

    function select_kecamatan(){
		$kode_kabupaten = $this->input->post('kode_kabupaten');
        $data = $this->Mod_master->get_kecamatan($kode_kabupaten)->result();
        echo json_encode($data);
    }

    function select_desa(){
		$kode_kecamatan = $this->input->post('kode_kecamatan');
        $data = $this->Mod_master->get_desa($kode_kecamatan)->result();
        echo json_encode($data);
    }
    
    function pedoman_berbelanja(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  
        
        $data['pageTitle'] = "Pedoman Berbelanja";

        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['provinsi'] = $this->Mod_master->get_all_provinsi()->result();
		$data['kabupaten'] = $this->Mod_master->get_all_kabupaten()->result();
		$data['kecamatan'] = $this->Mod_master->get_all_kecamatan()->result();
		$data['desa'] = $this->Mod_master->get_all_desa()->result();

        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/pedoman_berbelanja/body",$data);
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/pedoman_berbelanja/body",$data);
        }
    }

    function tentang(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  
        
        $data['pageTitle'] = "Tentang";
        
        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        
        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $this->load->view("frontend/konsumen/tentang/body",$data,"frontend/konsumen/tentang/footer");
        }
        else{
            // $this->session->sess_destroy();
            $this->load->view("frontend/konsumen/tentang/body",$data,"frontend/konsumen/tentang/footer");
        }
    }
}
