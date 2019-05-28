<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500'>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/form_wizard/css/style1.css');?>">

            <div class="container" ng-app="">
                
        
                    <div class=" form-wizard">
					
						<!-- Form Wizard -->
                    	<?php      
					        echo show_msg();
					        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
					        echo form_open(base_url('spg/employee/save'), $attributes);
        ?>                 			
							
							<!-- Form progress -->
                    		<div class="form-wizard-steps form-wizard-tolal-steps-4">
                    			<div class="form-wizard-progress">
                    			    <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
                    			</div>
								<!-- Step 1 -->
                    			<div class="form-wizard-step active">
                    				<div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                    				<p>Personal Detatils</p>
                    			</div>
								<!-- Step 1 -->
								
								<!-- Step 2 -->
                    			<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                    				<p>Bank Details</p>
                    			</div>
								<!-- Step 2 -->
								
								<!-- Step 3 -->
								<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                    				<p>Company Details</p>
                    			</div>
								<!-- Step 3 -->
								
								<!-- Step 4 -->
								<div class="form-wizard-step">
                    				<div class="form-wizard-step-icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                    				<p>Confirmation</p>
                    			</div>
								<!-- Step 4 -->
                    		</div>
							<!-- Form progress -->
                    		
							
							<!-- Form Step 1 -->

            		<fieldset>

        		    <h4>Personal Information: <span>Step 1 - 4</span></h4>
            		    <div class="row">
            		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
            		    		<div class="form-group">
                    			    <label>Employee Name: <span>*</span></label>
                                    <input type="text" ng-model="emp_name" name="emp_name" placeholder="Employee Name Name" class="form-control required">
                                </div>
                               
								<div class="form-group" style="padding:2px">
                    			    <label>Gender : </label><br><wbr>
                                    <label class="radio-inline">
									  <input type="radio" ng-model="gender" name="gender" value="male" checked="checked"> Male
									</label>
									<label class="radio-inline">
									  <input type="radio" ng-model="gender" name="gender" value="female"> Female
									</label>
                                </div>

								<div class="form-group">
                    			    <label>Employee Date Of Birth : <span>*</span></label>
                                    <input type="date" ng-model="emp_dob" name="emp_dob" class="form-control required">
                                </div>

								<div class="form-group">
                    			    <label>Perment Address : <span>*</span></label>
                                    <input type="text" ng-model="p_address" name="p_address" placeholder="Perment Address" class="form-control required">
                                </div>
                                <div class="form-group">
                    			    <label>Employee Email Address: <span>*</span></label>
                                    <input type="email" ng-model="emp_mail" name="emp_mail" placeholder="Employee Email" class="form-control required">
                                </div>

								<div class="form-group">
                    			    <label>Physical Handicap: <span>*</span></label>
                                     <select class="form-control" ng-init="handicap=NO" ng-model="handicap" name="handicap">
									  <option value="YES">Yes</option>
									  <option value="NO" selected="selected" >No</option>						 
									</select>
                                  
								</div>

								<div class="form-group">
                    			    <label>Relation Name: <span>*</span></label>
                                    <input type="text" ng-model="rel_name" name="rel_name" placeholder="Relation Name" class="form-control required">
                                </div>

                                <div class="form-group">
                    			    <label>Relation Age: <span>*</span></label>
                                    <input type="text" ng-model="rel_age" name="rel_age" placeholder="Relation Age" class="form-control required">
                                </div>

                                <div class="form-group">
                    			    <label>Nomination 1: <span>*</span></label>
                                    <input type="text" ng-model="nom1" name="nom1" placeholder="Nomination 1" class="form-control required">
                                </div>

                                <div class="form-group">
                    			    <label>Nomination 3: <span>*</span></label>
                                    <input type="text" ng-model="nom3" name="nom3" placeholder="Nomination 3" class="form-control required">
                                </div>
                         	</div>
        		    	
        		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
        		    		<div class="form-group">
                			    <label>Employee Father/Husband Name: <span>*</span></label>
                                    <input type="text" ng-model="parent_name" name="parent_name" placeholder="Parent Name" class="form-control required">
                            </div>

                            <div class="form-group">
                    			<label>Maratial Status: </label>
                                    <select class="form-control" ng-model="m_status" name="m_status">
										<option value="">Select Status ...</option>
										<option value="Married">Married</option>
										<option value="Divorced">Divorced</option>
										<option value="Un-Married">Un-Married</option>
										<option value="Widowed">Widowed</option>
									</select>
                            </div>

                            <div class="form-group">
                			    <label>Education Qualifications: <span>*</span></label>
                                    <select class="form-control" ng-model="education" name="education">
                                    <option selected>--Select--</option>
                                    <option value="Non Metric">Non Metric</option>
                                    <option value="Metric">Metric</option>
                                    <option value="Senior Secondary">Senior Secondary</option>
                                    <option value="Graduate">Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                    <option value="Doctorate">Doctorate</option>
                                  </select>
                            </div>
							<div class="form-group">
                			    <label>Current Address: <span>*</span></label>
                                    <input type="text" ng-model="c_address" name="c_address" placeholder="Current Address" class="form-control required">
                            </div>

							<div class="form-group">
                			    <label>Employee Phone Number: <span>*</span></label>
                                	<input type="tel" ng-model="emp_mob" name="emp_mob" placeholder="Phone Number" class="form-control required">
                            </div>
								
                            <div class="form-group">
                			    <label>Physically Handicap Catogay: <span>*</span></label>
                                	<select class="form-control" ng-init="phy_handi_cat=selected" ng-model="phy_handi_cat" name="phy_handi_cat">
                                    <option value="selected" selected="selected">--Select--</option>
                                    <option value="N/A">N/A</option>
                                    <option value="Locomotive">Locomotive</option>
                                    <option value="Visual">Visual</option>
                                    <option value="Hearing">Hearing</option>
                                  </select>
                                  
                            </div>
							<div class="form-group">
                			    <label>Relation DOB : <span>*</span></label>
                                	<input type="text" ng-model="rel_dob" name="rel_dob" placeholder="Relation DOB" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>Relation Aadhar : <span>*</span></label>
                                	<input type="text" ng-model="rel_aadhar" name="rel_aadhar" placeholder="Relation Aadhar" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>Nomination2 : <span>*</span></label>
                                	<input type="text" ng-model="nom2" name="nom2" placeholder="Nomination2" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>Nomination4 : <span>*</span></label>
                                	<input type="text" ng-model="nom4" name="nom4" placeholder="Nomination4" class="form-control required">
                            </div>
    		    		</div>
        		    </div>
								
                    <div class="form-wizard-buttons">
                        <button type="button" class="btn btn-next" style="background-color: #044f7d!important;">Next</button>
                    </div>
                </fieldset>
							<!-- Form Step 1  completed-->

							<!-- Form Step 2 started-->
                <fieldset>

                    <h4>Bank Information : <span>Step 2 - 4</span></h4>
					 <div class="row">
            		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
            		    		<div class="form-group">
                    			    <label>Bank Name: <span>*</span></label>
                                    <input type="text" ng-model="bank_name" name="bank_name" placeholder="Bank Name" class="form-control required">
                                </div>
                               
								<div class="form-group">
                    			    <label>Account Number: <span>*</span></label>
                                    <input type="text" ng-model="ac_no" name="ac_no" placeholder="Account Number" class="form-control required">
                                </div>

								<div class="form-group">
                    			    <label>PAN Number : <span>*</span></label>
                                    <input type="text" ng-model="emp_pan" name="emp_pan" placeholder="PAN Number" class="form-control required">
                                </div>

								<div class="form-group">
                    			    <label>Aadhar Number : <span>*</span></label>
                                    <input type="text" ng-model="emp_aadhar" name="emp_aadhar" placeholder="Aadhar Number" class="form-control required">
                                </div>
                                <div class="form-group">
                    			    <label>Require PF Deduction?: <span>*</span></label>
                                    <select class="form-control" ng-model="pf_dud" name="pf_dud">
									  <option value="YES">Yes</option>
									  <option value="NO" selected>No</option>						 
									</select>
                                </div>

								<div class="form-group">
                    			    <label>Require ESIC Deduction?: <span>*</span></label>
                                     <select class="form-control" ng-model="esic_dud" name="esic_dud">
									  <option value="YES">Yes</option>
									  <option value="NO" selected>No</option>						 
									</select>
								</div>

								<div class="form-group">
                    			    <label>Existing UAN No: <span>*</span></label>
                                    <input type="text" ng-model="una_no" name="una_no" placeholder="Existing UAN No" class="form-control required">
                                </div>

                                
                         	</div>
        		    	
        		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
        		    		<div class="form-group">
                			    <label>Branch Name: <span>*</span></label>
                                    <input type="text" ng-model="branch_name" name="branch_name" placeholder="Branch Name" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>IFSC Code: <span>*</span></label>
                                	<input type="text" ng-model="ifsc_no" name="ifsc_no" placeholder="IFSC Code" class="form-control required">
                            </div>
								
                            <div class="form-group">
                			    <label>Name as per Pan Card	: <span>*</span></label>
                                	<input type="text" ng-model="pan_name" name="pan_name" placeholder="Name as per Pan Card" class="form-control required">
                            </div>
							<div class="form-group">
                			    <label>Name as per Aadhar Card	 : <span>*</span></label>
                                	<input type="text" ng-model="adhar_name" name="adhar_name" placeholder="Name as per Aadhar Card	" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>User Limit : <span>*</span></label>
                                	<input type="text" ng-model="user_limit" name="user_limit" placeholder="User Limit" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>Existing ESIC No	 : <span>*</span></label>
                                	<input type="text" ng-model="ex_esic_no" name="ex_esic_no" placeholder="Existing ESIC No" class="form-control required">
                            </div>

                            <div class="form-group">
                			    <label>DOB as per Aadhar Card : <span>*</span></label>
                                	<input type="text" ng-model="dob_as_adhar" name="dob_as_adhar" placeholder="DOB as per Aadhar Card" class="form-control required">
                            </div>
    		    		</div>
        		    </div>
					
                    <div class="form-wizard-buttons">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="button" class="btn btn-next" style="background-color: #044f7d!important;">Next</button>
                    </div>
                </fieldset>
							<!-- Form Step 2 completed-->

							<!-- Form Step 3 started-->
		        <fieldset>

		            <h4>Official Information: <span>Step 3 - 4</span></h4>
					<div class="row">
        		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
        		    		<div class="form-group">
                			    <label>Company Name: <span>*</span></label>
                                <input type="text" ng-model="comp_name" name="comp_name" placeholder="Company Name" class="form-control required">
                            </div>
                           
							<div class="form-group" >
                			    <label> Company Branch Name: <span>*</span></label>
                                <input type="text" ng-model="comp_branch" name="comp_branch" placeholder="Branch Name" class="form-control required">
                            </div>

							<div class="form-group">
                			    <label>Designation : <span>*</span></label>
                                <input type="date" ng-model="emp_post" name="emp_post" placeholder="Designation" class="form-control required">
                            </div>

							<div class="form-group">
                			    <label>Employee join Date : <span>*</span></label>
                                <input type="date" ng-model="join_date" name="join_date" class="form-control required">
                            </div>
                            <div class="form-group">
                			    <label>Membership Date: <span>*</span></label>
                                <input type="date" ng-model="mem_date" name="mem_date"  class="form-control required">
                            </div>

							<div class="form-group">
                			    <label>Employee Status: <span>*</span></label>
                                 <select class="form-control" ng-model="emp_sts" name="emp_sts">
								  <option value="NEW" selected>New</option>
								  <option value="OLD" >Old</option>						 
								</select>
							</div>

							<div class="form-group">
                			    <label>Vendor ID: <span>*</span></label>
                                <input type="text" ng-model="vendor" name="vendor" placeholder="Vendor ID" class="form-control required">
                            </div>                            
                     	</div>
    		    	
    		    	<div class="col-sm-6 col-md-6  col-lg-6 ">
    		    		<div class="form-group">
            			    <label>Company Register ID: <span>*</span></label>
                                <input type="text" placeholder="Company Code" class="form-control required"     >
                                 <input type="text" ng-model="comp_code" name="comp_code" >
                        </div>

                        <div class="form-group">
                			<label>Department: </label>
                               <input type="text" ng-model="dept" name="dept" placeholder="Department" class="form-control required">
                        </div>

                        <div class="form-group">
            			    <label>Location: <span>*</span></label>
                                <input type="text" ng-model="loc" name="loc" placeholder="Location" class="form-control required">
                        </div>
						<div class="form-group">
            			    <label>Existing Date: <span>*</span></label>
                                <input type="Date" ng-model="ex_date" name="ex_date"  class="form-control required">
                        </div>

						<div class="form-group">
            			    <label>Internation Worker: <span>*</span></label>
                            	<select class="form-control" ng-model="worker" name="worker">
                                <option value="YES" selected>YES</option>
                                <option value="NO">NO</option>
                                
                              </select>
                        </div>
							
						<div class="form-group">
            			    <label>Contractor Name : <span>*</span></label>
                            	<input type="text" ng-model="contractor" name="contractor" placeholder="Contractor" class="form-control required">
                        </div>

                        
		    		</div>
    		    </div>
		            <div class="form-wizard-buttons">
		                <button type="button" class="btn btn-previous">Previous</button>
		                <button type="button" class="btn btn-next" style="background-color: #044f7d!important;">Next</button>
		            </div>
		        </fieldset>
							<!-- Form Step 3 -->
							
							<!-- Form Step 4 -->
				<fieldset>

                    <h4>Confirmation: <span>Step 4 - 4</span></h4>

					<div style="clear:both;"></div>
						<h3>*** Personal Information ***</h3>
					<div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Name : </label><strong>{{emp_name}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Parent Name : </label><strong>{{parent_name}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

					 <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Gender : </label><strong>{{gender}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Marital Status : </label><strong>{{m_status}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Date of Birth : </label><strong>{{emp_dob}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Education Qualifications : </label><strong>{{education}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Perment Address : </label><strong>{{p_address}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Cureent Address : </label><strong>{{c_address}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Email Address : </label><strong>{{emp_mail}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Phone Number : </label><strong>{{emp_mob}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Physical Handicap : </label><strong>{{handicap}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Physically Handicap Catogary : </label><strong>{{phy_handi_cat}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Relation Name : </label><strong>{{rel_name}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Relation Date of Birth : </label><strong>{{rel_dob}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Relation Age : </label><strong>{{rel_age}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Relation Aadhar : </label><strong>{{rel_aadhar}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Nomination 1 : </label><strong>{{nom1}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Nomination 2 : </label><strong>{{nom2}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Nomination 3 : </label><strong>{{nom3}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Nomination 4 : </label><strong>{{nom4}}</strong>
        		    		</div>
        		    	</div>
        		    </div>
        		    <hr>
        		    <h3>*** Bank Details ***</h3>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Bank Name : </label><strong>{{bank_name}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Branch Name : </label><strong>{{branch_name}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Account Number : </label><strong>{{ac_no}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>IFSC Code : </label><strong>{{ifsc_no}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>PAN Number : </label><strong>{{emp_pan}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label> Name as per PAN Card : </label><strong>{{pan_name}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Aadhar Number : </label><strong>{{emp_aadhar}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Name as per Aadhar Card : </label><strong>{{adhar_name}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Require PF Deduction ? : </label><strong>{{pf_dud}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>User Limit : </label><strong>{{user_limit}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Require ESIC Deduction : </label><strong>{{esic_dud}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Existing ESIC No : </label><strong>{{ex_esic_no}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Existing UAN No : </label><strong>{{una_no}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>DOB as per Aadhar Card : </label><strong>{{dob_as_adhar}}</strong>
        		    		</div>
        		    	</div>
        		    </div>
        		    <hr>
        		    <h3>*** Company Details ***</h3>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Company Name : </label><strong>{{comp_name}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label> Company Code : </label><strong>{{comp_code}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Branch Name : </label><strong>{{comp_branch}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Department : </label><strong>{{dept}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Designation : </label><strong>{{emp_post}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Location : </label><strong>{{loc}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Join Date : </label><strong>{{join_date}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Existing Date : </label><strong>{{ex_date}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Membership Date : </label><strong>{{mem_date}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Internation Worker : </label><strong>{{worker}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Employee Status : </label><strong>{{emp_sts}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>Contractor Name : </label><strong>{{contractor}}</strong>
        		    		</div>
        		    	</div>
        		    </div>

        		    <div class="row">
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label>vendor ID : </label><strong>{{vendor}}</strong>
        		    		</div>
        		    	</div>
        		    	<div class="col-sm-6 col-md-6 col-lg-6 ">
        		    		<div class="form-group">
        		    			 <label> : </label><strong>{{}}</strong>
        		    		</div>
        		    	</div>
        		    </div>
					
                    <div class="form-wizard-buttons">
                        <button type="button" class="btn btn-previous">Previous</button>
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </fieldset>
							<!-- Form Step 4 -->
                    	
                    	</form>
						<!-- Form Wizard -->
                    </div>
              
                    
      
      
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script> -->

  

    <script  src="<?php echo base_url('assets/form_wizard/js/index1.js');?>"></script>