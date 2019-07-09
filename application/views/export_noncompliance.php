<!-- <div class="col-sm-5"> -->
	<div class="container">
	<div class="widget-box ">
		<div class="widget-header">
			<h4 class="widget-title">Non Compliance Report</h4>
		</div>

		<div class="widget-body container">
			<div class="widget-main padding">
			<?php      
		        echo "<span style='color:red'>".show_msg()."</span>";
		        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		        echo form_open(base_url(''.$user_type.'/export/noncompliance'), $attributes);
        	?>            
				<!-- 	<legend>Form</legend> -->
				<br>
				<div class="row">
					 <div class="col-sm-5">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Company Name</label>
								</div>
								<div class="col-sm-5">
									<input type="text" id="comp_name" class="width-100" name="cust_name" required list="comp" />
									
									<datalist id="comp">
									<?php 
									foreach ($result as $key) {
										echo "<option data-value='".$key->custid."' value='".$key->entity_name."' />";
									}
									?>
									</datalist>
									<!-- <input type="text"  name="comp_name" placeholder="Type something&hellip;" class="form-control required" /> -->
									<input type="hidden" name="spgid" value="<?php echo user_id();?>">
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>						
						
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Company Register Id</label>
								</div>
								<div class="col-sm-5">
									<input type="text" name="custid" placeholder="Type something&hellip;" id="custid" class="form-control required" />
									
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
				</div>

				
				<div class="row">
					<div class="form-actions center">
						<input type="submit" class="btn btn-sm btn-success" name="submit" value="Submit">
							
							<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
						<!-- </button> -->
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	 
  $("#comp_name").on('input', function(){

  	var datalist=$('#comp option');
  	var val=$(this).val();
  	var optionvalue= datalist.filter(function() {
            return this.value == val;
        }).data('value');

    $('#custid').val(optionvalue);    
  });

});
</script>