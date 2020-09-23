<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barcodenya extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
       
    }
	public function index()
	{
			$this->load->library('barcode128');	
			$kode='1234567890';
			echo bar128(stripslashes($kode));
		
	}
	

	
	

}

?>