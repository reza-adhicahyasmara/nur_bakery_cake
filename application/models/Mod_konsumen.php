<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Mod_konsumen extends CI_Model {

    function get_all_konsumen(){ 
        $this->db->select('konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->order_by('nama_konsumen ASC');
        return $this->db->get('konsumen'); 
    }

    function get_konsumen($id_konsumen){
        $this->db->select('konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->where('id_konsumen', $id_konsumen);
        $this->db->order_by('nama_konsumen ASC');
        return $this->db->get('konsumen');
    }
    
    function get_kontak_konsumen($kontak_konsumen){
        $this->db->where('kontak_konsumen', $kontak_konsumen);
        return $this->db->get('konsumen');
    }

    function get_email_konsumen($email_konsumen){
        $this->db->where('email_konsumen', $email_konsumen);
        return $this->db->get('konsumen');
    }

    function insert_konsumen($data){
        $this->db->insert('konsumen', $data);
    }

    function update_konsumen($id_konsumen, $data){
        $this->db->where('id_konsumen', $id_konsumen);
		$this->db->update('konsumen', $data);
    }

    function delete_konsumen($id_konsumen){
        $this->db->where('id_konsumen', $id_konsumen);
        $this->db->delete('konsumen');
    }

    function auth_hp_konsumen($email_hp_login, $password_konsumen){
        $this->db->select('konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->where('password_konsumen ', $password_konsumen);
        $this->db->where('kontak_konsumen ', $email_hp_login);
        return $this->db->get('konsumen');
    }

    function auth_email_konsumen($email_hp_login, $password_konsumen){
        $this->db->select('konsumen.*, provinsi.*, kabupaten.*, kecamatan.*, desa.*');
        $this->db->join('provinsi', 'provinsi.kode_provinsi = konsumen.kode_provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.kode_kabupaten = konsumen.kode_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.kode_kecamatan = konsumen.kode_kecamatan', 'left');
        $this->db->join('desa', 'desa.kode_desa = konsumen.kode_desa', 'left');
        $this->db->where('password_konsumen ', $password_konsumen);
        $this->db->where('email_konsumen ', $email_hp_login);
        return $this->db->get('konsumen');
    }
}