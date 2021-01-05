<?php
class M_home extends CI_Model
{
    // function get_data($id_admin)
    // {
    // 	$query = $this->db->query("SELECT * FROM dokter WHERE id_admin = '$id_admin' ORDER BY nama_dokter ASC");
    // 	return $query->result_array();
    // }

    function get_data_makanan()
    {
        return $this->db->get('makanan')->result_array();
    }

    function tambah_data($data)
    {
        return $this->db->insert("makanan", $data);
    }
}
