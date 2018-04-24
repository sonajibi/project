<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('frontend_model');
        $this->load->helper('xcrud');
        $this->load->library(array('form_validation', 'session'));
        //check_adminAuth();
    }

    public function order_list($msg = NULL) {
       $xcrud = Xcrud::get_instance()->table('orders');
        /*         * ********view pages********** */
        $xcrud->unset_remove(); // nested table instance access
        $xcrud->unset_print();
        $xcrud->unset_csv();
        $xcrud->unset_add();
        $xcrud->unset_edit(true,'status','!=','Pending');
        $xcrud->order_by('id', 'DESC');
        $xcrud->relation('user_id', 'users', 'id', 'email');
        $xcrud->columns('order_date,name,user_id,address,total_items,order_total,status');
        $xcrud->label('name', 'Shipping Name');
        $xcrud->fields('status', false,false,'edit');
        $xcrud->before_update('update_order_status');
        $products_list = $xcrud->nested_table('order_items', 'id', 'order_items', 'order_id'); // nested table
        $products_list->unset_csv(); // nested table instance access
        $products_list->unset_remove(); // nested table instance access
        $products_list->unset_add(); // nested table instance access
        $products_list->unset_print(); // nested table instance access
        $products_list->unset_search(); // nested table instance access
        $products_list->unset_edit();
        $products_list->unset_view();
        $products_list->unset_pagination();
        $products_list->columns('variation_id,quantity,price');
        $products_list->fields('variation_id', true);
        $products_list->relation('variation_id', 'product_variation', 'id', 'name');
        $products_list->label('variation_id', 'Item Name');
        $xcrud->label('user_id', 'Email');
        $data['title'] = 'ORDER LIST';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

    public function category_list($msg = NULL) {
        $xcrud = Xcrud::get_instance()->table('category');
        /*         * ********view pages********** */
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $xcrud->unset_print();
        $xcrud->order_by('id', 'DESC');
        $data['title'] = 'CATEGORY LIST';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

    public function product_list($msg = NULL) {
        $xcrud = Xcrud::get_instance()->table('product');
        /*         * ********view pages********** */
        $xcrud->unset_print();
        $xcrud->unset_csv();
        $xcrud->order_by('id', 'DESC');
        $xcrud->relation('category', 'category', 'id', 'name');
        $xcrud->change_type('product_image', 'image');
        $products_list = $xcrud->nested_table('product_variation', 'id', 'product_variation', 'product_id'); // nested table
        $products_list->unset_csv(); // nested table instance access
        $products_list->unset_print(); // nested table instance access
        $products_list->unset_search(); // nested table instance access
        $products_list->columns('name,price');
        $products_list->fields('product_id', true);
        $data['title'] = 'PRODUCT LIST';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

    public function profile($msg = NULL) {
        $xcrud = Xcrud::get_instance()->table('users');
        /*         * ********view pages********** */
        $xcrud->unset_csv();
        $xcrud->unset_print();
        $data['title'] = 'MY PROFILE';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

    public function access_page($msg = NULL) {
        $xcrud = Xcrud::get_instance()->table('access_pages');
        /*         * ********view pages********** */
        $xcrud->unset_csv();
        $xcrud->relation('parent_id', 'access_pages', 'id', 'title', array('parent_id' => 0));
        $xcrud->label('state_id', 'State Name');
        $data['title'] = 'ACCESS MASTER';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

    public function customers_list($msg = NULL) {
        $xcrud = Xcrud::get_instance()->table('users');
        /*         * ********view pages********** */
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $xcrud->unset_print();
        $xcrud->unset_csv();
        $xcrud->unset_print();
        $xcrud->unset_add();
        $xcrud->where('role =', 'Customer');
        $xcrud->pass_var('role', 'Customer');
        $xcrud->pass_var('created_at', date("Y-m-d H:i:s"));
        //$xcrud->relation('state','state','id','state_name');
        //$xcrud->relation('city','city','id','city_name','','','','','','state_id','state');
        $xcrud->change_type('id_proof', 'image');
        $xcrud->columns('name,email,id_proof,status,created_at');
        $xcrud->highlight_row('status', '=', 'Deactive', '#f2d0de');
        //$xcrud->relation('parent_id','users','id','name',array('role'=>'Franchise'));
        $xcrud->fields('role,password,created_at', true);
        $xcrud->order_by('name', 'ASC');
        $data['title'] = 'Customers List';
        $data['item_type'] = $xcrud->render();
        admin_view('admin/account/xcrud_table', $data);
    }

}

?>