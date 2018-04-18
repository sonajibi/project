<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form', 'cookie'));
        $this->load->library(array('form_validation', 'session', 'image_lib', 'email'));
        $this->load->model('frontend_model');
    }

    public function index() {
        $data['msg'] = '';
        $data['cookie'] = get_cookie('login_details');
        $this->load->view('index', $data);
    }

    public function check_login() {
        $result = $this->frontend_model->check_user_login();
        if (!$result) {
            echo "Error! Invalid Email or Password. Log in Failed";
        } else {
            redirect('dashboard');
        }
    }

    public function logout() {
        $data = array('user_id' => '', 'name' => '', 'validated' => false);
        $this->session->set_userdata($data);
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('');
    }

    public function insert_user() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_message('is_unique', 'Email already exist!');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
//            if ($_FILES['uimg']['name'] != '') {
//                $uimg = $this->image_upload('uimg');
//            } else {
//                $uimg = '';
//            }
            $data = array('name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'created_at' => date('Y-m-d H:i:s'));
            $result = $this->frontend_model->insert_data('users', $data);
            if ($result) {
                echo 'Success! Your Account is created. Please Login.';
            } else {
                echo $mesg = "Error! Try Again!";
            }
        }
    }

    public function image_upload($imgname) {
        $config = array('upload_path' => "./uploads",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => false,
            'file_name' => time());
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($imgname)) {
            $uploadimg = $this->upload->data();
            $uimg = $uploadimg['file_name'];
            return $uimg;
        } else {
            $uimg = '';
            return false;
        }
    }

}
