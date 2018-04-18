<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('admin_view')) {

    function admin_view($view = '', $data = array(), $footer = true) {

        $data['msg'] = '';
        $CI = & get_instance();
        $CI->load->library('session');
        $role = $CI->session->userdata('role');
        $query = $CI->db->query("select * from access_pages where role='$role' and parent_id=0 order by `menu_order` ");
        $data['front_menu'] = $query->result_array();
        $CI->load->view('admin/templates/header', $data);
        $CI->load->view($view);
        if ($footer) {
            $CI->load->view('admin/templates/footer');
        }
    }

}


function front_view($view = '', $data = array(), $footer = true) {
        $data['msg'] = '';
		$CI = & get_instance();
        $CI->load->view('templates/header', $data);
        $CI->load->view($view);
        if ($footer) {
            $CI->load->view('templates/footer');
        }
    }

function checkAuth() {
    $CI = & get_instance();
    $CI->load->library('session');
    if ($CI->session->userdata('user_id') != '') {
        return true;
    } else {
        redirect('');
    }
}

if (!function_exists('check_adminAuth')) {

    function check_adminAuth() {

        $CI = & get_instance();

        $CI->load->library('session');

        if ($CI->session->userdata('login_id') != '') {

            $CI->load->helper('url');

            $url = $url = $CI->uri->segment(1) . '/' . $url = $CI->uri->segment(2) . '/' . $CI->uri->segment(3);

            $role = $CI->session->userdata('role');

            $query = $CI->db->query("select * from access_pages where role='$role' and page_link='$url'");

            $chk = $query->result_array();

            if (empty($chk)) {

                redirect('admin/noaccess');
            } else {

                return true;
            }
        } else {

            redirect('admin');
        }
    }

}