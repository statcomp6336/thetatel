<?php echo show_msg();


?>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Companies Details  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Sr.No</th>			
			<th class="center">Company Name</th>
			<th class="center">Company ID</th>
			<th class="center">Alliance ID</th>							
		</tr>
	</thead>

	<tbody>
<?php $count =0;//$spgid=$this->session->SESS_CUST_ID;
foreach ($result as $key) {
	$entity_name=$key->entity_name;
	$custid=$key->custid;
	$spgid=$key->allianceid;
	$count++;		
?>
		<tr>
			<td class="center">
				<label class="pos-rel"><span class="lbl"><?php echo $count; ?></span></label>
			</td>
			<td>
	<a href="<?php echo base_url(''.$user_type.'/branch/registration/'.$spgid.'/'.$custid.'/'.$entity_name.'');?>">

	<?php echo $entity_name;?></a> 
			</td>
			<td class="center"><?php echo $custid;?></td>
			<td class="center"><?php echo $spgid;?></td>
		</tr>		
<?php }?>		
	</tbody>
</table>

</div>	
	</div>
</div>	