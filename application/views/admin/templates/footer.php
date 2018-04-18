<div class="row-fluid">
  <div id="footer" class="span12"> Web  </div>
</div>
<script>
$(document).ready(function () {
		
        productAutoList();
});
function calculations(){
	 	var i = 0;
		var subtotal=0;
		var discounttotal=0;
		var taxtotal=0;
		var tax1total=0;
		var tax2total=0;
		var tax3total=0;
		
		var billtotal=0;
		
		
		  $('.qty').each(function(){
			  var qty = $('.qty').eq(i).val();
			  var prate = $('.prate').eq(i).val();
			  var discount = $('.discount').eq(i).val();
			  var tax1 = $('.tax1').eq(i).val();
			  var tax2 = $('.tax2').eq(i).val();
			  var tax3 = $('.tax3').eq(i).val();
			  var inv_type = $('.inv_type').eq(i).val();

			 // sub total calculation
				  var rowsubtotal = qty*prate;
				  rowsubtotal=(isNaN(rowsubtotal))?0:rowsubtotal;
				  subtotal = subtotal+rowsubtotal;
				  $('.subtotal').eq(i).val(parseFloat(rowsubtotal).toFixed(2));
			  // sub total calculation
			  
			  
			  //discountcalculation
				  var rowdiscounttotal = (rowsubtotal*discount)/100;
				  rowdiscounttotal=(isNaN(rowdiscounttotal))?0:rowdiscounttotal;
				  rowsubtotal = rowsubtotal-rowdiscounttotal;
				  discounttotal = discounttotal +rowdiscounttotal; 
				  $('.dis_total').eq(i).val(parseFloat(rowdiscounttotal).toFixed(2));
			  //discountcalculation
			  
			  //tax1 calculation
				  var rowtax1total = (rowsubtotal*tax1)/100;
				  rowtax1total=(isNaN(rowtax1total))?0:rowtax1total;
				  tax1total = tax1total + rowtax1total; 
				  $('.tax1total').eq(i).val(parseFloat(rowtax1total).toFixed(2));
			  //tax1 calculation

			  //tax2 calculation
				  var rowtax2total = (rowsubtotal*tax2)/100;
				  rowtax2total=(isNaN(rowtax2total))?0:rowtax2total;
				  tax2total = tax2total + rowtax2total; 
				  $('.tax2total').eq(i).val(parseFloat(rowtax2total).toFixed(2));
			  //tax2 calculation



			  //tax3 calculation
				  var rowtax3total = (rowsubtotal*tax3)/100;
				  rowtax3total=(isNaN(rowtax3total))?0:rowtax3total;
				  tax3total = tax3total + rowtax3total; 
				  $('.tax3total').eq(i).val(parseFloat(rowtax3total).toFixed(2));
			  //tax3 calculation
			  
			  taxtotal = taxtotal + (rowtax1total+rowtax2total+rowtax3total);
			  taxtotal=(isNaN(taxtotal))?0:taxtotal;

			  //net purchase calculation
				  var rowtotal=rowsubtotal+rowtax1total+rowtax2total+rowtax3total;
				  nprate=(isNaN(rowtotal))?0:rowtotal/qty;
				  nprate=(isNaN(nprate))?0:nprate;
				  $('.nprate').eq(i).val(parseFloat(nprate).toFixed(2));
			  //net purchase calculation

			  rowtotal=(isNaN(rowtotal))?0:rowtotal;
			  rowtotal=(isNaN(rowtotal))?0:rowtotal;
			  billtotal = billtotal+rowtotal;
			  $('.rowtotal').eq(i).val(parseFloat(rowtotal).toFixed(2));
			  $('.txtrowtotal').eq(i).html(parseFloat(rowtotal).toFixed(2));
			  

			  i++;
		  });
		  
	$('#f_subtotal').val(parseFloat(subtotal).toFixed(2));
	$('#txt_f_subtotal').html(parseFloat(subtotal).toFixed(2));
	
	$('#f_dis_total').val(parseFloat(discounttotal).toFixed(2));
	$('#txt_f_dis_total').html(parseFloat(discounttotal).toFixed(2));
	
	$('#f_tax_total').val(parseFloat(taxtotal).toFixed(2));
	$('#txt_f_tax_total').html(parseFloat(taxtotal).toFixed(2));
	
	$('#f_bill_total').val(parseFloat(billtotal).toFixed(2));
	$('#txt_f_bill_total').html(parseFloat(billtotal).toFixed(2));

	var transport_charges=$('#transport_charges').val();
	transport_charges=(isNaN(transport_charges))?parseInt(0):parseFloat(transport_charges);

	var case_charges=$('#case_charges').val();
	case_charges=(isNaN(case_charges))?parseInt(0):parseFloat(case_charges);

	var gross_total = parseFloat(billtotal)+parseFloat(transport_charges)+parseFloat(case_charges);
	//gross_total=(isNaN(gross_total))?0:gross_total;
	$('#gross_total').html(parseFloat(gross_total).toFixed(2));


}


