
<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : transaksi
 * ------------------------------------------------------------------------
 *
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 */

class Laporan_detail_tran extends CI_Controller //MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('ap_level') == 'inventory'){
			redirect();
		}
		*/
	}

	public function index()
	{
		$this->laporan_detail_tran();
	}

	public function laporan_detail_tran()
	{  
		$this->load->view('laporan/laporan_detail_tran');
		
	}

}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>