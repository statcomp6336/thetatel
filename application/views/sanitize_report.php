<?php echo show_msg();

// var_dump($result);
// exit();
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Employee Master Table</h4>
		<div class="widget-toolbar">		

			<a href="<?php echo base_url(''.$user_type.'/report/sanitize/genrate');?>" >
			<button class="btn btn-info" > Genrate Sanitize Report</button> 
			</a>
		</div>
	</div>
	<div class="widget-body ">
		<div class="widget-main" >
		<?php
		// $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		//  echo form_open_multipart('spg/Spg/save_master_emp',$attributes );
			
			
		// 	  echo form_close(); ?>		
		
<table id="simple-table" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<label class="pos-rel">
					
					<span class="lbl">Sr.No</span>
				</label>
			</th>
			<th>Company ID</th>
			<th>Company Name</th>
			<th>Total Employees</th>
			<th >Total Salary's</th>

			<th>
				Differnce in Employee's	
			</th>
			<th>
				Differnce in Salary's	
			</th>

			<th>Month&year</th>

			<th></th>
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
		foreach ($result as $key) {
			$count++;			
		?>
		<tr>
			<td class="center">
				<label class="pos-rel">
					
					<span class="lbl"><?php echo $count; ?></span>
				</label>
			</td>

			<td class="center">
				<?php echo $key['custid'];?>
			</td>

			<td>
				<a href="#"><?php echo $key['comp_name'];?></a>
			</td>
			<td><?php echo $key['emp_data'];?></td>
			<td ><?php echo $key['sal_data'];?></td>
			<td><?php echo $key['diff_emp'];?></td>

			
			<td class="hidden-480">
				<span class="label label-sm label-warning"><?php echo $key['diff_sal'];?></span>
			</td>
			<td class="hidden-480">
				<span class="label label-sm label-warning">Expiring</span>
			</td>

			
		</tr>

		
	<?php }?>
		
	</tbody>
</table>
<?php //echo $links; ?>
</div>	
	</div>
</div>	


		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/dataTables.select.min.js"></script>										
		


		<script src="<?php echo base_url();?>assets/dashboard/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/spinbox.min.js"></script>
	
		<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-tag.min.js"></script>