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
.deleteButton {
background: transparent;
border: 1px solid #f00;
border-radius: 2em;
display: inline-block;
font-size: 12px;
height: 20px;
line-height: 2px;
margin: 0 0 8px;
padding: 0;
text-align: center;
width: 50px;
  background-color :#d15b47;
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

<?php 
    if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?><link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">User Master Table</h4>

		<div class="widget-toolbar">
			<a href="#modal-wizard-spg-user" data-toggle="modal" class="pink">
				
				<button class="btn btn-success" id="import" > Create SPG User</button> 
			</a>

			<a href="#modal-wizard-user" data-toggle="modal" class="pink" >
			<button class="btn btn-info" > Create User</button> 
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
			<th >Username Name</th>

			<th>
				Email Id	
			</th>
			<th>
				Access Code
			</th>

			<th>Add Company</th>
			<th>Remove Company</th>

			<th>Status</th>
			<th>Remove User</th>
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
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
			<td><?php echo $key->username;?></td>

			<td class="hidden-480"><?php echo $key->email;?></td>
			

			
			<td class="hidden-480">
				<span class="label label-sm label-warning"><?php echo $key->access_code;?></span>
			</td>
			<td>
				<a href="#modal-wizard-company" data-toggle="modal" class="green" title="Add Company" >
						<button class="add_comp"  data-add="<?php echo hash_id($key->srno); ?>" data-spg="<?php echo $key->custid; ?>" data-user="<?php echo $key->username; ?>">Add Company</button>
						
				</a>

			</td>

			<td>
				<a href="#modal-wizard-company" data-toggle="modal" class="red" title="Remove Company" >
						<button class="remove_comp" data-remove="<?php echo hash_id($key->srno); ?>" data-spg="<?php echo $key->custid; ?>" data-user="<?php echo $key->username; ?>">Remove Company</button>						
				</a>

			</td>
			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>
			<td class="center">
					<a href="<?php echo base_url(''.$user_type.'/user/remove/'.hash_id($key->srno).'');?>" title="Remove User" onclick="return confirm('Are you sure?')">
						<button class="deleteButton"> 
						<i class="ace-icon fa fa-times btn-danger"></i></button>
						
					</a>
			</td>

			
		</tr>
		<tr class="detail-row">
			<td colspan="10">
				<div class="table-detail">
					
							
								<?php 
			$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 	echo form_open_multipart(base_url(''.$user_type.'/user/update'),$attributes );?>	
			 			<div class="row">
							<div class="col-xs-6 col-sm-6">

								<div class="profile-info-row">
									<div class="profile-info-name"> Company Register id </div>

									<div class="profile-info-value">
										<input type="text" name="custid" value="<?php echo $key->custid;?>">
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6">		
								<div class="profile-info-row">
									<div class="profile-info-name"> Company Name </div>

									<div class="profile-info-value">
										<input type="text" name="cust_name" value="<?php echo $key->entity_name;?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<div class="profile-info-row">
									<div class="profile-info-name"> Email id </div>

									<div class="profile-info-value">
										<span><input type="email" name="mailid" value="<?php echo $key->email;?>"></span>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span><input type="text" name="username" value="<?php echo $key->username;?>"></span>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<div class="profile-info-row">
									<div class="profile-info-name"> Access Code </div>

									<div class="profile-info-value">
										<span><input type="text" name="code" value="<?php echo $key->access_code;?>"></span>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6">
								<div class="profile-info-row">
									

									<div class="profile-info-value">
										<input type="hidden" name="srno" value="<?php echo $key->srno;?>">
										<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" name="spg_user" value="Submit">
									</div>
								</div>
							</div>
						</div>
								<?php echo form_close(); ?>


							
						</div>

						<div class="col-xs-4 col-sm-4">
							<div class="space visible-xs"></div>

							
						</div>

						<div class="col-xs-4 col-sm-4">
							<div class="space visible-xs"></div>

							
						</div>
					</div>
				</div>
			</td>
		</tr>

		
	<?php }?>
		
	</tbody>
</table>
</div>	
	</div>
