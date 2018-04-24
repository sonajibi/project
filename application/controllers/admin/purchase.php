<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','form')); 
		$this->load->model('frontend_model');
		date_default_timezone_set("Asia/Calcutta");
		$this->load->helper('xcrud');
		$this->load->library(array('form_validation','session'));
		
	}

	public function index(){
		check_adminAuth();  
		$data['msg']='';
		admin_view('admin/account/purchase_entry',$data);
	}
	
	public function get_last_purchase(){
		$product_id = $this->input->post('product_id');
		$sql="select * from inventory where product_id='$product_id' and inventory_type='purchase' order by id desc limit 1";
		$search_rs=$this->frontend_model->fetch_sql_record($sql);
		echo json_encode($search_rs);
	}
	
	public function edit_purchase($id){
		$purchase_info=$this->frontend_model->fetch_recordbyid('purchase',array('id'=>$id));
		$data['purchase_info']=$purchase_info;
		$sql="select product.product_name,product.product_code as hsn_code,inventory.* from  product,inventory where product.id=inventory.product_id 
				and inventory.purchase_id='$id'";
		$search_rs=$this->frontend_model->fetch_sql_record($sql);
		$data['product_info']=$search_rs;
		admin_view('admin/account/edit_purchase',$data);
	}
	
	
	public function purchase_list(){
		check_adminAuth();  
		$xcrud = Xcrud::get_instance()->table('purchase');
		/**********view pages***********/
		$xcrud->unset_view(); $xcrud->unset_remove(); $xcrud->unset_print();
		$xcrud->unset_csv(); $xcrud->unset_print(); $xcrud->unset_add();
		$xcrud->unset_edit();
		$xcrud->button('edit_purchase/{id}','EDIT PURCHASE BILL','icon-pencil','','');
		//$xcrud->pass_var('created_at',date("Y-m-d"));
		$xcrud->relation('distributer_name','sellers','id','firm_name');
		//$xcrud->relation('city','city','id','city_name','','','','','','state_id','state');
		$xcrud->column_callback('bill_no','purchase_invoice');
		$xcrud->columns('bill_date,bill_no,distributer_name,bill_total,remark');
		
		
		//$xcrud->highlight_row('status', '=', 'Deactie', '#f2d0de');
		//$xcrud->fields('created_at',true);
		$xcrud->order_by('bill_date','DESC');
		$data['title'] = 'PURCHASE LIST'; 
		$data['item_type'] = $xcrud->render();
		admin_view('admin/account/xcrud_table', $data);
	}
	
	public function insert_purchase(){
		$post=$this->input->post();
		
		if(!empty($post)){
			$data = array(
				'entry_type' => $post['entry_type'],
				'bill_no' => strtoupper(trim($post['bill_no'])),
				'bill_date' => date("Y-m-d",strtotime($post['bdate'].'-'.$post['bmonth'].'-'.$post['byear'])),
				'distributer_name' => $post['seller_id'],
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
				'remark' => trim($post['remark']),
				'created_at' => date('Y-m-d H:i:s')
			);
			if(!empty($post['purchase_id'])){
				 $this->frontend_model->update_data('purchase',$data,array('id'=>$post['purchase_id']));
				 $this->frontend_model->delete_data('inventory',array('purchase_id'=>$post['purchase_id']));
				 $purchase_id =$post['purchase_id'];
			}else{
				$purchase_id = $this->frontend_model->insert_data('purchase',$data);
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
							'purchase_id' => $purchase_id,
							'product_id' => $product_id,
							'qty' => $post['qty'][$i],
							'unit' => $post['unit'][$i],
							'purchase_rate' => $post['prate'][$i],
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
							'sale_rate' => $post['salerate'][$i],
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
	
	public function purchase_inoice($id){
		$sql="select product.product_name,inventory.* from  product,inventory where product.id=inventory.product_id 
				and inventory.purchase_id='$id'";
		$search_rs=$this->frontend_model->fetch_sql_record($sql);
		$data['product_info']=$search_rs;
		
		$sql1="select sellers.firm_name,purchase.* from  purchase,sellers where sellers.id=purchase.distributer_name 
				and purchase.id='$id'";
		$data['purchase']=$this->frontend_model->fetch_sql_record($sql1);
		//$data['purchase_info']=$this->frontend_model->fetch_recordbyid('purchase',array('id'=>$id));
		if(!empty($search_rs)){
			$this->load->view('admin/account/purchase_invoice',$data);
		}else {
		   return false;
		}
	}

}