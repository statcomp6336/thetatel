<style type="text/css">
	.widget-main{
		height: auto;
	}
	.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
.profile-info-name {
    text-align: right;
    padding: 6px 10px 6px 4px;
    font-weight: 400;
    color: #050003;
    background-color: transparent;
    width: 200px;
    vertical-align: middle;
}
.fillup-company
{
	height: 300px;
	display: inline-block;
	overflow: scroll;

}
</style>
<?php echo show_msg();?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">User Master Table</h4>

		<div class="widget-toolbar">
			<a href="#modal-wizard-company" data-toggle="modal" class="pink">
				
				<button class="btn btn-success" id="import" >Get Total Scope</button> 
			</a>

			<a href="<?php echo base_url(''.$user_type.'/download/totalscope/'.user_id().'');?>" data-toggle="modal" class="pink" >

			<button class="btn btn-info" > Downloadd</button> 
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
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/dataTables.select.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.bootstrap-duallistbox.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.raty.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-multiselect.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/select2.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery-typeahead.js"></script>
		<script type="text/javascript">
			var expanded = false;

			function showCheckboxes() {
			  var checkboxes = document.getElementById("checkboxes");
			  if (!expanded) {
			    checkboxes.style.display = "block";
			    expanded = true;
			  } else {
			    checkboxes.style.display = "none";
			    expanded = false;
			  }
			}
		</script>										
		<script type="text/javascript">
			jQuery(function($) {
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
				
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});

				$('.add_comp').on('click', function() {
					
					var no=$(this).data("add");
					var spg=$(this).data("spg");
					var user=$(this).data("user");
					alert(no);					
					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url(''.$user_type.'/user/get-companys/');?>"+no,            
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:no,								   
								  }, 
					        success: function(response){
					        $('#spgid').val(spg);
					        $('#username').val(user);
					         $('#actions').val('add');  
					            $(".fillup-company").html(response);			            
					        }
					    });
				});

				$('.remove_comp').on('click', function() {
					
					var no=$(this).data("remove");
					var spg=$(this).data("spg");
					var user=$(this).data("user");
									
					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url(''.$user_type.'/user/remove-companys/');?>"+no,            
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:no,								   
								  }, 
					        success: function(response){
						        $('#spgid').val(spg);
						        $('#username').val(user);                  
						        $('#actions').val('remove');                  
						        $(".fillup-company").html(response);			            
					        }
					    });
				});


				
				
			
			
			})
		</script>



		<script src="<?php echo base_url();?>assets/dashboard/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/spinbox.min.js"></script>
	<!-- 	<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script> -->
		<script src="<?php echo base_url();?>assets/dashboard/js/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/daterangepicker.min.js"></script>
		<!-- <script src="assets/js/bootstrap-datetimepicker.min.js"></script> -->
		<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/jquery.maskedinput.min.js"></script>
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
		 echo form_open_multipart(base_url(''.$user_type.'/total-scope'),$attributes );?>	
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