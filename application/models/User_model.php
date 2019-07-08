<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user berdasar username
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}


public function insertUser($username, $password, $fullname, $role){
	$data = array(
				"username" => $username,
				"password" => $password,
				"fullname" => $fullname,
				"role" => $role
	);
	$query = $this->db->insert('users', $data);
}

public function showUser($username = false){
	// membaca semua data buku dari tabel 'books'
	if ($username == false){
		$query = $this->db->get('users');
		return $query->result_array();
	} else {
		// membaca data buku berdasarkan id
		$query = $this->db->get_where('users', array("username" => $username));
		return $query->row_array();
	}
}

	// method untuk hapus data buku berdasarkan id
	public function delUser($username){
		$this->db->delete('users', array("username" => $username));
	}

public function editUser($username, $fullname, $password, $role){
	$data = array(
				"username" => $username,
				"fullname" => $fullname, "password" => $password,"role" => $role
	);
	$this->db->where('username', $username);
	$query = $this->db->update('users', $data);		
}



}




?>