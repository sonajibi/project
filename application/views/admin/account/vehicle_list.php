<select data-placeholder="Your Favorite Type of Bear" class="form-control chzn-select chzn-rtl" tabindex="-1" name="vehicle_id" id="vehicle_id" onchange="calculate_estimate_fare(this.value)">
<option value="">Select Vehicle</option>
<?php 
if(!empty($vehicle_detail)){
foreach($vehicle_detail as $vehicle){
?>
<option value="<?php echo $vehicle['id'];?>"><?php echo $vehicle['vehicle_name'];?></option>
<?php
} }
?>
</select>