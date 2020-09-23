<?php
ob_start();
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : Secure
 * ------------------------------------------------------------------------
 * template from :
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 *edited :
 * tanggal : 08-12-2019 
 *@author : dtechno 
 */

class Dashboard extends CI_Controller //MY_Controller 
{
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	public function index()
	{
		$this->load->view('admin/home');
		
	}
	
}
