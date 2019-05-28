<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Employee Master Table</h4>

		<div class="widget-toolbar">
			<a href="#" data-action="collapse">
				
				<button class="btn btn-success" id="import" > Import Multipal Employees</button> 
			</a>

			<a href="<?php echo base_url(''.$user_type.'/employee/create');?>" >
			<button class="btn btn-info" > Add Single Employee</button> 
			</a>
		</div>

	</div>
	<div class="widget-body ">
		<div class="widget-main" style="display:none">
		<?php
		$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 echo form_open_multipart('spg/Spg/save_master_emp',$attributes );?>		
			<div class="form-group">
				<div class="col-xs-12">
					<input multiple="" type="file" name="file" id="id-input-file-3" />					
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<input  type="Submit" class="btn-primary" value="Upload" />
				</div>
			</div>
			 <?php echo form_close(); ?>		
		</div>	
	</div>
</div>	
<table id="simple-table" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<label class="pos-rel">
					
					<span class="lbl">Sr.No</span>
				</label>
			</th>
			<th class="detail-col">Details</th>
			<th>Employee Code</th>
			<th>Employee Name</th>
			<th class="hidden-480">Company Name</th>

			<th>
				Department 		
			</th>
			<th>
				Designation 		
			</th>

			<th class="hidden-480">Status</th>

			<th></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="center">
				<label class="pos-rel">
					<input type="checkbox" class="ace" />
					<span class="lbl"></span>
				</label>
			</td>

			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>

			<td>
				<a href="#">ace.com</a>
			</td>
			<td>$45</td>
			<td class="hidden-480">3,330</td>
			<td>Feb 12</td>

			<td class="hidden-480">
				<span class="label label-sm label-warning">Expiring</span>
			</td>

			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-success">
						<i class="ace-icon fa fa-check bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-danger">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-warning">
						<i class="ace-icon fa fa-flag bigger-120"></i>
					</button>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							<li>
								<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
									<span class="blue">
										<i class="ace-icon fa fa-search-plus bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-4 col-sm-4">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Employee Name </div>

									<div class="profile-info-value">
										<span>alexdoe</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Date of Birth </div>

									<div class="profile-info-value">
										<span>10-Nov-1996</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Gender </div>

									<div class="profile-info-value">
										<span>Male</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Current Address </div>

									<div class="profile-info-value">
										<span>At/Post: Vhanali, Dist:Kolhapur</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Email Address </div>

									<div class="profile-info-value">
										<span>goutampalkar6336@gmail.com</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Employee Phone Number </div>

									<div class="profile-info-value">
										<span>830893828</span>
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
										<span>Bank Of Baroda</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Branch Name </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name">Account Number </div>

									<div class="profile-info-value">
										<span>210222200006</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> IFSC Code </div>

									<div class="profile-info-value">
										<span>FKSK00041D</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> PAN Number </div>

									<div class="profile-info-value">
										<span>dsfaf12205</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> AADHAR Number </div>

									<div class="profile-info-value">
										<span>222526225122</span>
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
										<span>Statcomp pvt ltd pune</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Department </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Designation </div>

									<div class="profile-info-value">
										<span>IT Officer</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<span>pune</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Join Date </div>

									<div class="profile-info-value">
										<span>dsfaf12205</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Existing Date </div>

									<div class="profile-info-value">
										<span>222526225122</span>
									</div>
								</div>
								<button> Know More..</button>
							</div>
						</div>>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<td class="center">
				<label class="pos-rel">
					<input type="checkbox" class="ace" />
					<span class="lbl"></span>
				</label>
			</td>

			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>

			<td>
				<a href="#">base.com</a>
			</td>
			<td>$35</td>
			<td class="hidden-480">2,595</td>
			<td>Feb 18</td>

			<td class="hidden-480">
				<span class="label label-sm label-success">Registered</span>
			</td>

			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-success">
						<i class="ace-icon fa fa-check bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-danger">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-warning">
						<i class="ace-icon fa fa-flag bigger-120"></i>
					</button>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							<li>
								<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
									<span class="blue">
										<i class="ace-icon fa fa-search-plus bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-12 col-sm-2">
							<div class="text-center">
								<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url();?>assets/dashboard/images/avatars/profile-pic.jpg" />
								<br />
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
									<div class="inline position-relative">
										<a class="user-title-label" href="#">
											<i class="ace-icon fa fa-circle light-green"></i>
											&nbsp;
											<span class="white">Alex M. Doe</span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-7">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span>alexdoe</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Age </div>

									<div class="profile-info-value">
										<span>38</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span>2010/06/20</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Last Online </div>

									<div class="profile-info-value">
										<span>3 hours ago</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> About Me </div>

									<div class="profile-info-value">
										<span>Bio</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-3">
							<div class="space visible-xs"></div>
							<h4 class="header blue lighter less-margin">Send a message to Alex</h4>

							<div class="space-6"></div>

							<form>
								<fieldset>
									<textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
								</fieldset>

								<div class="hr hr-dotted"></div>

								<div class="clearfix">
									<label class="pull-left">
										<input type="checkbox" class="ace" />
										<span class="lbl"> Email me a copy</span>
									</label>

									<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
										Submit
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<td class="center">
				<label class="pos-rel">
					<input type="checkbox" class="ace" />
					<span class="lbl"></span>
				</label>
			</td>

			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>

			<td>
				<a href="#">max.com</a>
			</td>
			<td>$60</td>
			<td class="hidden-480">4,400</td>
			<td>Mar 11</td>

			<td class="hidden-480">
				<span class="label label-sm label-warning">Expiring</span>
			</td>

			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-success">
						<i class="ace-icon fa fa-check bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-danger">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-warning">
						<i class="ace-icon fa fa-flag bigger-120"></i>
					</button>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							<li>
								<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
									<span class="blue">
										<i class="ace-icon fa fa-search-plus bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-12 col-sm-2">
							<div class="text-center">
								<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url();?>assets/dashboard/images/avatars/profile-pic.jpg" />
								<br />
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
									<div class="inline position-relative">
										<a class="user-title-label" href="#">
											<i class="ace-icon fa fa-circle light-green"></i>
											&nbsp;
											<span class="white">Alex M. Doe</span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-7">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span>alexdoe</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Age </div>

									<div class="profile-info-value">
										<span>38</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span>2010/06/20</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Last Online </div>

									<div class="profile-info-value">
										<span>3 hours ago</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> About Me </div>

									<div class="profile-info-value">
										<span>Bio</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-3">
							<div class="space visible-xs"></div>
							<h4 class="header blue lighter less-margin">Send a message to Alex</h4>

							<div class="space-6"></div>

							<form>
								<fieldset>
									<textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
								</fieldset>

								<div class="hr hr-dotted"></div>

								<div class="clearfix">
									<label class="pull-left">
										<input type="checkbox" class="ace" />
										<span class="lbl"> Email me a copy</span>
									</label>

									<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
										Submit
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<td class="center">
				<label class="pos-rel">
					<input type="checkbox" class="ace" />
					<span class="lbl"></span>
				</label>
			</td>

			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>

			<td>
				<a href="#">best.com</a>
			</td>
			<td>$75</td>
			<td class="hidden-480">6,500</td>
			<td>Apr 03</td>

			<td class="hidden-480">
				<span class="label label-sm label-inverse arrowed-in">Flagged</span>
			</td>

			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-success">
						<i class="ace-icon fa fa-check bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-danger">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-warning">
						<i class="ace-icon fa fa-flag bigger-120"></i>
					</button>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							<li>
								<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
									<span class="blue">
										<i class="ace-icon fa fa-search-plus bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-12 col-sm-2">
							<div class="text-center">
								<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url();?>assets/dashboard/images/avatars/profile-pic.jpg" />
								<br />
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
									<div class="inline position-relative">
										<a class="user-title-label" href="#">
											<i class="ace-icon fa fa-circle light-green"></i>
											&nbsp;
											<span class="white">Alex M. Doe</span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-7">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span>alexdoe</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Age </div>

									<div class="profile-info-value">
										<span>38</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span>2010/06/20</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Last Online </div>

									<div class="profile-info-value">
										<span>3 hours ago</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> About Me </div>

									<div class="profile-info-value">
										<span>Bio</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-3">
							<div class="space visible-xs"></div>
							<h4 class="header blue lighter less-margin">Send a message to Alex</h4>

							<div class="space-6"></div>

							<form>
								<fieldset>
									<textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
								</fieldset>

								<div class="hr hr-dotted"></div>

								<div class="clearfix">
									<label class="pull-left">
										<input type="checkbox" class="ace" />
										<span class="lbl"> Email me a copy</span>
									</label>

									<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
										Submit
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<td class="center">
				<label class="pos-rel">
					<input type="checkbox" class="ace" />
					<span class="lbl"></span>
				</label>
			</td>

			<td class="center">
				<div class="action-buttons">
					<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
						<i class="ace-icon fa fa-angle-double-down"></i>
						<span class="sr-only">Details</span>
					</a>
				</div>
			</td>

			<td>
				<a href="#">pro.com</a>
			</td>
			<td>$55</td>
			<td class="hidden-480">4,250</td>
			<td>Jan 21</td>

			<td class="hidden-480">
				<span class="label label-sm label-success">Registered</span>
			</td>

			<td>
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-success">
						<i class="ace-icon fa fa-check bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-info">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-danger">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>

					<button class="btn btn-xs btn-warning">
						<i class="ace-icon fa fa-flag bigger-120"></i>
					</button>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							<li>
								<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
									<span class="blue">
										<i class="ace-icon fa fa-search-plus bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>

							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		</tr>

		<tr class="detail-row">
			<td colspan="8">
				<div class="table-detail">
					<div class="row">
						<div class="col-xs-12 col-sm-2">
							<div class="text-center">
								<img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url();?>assets/dashboard/images/avatars/profile-pic.jpg" />
								<br />
								<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
									<div class="inline position-relative">
										<a class="user-title-label" href="#">
											<i class="ace-icon fa fa-circle light-green"></i>
											&nbsp;
											<span class="white">Alex M. Doe</span>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-7">
							<div class="space visible-xs"></div>

							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span>alexdoe</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Location </div>

									<div class="profile-info-value">
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<span>Netherlands, Amsterdam</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Age </div>

									<div class="profile-info-value">
										<span>38</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span>2010/06/20</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Last Online </div>

									<div class="profile-info-value">
										<span>3 hours ago</span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> About Me </div>

									<div class="profile-info-value">
										<span>Bio</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-3">
							<div class="space visible-xs"></div>
							<h4 class="header blue lighter less-margin">Send a message to Alex</h4>

							<div class="space-6"></div>

							<form>
								<fieldset>
									<textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
								</fieldset>

								<div class="hr hr-dotted"></div>

								<div class="clearfix">
									<label class="pull-left">
										<input type="checkbox" class="ace" />
										<span class="lbl"> Email me a copy</span>
									</label>

									<button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
										Submit
										<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>


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
				
				$('#import').on('click', function(){
					
					 $('.widget-main').toggle();
				});
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
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