<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $page_title;?></title>

		<meta name="description" content="top menu &amp; navigation" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/dashboard/js/ace-extra.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url();?>assets/dashboard/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url();?>assets/dashboard/js/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.widget-main{
						padding: 12px;
					    height: -webkit-fill-available;
					    display: block;
					    overflow: scroll;}
			a:visited {
				color: #0254EB
			}
			a.morelink {
				text-decoration:none;
				outline: none;
			}
			.morecontent span {
				display: none;
			}
			.comment {
				width: 400px;
				background-color: #f0f0f0;
				margin: 10px;
			}		    

					    
		</style>
	</head>

	<body class="skin-1">

		<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							ComplianceTrack
						</small>
					</a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>

						<img src="<?php echo base_url();?>assets/dashboard/images/avatars/user.jpg" alt="Jason's Photo" />
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
						<li class="transparent dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
							</a>

							<div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<li class="active">
											<a data-toggle="tab" href="#navbar-tasks">
												Tasks
												<span class="badge badge-danger">4</span>
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#navbar-messages">
												Messages
												<span class="badge badge-danger">5</span>
											</a>
										</li>
									</ul><!-- .nav-tabs -->

									<div class="tab-content">
										<div id="navbar-tasks" class="tab-pane in active">
											<ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
												<li class="dropdown-content">
													<ul class="dropdown-menu dropdown-navbar">
														<li>
															<a href="#">
																<div class="clearfix">
																	<span class="pull-left">Software Update</span>
																	<span class="pull-right">65%</span>
																</div>

																<div class="progress progress-mini">
																	<div style="width:65%" class="progress-bar"></div>
																</div>
															</a>
														</li>

														<li>
															<a href="#">
																<div class="clearfix">
																	<span class="pull-left">Hardware Upgrade</span>
																	<span class="pull-right">35%</span>
																</div>

																<div class="progress progress-mini">
																	<div style="width:35%" class="progress-bar progress-bar-danger"></div>
																</div>
															</a>
														</li>

														<li>
															<a href="#">
																<div class="clearfix">
																	<span class="pull-left">Unit Testing</span>
																	<span class="pull-right">15%</span>
																</div>

																<div class="progress progress-mini">
																	<div style="width:15%" class="progress-bar progress-bar-warning"></div>
																</div>
															</a>
														</li>

														<li>
															<a href="#">
																<div class="clearfix">
																	<span class="pull-left">Bug Fixes</span>
																	<span class="pull-right">90%</span>
																</div>

																<div class="progress progress-mini progress-striped active">
																	<div style="width:90%" class="progress-bar progress-bar-success"></div>
																</div>
															</a>
														</li>
													</ul>
												</li>

												<li class="dropdown-footer">
													<a href="#">
														See tasks with details
														<i class="ace-icon fa fa-arrow-right"></i>
													</a>
												</li>
											</ul>
										</div><!-- /.tab-pane -->

										<div id="navbar-messages" class="tab-pane">
											<ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
												<li class="dropdown-content">
													<ul class="dropdown-menu dropdown-navbar">
														<li>
															<a href="#">
																<img src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Alex:</span>
																		Ciao sociis natoque penatibus et auctor ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>a moment ago</span>
																	</span>
																</span>
															</a>
														</li>

														<li>
															<a href="#">
																<img src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Susan:</span>
																		Vestibulum id ligula porta felis euismod ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>20 minutes ago</span>
																	</span>
																</span>
															</a>
														</li>

														<li>
															<a href="#">
																<img src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Bob:</span>
																		Nullam quis risus eget urna mollis ornare ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>3:15 pm</span>
																	</span>
																</span>
															</a>
														</li>

														<li>
															<a href="#">
																<img src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Kate:</span>
																		Ciao sociis natoque eget urna mollis ornare ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>1:33 pm</span>
																	</span>
																</span>
															</a>
														</li>

														<li>
															<a href="#">
																<img src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
																<span class="msg-body">
																	<span class="msg-title">
																		<span class="blue">Fred:</span>
																		Vestibulum id penatibus et auctor  ...
																	</span>

																	<span class="msg-time">
																		<i class="ace-icon fa fa-clock-o"></i>
																		<span>10:09 am</span>
																	</span>
																</span>
															</a>
														</li>
													</ul>
												</li>

												<li class="dropdown-footer">
													<a href="<?php echo base_url(''.$user_type.'/notification');?>">
														See all messages
														<i class="ace-icon fa fa-arrow-right"></i>
													</a>
												</li>
											</ul>
										</div><!-- /.tab-pane -->
									</div><!-- /.tab-content -->
								</div><!-- /.tabbable -->
							</div><!-- /.dropdown-menu -->
						</li>

						<li class="light-blue dropdown-modal user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url();?>assets/dashboard/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info"> 
									<small>Welcome,</small>
									<?php 
									echo USERNAME; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url('Home/quite');;?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

				<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								Overview
	  		&nbsp;
								<i class="ace-icon fa fa-angle-down bigger-110"></i>
							</a>

							<ul class="dropdown-menu dropdown-light-blue dropdown-caret">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-eye bigger-110 blue"></i>
										Monthly Visitors
									</a>
								</li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-user bigger-110 blue"></i>
										Active Users
									</a>
								</li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog bigger-110 blue"></i>
										Settings
									</a>
								</li>
							</ul>
						</li>

						<li>
					<a href="<?php echo base_url(''.$user_type.'/inbox'); ?>" id="new_msg" >
								<i class="ace-icon fa fa-envelope"></i>
								Messages
								<?php 

									if (!empty($new_mail)) { ?>
										
									
								<span class="badge badge-warning blink"><?php echo $new_mail;
								?></span>
								<?php }
								?>
							</a>
						</li>
					</ul>

					<form class="navbar-form navbar-left form-search" role="search">
						<div class="form-group">
							<input type="text" placeholder="search" />
						</div>

						<button type="button" class="btn btn-mini btn-info2">
							<i class="ace-icon fa fa-search icon-only bigger-110"></i>
						</button>
					</form>
				</nav>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse          ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list"> 
					<li class="active hover">
						<?php if (!empty($menu['dashboard_access']) && $menu['dashboard_access'] == TRUE) {
						
						?>
						<a href="<?php echo base_url(''.$user_type.'');?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					<?php } ?>
						<b class="arrow"></b>
					</li>
					<?php if ( !empty($menu['setup_access']) && $menu['setup_access'] == TRUE) {					
						?>
					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">						
							Setup
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="open hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Company
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="<?php echo base_url('spg/company/registration'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Company Registration
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="<?php echo base_url('spg/branch/registration'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Branch Registration
										</a>

										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>
<!--  end company area -->
<!--  start contractor area -->
<li class="open hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Contractor
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="active hover">
										<a href="<?php echo base_url('spg/contractor/registration'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Contractor Registration
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="<?php echo base_url('spg/subcontractor/registration'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Sub-Contractor Registration
										</a>

										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>
<!-- end contractor area -->
<!-- start act compiletion area -->	
							<li class="open hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									 Acts
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="<?php echo base_url('spg/act/create');?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Create Act
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url('spg/company/act');?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Act Selection
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/compliance/bulk-update'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Act Due Date
										</a>

										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>
						</ul>
					</li>
<?php } ?>
<!-- end Setup area -->

<!-- start my activity  -->
<?php 
if ( !empty($menu['myactivity_access']) && $menu['myactivity_access'] == TRUE) 
{						
?>
					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text "> My Activity </span><?php 
							if (!empty($error_count)) {
								echo "<span class='badge badge-warning blink'> ".$error_count."</span>";
							}

							?>
							

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="open hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Employee
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="active hover">
										<a href="<?php echo base_url(''.$user_type.'/employee/show'); ?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Employee Registration
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="two-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Employee Attendence
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/missing-uan');?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Missing UAN Number
										</a>

										<b class="arrow"></b>
									</li>

									
								</ul>
							</li>

							<li class="open hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
								Salary
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="active hover">
										<a href="<?php echo base_url(''.$user_type.'/salary/import');?>">
											<i class="menu-icon fa fa-caret-right"></i>
											Import salary
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
										PF
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/pfnewjoinee'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
										   PF New joinee Report
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/pf'); ?>" >
											<i class="menu-icon fa fa-pencil orange"></i>
											PF Template				
										</a>

										<b class="arrow"></b>

										
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/pfsummary'); ?>" >
											<i class="menu-icon fa fa-leaf green"></i>
											PF Summary
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
										ESIC
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/esicnewjoinee'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
										  ESIC New Joinee Report
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/esictemplate'); ?>">
											<i class="menu-icon fa fa-pencil orange"></i>
											ESIC Template Report		
										</a>

										<b class="arrow"></b>

										
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/esictemplateempid'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											ESIC Template Report(EMP ID)
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/esicsummary'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											ESIC Summary Report
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
										Group Reconcile
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/report/sanitize');?>">
											<i class="menu-icon fa fa-leaf green"></i>
										  Sanitize Reconcile
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/report/backlog');?>">
											<i class="menu-icon fa fa-leaf green"></i>
										 Backlog Reconcile
										</a>

										<b class="arrow"></b>
									</li>

									
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/report/process');?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Process Reconcile
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>

						</ul>
					</li>
<?php } ?>
<!--  end my activity -->
<?php 
if (!empty($menu['mycompliance_access']) &&  $menu['mycompliance_access'] == TRUE) 
{						
?>					

					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">  My Compliance  </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">						
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/compliance/bulk-compliance'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Bulk Compliance
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/compliance/bulk-timeline'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Compilence Timeline
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<?php } ?>
<?php 
if (!empty($menu['myapproval_access']) && $menu['myapproval_access'] == TRUE) 
{						
?>
					<li class="hover">
						<a href="<?php echo base_url(''.$user_type.'/compliance/bulk-approval'); ?>">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> My Approval </span>
						</a>

						<b class="arrow"></b>
					</li>
<?php } ?>

					<!-- <li class="hover">
						<a href="calendar.html">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								User Profile

								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li> -->

<?php 
if (!empty($menu['userprofile_access']) &&  $menu['userprofile_access'] == TRUE) 
{						
?>					
					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> User Profile </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/users'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									All User
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/user/company-access');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Suspend / Restore Access
								</a>

								<b class="arrow"></b>
							</li>
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/user/reset-password');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Reset Password
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<?php } ?>

					<!-- <li class="hover">
						<a href="<?php echo base_url(''.$user_type.'/explore');?>">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text"> File Explore </span>
						</a>

						<b class="arrow"></b>
					</li> -->
<?php 
if (!empty($menu['managefiles_access']) &&  $menu['managefiles_access'] == TRUE) 
{						
?>
					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> Manage Files</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/explore');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									File Explore
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/share-files');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									File Shareing
								</a>

								<b class="arrow"></b>
							</li>

							<!-- <li class="hover">
								<a href="pricing.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Pricing Tables
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="invoice.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Invoice
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="timeline.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Timeline
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="search.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Search Results
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="email.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Email Templates
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="login.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Login &amp; Register
								</a>

								<b class="arrow"></b>
							</li> -->
						</ul>
					</li>
<?php } ?>
<?php 
if (!empty($menu['report_access']) &&  $menu['report_access'] == TRUE) 
{						
?>
					<li class="hover">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-o"></i>

							<span class="menu-text">
								Report								
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							

							<!-- +++++++++++++ -->
							<?php 
if (!empty($menu['compliance_report']) &&  $menu['compliance_report'] == TRUE) 
{						
?>
							<li class="hover">

								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
										Compliance Reports
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<?php 
if (!empty($menu['compliance_report']) &&  $menu['compliance_report'] == TRUE) 
{						
?>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/compliance'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Compliance
										</a>

										<b class="arrow"></b>
									</li>
								<?php }
if (!empty($menu['non_compliance_report']) &&  $menu['non_compliance_report'] == TRUE) 
{						
?>

									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/noncompliance'); ?>">
											<i class="menu-icon fa fa-pencil orange"></i>
										Non-Compliance
											<b class="arrow fa fa-angle-down"></b>
										</a>
										<b class="arrow"></b>
									</li>
									<?php }
if (!empty($menu['compliance_doc']) &&  $menu['compliance_doc'] == TRUE) 
{						
?>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/compliancedocument'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Compliance Documents
										</a>

										<b class="arrow"></b>
									</li>
									<?php }
if (!empty($menu['approval_report']) &&  $menu['approval_report'] == TRUE) 
{						
?>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/approval'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Approval Report
										</a>

										<b class="arrow"></b>
									</li>
									<?php }
if (!empty($menu['compliance_reject']) &&  $menu['compliance_reject'] == TRUE) 
{						
?>

									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/rejected'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Rejected Report
										</a>

										<b class="arrow"></b>
									</li>
								<?php } ?>
								</ul>
							</li>
						<?php }
if (!empty($menu['employee_info']) &&  $menu['employee_info'] == TRUE) 
{						
?>
							<!-- +++++++++++++ -->
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/employeedetails'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Emplyoee details
								</a>

								<b class="arrow"></b>
							</li>
							<?php }
if (!empty($menu['salary_report']) &&  $menu['salary_report'] == TRUE) 
{						
?>

							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/salarydetails'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Salary details
								</a>

								<b class="arrow"></b>
							</li>
										<?php }
if (!empty($menu['entity_report']) &&  $menu['entity_report'] == TRUE) 
{						
?>

							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/entitydetails'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Entities Details
								</a>

								<b class="arrow"></b>
							</li>
							<?php }
if (!empty($menu['compliance_req']) &&  $menu['compliance_req'] == TRUE) 
{						
?>

							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/compliancerequest'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Compliance Request Details
								</a>

								<b class="arrow"></b>
							</li>
								<?php }
if (!empty($menu['user_info']) &&  $menu['user_info'] == TRUE) 
{						
?>
		
							<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/spguserdetails'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									User Details
								</a>

								<b class="arrow"></b>
							</li>
										<?php }
if (!empty($menu['register_menu']) &&  $menu['register_menu'] == TRUE) 
{						
?>


							<li class="hover" >
								<a href="error-404.html" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Register Menu
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
									<!-- <li class="hover">
										<a href="#">
											<i class="menu-icon fa fa-leaf green"></i>
											Maternity Form
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="#">
											<i class="menu-icon fa fa-pencil orange"></i>
										Form XXI 
											<b class="arrow fa fa-angle-down"></b>
										</a>
										<b class="arrow"></b>	
									</li> -->
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/formd'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											 FORM D
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="#">
											<i class="menu-icon fa fa-leaf green"></i>
											FORM O
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/export/formq'); ?>">
											<i class="menu-icon fa fa-leaf green"></i>
											FORM Q
										</a>

										<b class="arrow"></b>
									</li>									
								</ul>							
							</li>
						<?php } ?>
							<!-- +++++++++++++ -->
							
							<!-- +++++++++++++ -->
								<!-- +++++++++++++ -->
							<!-- <li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-caret-right"></i>
									Companywise Reconcile 
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
										<a href="#">
											<i class="menu-icon fa fa-leaf green"></i>
										   Single Sanitize
										</a>

										<b class="arrow"></b>
									</li>

									<li class="hover">
										<a href="#" class="dropdown-toggle">
											<i class="menu-icon fa fa-pencil orange"></i>
											Single Backlog		
										</a>

										<b class="arrow"></b>

										
									</li>
									<li class="hover">
										<a href="#">
											<i class="menu-icon fa fa-leaf green"></i>
											Single Process
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li> -->

							<!-- +++++++++++++ -->
						</ul>
					</li>
<?php } ?>
					<li class="hover">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-book"></i>
										Help
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="hover">
								<a href="<?php echo base_url(''.$user_type.'/export/faqdetails'); ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									FAQ
								</a>

								<b class="arrow"></b>
							</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/report/backlog');?>">
											<i class="menu-icon fa fa-leaf green"></i>
										About us
										</a>

										<b class="arrow"></b>
									</li>

									
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/');?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Feedback
										</a>

										<b class="arrow"></b>
									</li>
									<li class="hover">
										<a href="<?php echo base_url(''.$user_type.'/');?>">
											<i class="menu-icon fa fa-leaf green"></i>
											Users Guide
										</a>

										<b class="arrow"></b>
									</li>
								</ul>
							</li>
							<!-- +++++++++++++ -->
						</ul>
					</li>

				</ul><!-- /.nav-list -->
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								<?php echo $where;?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 <?php echo $sub_menu;?> <i class="hidden-sm hidden-xs sidebar-collapse  ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down" data-target="#sidebar"></i>
								</small>
							</h1>
						</div>
						<!-- /.page-header -->

						<div class="row">