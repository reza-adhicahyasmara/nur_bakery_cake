<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function index() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses');  

        if($id_karyawan != null && $hak_akses == 'Admin'){

            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            
            //TRANSAKSI
            $grafik_transaksi = $this->Mod_pemesanan->grafik_transaksi();
            foreach($grafik_transaksi->result() as $kasep){
                if($kasep->jenis == "Antar Cepat"){
                    $jumlah_antar_cepat[] = $kasep->jumlah;
                    $bulan_tahun[] = $bulan[$kasep->bulan];
                }

                if($kasep->jenis == "Antar Ekspedisi"){
                    $jumlah_antar_ekspedisi[] = $kasep->jumlah;
                }

                if($kasep->jenis == "Ambil Sendiri"){
                    $jumlah_ambil_sendiri[] = $kasep->jumlah;
                }

            }

            //ANTAR CEPAT
            if (!isset($jumlah_antar_cepat)){ $jumlah_antar_cepat = NULL; }
            if (!isset($jumlah_antar_ekspedisi)){ $jumlah_antar_ekspedisi = NULL; }
            if (!isset($jumlah_ambil_sendiri)){ $jumlah_ambil_sendiri = NULL; }
            if (!isset($bulan_tahun)){ $bulan_tahun = NULL; }

            $data['jumlah_antar_cepat'] = json_encode($jumlah_antar_cepat);
            $data['jumlah_antar_ekspedisi'] = json_encode($jumlah_antar_ekspedisi);
            $data['jumlah_ambil_sendiri'] = json_encode($jumlah_ambil_sendiri);
            $data['bulan_tahun'] = json_encode($bulan_tahun);

            //RATING 1
            $grafik_raing = $this->Mod_pemesanan->grafik_kepuasan();
            foreach($grafik_raing->result() as $kasep){
                if($kasep->jenis == "rating_0"){
                    $jumlah_rating_0[] = $kasep->jumlah;
                    $bulan_tahun[] = $bulan[$kasep->bulan];
                }
                if($kasep->jenis == "rating_1"){
                    $jumlah_rating_1[] = $kasep->jumlah;
                }
                if($kasep->jenis == "rating_2"){
                    $jumlah_rating_2[] = $kasep->jumlah;
                }
                if($kasep->jenis == "rating_3"){
                    $jumlah_rating_3[] = $kasep->jumlah;
                }
                if($kasep->jenis == "rating_4"){
                    $jumlah_rating_4[] = $kasep->jumlah;
                }
                if($kasep->jenis == "rating_5"){
                    $jumlah_rating_5[] = $kasep->jumlah;
                }
            }

            if (!isset($jumlah_rating_0)){ $jumlah_rating_0 = NULL; }
            if (!isset($bulan_tahun_rating_0)){ $bulan_tahun_rating_0 = NULL; }
            if (!isset($jumlah_rating_1)){ $jumlah_rating_1 = NULL; }
            if (!isset($jumlah_rating_2)){ $jumlah_rating_2 = NULL; }
            if (!isset($jumlah_rating_3)){ $jumlah_rating_3 = NULL; }
            if (!isset($jumlah_rating_4)){ $jumlah_rating_4 = NULL; }
            if (!isset($jumlah_rating_5)){ $jumlah_rating_5 = NULL; }

            $data['jumlah_rating_0'] = json_encode($jumlah_rating_0);
            $data['bulan_tahun_rating_0'] = json_encode($bulan_tahun_rating_0);
            $data['jumlah_rating_1'] = json_encode($jumlah_rating_1);
            $data['jumlah_rating_2'] = json_encode($jumlah_rating_2);
            $data['jumlah_rating_3'] = json_encode($jumlah_rating_3);
            $data['jumlah_rating_4'] = json_encode($jumlah_rating_4);
            $data['jumlah_rating_5'] = json_encode($jumlah_rating_5);

            $data['pageTitle'] = "Dashboard";

            $data['pageTitle'] = "Dashboard";
            $this->load->view("backend/admin/dashboard/body",$data);
        }
        else{ 
            redirect('login');
        }  
    }
}