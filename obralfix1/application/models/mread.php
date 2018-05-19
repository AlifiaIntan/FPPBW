<?php    
class Mread extends CI_Model{
    function report(){
        $query = $this->db->query("SELECT * from kritik");
        
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}