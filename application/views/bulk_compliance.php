
<style type="text/css">
	table td{		  
			position:relative; 
	}
	
 table td .up {
  height: 30px;
  width: 40px;
  border-radius: 50px 0px 0px 50px;
  padding: 2px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
 	background: #f39929;
    color: darkblue;
  position: absolute;
  right:    0;
  bottom:   1px;
  transition-property: width;
  transition-duration: 0.3s;
  transition-timing-function: linear;
  transition-delay: 0.3s;
  
}
table td .up:hover {  
  height: 30px;
  width: 100%;
}
table td .up:hover:before {  
  content:"View Files"; 
}
</style>
<?php echo show_msg();?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div id="kaypn"></div>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Bulk Compliance</h4>

		<div class="widget-toolbar">
			<a href="#modal-wizard-extract" data-toggle="modal" class="pink">
				
				<button class="btn btn-success" id="import" > Extract Data</button> 
			</a>

			<!-- <a href="#modal-wizard-up" data-toggle="modal" class="pink" >
			<button class="up" > Create User</button> 
			</a> --> 
		</div>

	</div>
	<div class="widget-body ">
		<div class="widget-main">
		<?php 
			if (!empty($bulk_data['data'])) { ?>		
		
<table id="simple-table" class="table  table-bordered table-hover ">
	<thead>
		<tr>
			<th class="center"><label class="pos-rel">				
					<span class="lbl">Sr.No</span>
					</label>
			</th>			
			<th>Act</th>
			<th>Particular</th>
			<th >Obligation</th>
			<th>challan date</th>
			
			<th>Pay date</th>
			<th>Pending doc</th>
			<th>Doc upload	</th>
			<th>Remark</th>
			<th>Pending Status</th>
			<th>Flow of work</th>
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
		foreach ($bulk_data['data'] as $key) {
			$count++;			
		?>
		<tr>
			<td class="center">
				<label class="pos-rel">
					
					<span class="lbl"><?php echo $count; ?></span>
				</label>
			</td>
			<td>
				<a href="#"><?php echo $key->act;?></a>
			</td>
			<td><?php echo $key->Particular;?></td>
			<td class="hidden-480"><?php echo $key->obligation;?></td>
			<td><input type="date"  name="Challan_genrtn_date[]" value="<?php echo $key->Retrn_Challan_genrtn_date;?>" class="width-50"></td>

			
			<td >
				<input type="date" name="Pay_date[]" value="<?php echo $key->Submisn_Pay_date;?>">
			</td>
			<td >
				<input type="text" name="Pend_docu_no[]" value="<?php echo $key->Pend_docu_in_nos;?>">

			</td>
			<td class="center">
				<a href="#modal-wizard-upload" data-toggle="modal" class="pink" >
					<button id="upload_file" class="btn btn-info" data-custid="<?php echo $key->srno; ?>"> Upload Docs</button>
				</a>

				<a href="#modal-wizard-up" data-toggle="modal" class="pink" >
					<button class="up" id="up" data-upload="<?php echo $key->srno; ?>"> 6 </button> 
				</a> 
				<!-- <div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div> -->
			</td>
			<td><input type="text" name="remark[]" value="<?php echo $key->Remarks;?>"></td>
			<td><select  name="statusforpending[]">
	              			<option value=" " selected>--Select--</option>
	                        <option value="cust">Pending with Customer</option>
	                        <option value="spg">Pending with SPG</option> 
	                        <option value="approval" >Pending For Approval</option>     
	                </select>
	            </td>
	            <td></td>
		

			
		</tr>

		<!-- <tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-4 col-sm-4">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Employee Name </div>

									<div class="profile-info-value">
										<span><?php echo $key->emp_name;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Date of Birth </div>

									<div class="profile-info-value">
										<span><?php echo $key->birth_date;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Gender </div>

									<div class="profile-info-value">
										<span><?php echo $key->gender;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Current Address </div>

									<div class="profile-info-value">
										<span><?php echo $key->temp_address;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Email Address </div>

									<div class="profile-info-value">
										<span><?php echo $key->email;?></span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Employee Phone Number </div>

									<div class="profile-info-value">
										<span><?php echo $key->mob;?></span>
									</div>
								</div>


							</div>
						</div>

						<div class="col-xs-4 col-sm-4">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Bank Name </div>

									<div class="profile-info-value">
										<span><?php echo $key->bank_name;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Branch Name </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span><?php echo $key->bank_branch;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Account Number </div>

									<div class="profile-info-value">
										<span><?php echo $key->bank_ac;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> IFSC Code </div>

									<div class="profile-info-value">
										<span><?php echo $key->ifsc;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> PAN Number </div>

									<div class="profile-info-value">
										<span><?php echo $key->pan;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> AADHAR Number </div>

									<div class="profile-info-value">
										<span><?php echo $key->adhaar;?></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-4 col-sm-4">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Company Name </div>

									<div class="profile-info-value">
										<span><?php echo $key->entity_name;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Department </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span><?php echo $key->dept;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Designation </div>

									<div class="profile-info-value">
										<span><?php echo $key->designation;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<span><?php echo $key->location;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Join Date </div>

									<div class="profile-info-value">
										<span><?php echo $key->join_date;?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Exiting Date </div>

									<div class="profile-info-value">
										<span><?php echo $key->exit_date;?></span>
									</div>
								</div>
								<button> Know More..</button>
							</div>
						</div>>
					</div>
				</div>
			</td>
		</tr> -->
	<?php }?>
		
	</tbody>
</table>
<?php
}
		?>	
