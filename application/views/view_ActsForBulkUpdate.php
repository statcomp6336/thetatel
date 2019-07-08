<style type="text/css">
	.widget-main{
		height: fit-content;
	}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php 
    if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?>	<!-- <div class="col-sm-5"> -->
	<div class="container">
	<div class="widget-box ">
		<div class="widget-header">
			<h4 class="widget-title"> View Company Compliance for Bulk Update </h4>
		</div>

		<div class="widget-body container">
			<div class="widget-main padding">
			<?php      
		        
		        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		        echo form_open(base_url(''.$user_type.'/company/act'), $attributes);
        	?>            
				<!-- 	<legend>Form</legend> -->
				<br>
				<div class="row">
					 <div class="col-sm-6">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-6">
									<label>Company Name</label>
								</div>
								<div class="col-sm-6">

								<input type="text" id="comp_name" class="width-100" name="cust_name" required list="comp" />
									
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
					<div class="col-sm-6">
						<div class="form-group">
							<div class="row">
					 			<div class="col-sm-6">
									<label>Company Register Id</label>
								</div>
								<div class="col-sm-6">

									<input type="text" name="custid" placeholder="Type something&hellip;" id="custid" class="form-control required" />
									<span class="help-block hide">Example block-level help text here.</span>
								</div>
							</div>
						</div>	
					</div>
					
				</div>

				<div class="row">
					<div class="form-group center">
			
						<input type="submit" class="btn btn-sm btn-success submit" name="submit" value="Submit">
							
							

						<!-- </button> -->
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
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
<?php 
if (!empty($result)) { ?>
	<script>
$(document).ready(function(){
	
		$("#myModal").modal('show');
});
</script>		
	
<?php }
?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Act for <strong> <?php 
                echo !empty($this->input->post('cust_name'))?$this->input->post('cust_name'):"Company";
                ?></strong></h4>
            </div>
            <div class="modal-body">
				
				<?php 
if (!empty($result)) { 
$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		        echo form_open(base_url(''.$user_type.'/company/attachAct'), $attributes);

	?>
               
<table id="simple-table" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<label class="pos-rel">
					
					<span class="lbl">Sr.No</span>
				</label>
			</th>
			<th></th>
			<th>Act Name</th>
			<th>Act Code</th>
			
		</tr>
	</thead>

	<tbody>
		<?php 
        	 $count =0;
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

				<input type="checkbox"  name="actCode[]" id="act_code[]"  value="<?php echo $key->act_code; ?>" 	<?php if (!empty($key->is_check) && $key->is_check=='check') {
					echo "checked   disabled";
				} ?> />	
			</td>
			<td><?php echo $key->act;?></td>
		
			<td class="hidden-480">
				<span class="label label-sm label-warning"><?php echo $key->act_code;?></span>
			</td>			
		</tr>
		
		
	<?php }?>
	
	</tbody>
</table>
<input type='hidden' name='custId' value='<?php echo $this->input->post('custid');?>' >
		<input type='hidden' name='compName' value='<?php echo $this->input->post('cust_name');?>' >
		<input type="submit" name="submit" value="submit" class="btn btn-primary">
		<?php echo form_close(); ?>

                <?php }
?>
            </div>
        </div>
    </div>
</div>