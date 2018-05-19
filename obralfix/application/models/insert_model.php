<?php
class insert_model extends CI_Model{
function __construct() {
parent::__construct();
}
function form_insert($data){
// Inserting in Table(Kontak) of Database(database)
$this->db->insert('kontak', $data);
}
}
?>
