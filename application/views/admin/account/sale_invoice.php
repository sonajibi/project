<style>
body {
	font-family:Arial, Helvetica, sans-serif;
}
p {
	line-height:1em;
	font-size:14px;
}
table {
	border-collapse: collapse;
}
table, th, td {
	font-size:14px;
	padding:5px;
	border:1px solid #000;
}
</style>
<meta charset="utf-8"> 
<table width="900" align="center">
<tr>
    <td colspan="12" align="center"><b>श्री नाकोडा भैरव नाथायः नमः</b></td>
  </tr>
  <tr>
    <td colspan="6">GSTN:- 23ABRPJ9941P1ZS</td>
    <td colspan="6" align="right">ORIGINAL FOR RECIPIENT</td>
  </tr>
  <tr align="center">
    <td colspan="12">
      <span style="font-size:36px;font-weight:bold">NATKHAT KIDS ZONE</span><br>
      35, MANBHAAN NAGAR, INDORE(M.P.)<br>
      <p>MOBILE NO.:+91-9425313959, EMAIL:	avantjain1411@gmail.com</p>
    
      </td>
  </tr>
  
  <tr>
    <td colspan="6" width="50%">Invoice No.: <b><?= str_pad($sale[0]['bill_no'],5,0,STR_PAD_LEFT); ?></b></td>
    <td colspan="6">Date: <?= date("d/m/Y",strtotime($sale[0]['bill_date'])); ?></td>
  </tr>
  <tr>
    <td colspan="6" width="50%">Details of Receiver (Bill To)</td>
    <td colspan="6" align="left">Details of Consignee (Ship To)</td>
  </tr>
 
  <tr>
    <td colspan="6"><b><?= strtoupper($sale[0]['customer_name']); ?></b><br />
    </td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr align="right" style="background:#C0C0C0;">
          <th colspan="6" align="left">Product Name</th>
          <th>Qty.</th>
          <th align="center">Unit</th>
          <th>Rate</th>
          
          <th width="7%">Dis.%</th>  
          <th width="7%"><?= strtoupper($sale[0]['tax_type']) ?>%</th>       
          <th width="10%">Sub Total</th>
          
        </tr>
        <?php if(!empty($product_info)){ $textSlab=array();
				  foreach($product_info as $purchaseval){
if(isset($textSlab[$purchaseval['tax1_percent']])){
	$textSlab[$purchaseval['tax1_percent']]=$textSlab[$purchaseval['tax1_percent']]+$purchaseval['tax1_total'];
}else{
$textSlab[$purchaseval['tax1_percent']]=$purchaseval['tax1_total'];
}
 ?>
        <tr align="right">
          <td colspan="6" align="left"><?php echo $purchaseval['product_name']; ?></td>
          <td><?php echo $purchaseval['qty']; ?></td>
          <td align="center"><?php echo $purchaseval['unit']; ?></td>
          <td><?php echo $purchaseval['sale_rate']; ?></td>
          <td><?php echo $purchaseval['dis_percent']; ?></td>
          <td><?php echo number_format(($sale[0]['tax_type']=='GST')?$purchaseval['tax1_percent']+$purchaseval['tax2_percent']:$purchaseval['tax3_percent'],2); ?></td>
          <td><?php echo $purchaseval['total'];//echo round($purchaseval['sub_total']-($purchaseval['sub_total']*$purchaseval['dis_percent'])/100,2); ?></td>
          
          <!--<td><?php echo ucfirst($purchaseval['inventory_type']); ?></td>-->
        </tr>
        <?php }} ?>

  <tr>
    <td colspan="6" rowspan="6" valign="bottom">
	<?php foreach($textSlab as $key=>$value){
echo strtoupper($sale[0]['tax_type']).' '.round($key).'% Rs.'.round(($value),2).'<br>';
} ?>
    </td>
    <td colspan="5">(+) SUB TOTAL</td>
    <td colspan="" align="right"><?= number_format($sale[0]['sub_total'],2); ?></td>
    
  </tr>
  
  <tr>

    <td colspan="5">(-) DISCOUNT TOTAL</td>
    <td colspan="" align="right"><?= number_format(($sale[0]['discount_total']),2) ?></td>
  </tr>
  <tr>
       <td colspan="5">Total Taxable Value:</td>
    <td align="right"><?= number_format(($sale[0]['tax_total']),2) ?></td>   
    
  </tr>
  <?php if($sale[0]['tax_type']=='GST'){ ?>
   <tr>

    <td colspan="5">(+) CGST AMOUNT</td>
    <td colspan="" align="right"><?= number_format(round(($sale[0]['tax_total']/2),2),2) ?></td>
  </tr>
  <tr>
    <td colspan="5">(+) SGST AMOUNT</td>
    <td align="right"><?= number_format(round(($sale[0]['tax_total']/2),2),2) ?></td>
  </tr>
  <?php }else{ ?>
<tr>

    <td colspan="5">(+) IGST AMOUNT</td>
    <td colspan="" align="right"><?= number_format(round(($sale[0]['tax_total']),2),2) ?></td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td align="right"></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5">Round Off</td>
    <td align="right"><?= number_format(round($sale[0]['gross_total'])-$sale[0]['gross_total'],2); ?></td>
  </tr>
  <tr>
  <td colspan="6">G.Total in Words:<?= $words; ?></td>
    <td colspan="5"><b>(Rounded) Grand Total</b></td>
    <td align="right"><b><?= number_format(round($sale[0]['gross_total']),2); ?></b></td>
  </tr>
  <tr align="">
    <td colspan="6"><b>TERMS AND CONDITIONS</b><BR>
      1) Subject to Indore Jurisdiction only.<br>
      2) We are not responsible for breakage & pifferage.<br>
      <b>3) Credit limit 15 days only.</b>
    </td>
    <td colspan="6" align="right" style="border:0px;" valign="bottom">Auth. Sign.</td>
  </tr>
  <tr align="center">
    <td colspan="12"><b>BANK NAME: PANJAB NATIONAL BANK, GOYAL NAGAR, INDORE (M.P.)</b> <br><b>ACCOUNT NUMBER:4751002100000956</b>,  <b>IFSC CODE:PUNB0475100</b></td>
  </tr>
</table>
