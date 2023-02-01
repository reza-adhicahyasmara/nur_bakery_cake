<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_pemesanan extends CI_Model {

    function get_all_list_pembelian($kode_pemesanan){
        $query2 = $this->db->query("SELECT produk.kode_produk AS xxx, ipemesanan.*, produk.*, kategori.*, ukuran.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE ipemesanan.kode_pemesanan = '$kode_pemesanan'
                                    GROUP BY ipemesanan.kode_ipemesanan
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function cek_perimaan_kosong($kode_pemesanan){
        $this->db->select('*');
        $this->db->from('ipemesanan');
        $this->db->where('kode_pemesanan', $kode_pemesanan);
        $this->db->where('status_penerimaan_ipemesanan', 'Proses');
        return $this->db->get();
    }

    function cek_perimaan_baik($kode_pemesanan){
        $this->db->select('*');
        $this->db->from('ipemesanan');
        $this->db->where('kode_pemesanan', $kode_pemesanan);
        $this->db->where('status_penerimaan_ipemesanan', 'Baik');
        return $this->db->get();
    }

    function cek_perimaan_buruk($kode_pemesanan){
        $this->db->select('*');
        $this->db->from('ipemesanan');
        $this->db->where('kode_pemesanan', $kode_pemesanan);
        $this->db->where('status_penerimaan_ipemesanan', 'Komplain');
        return $this->db->get();
    }



    //IPEMESANAN
    function get_all_ipemesanan(){
        $query2 = $this->db->query("SELECT ipemesanan.*, produk.*, kategori.*, ukuran.*, produk.kode_produk AS hahaha
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_all_ipemesanan_konsumen($id_konsumen){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.kode_produk AS xxx,  ipemesanan.*, produk.*, kategori.*, ukuran.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE ipemesanan.id_konsumen = '$id_konsumen'
                                    GROUP BY ipemesanan.kode_ipemesanan
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_potongan_ipemesanan_konsumen($id_konsumen){
        $query2 = $this->db->query("SELECT SUM(qty_ipemesanan) as jumlah_pemesanan, kategori.* ,ipemesanan.*, produk.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    WHERE ipemesanan.id_konsumen = '$id_konsumen'
                                    GROUP BY kategori.kode_kategori
                                ");
        return $query2;
    }

    function insert_ipemesanan($data){
        return $this->db->insert('ipemesanan', $data);
    }

    function cek_ipemesanan($id_konsumen, $kode_ukuran){
        $query2 = $this->db->query("SELECT *
                                    FROM ipemesanan
                                    WHERE id_konsumen = '$id_konsumen'
                                    AND kode_ukuran = '$kode_ukuran'
                                    AND status_ipemesanan = '1'
                                ");
        return $query2;
    }

    function cek_status_ipemesanan($status_ipemesanan){
        $this->db->select('ipemesanan.*, produk.kode_produk AS hahaha, produk.*, kategori.*, ukuran.*');
        $this->db->from('ipemesanan');
        $this->db->join('produk', 'produk.kode_produk = ipemesanan.kode_produk', 'inner');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->join('ukuran', 'ukuran.kode_produk = produk.kode_produk', 'left');
        $this->db->where('ipemesanan.status_ipemesanan', $status_ipemesanan);
        return $this->db->get();
    }

    function update_ipemesanan($kode_ipemesanan, $data){
        $this->db->where('kode_ipemesanan', $kode_ipemesanan);
        $this->db->update('ipemesanan', $data);
    }

    function delete_ipemesanan($kode){
        $this->db->where('kode_ipemesanan', $kode);
        $this->db->delete('ipemesanan');
    }

    function get_detail_produk($kode_produk){
        $this->db->select('produk.kode_produk AS hahaha, produk.*, kategori.*, ukuran.*');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->where('produk.kode_produk', $kode_produk);
        return $this->db->get();
    }

    function get_ulasan_produk(){
        $query2 = $this->db->query("SELECT produk.kode_produk AS kode, ipemesanan.*, produk.*, pemesanan.*, konsumen.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN pemesanan ON pemesanan.kode_pemesanan = ipemesanan.kode_pemesanan
                                    LEFT JOIN konsumen ON konsumen.id_konsumen = pemesanan.id_konsumen
                                ");
        return $query2;
    }



    //pemesanan
    function get_all_pemesanan(){
        $this->db->select('pemesanan.*, konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*, karyawan.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'inner');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pemesanan.id_karyawan', 'left');
        return $this->db->get();
    }

    function get_pemesanan($id_konsumen){
        $this->db->select('pemesanan.*, konsumen.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'inner');
        $this->db->where('pemesanan.id_konsumen', $id_konsumen);
        return $this->db->get();
    }

    function get_detail_pemesanan($kode_pemesanan){
        $this->db->select('pemesanan.*, konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*, karyawan.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'inner');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pemesanan.id_karyawan', 'left');
        $this->db->where('pemesanan.kode_pemesanan', $kode_pemesanan);
        return $this->db->get();
    }

    function insert_pemesanan($data){
        return $this->db->insert('pemesanan', $data);
    }

    function update_pemesanan($kode_pemesanan, $data){
        $this->db->where('kode_pemesanan', $kode_pemesanan);
        $this->db->update('pemesanan', $data);
    }
    
    function grafik_transaksi(){
        $countLimit = $this->db->query("SELECT SUM(total_tagihan_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'Antar Cepat' AS jenis 
                                        FROM pemesanan
                                        WHERE metode_pengiriman_pemesanan = 'Antar Cepat'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        GROUP BY bulan
                                        UNION
                                        SELECT SUM(total_tagihan_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'Ekspedisi' AS jenis
                                        FROM pemesanan
                                        WHERE metode_pengiriman_pemesanan = 'Ekspedisi'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        GROUP BY bulan
                                        UNION
                                        SELECT SUM(total_tagihan_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'Ambil Sendiri' AS jenis
                                        FROM pemesanan
                                        WHERE metode_pengiriman_pemesanan = 'Ambil Sendiri'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        GROUP BY bulan");
        return $countLimit;
    }
    
    function grafik_kepuasan(){
        $countLimit = $this->db->query("SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_0' AS jenis 
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '0'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan
                                        UNION
                                        SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_1' AS jenis 
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '1'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan
                                        UNION
                                        SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_2' AS jenis 
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '2'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan
                                        UNION
                                        SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_3' AS jenis 
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '3'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan
                                        UNION
                                        SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_4' AS jenis 
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '4'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan
                                        UNION
                                        SELECT COUNT(rating_pemesanan) AS jumlah, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun, 'rating_5' AS jenis
                                        FROM pemesanan
                                        WHERE rating_pemesanan = '5'
                                        AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())
                                        AND ulasan_pemesanan IS NOT NULL
                                        GROUP BY bulan");
        return $countLimit;
    }

    function grafik_pesan_antar(){
        $this->db->select("COUNT(kode_pemesanan) AS pemesanan, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun");
        $this->db->from('pemesanan');
        $this->db->where('status_pemesanan', '5');
        $this->db->where('metode_pengiriman_pemesanan', 'Transfer');
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_pesan_ambil(){
        $this->db->select("COUNT(kode_pemesanan) AS pemesanan, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun");
        $this->db->from('pemesanan');
        $this->db->where('status_pemesanan', '5');
        $this->db->where('metode_pengiriman_pemesanan', 'Cash on Delivery');
        $this->db->group_by('bulan');
        return $this->db->get();
    }

    function grafik_batal(){
        $this->db->select("COUNT(kode_pemesanan) AS pemesanan, MONTH(tanggal_pemesanan) AS bulan, YEAR(tanggal_pemesanan) AS tahun");
        $this->db->from('pemesanan');
        $this->db->where('status_pemesanan', '6');
        $this->db->group_by('bulan');
        return $this->db->get();
    }


    function get_laporan($tanggal_awal, $tanggal_akhir, $metode_pembelian, $status_pemesanan){
        $this->db->select('pemesanan.*, konsumen.*, karyawan.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pemesanan.id_karyawan', 'left');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->where("pemesanan.tanggal_pemesanan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("pemesanan.metode_pengiriman_pemesanan", "$metode_pembelian");
        $this->db->where("pemesanan.status_pemesanan IN($status_pemesanan)");
        return $this->db->get();
    }

}