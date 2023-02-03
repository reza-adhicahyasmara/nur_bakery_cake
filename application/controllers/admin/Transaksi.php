<?php 
defined('BASEPATH') || exit('No direct script access allowed');

require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mod_karyawan');
        $this->load->model('Mod_konsumen');
        $this->load->model('Mod_master');
        $this->load->model('Mod_pemesanan');
    }

    function ambil_sendiri() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Ambil Sendiri";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_ambil_sendiri",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function antar_cepat() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Antar Cepat";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_antar_cepat",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function antar_ekspedisi() {
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 

        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Transaksi Antar Ekspedisi";

            $data['data_pemesanan'] = $this->Mod_pemesanan->get_all_pemesanan()->result();

            $this->load->view("backend/admin/transaksi/body_antar_ekspedisi",$data);
        }
        else{  
            redirect('login');
        }  
    }

    function detail($kode_pemesanan){
        $id_karyawan = $this->session->userdata('ses_id_karyawan');  
        $hak_akses = $this->session->userdata('ses_akses'); 
        
        if($id_karyawan != null && $hak_akses == 'Admin'){
            $data['pageTitle'] = "Detail Transaksi";
            
            $data['data_detail'] = $this->Mod_pemesanan->get_detail_pemesanan($kode_pemesanan)->row_array();
            $data['list_produk'] = $this->Mod_pemesanan->get_all_list_pembelian($kode_pemesanan)->result();
            $data['data_karyawan'] = $this->Mod_karyawan->get_all_karyawan()->result();

            $this->load->view("backend/admin/transaksi/body_detail",$data);
        }
        else{  
            redirect('login');
        }
    }




    
    function proses_transaksi(){
        $id_karyawan = $this->input->post('id_karyawan');
        $kode_pemesanan = $this->input->post('kode_pemesanan');
        $noresi_pemesanan = $this->input->post('noresi_pemesanan');
        $metode_pby_pemesanan = $this->input->post('metode_pby_pemesanan');
        $status_pby_pemesanan = $this->input->post('status_pby_pemesanan');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $keterangan_pemesanan = $this->input->post('keterangan_pemesanan');

        echo 1;         
        $data1  = array( 
            'kode_pemesanan'        => $kode_pemesanan,
            'id_karyawan'           => $id_karyawan,
            'noresi_pemesanan'      => $noresi_pemesanan,
            'status_pby_pemesanan'  => $status_pby_pemesanan,
            'status_pemesanan'      => $status_pemesanan,
            'keterangan_pemesanan'  => $keterangan_pemesanan
        );
                    
        $this->Mod_pemesanan->update_pemesanan($kode_pemesanan, $data1);    
        

        //UPDATE STATUS KARYAWAN
        if($status_pemesanan == 4 && $metode_pby_pemesanan == "Antar Cepat"){
            
            $data2  = array(
                'id_karyawan'         => $id_karyawan,
                'status_karyawan'     => 'Tidak'    
            );      
            $this->Mod_karyawan->update_karyawan($id_karyawan, $data2);  
        }
    
    }




    function download(){
        $this->load->helper('download');
        if($this->uri->segment(4)){
            $data   = file_get_contents('./assets/img/pemesanan/'.$this->uri->segment(4));
        }
        $name   = $this->uri->segment(4);
        force_download($name, $data);
    }




    function laporan_data_pemesanan(){

        $tanggal_awal = $this->input->post("tanggal_awal");
        $tanggal_akhir = $this->input->post("tanggal_akhir");
        $status_pemesanan = $this->input->post("status_pemesanan");
        $metode_pengiriman_pemesanan = $this->input->post("metode_pengiriman_pemesanan");
        
        if($status_pemesanan == "'1'"){
            $status_judul = "Menunggu Transfer";
        } elseif($status_pemesanan == "'2'"){
            $status_judul = "Validasi Pembayaran";
        } elseif($status_pemesanan == "'3'"){
            $status_judul = "Proses Pembuatan Produk";
        } elseif($status_pemesanan == "'4'"){
            $status_judul = "Produk Dikirim";
        } elseif($status_pemesanan == "'5'"){
            $status_judul = "Produk Siap Ambil";
        } elseif($status_pemesanan == "'6'"){
            $status_judul = "Selesai";
        } elseif($status_pemesanan == "'7'"){
            $status_judul = "Batal";
        } else {
            $status_judul = "Semua";
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]

        ];
        $sheet->setCellValue('A1', "LAPORAN TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1

        $sheet->setCellValue('A2', $tanggal_awal.' s.d. '.$tanggal_akhir ); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A2:O2'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1

        $sheet->setCellValue('A3', '(Status Transaksi: '.$status_judul.') - (Metode Pembelian: '.$metode_pengiriman_pemesanan.')' ); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A3:O3'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A3')->getFont()->setBold(true); // Set bold kolom A1



        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A5', "NO");
        $sheet->setCellValue('B5', "INVOICE"); 
        $sheet->setCellValue('C5', "TGL PEMBELIAN"); 
        $sheet->setCellValue('D5', "NAMA");
        $sheet->setCellValue('E5', "ALAMAT"); 
        $sheet->setCellValue('F5', "KONTAK"); 
        $sheet->setCellValue('G5', "METODE PEMBELIAN"); 
        $sheet->setCellValue('H5', "KURIR"); 
        $sheet->setCellValue('I5', "PETUGAS"); 
        $sheet->setCellValue('J5', "STATUS PEMBAYARAN"); 
        $sheet->setCellValue('K5', "TOTAL BELANJA"); 
        $sheet->setCellValue('L5', "BIAYA PENGIRIMAN"); 
        $sheet->setCellValue('M5', "TOTAL TAGIHAN"); 
        $sheet->setCellValue('N5', "STATUS"); 
        $sheet->setCellValue('O5', "KETERANGAN"); 
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A5')->applyFromArray($style_col);
        $sheet->getStyle('B5')->applyFromArray($style_col);
        $sheet->getStyle('C5')->applyFromArray($style_col);
        $sheet->getStyle('D5')->applyFromArray($style_col);
        $sheet->getStyle('E5')->applyFromArray($style_col);
        $sheet->getStyle('F5')->applyFromArray($style_col);
        $sheet->getStyle('G5')->applyFromArray($style_col);
        $sheet->getStyle('H5')->applyFromArray($style_col);
        $sheet->getStyle('I5')->applyFromArray($style_col);
        $sheet->getStyle('J5')->applyFromArray($style_col);
        $sheet->getStyle('K5')->applyFromArray($style_col);
        $sheet->getStyle('L5')->applyFromArray($style_col);
        $sheet->getStyle('M5')->applyFromArray($style_col);
        $sheet->getStyle('N5')->applyFromArray($style_col);
        $sheet->getStyle('O5')->applyFromArray($style_col);
        //Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        
        $siswa = $this->Mod_pemesanan->get_laporan($tanggal_awal, $tanggal_akhir, $status_pemesanan, $metode_pengiriman_pemesanan)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($siswa as $data){ // Lakukan looping pada variabel siswa
            $kurir = explode("|",$data->kurir_pemesanan);
            $alamat_konsumen = explode("-", $data->alamat_konsumen); 
            if($data->status_pemesanan == 1){
                $status_pemesanan = "Menunggu Transfer";
            } elseif($data->status_pemesanan == 2){
                $status_pemesanan = "Validasi Pembayaran";
            } elseif($data->status_pemesanan == 3){
                $status_pemesanan = "Proses Pembuatan";
            } elseif($data->status_pemesanan == 4){
                $status_pemesanan = "Produk Dikirim";
            } elseif($data->status_pemesanan == 5){
                $status_pemesanan = "Produk Siap Ambil";
            } elseif($data->status_pemesanan == 6){
                $status_pemesanan = "Selesai";
            } elseif($data->status_pemesanan == 7){
                $status_pemesanan = "Batal";
            }
            
            $sheet->setCellValue('A'.$numrow, $no);
            $sheet->setCellValue('B'.$numrow, $data->kode_pemesanan);
            $sheet->setCellValue('C'.$numrow, $data->tanggal_pemesanan);
            $sheet->setCellValue('D'.$numrow, $data->nama_konsumen);
            $sheet->setCellValue('E'.$numrow, $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2]." Desa/Lingk. ".$data->nama_desa.", kec. ".$data->nama_kecamatan.", kab. ".$data->nama_kabupaten.", prov. ".$data->nama_provinsi);
            $sheet->setCellValue('F'.$numrow, $data->kontak_konsumen);
            $sheet->setCellValue('G'.$numrow, $data->metode_pengiriman_pemesanan);
            $sheet->setCellValue('H'.$numrow, $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)");
            $sheet->setCellValue('I'.$numrow, $data->nama_karyawwan);
            $sheet->setCellValue('J'.$numrow, $data->status_pby_pemesanan);
            $sheet->setCellValue('K'.$numrow, "Rp. ".number_format($data->total_belanja_pemesanan), 0, ".", ".");
            $sheet->setCellValue('L'.$numrow, "Rp. ".number_format($kurir[3]), 0, ".", ".");
            $sheet->setCellValue('M'.$numrow, "Rp. ".number_format($data->total_tagihan_pemesanan), 0, ".", ".");
            $sheet->setCellValue('N'.$numrow, $status_pemesanan);
            $sheet->setCellValue('O'.$numrow, $data->keterangan_pemesanan);
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('M'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('N'.$numrow)->applyFromArray($style_row);
            $sheet->getStyle('O'.$numrow)->applyFromArray($style_row);
            
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(40); 
        $sheet->getColumnDimension('F')->setWidth(30); 
        $sheet->getColumnDimension('G')->setWidth(30); 
        $sheet->getColumnDimension('H')->setWidth(40); 
        $sheet->getColumnDimension('I')->setWidth(30); 
        $sheet->getColumnDimension('J')->setWidth(30); 
        $sheet->getColumnDimension('K')->setWidth(30); 
        $sheet->getColumnDimension('L')->setWidth(30); 
        $sheet->getColumnDimension('M')->setWidth(30); 
        $sheet->getColumnDimension('N')->setWidth(30); 
        $sheet->getColumnDimension('O')->setWidth(50); 
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Siswa");
        // Proses file excel
        $fileName = 'Laporan Transaksi ('.$tanggal_awal.' s.d. '.$tanggal_akhir.').xlsx';  
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=Report.xlsx");
        header("Content-Transfer-Encoding: binary ");

// Write file to the browser
        $writer = new Xlsx($spreadsheet);
		$writer->save("assets/berkas/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/assets/berkas/".$fileName);
    
    }

}