<?php

class Kategori_model extends CI_Model {

	// method untuk menampilkan data buku
	public function showKategori($id = false){
		// membaca semua data buku dari tabel 'kategori'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
    }
    // method untuk insert kategori 
    public function insertKategori($KategoriBaru){
	$data = array(
		"kategori" => $KategoriBaru
	    );
	$query = $this->db->insert('kategori', $data);
    }
    
    public function editKategori($idkategori,$kategori){
		$data = array(
			"idkategori"=>$idkategori,
			"kategori" => $kategori,
		);
		$this->db->where('idkategori', $idkategori);
		$query = $this->db->update('kategori', $data);		
    }

    public function delKategori($idkategori){
        $this->db->delete('kategori', array("idkategori" => $idkategori));
    }
}
?>