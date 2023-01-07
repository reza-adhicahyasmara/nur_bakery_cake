<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Produk extends CI_Controller {

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
            $data['pageTitle'] = "Data Produk";
            $this->load->view("backend/admin/produk/body",$data,"backend/admin/produk/footer");
        }
        else{ 
            redirect('login');
        } 
    }

    function load_data_produk(){
        $data['produk'] = $this->Mod_master->get_all_produk();
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $this->load->view('backend/admin/produk/load_data_produk', $data);
    }

    function form_tambah_produk(){
        $data['kategori'] = $this->Mod_master->get_all_kategori();
        $this->load->view("backend/admin/produk/form_tambah_produk", $data);
    }

    function form_edit_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $data['kategori'] = $this->Mod_master->get_all_kategori();
		$data['produk'] = $this->Mod_master->get_produk($kode_produk)->row_array();
		$this->load->view("backend/admin/produk/form_edit_produk", $data);
    }

    
    function tambah_edit_produk(){
        $jenis = $this->input->post('jenis');
    
        $kode_produk_baru = $this->input->post('kode_produk_baru');
        $kode_produk_lama = $this->input->post('kode_produk_lama');
        $kode_kategori = $this->input->post('kode_kategori');
        $nama_produk = $this->input->post('nama_produk');     
        $bentuk_produk = $this->input->post('bentuk_produk');     
        $penyajian_produk = $this->input->post('penyajian_produk');   
        $penyimpanan_produk = $this->input->post('penyimpanan_produk');        
        $pengemasan_produk = $this->input->post('pengemasan_produk');          
        $aksesoris_produk = $this->input->post('aksesoris_produk');          
        $deskripsi_produk = $this->input->post('deskripsi_produk');             

        $config['upload_path'] = './assets/img/produk/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|PNG';
        $this->upload->initialize($config);

        $cek_kode = $this->Mod_master->get_produk($kode_produk_baru);    

        if($jenis == "Tambah"){
            if($cek_kode->num_rows() > 0){
                echo "Kode produk sudah terdaftar..!!";
            }
            else{
                if($this->upload->do_upload('file')){  
                    $data = array('upload_data' => $this->upload->data());
                    $config['image_library'] = 'gd2';
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 500;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar_produk = $data['upload_data']['file_name'];
                }else{
                    $gambar_produk = "";  
                }

                echo 1;                 
                $data  = array( 
                    'kode_produk'           => $kode_produk_baru,
                    'kode_kategori'         => $kode_kategori,
                    'nama_produk'           => $nama_produk,
                    'bentuk_produk'         => $bentuk_produk,
                    'penyajian_produk'      => $penyajian_produk,
                    'penyimpanan_produk'    => $penyimpanan_produk,
                    'pengemasan_produk'     => $pengemasan_produk,
                    'aksesoris_produk'      => $aksesoris_produk,
                    'deskripsi_produk'      => $deskripsi_produk,
                    'gambar_produk'         => $gambar_produk,
                );
                $this->Mod_master->insert_produk($data); 
                
                $item = $this->Mod_master->get_all_ukuran()->result();

                foreach($item as $row){
                    if ($row->kode_produk == NULL){
                        $kode_ukuran = $row->kode_ukuran;

                        $data = array(
                            'kode_ukuran'   => $kode_ukuran,
                            'kode_produk'   => $kode_produk_baru
                        );
                        
                        $this->Mod_master->update_ukuran($kode_ukuran, $data); 
                    }
                }
            }   
        }
        elseif($jenis == "Edit"){  

            if($this->upload->do_upload('file')){      
                $gambar_produk_lama = $this->input->post('gambar_produk_lama');  
                if($gambar_produk_lama != NULL){
                    unlink('assets/img/produk/'.$gambar_produk_lama);
                }

                $data = array('upload_data' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 500;

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar_produk = $data['upload_data']['file_name'];
            }else{
                $gambar_produk = $this->input->post('gambar_produk_lama');
            }
            
            $data  = array( 
                'kode_produk'           => $kode_produk_baru,
                'kode_kategori'         => $kode_kategori,
                'nama_produk'           => $nama_produk,
                'bentuk_produk'         => $bentuk_produk,
                'penyajian_produk'      => $penyajian_produk,
                'penyimpanan_produk'    => $penyimpanan_produk,
                'pengemasan_produk'     => $pengemasan_produk,
                'aksesoris_produk'      => $aksesoris_produk,
                'deskripsi_produk'      => $deskripsi_produk,
                'gambar_produk'         => $gambar_produk,
            );

            if($kode_produk_baru != $kode_produk_lama){
                if($cek_kode->num_rows() > 0){
                    echo "Kode produk sudah terdaftar..!!";
                }else{
                    echo 1;
                    $this->Mod_master->update_produk($kode_produk_lama, $data);    
                }
            }
            else{
                echo 1;
                $this->Mod_master->update_produk($kode_produk_lama, $data);  
            }    
        }      
    }

    function hapus_produk(){
        $kode_produk = $this->input->post('kode_produk');
        $gambar_produk = $this->input->post('gambar_produk');

        $this->Mod_master->delete_produk($kode_produk);
        $this->Mod_master->delete_all_ukuran($kode_produk);

        unlink('assets/img/produk/'.$gambar_produk);
    }   




    

    
    ////////////////////-----PRODUK LIST-----////////////////////

    function load_data_ukuran(){
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $this->load->view('backend/admin/produk/load_data_ukuran', $data);
    }

    function load_data_edit_ukuran(){
        $data['kode_produk'] = $this->input->post('kode_produk');
        $data['ukuran'] = $this->Mod_master->get_all_ukuran();
        $this->load->view('backend/admin/produk/load_data_edit_ukuran', $data);
    }

    function tambah_edit_ukuran(){ 
        $kode_produk = $this->input->post('kode_produk');
        $kode_ukuran = $this->input->post('kode_ukuran');
        $volume_ukuran = $this->input->post('volume_ukuran');
        $irisan_ukuran = $this->input->post('irisan_ukuran');
        $berat_ukuran = $this->input->post('berat_ukuran');
        $harga_ukuran = $this->input->post('harga_ukuran');

        if($volume_ukuran == ""){
            echo "Volume harus disii.!";
        }elseif($irisan_ukuran == ""){
            echo "Irisan harus disii.!";
        }elseif($berat_ukuran == ""){
            echo "Berat harus disii.!";
        }elseif($harga_ukuran == ""){
            echo "Harga harus disii.!";
        }else{
        
            if($kode_ukuran == ""){
                echo 1;     
                $data  = array( 
                    'kode_produk'       => $kode_produk,  
                    'volume_ukuran'     => $volume_ukuran,  
                    'irisan_ukuran'     => $irisan_ukuran,  
                    'berat_ukuran'      => $berat_ukuran,  
                    'harga_ukuran'      => $harga_ukuran,  
                );
                            
                $this->Mod_master->insert_ukuran($data);    
                
            }else{
                echo 1;
                $data  = array( 
                    'kode_produk'       => $kode_produk,  
                    'volume_ukuran'     => $volume_ukuran, 
                    'irisan_ukuran'     => $irisan_ukuran,   
                    'berat_ukuran'      => $berat_ukuran,  
                    'harga_ukuran'      => $harga_ukuran,  
                );
                            
                $this->Mod_master->update_ukuran($kode_ukuran, $data);   
            
            }    
        }
    }

    function hapus_ukuran(){
        $kode_ukuran = $this->input->post('kode_ukuran');
        $this->Mod_master->delete_ukuran($kode_ukuran);
    } 
}