<?php 
	$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
	 echo form_open_multipart(base_url(''.$user_type.'/user/reset-password'),$attributes );
?>	
<?php 
    if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?>				
					
<div class="container"><div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Name.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="text" id="comp_name" class="width-100" name="cust_name" required list="comp" />
				<i class="ace-icon fa fa-leaf green"></i>
				<datalist id="comp">
				<?php 
				foreach ($companys as $key) {
					echo "<option data-value='".$key->custid."' value='".$key->entity_name."' />";
				}
				?>

			</datalist>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Custmer register id.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="text" class="width-100" name="custid" required id="custid" />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Email address.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="email" id="inputWarning" class="width-100" name="email" required />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Username.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="text" id="inputWarning" class="width-100" name="username" required />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Old Password.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="password" id="inputWarning" class="width-100" name="oldpassword" required />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">New Password.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="password" id="inputWarning" class="width-100" name="newpassword" required />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>

	<div class="form-group">
		<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password.</label>

		<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
				<input type="password" id="inputWarning" class="width-100" name="confirm" required />
				<i class="ace-icon fa fa-leaf green"></i>
			</span>
		</div>
		<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
	</div>


	<input class="btn btn-success btn-sm btn-next pull-right"  type="submit" name="submit" value="Set Password">
	
	

	
	<input type="reset" value="Cancel" class="btn btn-danger btn-sm pull-left">
			</div>
			<?php echo form_close(); ?>
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