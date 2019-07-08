 <?php 
    if (!empty(show_msg())) {
     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?>

 <div class="container" >
 	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Employee Master Salary Table</h4>

		<div class="widget-toolbar">
			<a href="<?php echo base_url(''.$user_type.'/save/salary'); ?>">
				
				<button class="btn btn-success" id="edit" >Save Employees Salary</button> 
			</a>			
		</div>
		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				
				<button class="btn btn-warning" >CANCLE</button> 
			</a>			
		</div>
	</div>	
	<div class="widget-body " >
		<div class="widget-main"  id="t">


 <table class="table  table-bordered table-hover"  bgcolor="9999FF">

    <thead>
						
		<th >Entity ID</th>
		<th >Entity Name</th>
		<th >Emp ID</th>

		<th>PF No</th>		
		<th>ESIC No</th>		
		<th>Name</th>		
		<th>Month Days</th>
		<th>Paid Days</th>
		
		<th>Fix Gross</th>
		<th>Basic</th>
		<th>Dearness Allowance (DA)</th>
		<th>House Rent Allowance (HRA)</th>
		<th>Convenience Allowance (CA)</th>
		<th>CCA</th>
		<th>Education Allowance (EA)</th>
		<th>Other Reimbrusement (OR)</th>
		<th>Other Allowance (OA)</th>
		<th>Overtime (OT)</th>
		<th>Washing Allounce (WA)</th>
		<th>LTA</th>
		<th>Monthly Gross</th>
		<th>PF</th>
		<th>VPF</th>
		<th>ESIC</th>
		<th>PT</th>
		<th>IT</th>
		
		<th>LWF</th>
		<th>Other Deduction(OD)</th>
		<th>Net Pay </th>
	    <th>Payment Mode</th>
	    <th>Year</th>
	    <th>Month</th>
	    <th>EPF Wages</th>
	    <th>Total Deduction</th>
    </thead>
    
    <tbody>
    	<?php foreach ($result as $key) { 
	// $bgcolor =$key->is_uploaded']==TRUE?'#3dc91a':'';
	
	?>
	<!-- <input type="hidden" name="is_uploaded[]" value="<?php //echo $key->is_uploaded]; ?>" /> -->
<tr>
<td><input type="text" name="cust_id[]" class="" value="<?php echo $key->custid; ?>"  readonly /></td>
<td><input type="text" name="cust_name[]" class="" value="<?php echo $key->entity_name; ?>"  readonly/></td>
<td><input type="text" name="emp_id[]" class="" value="<?php echo $key->empid; ?>"  readonly/></td>
<td><input type="text" name="pf_no[]" class="" value="<?php echo $key->pfno; ?>"  readonly/></td>
<td><input type="text" name="esic_no[]" class="" value="<?php echo $key->esicno; ?>"  readonly/></td>
<td><input type="text" name="emp_name[]" class="" value="<?php echo $key->name; ?>"  readonly/></td>
<td><input type="text" name="month_days[]" class="" value="<?php echo $key->Month_days; ?>"  readonly/></td>
<td><input type="text" name="paid_days[]" class="" value="<?php echo $key->paid_days; ?>"  readonly/></td>
<td><input type="text" name="fix_gross[]" class="" value="<?php echo $key->fixgross; ?>"  readonly/></td>
<td><input type="text" name="basic[]" class="" value="<?php echo $key->basic; ?>"  readonly/></td>
<td><input type="text" name="dearness[]" class="" value="<?php echo $key->DA; ?>"  readonly/></td>
<td><input type="text" name="hra[]" class="" value="<?php echo $key->HRA; ?>"  readonly/></td>
<td><input type="text" name="ca[]" class="" value="<?php echo $key->CA; ?>"  readonly/></td>
<td><input type="text" name="cca[]" class="" value="<?php echo $key->CCA; ?>"  readonly/></td>
<td><input type="text" name="ea[]" class="" value="<?php echo $key->EA; ?>"  readonly/></td>
<td><input type="text" name="or[]" class="" value="<?php echo $key->Other_reimb; ?>"  readonly/></td>
<td><input type="text" name="oa[]" class="" value="<?php echo $key->OA; ?>"  readonly/></td>
<td><input type="text" name="ot[]" class="" value="<?php echo $key->OT; ?>"  readonly/></td>
<td><input type="text" name="wa[]" class="" value="<?php echo $key->WA; ?>"  readonly/></td>
<td><input type="text" name="lta[]" class="" value="<?php echo $key->LTA; ?>"  readonly/></td>
<td><input type="text" name="monthly_gross[]" class="" value="<?php echo $key->monthly_gross; ?>"  readonly/></td>
<td><input type="text" name="pf[]" class="" value="<?php echo $key->PF; ?>"  readonly/></td>
<td><input type="text" name="vpf[]" class="" value="<?php echo $key->VPF; ?>"  readonly/></td>
<td><input type="text" name="esic[]" class="" value="<?php echo $key->ESIC; ?>"  readonly/></td>
<td><input type="text" name="pt[]" class="" value="<?php echo $key->PT; ?>"  readonly/></td>
<td><input type="text" name="it[]" class="" value="<?php echo $key->IT; ?>"  readonly/></td>
<td><input type="text" name="lwf[]" class="" value="<?php echo $key->LWF; ?>"  readonly/></td>
<td><input type="text" name="od[]" class="" value="<?php echo $key->OD; ?>"  readonly/></td>

<td><input type="text" name="net_pay[]" class="" value="<?php echo $key->net_pay; ?>"  readonly/></td>

<td><input type="text" name="payment_mode[]" class="" value="<?php echo $key->paymentmode; ?>"  readonly/></td>
<td><input type="text" name="year[]" class="" value="<?php echo $key->year; ?>"  readonly/></td>
<td><input type="text" name="month[]" class="" value="<?php echo $key->month; ?>"  readonly/></td>
<td><input type="text" name="epf_wages[]" class="" value="<?php echo $key->epf_wages; ?>"  readonly/></td>
<td><input type="text" name="total_dud[]" class="" value="<?php echo $key->total_deduction; ?>"  readonly/></td>


		</tr>
			
	<?php } ?>
    </tbody>
<!--     <input type="submit" value="upload"/>-->
    
</table>
</div>
</div>
	</div>
</div>
</div>
</div>