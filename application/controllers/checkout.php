<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('frontend_model');
        $this->load->helper('file');
        checkAuth();
    }

    public function index($id = '') {
        $data['msg'] = '';
        session_start();
        $orderId = session_id();
        $where = array('order_id' => $orderId, 'status' => 'cart');
        $data['cartInfo'] = $this->frontend_model->fetch_condrecord('order_items', $where);
        $this->load->view('checkout', $data);
    }

    public function order_now() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('province', 'Province', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('postal_code', 'Postal Code', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $data = array('status' => false, 'msg' => validation_errors());
            $this->session->set_userdata($data);
            redirect('checkout');
        } else {

            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address') . ', ' . $this->input->post('city') . ', ' . $this->input->post('province') . ', ' . $this->input->post('country') . ', ' . $this->input->post('postal_code'),
                'order_date' => date('Y-m-d'));
            $result = $this->frontend_model->insert_data('orders', $data);
            if ($result) {
                session_start();
                $orderId = session_id();
                $where = array('order_id' => $orderId, 'status' => 'cart');
                $cartInfo = $this->frontend_model->fetch_condrecord('order_items', $where);
                if (!empty($cartInfo)) {
                    $orderTotal = 0;
                    $itemTotal = 0;
                    foreach ($cartInfo as $cart) {
                        $varInfo = $this->frontend_model->fetch_recordbyid('product_variation', array('id' => $cart['variation_id']));
                        $data = array('order_id' => $result, 'price' => '$'.$varInfo->price, 'status' => 'ordered');
                        $this->frontend_model->update_data('order_items', $data, array('id'=>$cart['id']));
                        $orderTotal = $orderTotal + ($cart['quantity'] * $varInfo->price);
                        $itemTotal = $itemTotal + ($cart['quantity']);
                    }
                    $userInfo = $this->frontend_model->fetch_recordbyid('users', array('id' => $this->session->userdata('user_id')));
                    if ($userInfo->status == 'Unverified') {
                        $status='Pending';
                        $data = array('status' => false, 'msg' => 'Order placed successfully, admin will approved your order.');
                    } else {
                        $status='Verified';
                        $data = array('status' => true, 'msg' => 'Order placed successfully.');
                    }
                    $this->session->set_userdata($data);
                    $result = $this->frontend_model->update_data('orders', array('total_items' => $itemTotal, 'order_total' => '$'.$orderTotal, 'status' => $status), array('id' => $result));
                }
            }
            redirect('dashboard/order_history');
        }
    }

}
