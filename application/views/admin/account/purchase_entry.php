<input type="hidden" id="c_unit" />
<form id="purchase_frm" method="post" action="javascript:void(0);">
<div id="content">
  <div id="content-header"> </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <h5>PURCHASE ENTRY</h5>
          </div>
          <div class="widget-content">
            <div class="span3 control-group">
              <label class="control-label">Entry Type:</label>
              <div class="controls">
                <select class="span12" name="entry_type">
                  <option label="Purchase">Purchase</option>
                  <option label="Return">Purchase Return</option>
                  <option label="Challen">Challen Entry</option>
                </select>
              </div>
            </div>
            <div class="span3 control-group">
              <label class="control-label">Bill Number:</label>
              <div class="controls">
                <input class="span12" name="bill_no" placeholder="Bill No" type="text">
              </div>
            </div>
            <div class="span3 control-group">
              <label class="control-label">Bill Date: </label>
              <div class="controls">
                <input class="span3" name="bdate" placeholder="Bill Date" value="<?= date("d"); ?>" type="text">
                -
                <input class="span3" name="bmonth" placeholder="Bill Date" value="<?= date("m"); ?>" type="text">
                -
                <input class="span5" name="byear" placeholder="Bill Date" value="<?= date("Y"); ?>" type="text">
              </div>
            </div>
            <div class="span3 control-group">
              <label class="control-label">Remark: </label>
              <div class="controls">
                <input class="span12" name="remark" placeholder="Remark" value="" type="text">
              </div>
            </div>
            <div class="span6 mrg_0 control-group">
              <label class="control-label">Distributer Name: </label>
              <div class="controls">
                <select class="span12" name="seller_id" id="seller_id">
                  <option value="">Select Distributer</option>
                  <?php $seller_list = seller_list(); 
        				  if(!empty($seller_list)){
        					  foreach($seller_list as $seller){ ?>
        						  <option value="<?php echo $seller['id']; ?>"><?php echo $seller['firm_name']; ?></option>
        					<?php  }
        				  }
				          ?>
                </select>
              </div>
            </div>
            <div class="span3 control-group">
              <label class="control-label">Transport Name: </label>
              <div class="controls">
                <input class="span12" name="transport_name" placeholder="Transport Name" type="text">
              </div>
            </div>
            <div class="span3 control-group">
              <label class="control-label">Cases: </label>
              <div class="controls">
                <input class="span12" name="cases" placeholder="ex.: 2Carton" type="text">
              </div>
            </div>
            <div class="clear"></div>
            <hr />
            <div class="span12 mrg_0">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="5%">Code</th>
                    <th>Product Name</th>
                    <th width="5%">Qty.</th>
                    <th width="5%">Unit</th>
                    <th width="7%">P.Rate</th>
                    <th width="7%">Sub Total</th>
                    <!--<th width="5%">Tax1%</th>-->
                    <th width="5%">Dis.%</th>
                    <th width="3%">CGST%</th>
                    <th width="3%">SGST%</th>
                    <th width="3%">IGST%</th>
                    <th width="7%">NP. Rate</th>
                    <th width="7%">Sale Rate</th>
                    <th width="7%">Total</th>
                    <th width="7%">Type</th>
                    <th width="3%"></th>
                  </tr>
                </thead>
                <tbody id="items">
                  <tr>
                    <td><input class="hsn" name="code[]" type="text"  placeholder="Codes" /></td>
                    <td>
                      <input class="product" name="product[]" type="text" placeholder="Product Name" />
                      <input type="hidden" class="pro_id" />
                    </td>
                    <td><input class="digit qty" name="qty[]" type="text"  placeholder="0" /></td>
                    <td><input class="unit" name="unit[]" type="text" placeholder="Unit"/></td>
                    <td><input class="digit prate" name="prate[]" type="text" placeholder="0.00"/></td>
                    <td><input class="digit subtotal" name="subtotal[]" readonly="readonly" type="text" placeholder="0.00"/></td>
                    <td>
                      <input class="digit discount" name="discount[]" type="text" placeholder="0.00" maxlength="5" />
                      <input class="digit dis_total" name="dis_total[]" type="hidden" placeholder="0.00" />
                    </td>
                    <td>
                      <input class="digit tax1" name="tax1[]" type="text" placeholder="0.00" maxlength="5" />
                      <input class="digit tax1total" name="tax1total[]" type="hidden" placeholder="0.00" />
                    </td>
                    <td>
                      <input class="digit tax2" name="tax2[]" type="text" placeholder="0.00" maxlength="5" />
                      <input class="digit tax2total" name="tax2total[]" type="hidden" placeholder="0.00" />
                    </td>
                    <td>
                      <input class="digit tax3" name="tax3[]" type="text" placeholder="0.00" maxlength="5" />
                      <input class="digit tax3total" name="tax3total[]" type="hidden" placeholder="0.00" />
                    </td>
                    <td><input class="digit nprate" name="nprate[]" readonly="readonly" type="text" placeholder="0.00"/></td>
                    <td><input class="digit salerate" name="salerate[]" type="text" placeholder="0.00"/></td>
                    <td>
                      <input class="digit rowtotal" name="rowtotal[]" type="hidden" placeholder="0.00"/>
                      <span class="txtrowtotal">0.00</span>
                    </td>
                    <td>
                      <select class="inv_type span12" name="inv_type[]">
                        <option value="purchase">Purchase</option>
                        <option value="purchase_return">Return</option>
                        <option value="damage">Damage</option>
                        <option value="loss">Loss</option>
                      </select>
                    </td>
                    <td><button type="button" onclick="addRow($(this));" class="pad_0"><i class="icon icon-plus-sign"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="clear"></div>
            <hr />
            <div class="span12 mrg_0">
              <div class="span9"></div>
              <div class="span3">
                <table class="table table-bordered table-striped" style="text-align:right;">
                  <tr>
                    <td>Sub Total:</td>
                    <td width="40%"><input type="hidden" name="f_subtotal" id="f_subtotal" />
                    <span id="txt_f_subtotal">0.00</span></td>
                  </tr>

                  <tr>
                    <td>(-)Discount Total:</td>
                    <td><input type="hidden" name="f_dis_total" id="f_dis_total" />
                    <span id="txt_f_dis_total">0.00</span></td>
                  </tr>

                  <tr>
                    <td>(+)Tax Total:</td>
                    <td><input type="hidden" name="f_tax_total" id="f_tax_total" />
                    <span id="txt_f_tax_total">0.00</span></td>
                  </tr>
                  
                  
                  <tr>
                    <td>Bill Total:</td>
                    <td><input type="hidden" name="f_bill_total" id="f_bill_total" />
                    <span id="txt_f_bill_total">0.00</span></td>
                  </tr>
                  <tr>
                    <td>(+)Freight Charges:</td>
                    <td><input type="text" name="transport_charges" id="transport_charges" class="digit" placeholder="0.00"/></td>
                  </tr>
                  <tr>
                    <td>(+)Cases Charges:</td>
                    <td><input type="text" name="case_charges" id="case_charges" class="digit" placeholder="0.00"/></td>
                  </tr>
                  <tr>
                    <td>Gross Total:</td>
                    <td><span id="gross_total">0.00</td>
                  </tr>
                </table>
                
               	<p align="right" style="margin:5px;">
                <input id="btn_add_purchase" type="button" value="Save Purchase Entry" />
                </p>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      <?php //include("sidebar.php"); ?>
    </div>
  </div>