</div>	
	</div>
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
				/***************/
				
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				// $('#import').on('click', function(){
					
				// 	 $('.widget-main').toggle();
				// });
				$('table tr td #up').on('click',function(){
					var no=$(this).data("upload");

					var cust=14006140001;
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url('spg/Spg/f');?>",       //echo base_url(''.$user_type.'/fetch/uploaded-acts-files');?>      
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:no,								   
								  }, 
					        success: function(response){                    
					            $("#docs_up").html(response);			            
					        }
					    });
				});

				$('table tr td #upload_file').on('click',function(){
					var s=$(this).data("custid");
					$(".srn").val(s);

				});
				/* upload files on database */
				 $("#upl").on('submit',(function(e) {
				 	e.preventDefault();
					var s1=$(".srn").val();
					var file=$('#uploadImage').val();
					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url('spg/Spg/g');?>",       //echo base_url(''.$user_type.'/fetch/uploaded-acts-files');?>      
					        dataType: "html",   //expect html to be returned
					      	data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,				   
							success: function(re){                    
					            // $("#kaypn").html(re);
					            alert(re);			            
					        }
					    });
				}));

			$('.modal-body #docs_up .remove1').on('click',(function(e){
				e.preventDefault();
					var id=$(this).data("id");
					alert(id);

					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url('spg/Spg/r');?>",       //echo base_url(''.$user_type.'/fetch/uploaded-acts-files');?>      
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:id,								   
								  }, 
								  contentType: false,
							cache: false,
							processData:false,
					        success: function(response){                    
					            alert(response);			            
					        }
					    });
				}));

			
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







<div id="modal-wizard-extract" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Bulk Update	</h4>
				</div>
				 	<?php 
					$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
					 echo form_open_multipart(base_url(''.$user_type.'/compliance/bulk-compliance'),$attributes );?>	
				<div class="modal-body">										
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Name</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Reg. id</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" name="custid" class="width-100" />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Act Type</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								
								<i class="ace-icon fa fa-leaf green"></i>
								<select class="width-100" name="act_type">
									<option value="Preventive_Compliance">Preventive Compliance </option>
                                    <option value="Compliance">Compliance</option>
                                    <option value="Registration">Registration</option>                
                    			</select>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Month</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								
								<i class="ace-icon fa fa-leaf green"></i>
								<select class="width-100" name="month">
									<option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
								</select>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" value="Extract" name="submit">
				
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				

				<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Cancel
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div><!-- PAGE CONTENT ENDS -->




<div id="modal-wizard-upload" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Bulk Update	</h4>
				</div>
				<!-- <form id="form" name="upl" id="upl" enctype="multipart/form-data"> -->
				 	<?php 
					$attributes = array('name' => 'upl', 'id' => 'upl');
					 echo form_open_multipart('',$attributes );?>	
				<div class="modal-body">										
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">srno</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100 srn" disabled />
								<input type="hidden" name="sr" class="srn" />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Upload File</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								
								<input multiple="" type="file" name="image" id="id-input-file-3" />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>				

					
					
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<!-- <input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" value="Extract" name="submit"> -->
				<!-- <button class="btn btn-success btn-sm btn-next"  > submit</button>  -->
				
				<button class="btn btn-warning btn-sm pull-right" id="sub" type="submit" data-last="Finish">
					<i class="ace-icon fa fa-times"></i>
					next
				</button>

				<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Cancel
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>


<!-- download model box -->

<div id="modal-wizard-up" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Bulk Update	</h4>
				</div>
				 	<?php 
					$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
					 echo form_open_multipart(base_url(''.$user_type.'/compliance/bulk-compliance'),$attributes );?>	
				<div class="modal-body">
				<div id="docs_up"></div>										
					
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" value="Extract" name="submit">
				
					<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
				

				<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Cancel
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
