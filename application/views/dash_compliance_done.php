
<?php echo show_msg();?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
<style type="text/css">
	table thead th {
    background-color: #2e2626c9;
    color: lightgray;
}
</style>
		
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">User Master Table</h4>

		<div class="widget-toolbar">
			<a href="#modal-wizard-company" data-toggle="modal" class="pink">
				
				<button class="btn btn-success" id="import" >Get Total Scope</button> 
			</a>

			<a href="#modal-wizard-user" data-toggle="modal" class="pink" >
			<button class="btn btn-info" > Download</button> 
			</a>
		</div>

	</div>
	<div class="widget-body ">
		<div class="widget-main">

		
<table id="simple-table" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<label class="pos-rel">
					
					<span class="lbl">Sr.No</span>
				</label>
			</th>
			
			<th>Company Id</th>
			<th>Company Name</th>
			<th >Act Name</th>

			<th>
				Particular
			</th>
			<th>
				Frequency
			</th>
			<th>
				Due date
			</th>
			<th>
				Act Type
			</th>
			<th>
				Receive Date
			</th>
			<th>
				Year
			</th>
			
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
		if (!empty($result)) {	
		
		foreach ($result as $key) {
			$count++;			
		?>
		<tr>
			<td class="center">
				<label class="pos-rel">
					
					<span class="lbl"><?php echo $count; ?></span>
				</label>
			</td>
			<td>
				<a href="#"><?php echo $key->custid;?></a>
			</td>
			<td><?php echo $key->entity_name;?></td>
			<td><?php echo $key->act;?></td>

			<td class="hidden-480"><?php echo $key->Particular;?></td>
			<td><?php echo $key->Reg_freq;?></td>
			<td><?php echo $key->Statutory_due_date;?></td>
			<td><?php echo $key->act_type;?></td>
			<td><?php echo $key->Certi_rece_date;?></td>
			<td><?php echo $key->year;?></td>	
			
		</tr>
		
	<?php } }?>
		
	</tbody>
</table>
</div>	
	</div>
</div>	
<?php //echo $links; ?>
</div>


		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery-ui.custom.min.js"></script>
		
		<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-tag.min.js"></script>



<!-- add and Remove company -->
<div id="modal-wizard-company" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Create Spg User</h4>
				</div>
				 <?php 
		$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 echo form_open_multipart(base_url(''.$user_type.'/Complilnce-Done'),$attributes );?>	
				<div class="modal-body">
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Companyies</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<select name="custid" required class="width-100">
									<option value="ALL">ALL</option>
									<?php 
									$ar1=array();
									foreach ($company as $key) { 
									if (!in_array($key->custid, $ar1))
										  {
										  	 echo "<option value=".$key->custid.">".$key->entity_name."</option>";
										  }										
											array_push($ar1, $key->custid);
										}
									?>
		                          
		                        </select>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>
					<!--  -->
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Act Type</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<select name="act_code" required class="width-100">
									<option value="ALL">ALL</option>
									<?php 
											$ar=array();							
									foreach ($company as $key) {
										if (!in_array($key->act_code, $ar))
										  {
										  echo "<option value=".$key->act_code.">".$key->act."</option>";
										  }										
											array_push($ar, $key->act_code);					

		                          }
									?>
		                          
		                        </select>
		                       
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> </div>
					</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" name="submit" value="Submit">
					
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				</button>

				<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Cancel
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div><!-- PAGE CONTENT ENDS -->