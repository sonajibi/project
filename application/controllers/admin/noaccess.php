<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Noaccess extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('frontend_model');
		$this->load->helper('xcrud');
		$this->load->library(array('form_validation','session'));

	}
	public function index(){
			$data['msg']='';
			admin_view('admin/account/un_authentication',$data);
	}
	
}