<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller{
  function __construct(){
    parent::__construct();
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
  function cetak_label_alamat(){
    //$this->load->view('v_dashboard');
	//$this->load->view('order/form_cetak');
	$this->load->view('order/form_cetaklabel');
  }
  public function cetak_label()
	{
		/*
		$tglawal='2019-08-18';
		$tglakhir='2019-12-08';
		$data["kirimans"] = $this->torder_model->cekKiriman($tglawal,$tglakhir);
        //$this->load->view("v_cetaklabel",$data);
		$this->load->view("order/v_cetak_1",$data);
		*/
		//$this->load->view("order/v_cetak_1");
		$this->load->view('order/v_cetak_label');
		//$this->load->view("v_cetakhvs",$data);
	}
  public function tampilkan_order($tanggal)
	{
		$dt['tanggal']			= date('d F Y', strtotime($tanggal));
		$this->load->view('laporan/laporan_penjualan', $dt);
	}
	
	
  
 
}
