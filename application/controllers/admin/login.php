<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','form')); 
		$this->load->model('frontend_model');
		date_default_timezone_set("Asia/Calcutta");
		$this->load->library(array('form_validation','session'));  
	}
	public function index(){
		$data['msg']='';
		$this->load->view('admin/index',$data);
	}
	public function logout()
	{
		$data = array('medical_id' => '' ,'validated' => false);
		$this->session->set_userdata($data);
		$this->session->unset_userdata('medical_id');
		$this->session->sess_destroy();
		redirect('admin'); 
	}
	public function check_admin_login(){
		$result = $this->frontend_model->check_admin_login();	
		if(!$result){
			echo $mesg="<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert'>&times;</a>
						<strong>Error!</strong> Invalid Username or Password. Log in Failed. </div>";  
		}else{
			echo 1;
		}
	}
	public function forgot_password($msg = NULL){
		$data['seo_title']='Forgot Password';
		$data['seo_key']='';
		$data['seo_desc']='';
		$this->load->view('forgot_password',$data);
	}
}