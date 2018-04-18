<?php

function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
		//$CI =& get_instance();
		//$CI->load->library('session');
		$emp_id=5;
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE service_booking SET `fk_stage_id` = 4,fk_employee_id="'.$emp_id.'" WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
	
}

function purchase_invoice($value, $field, $priimary_key, $list, $xcrud)
	{
   		return '<a href="javascript:void(0);" onclick="purchase_invoice('.$priimary_key.');" data-toggle="modal" data-target="#purchase_invoice">'.$value.'</a>';
	}

    function update_order_status($postData,$primary,$xcrud){
        
        $db = Xcrud_db::get_instance();
        $query = 'SELECT user_id,email from orders INNER JOIN users on orders.user_id=users.id where orders.id="'.$primary.'"';
        $db->query($query);
        $orderInfo=$db->result();
        if($postData->get('status')=='Verified'){
            $message="Your oder has been approved. Please shop without any interruption from next time onwords.";
        }else{
            $message="Your id proof has not found resulting in order rejection. Please place order again with valid ID.";
        }
        $query = 'UPDATE users SET `status` ="'.$postData->get('status').'" WHERE id = ' . $orderInfo[0]['user_id'];
        $db->query($query);
        $headers = "From:  test@example.com" . "\r\n" .
                    "CC:  test@example.com";
        mail($orderInfo[0]['email'], 'Order Status Updated', $message, $headers);
    }


