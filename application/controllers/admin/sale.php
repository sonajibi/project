<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','form')); 
		$this->load->model('frontend_model');
		date_default_timezone_set("Asia/Calcutta");
		$this->load->helper('xcrud');
		$this->load->library('numbertowords');
		$this->load->library(array('form_validation','session'));
		
	}

	public function index(){
		check_adminAuth();  
		$data['msg']='';
		admin_view('admin/account/sale_entry',$data);
	}
	
	public function sale_list(){
		check_adminAuth();  
		$xcrud = Xcrud::get_instance()->table('sale');
		/**********view pages***********/
		$xcrud->unset_view(); $xcrud->unset_remove(); $xcrud->unset_print();
		$xcrud->unset_csv(); $xcrud->unset_print(); $xcrud->unset_add();
		$xcrud->unset_edit();
		//$xcrud->pass_var('created_at',date("Y-m-d"));
		//$xcrud->relation('customer_name','customers','id','firm_name');
		//$xcrud->relation('city','city','id','city_name','','','','','','state_id','state');
		$xcrud->columns('bill_date,bill_no,customer_name,mobile_number,bill_total,remaining,remark');
		$xcrud->button('edit_sale/{id}','EDIT SALE BILL','icon-pencil','','');
		$xcrud->button(base_url().'admin/sale/sale_invoice/{id}','Print Sale Bill','icon-print', '',array('target' => '_blank' ));
		$xcrud->highlight_row('remaining', '>', 0, '#f2d0de');
		//$xcrud->fields('created_at',true);
		$xcrud->order_by('bill_no','desc');
		$data['title'] = 'SALE LIST'; 
		$data['item_type'] = $xcrud->render();
		admin_view('admin/account/xcrud_table', $data);
	}

	public function edit_sale($id){
		$sql="select product.product_name,inventory.* from  product,inventory where product.id=inventory.product_id 
				and inventory.sale_id='$id'";
		$search_rs=$this->frontend_model->fetch_sql_record($sql);
		$data['product_info']=$search_rs;
		
		$sql1="select sale.* from  sale where sale.id='$id'";
		$sale=$this->frontend_model->fetch_sql_record($sql1);
		$data['sale']=$sale;
		admin_view('admin/account/edit_sale_entry', $data);

	}
	
	public function insert_sale(){
		$post=$this->input->post();
		if(!empty($post)){

			$data = array(
				'entry_type' => $post['entry_type'],
				'bill_no' => $post['bill_no'],
				'tax_type' => $post['tax_type'],
				'bill_date' => date("Y-m-d",strtotime($post['bdate'].'-'.$post['bmonth'].'-'.$post['byear'])),
				'customer_name' => ucwords(strtolower($post['customer_id'])),
				'mobile_number' => (trim($post['mobile_number'])),
				'transport_name' => ucwords(trim($post['transport_name'])),
				'cases' => $post['cases'],
				'sub_total' => trim($post['f_subtotal']),
				'tax_total' => trim($post['f_tax_total']),
				'discount_total' => trim($post['f_dis_total']),
				'round_value' => round($post['f_bill_total'])-$post['f_bill_total'],
				'bill_total' => round(trim($post['f_bill_total'])),
				'transport_charges' => trim($post['transport_charges']),
				'cases_charges' => trim($post['case_charges']),
				'gross_total' => trim($post['f_bill_total']+$post['transport_charges']+$post['case_charges']),
				'paid' => trim($post['paid']),
				'wave_off' => trim($post['wave_off']),
				'remaining' => trim($post['f_bill_total']-($post['paid']+$post['wave_off'])),
				'remark' => trim($post['remark']),
				'created_at' => date('Y-m-d H:i:s')
			);
			if(!empty($post['id']))
			{
				$purchase_id = $this->frontend_model->update_data('sale',$data,array('id' => $post['id']));
				$this->frontend_model->delete_data('inventory',array('sale_id' => $post['id']));
				$purchase_id =$post['id'];

			}else{
				$purchase_id = $this->frontend_model->insert_data('sale',$data);
			}
			if($purchase_id){
				$i = 0;
				foreach($post['product'] as $product){
					if($product!=''){
					$chk_pro=array('product_name'=>$product);
					$pro_rs = $this->frontend_model->fetch_recordbyid('product', $chk_pro);
					if($pro_rs){
						$product_id=$pro_rs->id;
					}else{
						$product_id=$this->frontend_model->insert_data('product',$chk_pro);
					}
					$inv_data= array(
							'inventory_type' => $post['inv_type'][$i],
							'sale_id' => $purchase_id,
							'product_id' => $product_id,
							'qty' => $post['qty'][$i],
							'unit' => $post['unit'][$i],
							'sale_rate' => $post['prate'][$i],
							'sub_total' => $post['subtotal'][$i],
							'dis_percent' => $post['discount'][$i],
							'dis_total' => $post['dis_total'][$i],
							'tax1_percent' => $post['tax1'][$i],
							'tax1_total' => $post['tax1total'][$i],
							'tax2_percent' => $post['tax2'][$i],
							'tax2_total' => $post['tax2total'][$i],
							'tax3_percent' => $post['tax3'][$i],
							'tax3_total' => $post['tax3total'][$i],
							'net_rate' => $post['nprate'][$i],		
							'total' => $post['rowtotal'][$i]
					);
					$this->frontend_model->insert_data('inventory',$inv_data);
				}
					$i++;
				}
				echo $purchase_id;
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function sale_invoice($id){
		$sql="select product.product_name,inventory.* from  product,inventory where product.id=inventory.product_id 
				and inventory.sale_id='$id'";
		$search_rs=$this->frontend_model->fetch_sql_record($sql);
		$data['product_info']=$search_rs;
		
		$sql1="select sale.* from sale where sale.id='$id'";
		$sale=$this->frontend_model->fetch_sql_record($sql1);
		$data['sale']=$sale;
		$data['words']=$this->numbertowords->convert_number(round($sale[0]['bill_total']));
		//$data['purchase_info']=$this->frontend_model->fetch_recordbyid('purchase',array('id'=>$id));
		if(!empty($search_rs)){
			$this->load->view('admin/account/sale_invoice',$data);
		}else {
		   return false;
		}
	}

}