</div>
</form>
<script>

function addRow(obj) {
	//alert(obj.parent().parent().index());
	
	var prevIndex=(obj.parent().parent().index());
	
	var aRow = '<tr>\
                    <td><input class="hsn" name="code[]" type="text"  placeholder="Codes" /></td>\
                    <td>\
                      <input class="product" name="product[]" type="text" placeholder="Product Name" />\
                      <input type="hidden" class="pro_id" />\
                    </td>\
                    <td><input class="digit qty" name="qty[]" type="text"  placeholder="0" /></td>\
                    <td><input class="unit" name="unit[]" type="text" placeholder="Unit"/></td>\
                    <td><input class="digit prate" name="prate[]" type="text" placeholder="0.00"/></td>\
                    <td><input class="digit subtotal" name="subtotal[]" readonly="readonly" type="text" placeholder="0.00"/></td>\
                    <td>\
                      <input class="digit discount" name="discount[]" type="text" placeholder="0.00" maxlength="5" />\
                      <input class="digit dis_total" name="dis_total[]" type="hidden" placeholder="0.00" />\
                    </td>\
                    <td>\
                      <input class="digit tax1" name="tax1[]" type="text" placeholder="0.00" maxlength="5" />\
                      <input class="digit tax1total" name="tax1total[]" type="hidden" placeholder="0.00" />\
                    </td>\
                    <td>\
                      <input class="digit tax2" name="tax2[]" type="text" placeholder="0.00" maxlength="5" />\
                      <input class="digit tax2total" name="tax2total[]" type="hidden" placeholder="0.00" />\
                    </td>\
                    <td>\
                      <input class="digit tax3" name="tax3[]" type="text" placeholder="0.00" maxlength="5" />\
                      <input class="digit tax3total" name="tax3total[]" type="hidden" placeholder="0.00" />\
                    </td>\
                    <td><input class="digit nprate" name="nprate[]" readonly="readonly" type="text" placeholder="0.00"/></td>\
                    <td><input class="digit salerate" name="salerate[]" type="text" placeholder="0.00"/></td>\
                    <td>\
                      <input class="digit rowtotal" name="rowtotal[]" type="hidden" placeholder="0.00"/>\
                      <span class="txtrowtotal">0.00</span>\
                    </td>\
                    <td>\
                      <select class="inv_type span12" name="inv_type[]">\
                        <option value="purchase">Purchase</option>\
                        <option value="purchase_return">Return</option>\
                        <option value="damage">Damage</option>\
                        <option value="loss">Loss</option>\
                      </select>\
                    </td>\
                    <td><button type="button" onclick="addRow($(this));" class="pad_0"><i class="icon icon-plus-sign"></i></button></td>\
                  </tr>';
	obj.parent().html('<button type="button" onclick="deleteRow($(this));" class="pad_0"><i class="icon icon-minus-sign"></i></button>');
	obj.remove();
	$('#items').append(aRow);
	productAutoList();
	};


function deleteRow(obj){
	var x = confirm('Are you sure you want to Delete Row.');
	if(x){
		obj.parent().parent().remove();
		calculations();
	}
}
</script> 
