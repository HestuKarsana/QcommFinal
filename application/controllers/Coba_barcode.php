<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : qcomm
 * ------------------------------------------------------------------------
 *
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 */

class Coba_barcode extends CI_Controller //MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		/*
		if($this->session->userdata('ap_level') == 'inventory'){
			redirect();
		}
		*/
	}

	public function index()
	{
		//$this->transaksi_cetak1();
		$this->load->view("order/vcetakbarcode");
	}

	
public function cetaklabelnya()
	{
		$this->load->view("order/cetaklabelnya");

	}


	
	
	
	
	
}