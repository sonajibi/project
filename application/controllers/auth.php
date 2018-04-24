<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form', 'cookie'));
        $this->load->library(array('form_validation', 'session', 'image_lib', 'email'));
        $this->load->model('frontend_model');
    }

    public function login() {
        $data['msg'] = '';
        $data['cookie'] = get_cookie('login_details');
        front_view('login', $data);
    }

    public function signup() {
        $data['msg'] = '';
        $data['cookie'] = get_cookie('login_details');
        front_view('signup', $data);
    }

    public function check_login() {
        $result = $this->frontend_model->check_user_login();
        if (!$result) {
            $data = array('status' => false, 'msg' => "Invalid Email or Password. Log in Failed");
            $this->session->set_userdata($data);
            redirect('auth/login');
        } else {
            redirect('dashboard');
        }
    }

    public function send_password() {
        $result = $this->frontend_model->fetch_recordbyid('users', ['email' => $this->input->post('email')]);
        if (empty($result)) {
            $data = array('status' => false, 'msg' => "User with this email not exist.");
            $this->session->set_userdata($data);
            redirect('auth/login');
        } else {
            $length = 6;
            $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
            $message = "<h2>New Account Details</h2><p>Email : " . $result->email . "</p><p>Password : " . $password . "</p>";
            $headers = "From:  test@example.com" . "\r\n" .
                    "CC:  test@example.com";
            if (mail($result->email, 'Forgot Password', $message, $headers)) {
                $this->frontend_model->update_data('users', ['password' => $password], ['id' => $result->id]);
                $data = array('status' => true, 'msg' => 'New password sent successfully. Please check your inbox.');
                $this->session->set_userdata($data);
                redirect('auth/login');
            } else {
                redirect('auth/login');
            }
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
            $data = array('status' => false, 'msg' => validation_errors());
            $this->session->set_userdata($data);
            redirect('auth/signup');
        } else {
            $data = array('name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'created_at' => date('Y-m-d H:i:s'));
            $result = $this->frontend_model->insert_data('users', $data);
            if ($result) {
                echo 'Success! Your Account is created. Please <a href="'.base_url().'auth/login">Login</a>.';
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
