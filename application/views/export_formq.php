<?php 
 if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
?>
<style type="text/css">
	.widget-main{
		height: fit-content;
	}
</style><!-- <div class="col-sm-5"> -->
	<div class="container">
	<div class="widget-box ">
		<div class="widget-header">
			<h4 class="widget-title">Form-Q Reports</h4>
		</div>

		<div class="widget-body container">
			<div class="widget-main padding">
			<?php      
		      
		        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		        echo form_open(base_url(''.$user_type.'/export/formq'), $attributes);
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

									<input type="text"  name="entity_name" placeholder="Type something&hellip;" id="comp_name" class="form-control required" list="comp" />
									<input type="hidden" name="spgid" value="<?php echo user_id();?>">
									<datalist id="comp">
									<?php 
									foreach ($companys as $key) {
										echo "<option data-value='".$key->custid."' value='".$key->entity_name."' />";
									}
									?>

								</datalist>
									
									
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

									<input type="text" name="custid" id="custid" placeholder="Type something&hellip;" class="form-control required" />
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
				</div>

				<div class="row">
					 <div class="col-sm-5">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Month</label>
								</div>
								<div class="col-sm-5">

									<select class="form-control required" name="month" >
										<option value="ALL" selected>ALL</option>
										<option value="Jan">JAN</option>
										<option value="Feb">Feb</option>
										<option value="Mar">Mar</option>
										<option value="Apr">Apr</option>
										<option value="May">May</option>
										<option value="Jun">Jun</option>
										<option value="Jul">Jul</option>
										<option value="Aug">Aug</option>
										<option value="Sep">Sep</option>
										<option value="Oct">Oct</option>
										<option value="Nov">Nov</option>
										<option value="Dec">Dec</option>
										

									</select>
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>						
						
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Year</label>
								</div>
								<div class="col-sm-5">

									<select  class="form-control required" name="year" >
										<option value="ALL">ALL</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
									</select>
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
				</div>

				<div class="row">
					 <div class="col-sm-5">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Location</label>
								</div>
								<div class="col-sm-5">

									<select class="form-control required" name="location">
										<option value='ALL' selected>ALL</option>
										<?php
										foreach ($result as $key) {
											
										?>
										<option value='<?php echo $key->location; ?>'><?php echo $key->location; ?></option>
										<?php } ?>
									</select>
									<span class="help-block hide" name="location">Example block-level help text here.</span>
								</div>
							</div>
						</div>						
						
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<!-- <div class="row">
					 			<div class="col-sm-5">
									<label>Label name</label>
								</div>
								<div class="col-sm-5">

									<input type="text" placeholder="Type something&hellip;" class="form-control required" />
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div> -->
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