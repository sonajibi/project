<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('frontend_model');
        $this->load->helper('file');
        $this->load->helper('xcrud');
        checkAuth();
    }

    public function index() {
        $data['msg'] = '';
        $where = array('id' => $this->session->userdata('user_id'));
        $data['userInfo'] = $this->frontend_model->fetch_recordbyid('users', $where);
        front_view('dashboard', $data);
    }

    public function order_history() {
        $xcrud = Xcrud::get_instance()->table('orders');
        /*         * ********view pages********** */
        $xcrud->unset_edit();
        $xcrud->unset_remove(); // nested table instance access
        $xcrud->unset_print();
        $xcrud->unset_csv();
        $xcrud->unset_add();
        $xcrud->order_by('id', 'DESC');
        $xcrud->relation('user_id', 'users', 'id', 'email');
        $xcrud->where('user_id', $this->session->userdata('user_id'));
        $xcrud->columns('order_date,name,user_id,address,total_items,order_total');
        $xcrud->label('name', 'Shipping Name');
        $products_list = $xcrud->nested_table('order_items', 'id', 'order_items', 'order_id'); // nested table
        $products_list->unset_csv(); // nested table instance access
        $products_list->unset_remove(); // nested table instance access
        $products_list->unset_add(); // nested table instance access
        $products_list->unset_print(); // nested table instance access
        $products_list->unset_search(); // nested table instance access
        $products_list->unset_edit();
        $products_list->unset_view();
        $products_list->unset_view();
        $products_list->unset_pagination();
        $products_list->columns('variation_id,quantity,price');
        $products_list->fields('variation_id', true);
        $products_list->relation('variation_id', 'product_variation', 'id', 'name');
        $products_list->label('variation_id', 'Item Name');
        $xcrud->label('user_id', 'Email');
        $data['title'] = 'ORDER LIST';
        $data['item_type'] = $xcrud->render();
        front_view('order_history', $data);
    }

    public function update_profile() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        if (!empty($this->input->post('file'))) {
            $this->form_validation->set_rules('file', '', 'callback_file_check');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => false, 'msg' => validation_errors());
            $this->session->set_userdata($data);
            redirect('dashboard');
        } else {
            if ($_FILES['file']['name'] != '') {
                $uimg = $this->image_upload('file');
                $status = 'Unverified';
            } else {
                $uimg = $this->input->post('oldIdProof');
                $where = array('id' => $this->session->userdata('user_id'));
                $userInfo = $this->frontend_model->fetch_recordbyid('users', $where);
                $status = $userInfo->status;
            }
            $data = array('name' => $this->input->post('name'),
                'id_proof' => $uimg,
                'status' => $status);
            $where = array('id' => $this->session->userdata('user_id'));
            $result = $this->frontend_model->update_data('users', $data, $where);
            if ($result) {
                $data = array('status' => true, 'msg' => 'Your Account is updated.');
                $this->session->set_userdata($data);
                session_start();
                $orderId = session_id();
                $where = array('order_id' => $orderId, 'status' => 'cart');
                $cartInfo = $this->frontend_model->fetch_condrecord('order_items', $where);
                if (!empty($cartInfo)) {
                    redirect('checkout');
                }
                redirect('dashboard');
            } else {
                echo $mesg = "Error! Try Again!";
            }
        }
    }

    /*
     * file value and type check during validation
     */

    public function file_check($str) {

        $allowed_mime_type_arr = array('application/pdf', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
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
