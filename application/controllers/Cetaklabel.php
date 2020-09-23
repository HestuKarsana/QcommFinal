<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetaklabel extends CI_Controller{
  function __construct(){
    parent::__construct();
    //validasi jika user belum login
   /* if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
		*/
  }
 
  function index(){
    //$this->load->view('v_dashboard');
	$this->load->view('order/trans_order');
  }
  
 
}