</div>	
<?php echo $links; ?>
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
		   <script>
            function validatePassword(password) {
                
                // Do not show anything when the length of password is zero.
                if (password.length === 0) {
                    document.getElementById("msg").innerHTML = "";
                    return;
                }
                // Create an array and push all possible values that you want in password
                var matchedCase = new Array();
                matchedCase.push("[$@$!%*#?&]"); // Special Charector
                matchedCase.push("[A-Z]");      // Uppercase Alpabates
                matchedCase.push("[0-9]");      // Numbers
                matchedCase.push("[a-z]");     // Lowercase Alphabates

                // Check the conditions
                var ctr = 0;
                for (var i = 0; i < matchedCase.length; i++) {
                    if (new RegExp(matchedCase[i]).test(password)) {
                        ctr++;
                    }
                }
                // Display it
                var color = "";
                var strength = "";
                switch (ctr) {
                    case 0:
                    case 1:
                    case 2:
                        strength = "Very Weak";
                        color = "red";
                        break;
                    case 3:
                        strength = "Medium";
                        color = "orange";
                        break;
                    case 4:
                        strength = "Strong";
                        color = "green";
                        break;
                }
                document.getElementById("msg").innerHTML = strength;
                document.getElementById("msg").style.color = color;
            }
            function validatePassworduser(password) {
                
                // Do not show anything when the length of password is zero.
                if (password.length === 0) {
                    document.getElementById("msg2").innerHTML = "";
                    return;
                }
                // Create an array and push all possible values that you want in password
                var matchedCase = new Array();
                matchedCase.push("[$@$!%*#?&]"); // Special Charector
                matchedCase.push("[A-Z]");      // Uppercase Alpabates
                matchedCase.push("[0-9]");      // Numbers
                matchedCase.push("[a-z]");     // Lowercase Alphabates

                // Check the conditions
                var ctr = 0;
                for (var i = 0; i < matchedCase.length; i++) {
                    if (new RegExp(matchedCase[i]).test(password)) {
                        ctr++;
                    }
                }
                // Display it
                var color = "";
                var strength = "";
                switch (ctr) {
                    case 0:
                    case 1:
                    case 2:
                        strength = "Very Weak";
                        color = "red";
                        break;
                    case 3:
                        strength = "Medium";
                        color = "orange";
                        break;
                    case 4:
                        strength = "Strong";
                        color = "green";
                        break;
                }
                document.getElementById("msg2").innerHTML = strength;
                document.getElementById("msg2").style.color = color;
            }
        </script>
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
					// alert(no);					
					
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

	$('#spg-user .confirm_password').on('keyup', function () {
  if ($('#spg-user .password').val() == $('#spg-user .confirm_password').val()) {
    $('#spg-user .conf_msg').html('Password Match').css('color', 'green');
  } else 
    $('#spg-user .conf_msg').html('Not Matching').css('color', 'red');
});

	$('#User .confirm_password').on('keyup', function () {
  if ($('#User .password').val() == $('#User .confirm_password').val()) {
    $('#User .conf_msg').html('Password Match').css('color', 'green');
  } else 
    $('#User .conf_msg').html('Not Matching').css('color', 'red');
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





<div id="modal-wizard-spg-user" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Create Spg User</h4>
				</div>
				 <?php 
		$attributes = array('name' => 'frmRegistration', 'id' => 'spg-user');
		 echo form_open_multipart(base_url(''.$user_type.'/user/save'),$attributes );?>	
				<div class="modal-body">
					

					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Code.</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" name="custid" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Name</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" name="cust_name" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Email Id</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="email" id="inputWarning" class="width-100" name="mailid" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">UserName</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" name="username" required/>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> </div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Password</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="password" id="pwd" class="width-100 password" name="password" onkeyup="validatePassword(this.value);" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline msg" id="msg"> </div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="password"  class="width-100 confirm_password" name="conf_pass" required/>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline conf_msg">  </div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Access Code</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" name="code" value="1" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"> </div>
					</div>
					<input type="hidden" name="type" value="9">
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" name="spg_user" value="Submit" id="main-user">
					
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




<div id="modal-wizard-user" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Create User</h4>
				</div>
<?php 
		$attributes = array('name' => 'frmRegistration', 'id' => 'User');
		 echo form_open_multipart(base_url(''.$user_type.'/user/save'),$attributes );?>	
				<div class="modal-body">
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Name</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text"  id="comp_name" list="comp" class="width-100" name="cust_name" required />
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
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Code</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="custid" class="width-100" name="custid" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Email Id</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="email" id="inputWarning" class="width-100" name="mailid" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">UserName</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" id="inputWarning" class="width-100" name="username" required/>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>

					
					<div class="form-group">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Password</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="password" id="pwd" class="width-100 password" name="password" onkeyup="validatePassworduser(this.value);" required />
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline msg" id="msg2"> </div>
					</div>

					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="password"  class="width-100 confirm_password" name="conf_pass" required/>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline conf_msg">  </div>
					</div>
					
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Access Code</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<select id="inputWarning" class="width-100" name="code" required >
									<option value="">Select The Access</option>
									<option value="0">Suspend Access</option>
									<option value="1">Restore Access</option>
								</select>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>
					<div class="form-group ">
						<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">User Type</label>

						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<select name="type" required class="width-100">
									<option value=" ">Select User Type</option>
		                          <option value="1">company</option>
		                          <option value="2">branch</option>
		                          <option value="3">contractor</option>
		                          <option value="4">subcontractor</option>
		                        </select>
								<i class="ace-icon fa fa-leaf green"></i>
							</span>
						</div>
						<div class="help-block col-xs-12 col-sm-reset inline"></div>
					</div>
					
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" name="user" value="Submit">
					
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
</div>

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
		 echo form_open_multipart(base_url(''.$user_type.'/user/add-remove-comany'),$attributes );?>	 
				<div class="modal-body">
					<input type="hidden" name="spgid" id="spgid" value="">
					<input type="hidden" name="username" id="username" value="">
					<input type="hidden" name="action" id="actions" value="">
				<div class="fillup-company"></div>				
					
				</div>
			</div>

			<div class="modal-footer wizard-actions">
				

				<input class="btn btn-success btn-sm btn-next" data-last="Finish" type="submit" name="spg_user" value="Submit">
					
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