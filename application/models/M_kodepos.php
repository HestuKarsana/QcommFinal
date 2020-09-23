<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Kodepos extends CI_Model {

   // Fetch users
   function getKodeposAlamat($searchTerm=""){

     // Fetch users
     $this->db->select('*')->limit(20);;
     $this->db->where("alamatcari like '%".$searchTerm."%' ");
     $fetched_records = $this->db->get('kodepos_pos');
     $users = $fetched_records->result_array();

     // Initialize Array with fetched data
     $data = array();
     foreach($users as $user){
        $data[] = array("id"=>$user['kodepos'], "text"=>$user['alamatcari']);
     }
     return $data;
  }

}