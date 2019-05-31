<style type="text/css">
	#t{
		display: block;
		overflow: scroll;
	}
	input[type=text] {
 
  box-sizing: border-box;
  border: 0px ;
  border-radius: 0px;
   background-color : yellow; 
}
input[readonly] {
    color: #f2f1f1;
    background: #3dc91a!important;
    
}


</style>
<script type="text/javascript">
	
$(document).ready(function(){

	$('#edit').click(function(){
		 var prev = $('input'),
        ro   = prev.prop('readonly');
		    prev.prop('readonly', !ro);
		    $(this).val(ro ? 'Save' : 'Edit');
	});

});

</script>

 <div class="conatiner"  >
 	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Employee Master Salary Table</h4>

		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				
				<button class="btn btn-success" id="edit" > Edit Employees Salary</button> 
			</a>			
		</div>
	</div>	
	<div class="widget-body " >
		<div class="widget-main"  id="t">


 <table class="table  table-bordered table-hover"  bgcolor="9999FF">

    <thead>
						
		<th align="center" bgcolor="#dcf442">Entity Name</th>
		<th align="center" bgcolor="#dcf442">Entity ID</th>
		<th align="center" bgcolor="#dcf442">Emp ID</th>
		<th align="center" bgcolor="#dcf442">Name</th>
		
		<th align="center" bgcolor="#dcf442">Month Days</th>
		<th align="center" bgcolor="#dcf442">Paid Days</th>
		<th align="center" bgcolor="#dcf442">Basic</th>
		<th align="center" bgcolor="#dcf442">Dearness Allowance (DA)</th>
		<th align="center" bgcolor="#dcf442">House Rent Allowance (HRA)</th>
		<th align="center" bgcolor="#dcf442">Convenience Allowance (CA)</th>
		<th align="center" bgcolor="#dcf442">CCA</th>
		<th align="center" bgcolor="#dcf442">Education Allowance (EA)</th>
		<th align="center" bgcolor="#dcf442">Other Reimbrusement (OR)</th>
		<th align="center" bgcolor="#dcf442">Other Allowance (OA)</th>
		<th align="center" bgcolor="#dcf442">Overtime (OT)</th>
		<th align="center" bgcolor="#dcf442">Washing Allounce (WA)</th>
		<th align="center" bgcolor="#dcf442">LTA</th>
		<th align="center" bgcolor="#dcf442">Monthly Gross</th>
		<th align="center" bgcolor="#dcf442">PF</th>
		<th align="center" bgcolor="#dcf442">ESIC</th>
		<th align="center" bgcolor="#dcf442">PT</th>
		<th align="center" bgcolor="#dcf442">IT</th>
		
		<th align="center" bgcolor="#dcf442">LWF</th>
		<th align="center" bgcolor="#dcf442">Other Deduction(OD)</th>
		<th align="center" bgcolor="#dcf442">Net Pay </th>
		
		<th align="center" bgcolor="#dcf442">VPF</th>
		<th align="center" bgcolor="#dcf442">pf no</th>
      <th align="center" bgcolor="#dcf442">ESIC NO</th>
      <th align="center" bgcolor="#dcf442">Fix Gross</th>
      <th align="center" bgcolor="#dcf442">Payment Mode</th>
    </thead>
    <?php
		$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 echo form_open_multipart('spg/Spg/edit_import_salary',$attributes );?>
    <tbody>
    	<?php echo show_msg();

foreach ($result as $key) { 
	$bgcolor =$key['is_uploaded']==TRUE?'#3dc91a':'';
	
	?>
	<input type="hidden" name="is_uploaded[]" value="<?php echo $key['is_uploaded']; ?>" />
		<tr bgcolor="<?php echo $bgcolor;?>">
			<td><input type="text" name="cust_name[]" class="" value="<?php echo $key['cust_name']; ?>"  readonly /></td>
			<td><input type="text" name="cust_id[]" class="" value="<?php echo $key['cust_id']; ?>"  readonly/></td>
			<td><input type="text" name="emp_id[]" class="" value="<?php echo $key['emp_id']; ?>"  readonly/></td>
			<td><input type="text" name="emp_name[]" class="" value="<?php echo $key['emp_name']; ?>"  readonly/></td>
			<td><input type="text" name="month_days[]" class="" value="<?php echo $key['month_days']; ?>"  readonly/></td>
			<td><input type="text" name="paid_days[]" class="" value="<?php echo $key['paid_days']; ?>"  readonly/></td>
			<td><input type="text" name="basic[]" class="" value="<?php echo $key['basic']; ?>"  readonly/></td>
			<td><input type="text" name="dearness[]" class="" value="<?php echo $key['dearness']; ?>"  readonly/></td>
			<td><input type="text" name="hra[]" class="" value="<?php echo $key['hra']; ?>"  readonly/></td>
			<td><input type="text" name="ca[]" class="" value="<?php echo $key['ca']; ?>"  readonly/></td>
			<td><input type="text" name="cca[]" class="" value="<?php echo $key['cca']; ?>"  readonly/></td>
			<td><input type="text" name="ea[]" class="" value="<?php echo $key['ea']; ?>"  readonly/></td>
			<td><input type="text" name="or[]" class="" value="<?php echo $key['or']; ?>"  readonly/></td>
			<td><input type="text" name="oa[]" class="" value="<?php echo $key['oa']; ?>"  readonly/></td>
			<td><input type="text" name="ot[]" class="" value="<?php echo $key['ot']; ?>"  readonly/></td>
			<td><input type="text" name="wa[]" class="" value="<?php echo $key['wa']; ?>"  readonly/></td>
			<td><input type="text" name="lta[]" class="" value="<?php echo $key['lta']; ?>"  readonly/></td>
			<td><input type="text" name="monthly_gross[]" class="" value="<?php echo $key['monthly_gross']; ?>"  readonly/></td>
			<td><input type="text" name="pf[]" class="" value="<?php echo $key['pf']; ?>"  readonly/></td>
			<td><input type="text" name="esic[]" class="" value="<?php echo $key['esic']; ?>"  readonly/></td>
			<td><input type="text" name="pt[]" class="" value="<?php echo $key['pt']; ?>"  readonly/></td>
			<td><input type="text" name="it[]" class="" value="<?php echo $key['it']; ?>"  readonly/></td>
			<td><input type="text" name="lwf[]" class="" value="<?php echo $key['lwf']; ?>"  readonly/></td>
			<td><input type="text" name="od[]" class="" value="<?php echo $key['od']; ?>"  readonly/></td>
			<td><input type="text" name="vpf[]" class="" value="<?php echo $key['vpf']; ?>"  readonly/></td>
			<td><input type="text" name="net_pay[]" class="" value="<?php echo $key['net_pay']; ?>"  readonly/></td>
			<td><input type="text" name="pf_no[]" class="" value="<?php echo $key['pf_no']; ?>"  readonly/></td>
			<td><input type="text" name="esic_no[]" class="" value="<?php echo $key['esic_no']; ?>"  readonly/></td>
			<td><input type="text" name="fix_gross[]" class="" value="<?php echo $key['fix_gross']; ?>"  readonly/></td>
			<td><input type="text" name="payment_mode[]" class="" value="<?php echo $key['payment_mode']; ?>"  readonly/></td>
			

		</tr>
			
	<?php } ?>
    </tbody>
    <input type="submit" value="upload"/>
    <?php echo form_close(); ?>	
</table>
</div>
</div>
	</div>
</div>
</div>