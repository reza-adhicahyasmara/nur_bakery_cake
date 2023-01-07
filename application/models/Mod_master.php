<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_master extends CI_Model {

    //CHAT
    function get_all_kontak(){ 
        $query2 = $this->db->query("SELECT chat.*, konsumen.* 
                                    FROM chat
                                    LEFT JOIN konsumen ON konsumen.id_konsumen = chat.id_konsumen
                                    WHERE chat.tanggal_chat IN (SELECT MAX(tanggal_chat) FROM chat GROUP BY chat.id_konsumen)
                                    ORDER BY chat.tanggal_chat DESc
                                ");
        return $query2;
    }

    function get_all_chat(){
        $this->db->select('*');
        $this->db->from('chat');
        return $this->db->get();
    }

    function get_chat_konsumen($id_konsumen){
        $this->db->select('chat.*, konsumen.*');
        $this->db->from('chat');
        $this->db->join('konsumen', 'konsumen.id_konsumen = chat.id_konsumen', 'left');
        $this->db->where('chat.id_konsumen', $id_konsumen );
        return $this->db->get();
    }

    function get_chat_nonkonsumen($nonmember_kontak_chat){
        $this->db->select('*');
        $this->db->from('chat');
        $this->db->where('nonmember_kontak_chat', $nonmember_kontak_chat);
        return $this->db->get();
    }

    function insert_chat($data){
        $this->db->insert('chat', $data);
    }

    function cek_chat($nonmember_kontak_chat){
        $this->db->where('nonmember_kontak_chat', $nonmember_kontak_chat);
        return $this->db->get('chat');
    }



    // WILAYAH
    function get_all_provinsi(){ 
        $this->db->order_by('nama_provinsi ASC');
        return $this->db->get('provinsi'); 
    }

    function get_all_kabupaten(){ 
        $this->db->order_by('nama_kabupaten ASC');
        return $this->db->get('kabupaten'); 
    }

    function get_kabupaten($kode_provinsi){ 
        $this->db->where('kode_provinsi', $kode_provinsi);
        $this->db->order_by('nama_kabupaten ASC');
        return $this->db->get('kabupaten'); 
    }
    
    function get_all_kecamatan(){ 
        $this->db->order_by('nama_kecamatan ASC');
        return $this->db->get('kecamatan'); 
    }

    function get_kecamatan($kode_kabupaten){ 
        $this->db->where('kode_kabupaten', $kode_kabupaten);
        $this->db->order_by('nama_kecamatan ASC');
        return $this->db->get('kecamatan'); 
    }

    function update_kecamatan($kode_kecamatan, $data){
        $this->db->where('kode_kecamatan', $kode_kecamatan);
		$this->db->update('kecamatan', $data);
    }

    function get_all_desa(){ 
        $this->db->order_by('nama_desa ASC');
        return $this->db->get('desa'); 
    }

    function get_desa($kode_kecamatan){ 
        $this->db->where('kode_kecamatan', $kode_kecamatan);
        $this->db->order_by('nama_desa ASC');
        return $this->db->get('desa'); 
    }




    //PRODUK
    function get_all_produk(){ 
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.*, kategori.*
                                    FROM produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    GROUP BY hahaha
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_detail_produk($kode_produk){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.*, kategori.*
                                    FROM produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE produk.kode_produk = '$kode_produk'
                                    GROUP BY hahaha
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_cari_produk($cari_produk){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.*, kategori.*
                                    FROM produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE produk.nama_produk LIKE '$cari_produk'
                                    GROUP BY hahaha
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_cari_kategori($cari_kategori){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.*, kategori.*
                                    FROM produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE produk.kode_kategori = '$cari_kategori'
                                    GROUP BY hahaha
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_cari_subkategori($cari_subkategori){
        $query2 = $this->db->query("SELECT produk.kode_produk AS hahaha, produk.*, kategori.*,
                                    FROM produk
                                    LEFT JOIN kategori ON kategori.kode_kategori = produk.kode_kategori
                                    LEFT JOIN ukuran ON ukuran.kode_produk = produk.kode_produk
                                    WHERE produk.kode_subkategori = '$cari_subkategori'
                                    GROUP BY hahaha
                                    ORDER BY produk.nama_produk ASC
                                ");
        return $query2;
    }

    function get_produk($kode_produk){
        $this->db->where('kode_produk', $kode_produk);
        return $this->db->get('produk');
    }

    function insert_produk($data){
        $this->db->insert('produk', $data);
    }

    function update_produk($kode_produk, $data){
        $this->db->where('kode_produk', $kode_produk);
		$this->db->update('produk', $data);
    }

    function delete_produk($kode){
        $this->db->where('kode_produk', $kode);
        $this->db->delete('produk');
    }

    //UKURAN
    function get_all_ukuran(){
        $this->db->select('ukuran.*, produk.*, kategori.*');
        $this->db->join('produk', 'produk.kode_produk = ukuran.kode_produk', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->order_by('ukuran.volume_ukuran DESC');
        return $this->db->get('ukuran');
    }

    function get_ukuran($kode_ukuran){
        $this->db->where('kode_ukuran', $kode_ukuran);
        return $this->db->get('ukuran');
    }

    function geproduk_ukuran($kode_produk){
        $this->db->where('kode_produk', $kode_produk);
        return $this->db->get('ukuran');
    }

    function get_ukuran_ukuran($ukuran_ukuran){
        $this->db->where('kode_produk IS NULL');
        $this->db->where('ukuran_ukuran', $ukuran_ukuran);
        return $this->db->get('ukuran');
    }

    function insert_ukuran($data){
        $this->db->insert('ukuran', $data);
    }

    function update_ukuran($kode_ukuran, $data){
        $this->db->where('kode_ukuran', $kode_ukuran);
		$this->db->update('ukuran', $data);
    }

    function delete_ukuran($kode_ukuran){
        $this->db->where('kode_ukuran', $kode_ukuran);
        $this->db->delete('ukuran');
    }

    function delete_all_ukuran($kode_produk){
        $this->db->where('kode_produk', $kode_produk);
        $this->db->delete('ukuran');
    }

    //KATEGORI
    function get_all_kategori(){ 
        $this->db->order_by('nama_kategori ASC');
        return $this->db->get('kategori'); 
    }

    function get_kategori($kode_kategori){
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->order_by('nama_kategori ASC');
        return $this->db->get('kategori');
    }

    function insert_kategori($data){
        $this->db->insert('kategori', $data);
    }

    function update_kategori($kode_kategori, $data){
        $this->db->where('kode_kategori', $kode_kategori);
		$this->db->update('kategori', $data);
    }

    function delete_kategori($kode_kategori){
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->delete('kategori');
    }





    //PROMO EVENT
    function get_display_promo(){
        $this->db->select('promo.*');
        $this->db->from('promo');
        $this->db->where("CURRENT_DATE() BETWEEN DATE_ADD(promo.tanggal_awal_promo, INTERVAL -7 DAY) AND promo.tanggal_akhir_promo");
        return $this->db->get(); 
    }

    function get_all_promo(){ 
        return $this->db->get('promo'); 
    }

    function get_promo($kode_promo){
        $this->db->where('kode_promo', $kode_promo);
        return $this->db->get('promo');
    }

    function cek_promo($nama_promo){
        $this->db->where('nama_promo', $nama_promo);
        return $this->db->get('promo');
    }

    function insert_promo($data){
        $this->db->insert('promo', $data);
    }

    function update_promo($kode_promo, $data){
        $this->db->where('kode_promo', $kode_promo);
		$this->db->update('promo', $data);
    }

    function delete_promo($kode){
        $this->db->where('kode_promo', $kode);
        $this->db->delete('promo');
    }



    
       
    //PROMO LIST
    function get_display_ipromo(){
        $this->db->select('ipromo.*, produk.*, ukuran.*, kategori.*, produk.kode_produk AS kode_produk_ipromo');
        $this->db->from('ipromo');
        $this->db->join('ukuran', 'ukuran.kode_ukuran = ipromo.kode_ukuran', 'left');
        $this->db->join('produk', 'produk.kode_produk = ukuran.kode_produk', 'left');
        $this->db->join('kategori', 'kategori.kode_kategori = produk.kode_kategori', 'left');
        $this->db->join('promo', 'promo.kode_promo = ipromo.kode_promo', 'left');
        $this->db->where("CURRENT_DATE() BETWEEN promo.tanggal_awal_promo AND promo.tanggal_akhir_promo");

        return $this->db->get(); 
    }

    function get_all_ipromo(){ 
        $this->db->select('ipromo.*, produk.*, ukuran.*');
        $this->db->join('ukuran', 'ukuran.kode_ukuran = ipromo.kode_ukuran', 'left');
        $this->db->join('produk', 'produk.kode_produk = ukuran.kode_produk', 'left');
        return $this->db->get('ipromo'); 
    }

    function get_all_ipromo1(){ 
        $this->db->select('ipromo.*, produk.*, ukuran.*');
        $this->db->join('ukuran', 'ukuran.kode_ukuran = ipromo.kode_ukuran', 'left');
        $this->db->join('produk', 'produk.kode_produk = ukuran.kode_produk', 'left');
        $this->db->where('kode_promo IS NULL');
        return $this->db->get('ipromo'); 
    }

    function get_ipromo($kode_ipromo){
        $this->db->where('kode_ipromo', $kode_ipromo);
        return $this->db->get('ipromo');
    }

    function cek_ipromo($nama_ipromo){
        $this->db->where('nama_ipromo', $nama_ipromo);
        return $this->db->get('ipromo');
    }

    function cek_ipromo0(){
        $this->db->where('kode_promo IS NULL OR kode_ukuran IS NULL');
        return $this->db->get('ipromo');
    }

    function cek_ipromo1($kode_ukuran){
        $this->db->where('kode_ukuran', $kode_ukuran);
        $this->db->where('kode_promo IS NULL');
        return $this->db->get('ipromo');
    }

    function insert_ipromo($data){
        $this->db->insert('ipromo', $data);
    }

    function update_ipromo($kode_ipromo, $data){
        $this->db->where('kode_ipromo', $kode_ipromo);
		$this->db->update('ipromo', $data);
    }

    function delete_ipromo($kode){
        $this->db->where('kode_ipromo', $kode);
        $this->db->delete('ipromo');
    }

    function delete_all_ipromo($kode){
        $this->db->where('kode_promo', $kode);
        $this->db->delete('ipromo');
    }




    //PENGATURAN

    function get_pengaturan($kode_pengaturan){
        $this->db->select('*');
        $this->db->where('kode_pengaturan', $kode_pengaturan);
        return $this->db->get('pengaturan'); 
    }

    function update_pengaturan($kode_pengaturan, $data){
        $this->db->where('kode_pengaturan', $kode_pengaturan);
		$this->db->update('pengaturan', $data);
    }

}