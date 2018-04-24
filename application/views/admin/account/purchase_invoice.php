
            <table width="100%">
              <tr>
                <td><b>Bill No.:</b><?= $purchase[0]['bill_no'] ?></td>
                <td><b>Bill Date:</b><?= date("d-m-Y",strtotime($purchase[0]['bill_date'])); ?></td>
                <td colspan="2"><b>Distributer Name:</b><?= $purchase[0]['firm_name'] ?></td>
              </tr>
              <tr>
                <td colspan="2"><b>Transport Name:</b><?= $purchase[0]['transport_name']; ?></td>
                <td><b>Cases:</b><?= $purchase[0]['cases']; ?></td>
                <td><b>Remark:</b><?= $purchase[0]['remark']; ?></td>
              </tr>
            </table>
            <hr />
            <table class="table table-bordered table-striped">
              <thead>
                <tr >
                  <th>Product Name</th>
                  <th width="7%">Qty.</th>
                  <th width="5%">Unit</th>
                  <th width="8%">P.Rate</th>
                  <th width="8%">Sub Total</th>
                  <th width="5$">Dis.%</th>
                  <th width="5$">CGST%</th>
                  <th width="5$">SGST%</th>
                  <th width="5$">IGST%</th>
                  
                  <th width="8%">NP. Rate</th>
                  <th width="8%">Sale Rate</th>
                  <th width="8%">Total</th>
                  <th width="7%">Type</th>
                </tr>
              </thead>
              <tbody>
              <?php if(!empty($product_info)){
				  foreach($product_info as $purchaseval){ ?>
                <tr>
                  <td><?php echo $purchaseval['product_name']; ?></td>
                  <td><?php echo $purchaseval['qty']; ?></td>
                  <td><?php echo $purchaseval['unit']; ?></td>
                  <td><?php echo $purchaseval['purchase_rate']; ?></td>
                  <td><?php echo $purchaseval['sub_total']; ?></td>
                  <td><?php echo $purchaseval['dis_percent']; ?></td>
                  <td><?php echo $purchaseval['tax1_percent']; ?></td>
                  <td><?php echo $purchaseval['tax2_percent']; ?></td>
                  <td><?php echo $purchaseval['tax3_percent']; ?></td>
                  <td><?php echo $purchaseval['net_rate']; ?></td>
                  <td><?php echo $purchaseval['sale_rate']; ?></td>
                  <td><?php echo $purchaseval['total']; ?></td>
                  <td><?php echo ucfirst($purchaseval['inventory_type']); ?></td>
                </tr>
                <?php }} ?>
               
              </tbody>
            </table>
            <hr />
            <div class="span12 mrg_0">
              <div class="span8"></div>
              <div class="span4">
                <table class="table table-bordered table-striped" style="text-align:right;">
                  <tbody>
                    <tr>
                      <td>Sub Total:</td>
                      <td width="40%"><span id="ssubtot"><?= $purchase[0]['sub_total']; ?></span></td>
                    </tr>
                    <tr>
                      <td>(-)Discount Total:</td>
                      <td><span id="sdistot"><?= $purchase[0]['discount_total']; ?></span></td>
                    </tr>
                    <tr>
                      <td>(+)Tax Total:</td>
                      <td><span id="staxtot"><?= $purchase[0]['tax_total']; ?></span></td>
                    </tr>
                    <tr>
                      <td>Round Off:</td>
                      <td><span id="sbilltot"><?= $purchase[0]['round_value']; ?></span></td>
                    </tr>
                    <tr>
                      <td>Bill Total:</td>
                      <td><span id="sbilltot"><?= $purchase[0]['bill_total']; ?></span></td>
                    </tr>
                    <tr>
                      <td>(+)Transport Charges:</td>
                      <td><?= $purchase[0]['transport_charges']; ?></td>
                    </tr>
                    <tr>
                      <td>(+)Cases Charges:</td>
                      <td><?= $purchase[0]['cases_charges']; ?></td>
                    </tr>
                    <tr>
                      <td>Gross Total:</td>
                      <td><?= number_format(round($purchase[0]['gross_total']),2); ?></td>
                    </tr>
                  </tbody>
                </table>
              
