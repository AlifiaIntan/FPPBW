<?php

Class Users extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "username =" . "'" . $data['username'] . "'";
$this->db->select('*');
$this->db->from('users_public');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('user_login', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($data) {

  // $encrypted = $this->encryption->encrypt($data['password']);
  // echo $encrypted;
  // $decryted = $this->encryption->decrypt($encrypted);
  // echo "<br>";
  // echo $decryted;
  // die();



  $condition = "Username =" . "'" . $data['username']."'";
  $this->db->select('Password');
  $this->db->from('users_public');
  $this->db->where($condition);
  $this->db->limit(1);
  $query = $this->db->get()->row();



  $password = $this->encryption->decrypt($query->Password);


  if ($data['password'] === $password) {
    return true;
  } else {
    return false;
  }
}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "Username =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('users_public');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->row();
} else {
return false;
}
}

}

?>
