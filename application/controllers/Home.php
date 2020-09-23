
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

class Home extends CI_Controller //MY_Controller 
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
		$this->home();
	}

	public function home()
	{   //$this->load->view('order/trans_order');
		$this->load->view('home/home');
	}
}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>