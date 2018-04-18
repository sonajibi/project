<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('frontend_model');
        $this->load->helper('file');
    }

    public function index($id = '') {
        $data['msg'] = '';
        session_start();
        $orderId = session_id();
        $where = array('order_id' => $orderId, 'status' => 'cart');
        $data['cartInfo'] = $this->frontend_model->fetch_condrecord('order_items', $where);
        front_view('cart', $data);
    }

    public function order_sub() {
        $post = $_POST;
        if (!empty($post)) {
            session_start();
            $orderId = session_id();
            foreach ($post['product'] as $order) {
                $i = 0;
                foreach ($post['variation'][$order] as $varId) {
                    $where = array('order_id' => $orderId, 'variation_id' => $varId);
                    $varInfo = $this->frontend_model->fetch_recordbyid('product_variation', array('id' => $varId));
                    $chkProduct = $this->frontend_model->fetch_recordbyid('order_items', $where);
                    $qty = $post['quantity'][$order][$i];
                    if ($qty > 0) {
                        $data = array('order_id' => $orderId, 'variation_id' => $varId, 'quantity' => $qty, 'price' => $varInfo->price);
                        if (empty($chkProduct)) {
                            $result = $this->frontend_model->insert_data('order_items', $data);
                        } else {
                            $result = $this->frontend_model->update_data('order_items', $data, $where);
                        }
                    } else {
                        $result = $this->frontend_model->delete_data('order_items', $where);
                    }
                    $i++;
                }
            }
        }
        redirect('cart');
    }

    public function delete_cart_item($id){
        session_start();
        $orderId = session_id();
        $where = array('order_id' => $orderId, 'id' => $id);
        $result = $this->frontend_model->delete_data('order_items', $where);
        $data = array('status' => true, 'msg' => 'Cart item deleted.');
        $this->session->set_userdata($data);
        redirect('cart');
    }

}
