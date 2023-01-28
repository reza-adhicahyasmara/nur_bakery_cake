<?php 
//ini wajib dipanggil paling atas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//ini sesuaikan foldernya ke file 3 ini
require 'assets/plugins/PHPMailer/src/Exception.php';
require 'assets/plugins/PHPMailer/src/PHPMailer.php';
require 'assets/plugins/PHPMailer/src/SMTP.php';

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
        $data['data_diskon'] = $this->Mod_master->get_display_diskon()->result();
        $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
      
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
                $this->session->set_userdata('ses_nama_konsumen',$data['nama_konsumen']);
                $this->session->set_userdata('ses_kontak_konsumen',$data['kontak_konsumen']);
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
                $this->session->set_userdata('ses_nama_konsumen',$data['nama_konsumen']);
                $this->session->set_userdata('ses_kontak_konsumen',$data['kontak_konsumen']);
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

        if($kode_kategori == 'Terlaris'){
            $data['nama_kategori'] = $nama_kategori;
            $status_ipemesanan = 4;
            $data['data_produk'] = $this->Mod_pemesanan->cek_status_ipemesanan($status_ipemesanan)->result();
            $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
            $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
            $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
            $data['data_diskon'] = $this->Mod_master->get_display_diskon()->result();
            $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
        }elseif($kode_kategori == 'Semua'){
            $data['nama_kategori'] = $nama_kategori;
            $data['data_produk'] = $this->Mod_master->get_all_produk()->result();
            $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
            $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
            $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
            $data['data_diskon'] = $this->Mod_master->get_display_diskon()->result();
            $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
        }else{
            $data['nama_kategori'] = $nama_kategori;
            $data['data_produk'] = $this->Mod_master->get_cari_kategori($kode_kategori)->result();
            $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
            $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
            $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
            $data['data_diskon'] = $this->Mod_master->get_display_diskon()->result();
            $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
        }

        $this->load->view('frontend/konsumen/home/load_data_produk', $data);
    }
    
    function cari_produk(){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 

        $cari_produk1 = "%".$_POST['cari_produk']."%";
        $data['konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['data_produk'] = $this->Mod_master->get_cari_produk($cari_produk1)->result();
        $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
        $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
        $data['data_ulasan_produk'] = $this->Mod_pemesanan->get_ulasan_produk()->result();
        $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();
        $data['data_diskon'] = $this->Mod_master->get_display_diskon()->result();
        $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();

        $data['pageTitle'] = "Cari Produk";
        
        $this->load->view("frontend/konsumen/cari_produk/body",$data);
    }

    function detail_produk($kode_produk){
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['data_produk'] = $this->Mod_master->get_detail_produk($kode_produk)->row_array();
        $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
        $data['data_kategori'] = $this->Mod_master->get_all_kategori()->result();
        $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
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
            
        $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
		$data['data_keranjang'] = $this->Mod_pemesanan->get_all_ipemesanan_konsumen($id_konsumen)->result();
        $data['data_ukuran'] = $this->Mod_master->get_all_ukuran()->result();
        $data['data_idiskon'] = $this->Mod_master->get_display_idiskon()->result();
        $kode_pengaturan = 1;
		$data['data_pengaturan'] = $this->Mod_master->get_pengaturan($kode_pengaturan)->row_array();

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
        $kode_ukuran = $this->input->post('kode_ukuran');
        $kode_ipemesanan = $this->input->post('kode_ipemesanan');
        $qty_ipemesanan = $this->input->post('qty_ipemesanan');
        $status_ipemesanan = 1;

        $cek_produk = $this->Mod_pemesanan->cek_ipemesanan($id_konsumen, $kode_ukuran);
        if($cek_produk->num_rows() > 0){
            echo 2; 
            
            $produk = $this->Mod_pemesanan->cek_ipemesanan($id_konsumen, $kode_ukuran)->row_array();
            $kode_ipemesanan = $produk['kode_ipemesanan'];

            $data  = array(
                'kode_ipemesanan'       => $kode_ipemesanan,
                'qty_ipemesanan'        => $qty_ipemesanan + $produk['qty_ipemesanan'],       
            );
                        
            $this->Mod_pemesanan->update_ipemesanan($kode_ipemesanan, $data); 

        } 
        else if($id_konsumen != ""){
            echo 1;
                            
            $data  = array(
                'id_konsumen'           => $id_konsumen,
                'kode_produk'           => $kode_produk,
                'kode_ukuran'           => $kode_ukuran,
                'qty_ipemesanan'        => $qty_ipemesanan,
                'status_ipemesanan'     => $status_ipemesanan        
            );
                        
            $this->Mod_pemesanan->insert_ipemesanan($data);   
        } 
        else if($id_konsumen == ""){
            echo 3;
     
            $data  = array(
                'kode_ipemesanan'        => $kode_ipemesanan,      
                'qty_ipemesanan'        => $qty_ipemesanan,      
            );
            $this->Mod_pemesanan->update_ipemesanan($kode_ipemesanan, $data); 
        }
    }

    function hapus_keranjang(){
        $kode_ipemesanan = $this->input->post('kode_ipemesanan');
        $this->Mod_pemesanan->delete_ipemesanan($kode_ipemesanan);
    } 

    function update_checked(){
        $kode_ipemesanan = $this->input->post('kode_ipemesanan');
        $check_ipemesanan = $this->input->post('check_ipemesanan');
        foreach ($kode_ipemesanan as $row) {
        
            $data = array(
                'kode_ipemesanan'       => $row,
                'check_ipemesanan'      => $check_ipemesanan
            );
            
            $this->Mod_pemesanan->update_ipemesanan($row, $data); 
        }
    } 



 
    //CHECKOUT

    function cek_ongkir(){
        $kota_asal = $this->input->post('kota_asal');
        $kota_tujuan = $this->input->post('kota_tujuan');
        $kurir = $this->input->post('kurir');
        $berat = $this->input->post('berat');

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: a92cb2d8c3d01481046b2df77a662298"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            exit("cURL Error #:" . $err);
        }
        print_r($response);
        //echo json_decode($response);
    }
    
    function checkout(){
        //DATA PESANAN
        $kode_pemesanan = "INV.".date("Ymd-His"); 
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $tanggal_pemesanan = date("Y-m-d H:i:s");
        $rekening_pemesanan = $this->input->post('rekening_pemesanan');
        $total_belanja_pemesanan = $this->input->post('total_belanja_pemesanan');
        $total_tagihan_pemesanan = $this->input->post('total_tagihan_pemesanan');
        $status_pby_pemesanan =  "Belum Dibayarkan";
        $metode_pengiriman_pemesanan = $this->input->post('metode_pengiriman_pemesanan');
        $kurir_pemesanan = $this->input->post('kurir_pemesanan');
        $berat_pemesanan = $this->input->post('berat_pemesanan');
        $status_pemesanan = "1";
        


        //CONFIG EMAIL
        $data_konsumen = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
        $data_keranjang = $this->Mod_pemesanan->get_all_ipemesanan_konsumen($id_konsumen)->result();
        $data_ukuran = $this->Mod_master->get_all_ukuran()->result();
        $data_idiskon = $this->Mod_master->get_display_idiskon()->result();
        

        //SETTING FORM
        $email = $data_konsumen['email_konsumen'];
        $judul = 'Transaksi Pemesanan Selesai Dibuat';
        $pesan = 'Yth Bapak/Ibu konsumen Nur Bakery & Cake. Berikut kami kirimkan informasi pemesanan. <br><br>'.
                'Kode pesanan : '.$kode_pemesanan.'<br>'.
                'Tanggal pesanan : '.$tanggal_pemesanan.'<br>'.
                'Metode pesanan : '.$metode_pengiriman_pemesanan.'<br>'.
                'Pembayaran ke : '.$rekening_pemesanan.'<br>'.
                'Total Tagihan : Rp '.number_format($total_belanja_pemesanan, 0, ".", ".").'<br><br>'.
                'Silahkan melakukan pembayaran sesuai dengan tagihan dan rekening yang anda pilih. Selanjutnya upload bukti pembayaran ke dalam sistem kami.<br><br>'.
                'Info Lebih Lanjut Klik dibawah ini<br>http://localhost/nur_bakery_cake/transaksi/detail/'.$kode_pemesanan.'<br><br>'.
                'Terima kasih';
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
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $judul;
        $mail->Body    = $pesan;
        // $mail->addAttachment('../../file/'.$nama_file);
        $mail->AltBody = '';
        // $mail->AddEmbeddedImage('assets/img/banner/bx-cake.svg', 'logo'); //abaikan jika tidak ada logo
        //$mail->addAttachment(''); 

        if($mail->send()){
            //DATA PEMESANAN
            $data1  = array(
                'kode_pemesanan'                => $kode_pemesanan,
                'id_konsumen'                   => $id_konsumen,
                'tanggal_pemesanan'             => $tanggal_pemesanan,
                'rekening_pemesanan'            => $rekening_pemesanan,
                'total_belanja_pemesanan'       => $total_belanja_pemesanan,
                'total_tagihan_pemesanan'       => $total_tagihan_pemesanan,
                'status_pby_pemesanan'          => $status_pby_pemesanan,
                'metode_pengiriman_pemesanan'   => $metode_pengiriman_pemesanan,
                'kurir_pemesanan'               => $kurir_pemesanan, 
                'berat_pemesanan'               => $berat_pemesanan,
                'status_pemesanan'              => $status_pemesanan,        
            );  

            $this->Mod_pemesanan->insert_pemesanan($data1);  
        

            //DATA IPEMESANAN
            foreach($data_keranjang as $row1){
                if($row1->kode_pemesanan == "" && $row1->check_ipemesanan == "1"){
                                
                    //MENCARI POTONGAN HARGA
                    foreach($data_ukuran as $row2){
                        if($row2->kode_ukuran == $row1->kode_ukuran){
                            $harga_ukuran = $row2->harga_ukuran;

                            $subtotal_harga = $harga_ukuran * $row1->qty_ipemesanan;

                            foreach($data_idiskon as $row3){
                                if($row3->kode_ukuran == $row2->kode_ukuran){
                                    $potongan_idiskon = $row3->potongan_idiskon;
                                    $subtotal_harga = $harga_ukuran - (($potongan_idiskon * $harga_ukuran) / 100);

                                }else{
                                    $potongan_idiskon = 0;
                                }
                            }
                        }
                    }

                    $data = array(
                        'kode_ipemesanan'       => $row1->kode_ipemesanan,
                        'kode_pemesanan'        => $kode_pemesanan,
                        'harga_ipemesanan'      => $harga_ukuran,
                        'diskon_ipemesanan'     => $potongan_idiskon,
                        'subtotal_ipemesanan'   => $subtotal_harga,
                        'status_ipemesanan'     => '2'
                    );
                    
                    $this->Mod_pemesanan->update_ipemesanan($row1->kode_ipemesanan, $data); 
                }
            }

        } else {
            echo "Gagal";
        }
    }





    





    //TRANSAKSI KONSUMEN
    function transaksi() {
        $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_konsumen != null && $hak_akses == 'Konsumen'){
            $data['pageTitle'] = "Transaksi";

            $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
            $data['data_pemesanan'] = $this->Mod_pemesanan->get_pemesanan($id_konsumen)->result();
            $data['data_produk'] = $this->Mod_pemesanan->get_all_ipemesanan()->result();

            $this->load->view("frontend/konsumen/transaksi/body",$data);
        }
        else{  
            $this->session->sess_destroy();
            redirect('home');
        }  
    }

    function detail_transaksi(){ 
            $kode_pemesanan = $this->input->post('kode_pemesanan');
            $id_konsumen = $this->session->userdata('ses_id_konsumen'); 
        
            
            $data['data_konsumen'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
            $data['data_pemesanan'] = $this->Mod_pemesanan->get_detail_pemesanan($kode_pemesanan)->row_array();
            $data['data_produk'] = $this->Mod_pemesanan->get_all_list_pembelian($kode_pemesanan)->result();

            $this->load->view("frontend/konsumen/transaksi/body_detail",$data);
    }

    function invoice($kode_pemesanan){
        $data['pageTitle'] = "Invoice";
        
        $data['data_pemesanan'] = $this->Mod_pemesanan->get_detail_pemesanan($kode_pemesanan)->row_array();
        $data['data_produk'] = $this->Mod_pemesanan->get_all_list_pembelian($kode_pemesanan)->result();

        $this->load->view("frontend/konsumen/transaksi/invoice",$data);
    }


    //PEMBAYARAN
    function upload_pembayaran(){
        $kode_pemesanan = $this->input->post('kode_pemesanan_pembayaran');
        $status_pby_pemesanan = "Sudah Ditransfer";
        $status_pemesanan = "2";

        $config['upload_path'] = './assets/img/pemesanan';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 500;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->upload->initialize($config);

        if($this->upload->do_upload('file')){  
            $data = array('upload_data' => $this->upload->data());
            $bukti_pby_pemesanan = $data['upload_data']['file_name'];

            echo 1;         
            $save  = array( 
                'kode_pemesanan'        => $kode_pemesanan,
                'bukti_pby_pemesanan'   => $bukti_pby_pemesanan,
                'status_pby_pemesanan'  => $status_pby_pemesanan,
                'status_pemesanan'      => $status_pemesanan
            );
                        
            $this->Mod_pemesanan->update_pemesanan($kode_pemesanan, $save);   

        }else{
            echo "Data harus diisi";
        }
    }


    //PENERIMAAN PRODUK
    function verifikasi_proses_produk(){
        $id_karyawan = $this->input->post('id_karyawan');
        $kode_pemesanan = $this->input->post('kode_pemesanan');
        $metode_pby_pemesanan = $this->input->post('metode_pby_pemesanan');
        $status_pemesanan = $this->input->post('status_pemesanan');
 

        //UPDATE STATUS KARYAWAN
        if($metode_pby_pemesanan == "Cash on Delivery"){                 
            $status_pby_pemesanan = "Lunas";
            $data1  = array(
                'id_karyawan'         => $id_karyawan,
                'status_karyawan'     => "Ada"    
            );      
            $this->Mod_karyawan->update_karyawan($id_karyawan, $data1);  
        }else{
            $status_pby_pemesanan = $this->input->post('status_pby_pemesanan');
        }

        //UPDATE PEMESANAN
        $data2  = array( 
            'kode_pemesanan'        => $kode_pemesanan,
            'status_pby_pemesanan'  => $status_pby_pemesanan,
            'status_pemesanan'      => $status_pemesanan,
        );
                    
        $this->Mod_pemesanan->update_pemesanan($kode_pemesanan, $data2);  
        
        echo 1;         
    
    }





    //CHAT

    function mulai_chat(){
        $nama_chat = $this->input->post('nama_chat');
        $kontak_chat = $this->input->post('kontak_chat');

        $cek = $this->Mod_master->cek_chat($kontak_chat);
        if($cek->num_rows() > 0) {
            
            $data_konsumen = $this->Mod_master->cek_chat($kontak_chat)->row_array();

            $id_konsumen = $data_konsumen['id_konsumen'];
            $nama_chat_input = $data_konsumen['nama_konsumen'];

            $this->session->set_userdata('ses_akses','Konsumen');
            $this->session->set_userdata('ses_id_konsumen',$id_konsumen);
            $this->session->set_userdata('ses_nama_konsumen',$nama_chat_input);
            $this->session->set_userdata('ses_kontak_konsumen',$kontak_chat);

        } else {

            $id_konsumen = "";
            $nama_chat_input = $this->input->post('nama_chat');

            $this->session->set_userdata('masuk',TRUE);
            $this->session->set_userdata('ses_akses','Nonkonsumen');
            $this->session->set_userdata('ses_nama_nonkonsumen',$nama_chat);
            $this->session->set_userdata('ses_kontak_nonkonsumen',$kontak_chat);
        }

        echo 1;
                            
            $data  = array(
                'id_konsumen'       => $id_konsumen,
                'tanggal_chat'      => date("Y-m-d H:i:s"),
                'chat'              => "Hai. Ada yang bisa saya bantu kak ".$nama_chat_input.".. Silahkan ajukan pertanyaan kepada kami.",
                'status_chat'       => '2',
                'pengirim_chat'     => 'admin',
                'nama_chat'         => $nama_chat_input,
                'kontak_chat'       => $kontak_chat     
            );
                        
            $this->Mod_master->insert_chat($data);   
    }

    function load_chat(){  
        $ses_akses = $this->session->userdata('ses_akses'); 
        $id_konsumen = $this->session->userdata('ses_id_konsumen');;

        if($ses_akses == "Konsumen"){
            $data['kontak'] = $this->Mod_konsumen->get_konsumen($id_konsumen)->row_array();
            $data['chat'] = $this->Mod_master->get_chat_konsumen($id_konsumen)->result();
        }else{
            $kontak_chat = $this->session->userdata('ses_kontak_nonkonsumen');
            $data['chat'] = $this->Mod_master->get_chat_nonkonsumen($kontak_chat)->result();
        }
        $this->load->view('frontend/konsumen/chat/load_chat', $data);
    }

    function kirim_pesan(){
        $nama_chat = $this->input->post('nama_chat');
        $kontak_chat = $this->input->post('kontak_chat');
        $chat = $this->input->post('chat');

        if($chat == "" || $chat == NULL){
            echo 2;
        } else {
            if($this->session->userdata('ses_akses') == 'Konsumen') {
                $id_konsumen = $this->session->userdata('ses_id_konsumen');
                $nama_chat = $this->session->userdata('ses_nama_konsumen');
                $kontak_chat = $this->session->userdata('ses_kontak_konsumen');
            }else{
                $id_konsumen = "";
                $nama_chat = $this->session->userdata('ses_nama_nonkonsumen');
                $kontak_chat = $this->session->userdata('ses_kontak_nonkonsumen');
            }

            echo 1;
                            
            $data  = array(
                'id_konsumen'       => $id_konsumen,
                'tanggal_chat'      => date("Y-m-d H:i:s"),
                'chat'              => $chat,
                'status_chat'       => '1',
                'pengirim_chat'     => 'konsumen',
                'nama_chat'         => $nama_chat,
                'kontak_chat'       => $kontak_chat        
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
