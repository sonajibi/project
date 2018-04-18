<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()

	{

		parent::__construct();

		$this->load->helper(array('url','html','form')); 

		$this->load->model('frontend_model');

		date_default_timezone_set("Asia/Calcutta");

		$this->load->library(array('form_validation','session'));

		check_adminAuth();  

	

	}

	public function index(){

			$data['msg']='';
			admin_view('admin/account/index',$data);

	}

	public function change_pass($msg = NULL)

	{   

		$data['seo_title']='Change Password Password';

		$data['msg'] = $msg;

		admin_view('admin/account/change_pass',$data);

	}

	public function profile($msg = NULL)
	{   
		$data['seo_title']='EDIT PROFILE';
		$data['msg'] = $msg;
		admin_view('admin/account/change_pass',$data);

	}
	
	public function access_menu($array){
		$data['msg'] = '';
		$result = $this->frontend_model->check_admin_login('access_pages',$array);
		return $result;			
	}

}