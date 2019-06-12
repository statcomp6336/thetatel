<!-- <div class="col-sm-5"> -->
	<div class="container">
	<div class="widget-box ">
		<div class="widget-header">
			<h4 class="widget-title">Missign UAN Number</h4>
		</div>

		<div class="widget-body container">
			<div class="widget-main padding">
			<?php      
		        echo "<span style='color:red'>".show_msg()."</span>";
		        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		        echo form_open(base_url(''.$user_type.'/export/missing-uan'), $attributes);
        	?>            
				<!-- 	<legend>Form</legend> -->
				<br>
				<div class="row">
					 <div class="col-sm-4">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Company Name</label>
								</div>
								<div class="col-sm-5">

									<input type="text"  name="comp_name" placeholder="Type something&hellip;" class="form-control required" />
									
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>						
						
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Company Register Id</label>
								</div>
								<div class="col-sm-5">

									<input type="text" name="custid" placeholder="Type something&hellip;" class="form-control required" />
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-5">
									<label>Location</label>
								</div>
								<div class="col-sm-5">

									<select class="form-control required" ></select>
									<span class="help-block hide" name="location">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
				</div>

				<div class="row">
					<div class="form-group center">
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
</div>