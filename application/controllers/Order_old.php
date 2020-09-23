<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller{
  function __construct(){
    parent::__construct();
	$this->load->helper('url');
    //validasi jika user belum login
    /*
	if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
		*/
  }
 
  function index(){
    //$this->load->view('v_dashboard');
	$this->load->view('order/trans_order');
  }
   //fungsi cetak label	
   /*
  function cetak_label_alamat(){
    //$this->load->view('v_dashboard');
	$this->load->view('order/form_cetaklabel');
  }
  */
  /*
  public function tampilkan_order($tanggal)
	{
		$dt['tanggal']			= date('d F Y', strtotime($tanggal));
		$this->load->view('laporan/laporan_penjualan', $dt);
	}
	*/
  
 
}
