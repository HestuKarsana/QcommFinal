<?php
class Test extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function index(){
//		echo "oke";
		$this->session->set_userdata(array('status'=> 'test session'));

		//$this->session->set_userdata('nama', 'oke');

		//echo $this->session->userdata('nama');
		//echo "<pre>";
		//print_r($this->session->all_userdata());
	}

	public function pr(){
		print_r($this->session->all_userdata());
  	}
}

?>
