<?php echo show_msg();


?>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Form-D Details  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	

<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">1.Name of the Establishment:</th>			
			<th class="center">2.Nature of Industry:</th>
			<th class="center">3.Name of the Employer: SPG</th>
			<th class="center">4.Total No of Employee :</th>	
			<th class="center">5.Number of employee benifited by bonus payment:</th>
			<th class="center">6.Complete Address:</th>						
		</tr>
	</thead>
</table>



		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Total amount payable as bonus under section 10 or 11 of the payment of bonus act 1965 as the case may be</th>			
			<th class="center">Settelment if any, reached under section 18 (1) or 12 (3) of the Industrial Disputes Act 1947 with date</th>
			<th class="center">Percentage bonus declared to be paid</th>
			<th class="center">Total Amount of bonus actually paid</th>	
			<th class="center">Date on which payment maid</th>
			<th class="center">Weather Bonus has been paid to all employee if not reason for non payment</th>
			<th class="center">Remark</th>						
		</tr>
	</thead>

	<tbody>
<?php $count =0;//$spgid=$this->session->SESS_CUST_ID;
foreach ($result as $key) {
	$entity_name=$key->entity_name;
	$custid=$key->custid;
	//$spgid=$key->allianceid;
	$count++;		
?>
		<tr>
			<td class="center">
				<label class="pos-rel"><span class="lbl"><?php echo $count; ?></span></label>
			</td>
			<td>

	

	<?php echo $entity_name;?></a> 
			</td>
			<td class="center"><?php echo $custid;?></td>
			<td class="center"><?php //echo $spgid;?></td>
		</tr>		
<?php }?>		
	</tbody>
</table>

</div>	
	</div>
</div>	