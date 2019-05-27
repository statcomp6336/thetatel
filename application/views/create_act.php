<script type="text/javascript">
	 $(document).ready(function () {
                $("#act").change(function () {
                    var output = $(this).val();
                    if (output !== '') {
                    	$('#sub_act').val('Please Wait for sub act id...');
                         $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url('spg/Spg/sub_act_id');?>',
                                // data: $('form').serialize(),
                                data: { act_code:output},
                                success: function (ret) {
                                  alert(ret);
                                  $('#sub_act').val(ret);
                                  $('#sub_act_h').val(ret);
                                }
                              });
                     }
                 });
            });


</script>
<div class="container">

<div class="row ">
	<div class="col-sm-12 widget-container-col " id="widget-container-col-10">
		<div class="widget-box" id="widget-box-10">
			<div class="widget-header widget-header-small">
				<h5 class="widget-title smaller">Create Compilence </h5>

				<div class="widget-toolbar no-border">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#home">Create Main Acts</a>
						</li>

						<li>
							<a data-toggle="tab" href="#profile">Create Sub-Acts</a>
						</li>

						<li>
							<a data-toggle="tab" href="#info">All Acts</a>
						</li>
						<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
						</a>
						<a href="#" data-action="fullscreen" class="orange2">
						<i class="ace-icon fa fa-expand"></i>
					</a>
					</ul>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main padding-6">
					<div class="tab-content">
						<div id="home" class="tab-pane in active">
							<!-- main Act form -->
							<?php echo form_open(base_url(''.$user_type.'/act/save'), array( 'class' => 'form-horizontal', 'method'=> 'POST','role'=>'form' ));?>
		
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Act Code </label>

					<div class="col-sm-9">
						<input type="text" name="" id="form-field-1" value="<?php echo $act_data['act_code'];?>" class="col-xs-10 col-sm-5" disabled />
						<input type="hidden" name="act_code" value="<?php echo $act_data['act_code'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Act Name </label>

					<div class="col-sm-9">
						<input type="text" name="act_name" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Act Short Name </label>

					<div class="col-sm-9">
						<input type="text" name="shortname" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Act Type </label>

					<div class="col-sm-9">
						<select name="act_type" class="col-xs-10 col-sm-5" >
							<option value="">  </option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
						</select>
					</div>
				</div>
				

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<input type="submit" class=" btn btn-info" name="acts" value="Submit">
																					

						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Reset
						</button>
					</div>
				
				</div>

			<?php echo form_close();echo "<span id ='msg'>".show_msg()."</span>"; ?>	
			<!-- main act form end -->
		</div>

		<div id="profile" class="tab-pane">
			<!-- sub act form start -->
			 <?php echo form_open(base_url(''.$user_type.'/act/save'), array( 'class' => 'form-horizontal', 'method'=> 'POST','role'=>'form' ));?>

			
			    <div class="row">						
			    	<div class="col-sm-6 widget-container-col">
									
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Sub-Act Code </label>

					<div class="col-sm-9">
						<input type="text"  id="sub_act" placeholder="Sub act id" class="col-xs-10 col-sm-10" disabled />
						<input type="hidden" name="pcr_code" id="sub_act_h" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Act Name </label>

					<div class="col-sm-9">
						<!-- <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  /> -->
						<select class="chosen-select form-control" id="act" name="act_code" placeholder="Choose a Act...">							
							<option value="">  </option>
							<?php if (!empty($act_data['data'])) {
								foreach ($act_data['data'] as $key ) {
									echo "<option value='".$key->act_code."'>".$key->act."</option>";
								}
							}
							else
							{
								echo "<option>No Data found</option>";
							}

							?>
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sub-Act  Name </label>

					<div class="col-sm-9">
						<input type="text" name="particular" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Frequency </label>

					<div class="col-sm-9">
						<input type="text" name="freq" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
					</div>
				</div>
					</div>
					<div class="col-sm-6 widget-container-col">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Weight </label>

							<div class="col-sm-9">
								<input type="text" name="weight" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Obligation </label>

							<div class="col-sm-9">
								<input type="text" name="obligation" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Due Date </label>

							<div class="col-sm-9">
								<input type="date" name="due_date" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Statutary Due Date </label>

							<div class="col-sm-9">
								<input type="date" name="stat_date" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-10"  />
							</div>
						</div>



					</div>
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<input type="submit" class=" btn btn-info" name="sub_acts" value="Submit">
																					

						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Reset
						</button>
					</div>
				
				</div>
				</div>
			<?php echo form_close();echo "<span id ='msg'>".show_msg()."</span>"; ?>
		</div>

						<div id="info" class="tab-pane">
							<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th>
									Sr
								</th>

								<th>
									Act Code
								</th>
								<th class="hidden-480">Act Name</th>
								<th>
									Act Type
								</th>
								<th>
									Act Short Name
								</th>
								<th>
									Act Type
								</th>
								<th>
									Created Date
								</th>
								<th>
									sub acts
								</th>


							</tr>
						</thead>

						<tbody>
							<tr>
								<td class="">1</td>

								<td>
									<a href="#"> alex@email.com alex@email.com alex@email.com alex@email.com alex@email.com alex@email.com</a>
								</td>
								<td>
									<a href="#">alex@email.com</a>
								</td>
								<td>
									<a href="#">alex@email.com</a>
								</td>
								<td>
									<a href="#">alex@email.com</a>
								</td>
								<td>
									<a href="#">alex@email.com</a>
								</td>
								<td>
									<a href="#">alex@email.com</a>
								</td>

								<td class="hidden-480">
									<span class="label label-warning">Pending</span>
								</td>
							</tr>

							<tr>
								<td class="">Fred</td>

								<td>
									<a href="#">fred@email.com</a>
								</td>

								<td class="hidden-480">
									<span class="label label-success arrowed-in arrowed-in-right">Approved</span>
								</td>
							</tr>

							<tr>
								<td class="">Jack</td>

								<td>
									<a href="#">jack@email.com</a>
								</td>

								<td class="hidden-480">
									<span class="label label-warning">Pending</span>
								</td>
							</tr>

							<tr>
								<td class="">John</td>

								<td>
									<a href="#">john@email.com</a>
								</td>

								<td class="hidden-480">
									<span class="label label-inverse arrowed">Blocked</span>
								</td>
							</tr>

							<tr>
								<td class="">James</td>

								<td>
									<a href="#">james@email.com</a>
								</td>

								<td class="hidden-480">
									<span class="label label-info arrowed-in arrowed-in-right">Online</span>
								</td>
							</tr>
						</tbody>
					</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
</div>
		 <script src="<?php echo base_url();?>assets/dashboard/js/jquery-2.1.4.min.js"></script>							
		<script src="<?php echo base_url();?>assets/dashboard//js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard//js/jquery.ui.touch-punch.min.js"></script>
