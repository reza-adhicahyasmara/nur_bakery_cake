<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_pemesanan extends CI_Model {

    function get_all_list_pembelian($kode_pemesanan){
        $query2 = $this->db->query("SELECT produk.kode_produk AS xxx, ipemesanan.*, produk.*, kategori.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
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
        $query2 = $this->db->query("SELECT ipemesanan.*, produk.*, kategori.*, produk.kode_produk AS hahaha
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_all_ipemesanan_konsumen($id_konsumen){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.kode_produk AS xxx,  ipemesanan.*, produk.*, kategori.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    WHERE ipemesanan.id_konsumen = '$id_konsumen'
                                    GROUP BY ipemesanan.kode_ipemesanan
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_potongan_ipemesanan_konsumen($id_konsumen){
        $query2 = $this->db->query("SELECT SUM(jumlah_ipemesanan) as jumlah_pemesanan, kategori.* ,ipemesanan.*, produk.*
                                    FROM ipemesanan
                                    INNER JOIN produk ON produk.kode_produk = ipemesanan.kode_produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    WHERE ipemesanan.id_konsumen = '$id_konsumen'
                                    GROUP BY kategori.kode_kategori
                                ");
        return $query2;
    }

    function inseripemesanan($data){
        return $this->db->insert('ipemesanan', $data);
    }

    function cek_ipemesanan($id_konsumen, $kode_produk){
        $query2 = $this->db->query("SELECT *
                                    FROM ipemesanan
                                    WHERE id_konsumen = '$id_konsumen'
                                    AND kode_produk = '$kode_produk'
                                    AND status_ipemesanan = '1'
                                ");
        return $query2;
    }

    function cek_status_ipemesanan(){
        $this->db->select('ipemesanan.*, produk.*');
        $this->db->from('ipemesanan');
        $this->db->join('produk', 'produk.kode_produk = ipemesanan.kode_produk', 'inner');
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
        $this->db->select('produk.kode_produk AS hahaha, produk.*, kategori.*');
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
        $this->db->select('pemesanan.*, konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'inner');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
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
        $this->db->select('pemesanan.*, konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'inner');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->where('pemesanan.kode_pemesanan', $kode_pemesanan);
        return $this->db->get();
    }

    function inserpemesanan($data){
        return $this->db->insert('pemesanan', $data);
    }

    function update_pemesanan($kode_pemesanan, $data){
        $this->db->where('kode_pemesanan', $kode_pemesanan);
        $this->db->update('pemesanan', $data);
    }



    //GRAFIK


    //LAPORAN
    function get_laporan($tanggal_awal, $tanggal_akhir, $metode_pemesanan, $status_pemesanan){
        $this->db->select('pemesanan.*, konsumen.*');
        $this->db->from('pemesanan');
        $this->db->join('konsumen', 'konsumen.id_konsumen = pemesanan.id_konsumen', 'left');
        $this->db->where("pemesanan.tanggal_pemesanan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
        $this->db->where("pemesanan.metode_pemesanan IN($metode_pemesanan)");
        $this->db->where("pemesanan.status_pemesanan IN($status_pemesanan)");
        return $this->db->get();
    }

}