<?php echo show_msg();
?>

	<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Reconcile Backlog Process  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Sr.No</th>
			<th>Company ID</th>
			<th>Company Name</th>
			<th>Total Diffrent Employees</th>
			<th >Total Diffrent Salary's</th>
			<th>Month&year</th>
			<th>Employee Data</th>			
			<th>Salary Data</th>			
				
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
		foreach ($result as $key) {
			$count++;
			$month=$key->month.'/'.$key->year;			
		?>
		<tr>
			<td class="center">
				<label class="pos-rel">
					
					<span class="lbl"><?php echo $count; ?></span>
				</label>
			</td>

			<td class="center">
				<?php echo $key->custid;?>
			</td>

			<td>
				<a href="#"><?php echo $key->entity_name;?></a>
			</td>
			<td><?php echo $key->diffempdata;?></td>
			<td ><?php echo $key->diffsaldata;?></td>
			
			</td>
			<td class="hidden-480">
				<span class="label label-sm label-warning"><?php echo $key->month.'/'.$key->year;?></span>
			</td>
			<td><a href="<?php echo base_url(''.$user_type.'/report/backlog/employee/edit/'.$key->spgid.'/'.$key->custid.'');?>">
					<button class="btn btn-success radius-1">
						<i class="ace-icon fa fa-floppy-o "></i>
						Edit
					</button>
				</a>
			</td>
			<td><a href="<?php echo base_url(''.$user_type.'/report/backlog/salary/edit/'.$key->spgid.'/'.$key->custid.'');?>" onclick="confirm('Are you shure ..? If you are download this file then edit the data and upload master Process');" >
					<button class="btn btn-success radius-1">
						<i class="ace-icon fa fa-floppy-o "></i>
						Edit
					</button>
				</a>
			</td>			
		</tr>

		
	<?php }?>
		
	</tbody>
</table>
<?php //echo $links; ?>
</div>	
	</div>
</div>
	<script type="text/javascript">
		jQuery(function($) {	

			$("#bootbox-confirm").on(ace.click_event, function() {
								bootbox.confirm("Are you sure?", function(result) {
									if(result) {
										//
									}
								});
							});
		});
	</script>