function digitRule() {
	
    /****** for price format 00.00 *****/
	$('.digit').on('keyup', function(e) {
		 calculations();
	});
	
    $('.digit').on('keydown', function(e) {
        // Allow: backspace, delete, tab, escape and enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110,190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 if($(this).val().indexOf('.') != -1) {
                    if(e.keyCode == 110 || e.keyCode == 190) {
                        e.preventDefault();
                    } else {
                        return;
                    }
                 } else {
                    return;
                 }
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        } else {
            var cur_value = jQuery(this).val();
            if(cur_value.indexOf('.') != -1) { // if . found
                if(e.keyCode == 46 || e.keyCode == 190) {
                    e.preventDefault();
                }
                var dec_pos = cur_value.indexOf('.');
                var total_length = cur_value.length;
                if(isTextSelected(this)) {
                /**** if text is selected *****/
                    return;
                } else {
                    var cursor_pos = getCaretPos(this);
                    var cursor_differ = total_length - cursor_pos;
                    if(cursor_differ <= 2) { // check if cursor position is before the point
                        if((total_length - dec_pos) > 2) { // restrict if two charectors are there after decimal
                            e.preventDefault();
                        }
                    } else {
                        return;
                    }
                }
            }
        }
    });
    $('.digit').on('blur', function(e) {
        if($(this).val() == '' || isNaN($(this).val())) {
            $(this).val('0.00');
        } else {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        }
    });
   
}
function productAutoList(){
	$('input').attr('autocomplete','off');
	digitRule();
	var cindex='';
	$('.product').on('focus', function(e) {
		//alert($('#c_unit').val());
        //$(this).next().val($('#c_unit').val());
		cindex =$(this).parent().parent().index();
		console.log('foc'+cindex);
		//console.log(cindex);
		//var pid=$('.pro_id').eq(cindex).val();
		//getLastPurchase(cindex,pid);
		
    });
	
	// Defining the local dataset
        // Constructing the suggestion engine
        var url = '<?php echo base_url();?>admin/settings/get_product_auto_list';
        // Initializing the typeahead
        $('.product').typeahead({
            hint: true,
            highlight: true, /* Enable substring highlighting */
            minLength: 2, /* Specify minimum characters required for showing result */
            source: function (request, response) {
                $.ajax({
                    url: url,
                    data: {product_name: request},
                    type: 'POST',
                    success: function (data) {
						if(data){
                        response(JSON.parse(data));
						}else{
							response('');
						}
                    }
                });
            },
            updater: function (item) {
				//getLastPurchase($(this),item.id);
				
				$('.pro_id').eq(cindex).val(item.id);
                return item;
            }
        });
		
		$('.product').on('blur', function(e) {
		var pid=$('.pro_id').eq(cindex).val();
		getLastPurchase(cindex,pid);
		
    });
}

    function getLastPurchase(cindex,id) {
		console.log(cindex);
        var url = '<?php echo base_url();?>admin/purchase/get_last_purchase';
        $.ajax({
            url: url,
            data: {product_id: id,etype:'<?= $this->uri->segment(2); ?>'},
            type: 'POST',
            success: function (data) {
                var productDetails = JSON.parse(data);
               
				productDetails  = productDetails[0];
				 
				$('.unit').eq(cindex).val(productDetails['unit']);
				
				
				<?php if($this->uri->segment(2)=='sale'){ ?>
				$('.prate').eq(cindex).val(productDetails['sale_rate']);
				<?php }else{
					?>
					$('.prate').eq(cindex).val(productDetails['purchase_rate']);
					<?php
				} ?>
				$('.discount').eq(cindex).val(productDetails['dis_percent']);
				$('.tax1').eq(cindex).val(productDetails['tax1_percent']);
				$('.tax2').eq(cindex).val(productDetails['tax2_percent']);
				$('.tax3').eq(cindex).val(productDetails['tax3_percent']);
				//alert(productDetails[0]['id']);
            }
        });
    }
	</script>
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>admin/';
	var admin_assets = '<?php echo base_url();?>assets/admin/';
</script>
<script src="<?php echo base_url(); ?>assets/admin/ajax/ajax.js"></script>
</body></html>