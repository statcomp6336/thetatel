
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


/* timeline css */
body{
  line-height:1.3em;
  min-width:920px;
}
.history-tl-container{
    font-family: "Roboto",sans-serif;
  width:100%;
  margin:auto;
  display:block;
  position:relative;
}
.history-tl-container ul.tl{
   /* margin:20px 0;*/
    padding:0;
    /*display:inline-block;*/

}
.history-tl-container ul.tl li{
    list-style: none;
    margin:auto;
    margin-left:200px;
    min-height:50px;
    /*background: rgba(255,255,0,0.1);*/
    border-left:3px dashed #86D6FF;
    padding:0 0 50px 30px;
    position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
    position: absolute;
    left: -22px;
    top: -5px;
    content: " ";
    border: 8px solid rgba(255, 255, 255, 0.74);
    border-radius: 500%;
    background: #258CC7;
    height: 40px;
    width: 40px;
    transition: all 500ms ease-in-out;

}
.history-tl-container ul.tl li:hover::before{
    border-color:  #258CC7;
    transition: all 1000ms ease-in-out;
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
    color:rgba(0,0,0,0.5);
    font-size:12px;
}
ul.tl li .timestamp{
    color: #8D8D8D;
    position: absolute;
    width:100px;
    left: -50%;
    text-align: right;
    font-size: 12px;
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
		<h4 class="widget-title">Bulk Approval</h4>

		<div class="widget-toolbar">
			<a href="#modal-wizard-extract" data-toggle="modal" class="pink">
				
				<button class="btn btn-success" id="import" > Extract Data</button> 
			</a>

			
			 
			
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
             <th>DueDate</th> 
             <?php 
				if ($this->input->post('act_type') =='Registration') { ?>	            
              <th>Application  Date</th>
              <th> Registration No</th>
              <th>Applicable Date </th>
              <th> Valid Upto</th>
              <th> Renewal Date</th>
              <th> Pay Date</th>
          <?php } ?>
              <th> Remark</th>
              <th> Task Completion date</th>
              <th> Action</th>
              <th> Comment</th>
              
              <th> Flow Of Work</th>
              <th> Document Download</th>
		</tr>
	</thead>
<?php 
if ($bulk_data['data']!=="N/A") {
$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
 echo form_open_multipart(base_url(''.$user_type.'/compliance/bulk-approval/update'),$attributes );?>
	<tbody>
		<?php $count =0;
		foreach ($bulk_data['data'] as $key) {
			$count++;			
		?>
		<tr>
			<td class="center"><label class="pos-rel"><span class="lbl">
				<input type="hidden" name="custid" value="<?php echo $this->input->post('custid');?>">
				<input type="hidden" name="srno[]" value="<?php echo $key->srno; ?>"><?php echo $count; ?></span></label></td>
			<td>
				<a href="#" class="comment more"><?php echo $key->act;?></a>
			</td>
			<td class="comment more"><?php echo $key->Particular;?></td>
			<td ><?php echo $key->due_date."</td>";
			
			if ($key->act_type == 'Registration') { ?>
			<td>
				<input type="hidden" name="registration_form[]" value="registration form"/>
				<?php echo $key->Application_date;?>
				</td>
          	<td><?php echo $key->registration_no;?></td>
          
          	<td><?php echo $key->Applicable_date;?></td>
          	<td><?php echo $key->Valid_upto;?></td>
          	<td><?php echo $key->Renewal_date;?></td>
          	<td><?php echo $key->Submisn_Pay_date;?></td>
		<?php }

		 ?>
			
			<td class="comment more"><?php echo $key->Remarks;?></td>
			<td><?php echo $key->Task_complitn_date;?></td>
			<td><select name="compliancestatus[]">           
                          <option value="approval" selected>approval</option>
                          <option value="rejection">rejection</option>               
                </select>
            </td>
	        <td>
	            <input type="text" value="" name="comment[]"/>
	        </td>
	        <td>
	        	<a href="#modal-wizard-flow" data-toggle="modal" class="pink" >
					<img src="<?php echo base_url('assets/flow_of_work.png');?>" height=" 50px" class="spin"  data-flow="<?php echo $key->srno; ?>"> 
				</a>
			</td>
	        <td><a href="#modal-wizard-up" data-toggle="modal" class="pink" >
					<button class="up" id="up" data-upload="<?php echo $key->srno; ?>"> 6 </button> 
				</a></td>

		

			
		</tr>

		
	<?php } ?>
	<button class="btn btn-warning" type="submit" > Save Compilence </button>
		<?php echo form_close();
	 }else
		{
			echo "<tbody><tr><td colspan='15' class='center'> Data Not Found..!</td></tr>";
		} ?>
		
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
				/* display timeline data flow of work */
				$('table tr td .spin').on('click',function(){
					var no=$(this).data("flow");					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url('spg/Spg/flow_of_work');?>",       //echo base_url(''.$user_type.'/fetch/uploaded-acts-files');?>      
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:no,								   
								  }, 
					        success: function(response){                    
					            $(".flow_of_work_box").html(response);
					            // alert(response);			            
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

			$(document).on('click','#docs_up .remove1',(function(e){
				e.preventDefault();
					var id=$(this).data("id");					
					$.ajax({    //create an ajax request to display.php
					        type: "POST",
					        url: "<?php echo base_url('spg/Spg/r');?>",       //echo base_url(''.$user_type.'/fetch/uploaded-acts-files');?>      
					        dataType: "html",   //expect html to be returned
					       data: {
								   srno:id,								   
								  }, 
							
					        success: function(set){                    
					            alert(set);			            
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
					 echo form_open_multipart(base_url(''.$user_type.'/compliance/bulk-approval'),$attributes );?>	
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
								<input type="text" id="inputWarning" name="custid" class="width-100 require" required />
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
								<select class="width-100" name="act_type" required>
									<option value="">Select Act type</option>
									<option value="Preventive_Compliance">Preventive Compliance </option>
                                    <option value="Compliance" >Compliance</option>
                                    <option value="Registration">Registration</option>                
                    			</select>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Act</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								
								<i class="ace-icon fa fa-leaf green"></i>
								<select class="width-100" name="act">
									<option value="ALL" selected>All</option>
									<?php 
									if (!empty($bulk_data['acts'])) {
										
										foreach ($bulk_data['acts'] as $val) {
											echo "<option value='".$val->act_code."'>".$val->act."</option>";
										}
									}
									?>
									
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




<div id="modal-wizard-flow" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Flow of Work</h4>
				</div>
				
				<div class="modal-body">										
					<div class="flow_of_work_box">
						
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


