
    


           <!--        <h4 class="lighter">
                        <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                        <a href="#modal-wizard" data-toggle="modal" class="pink"> Wizard Inside a Modal Box </a>
                  </h4>

                  <div class="hr hr-18 hr-double dotted"></div>

                  <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                              <h4 class="widget-title lighter">New Item Wizard</h4>

                              <div class="widget-toolbar">
                                    <label>
                                          <small class="green">
                                                <b>Validation</b>
                                          </small>                                          
                                          <span class="lbl middle"></span>
                                    </label>
                              </div>
                        </div>

                        <div class="widget-body">
                              <div class="widget-main">
                                    <div id="fuelux-wizard-container">
                                          <div>
                                                <ul class="steps">
                                                      <li data-step="1" class="active">
                                                            <span class="step">1</span>
                                                            <span class="title">Company Details</span>
                                                      </li>

                                                      <li data-step="2">
                                                            <span class="step">2</span>
                                                            <span class="title">HR & Admin Details</span>
                                                      </li>

                                                      <li data-step="3">
                                                            <span class="step">3</span>
                                                            <span class="title">Service Provider Details</span>
                                                      </li>

                                                      <li data-step="4">
                                                            <span class="step">4</span>
                                                            <span class="title">Confirmation</span>
                                                      </li>
                                                </ul>
                                          </div>

                                          <hr />

                                          <div class="step-content pos-rel">
                                                <div class="step-pane active" data-step="1">
                                                      <h3 class="lighter block green">Enter the following information</h3>                                   
                                                       <?php
                                                       
                                                        $attributes = array('name' => 'frmRegistration', 'id' => 'validation-form');
                                                        echo form_open(base_url('spg/company/save'), $attributes);
                                                        ?>                                                      
                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Entity Name:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <input type="email" name="ent_name" id="ent_name" ng-model="ent_name" class="col-xs-12 col-sm-6" />
                                                                        </div>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>

                                                           

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Entity Code:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <input type="text" name="ent_code" id="ent_code" ng-model="ent_code" class="col-xs-12 col-sm-4" />
                                                                        </div>
                                                                  </div>
                                                                  <span id="ent_code-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">Company PAN Number:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <input type="text" name="comp_pan" id="comp_pan" ng-model="comp_pan" class="col-xs-12 col-sm-4" />
                                                                        </div>
                                                                  </div>
                                                                  <span id="comp_pan-error"></span>
                                                            </div>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Company Name:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <input type="text" name="comp_name" id="comp_name" ng-model="comp_name" class="col-xs-12 col-sm-5" />
                                                                        </div>
                                                                  </div>
                                                                  <span id="comp_name-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Company Address:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="input-group">
                                                                              <div class="clearfix">
                                                                              <input type="text" name="comp_addr" id="comp_addr" ng-model="comp_addr" class="col-xs-12 col-sm-5" />
                                                                        </div>
                                                                             <!--  <span class="input-group-addon">
                                                                                    <i class="ace-icon fa fa-phone"></i>
                                                                              </span>

                                                                              <input type="tel" id="phone" name="phone" /> -->
                                                                        <!-- </div>
                                                                  </div>
                                                                  <span id="comp_addr-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">Landmark:</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <input type="text" name="comp_landmark" id="comp_landmark" ng-model="comp_landmark" class="col-xs-12 col-sm-8" />
                                                                        </div>
                                                                  </div>
                                                                  <span id="comp_landmark-error"></span>
                                                            </div>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right">State</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                      <select name="comp_state" id="comp_state"
ng-model="comp_state" class="select2" data-placeholder="Click to Choose...">
                                                                              <option value="">&nbsp;</option>
                                                                              <option value="AL">Alabama</option>
                                                                              <option value="AK">Alaska</option>
                                                                              <option value="AZ">Arizona</option>
                                                                              <option value="AR">Arkansas</option>
                                                                              <option value="CA">California</option>
                                                                              <option value="CO">Colorado</option>
                                                                              <option value="CT">Connecticut</option>
                                                                              <option value="DE">Delaware</option>
                                                                              
                                                                        </select>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right">Pincode</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div>
                                                                              <label class="line-height-1 blue">
                                                                                    <input name="comp_pin" ng-model="comp_pin" id="comp_pin" type="text" class="ace" />
                                                                                    <span class="lbl"> Male</span>
                                                                              </label>
                                                                        </div>

                                                                        
                                                                  </div>
                                                                  <span id="comp_pin-error"></span>
                                                            </div>

                                                            <div class="hr hr-dotted"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Corporate Phone</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <select id="state" name="state" class="select2" data-placeholder="Click to Choose...">
                                                                              <option value="">&nbsp;</option>
                                                                              <option value="AL">Alabama</option>
                                                                              <option value="AK">Alaska</option>
                                                                              <option value="AZ">Arizona</option>
                                                                              <option value="AR">Arkansas</option>
                                                                              <option value="CA">California</option>
                                                                              <option value="CO">Colorado</option>
                                                                              <option value="CT">Connecticut</option>
                                                                              <option value="DE">Delaware</option>
                                                                              
                                                                        </select>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Platform</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <select class="input-medium" id="platform" name="platform">
                                                                                    <option value="">------------------</option>
                                                                                    <option value="linux">Linux</option>
                                                                                    <option value="windows">Windows</option>
                                                                                    <option value="mac">Mac OS</option>
                                                                                    <option value="ios">iOS</option>
                                                                                    <option value="android">Android</option>
                                                                              </select>
                                                                        </div>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>

                                                            <div class="space-2"></div>

                                                            <div class="form-group">
                                                                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment</label>

                                                                  <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <textarea class="input-xlarge" name="comment" id="comment"></textarea>
                                                                        </div>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>

                                                            <div class="space-8"></div>

                                                            <div class="form-group">
                                                                  <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                                                                        <label>
                                                                              <input name="agree" id="agree" type="checkbox" class="ace" />
                                                                              <span class="lbl"> I accept the policy</span>
                                                                        </label>
                                                                  </div>
                                                                  <span id="ent_name-error"></span>
                                                            </div>
                                                   
                                                </div>

                                                <div class="step-pane" data-step="2">
                                                      <div>
                                                            <div class="col-xs-12 col-sm-9">
                                                                        <div class="clearfix">
                                                                              <select class="input-medium" id="platform" name="platform">
                                                                                    <option value="">------------------</option>
                                                                                    <option value="linux">Linux</option>
                                                                                    <option value="windows">Windows</option>
                                                                                    <option value="mac">Mac OS</option>
                                                                                    <option value="ios">iOS</option>
                                                                                    <option value="android">Android</option>
                                                                              </select>
                                                                        </div>
                                                                  </div>
                                                            <div class="alert alert-success">
                                                                  <button type="button" class="close" data-dismiss="alert">
                                                                        <i class="ace-icon fa fa-times"></i>
                                                                  </button>

                                                                  <strong>
                                                                        <i class="ace-icon fa fa-check"></i>
                                                                        Well done!
                                                                  </strong>

                                                                  You successfully read this important alert message.
                                                                  <br />
                                                            </div>

                                                            <div class="alert alert-danger">
                                                                  <button type="button" class="close" data-dismiss="alert">
                                                                        <i class="ace-icon fa fa-times"></i>
                                                                  </button>

                                                                  <strong>
                                                                        <i class="ace-icon fa fa-times"></i>
                                                                        Oh snap!
                                                                  </strong>

                                                                  Change a few things up and try submitting again.
                                                                  <br />
                                                            </div>

                                                            <div class="alert alert-warning">
                                                                  <button type="button" class="close" data-dismiss="alert">
                                                                        <i class="ace-icon fa fa-times"></i>
                                                                  </button>
                                                                  <strong>Warning!</strong>

                                                                  Best check yo self, you're not looking too good.
                                                                  <br />
                                                            </div>

                                                            <div class="alert alert-info">
                                                                  <button type="button" class="close" data-dismiss="alert">
                                                                        <i class="ace-icon fa fa-times"></i>
                                                                  </button>
                                                                  <strong>Heads up!</strong>

                                                                  This alert needs your attention, but it's not super important.
                                                                  <br />
                                                            </div>
                                                      </div>
                                                </div>   </form>

                                                <div class="step-pane" data-step="3">
                                                      <div class="center">
                                                            <h3 class="blue lighter">This is step 3</h3>
                                                      </div>
                                                </div>

                                                <div class="step-pane" data-step="4">
                                                      <div class="center">
                                                            <h3 class="green">Congrats!</h3>
                                                            Your product is ready to ship! Click finish to continue!
                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                                    <hr />
                                    <div class="wizard-actions">
                                          <button class="btn btn-prev">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Prev
                                          </button>

                                          <button class="btn btn-success btn-next" data-last="Finish">
                                                Next
                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                          </button>
                                    </div> -->
                              <!-- </div>/.widget-main -->
                        <!-- </div>/.widget-body -->
                  <!-- </div> --> 

                  <!-- <div id="modal-wizard" class="modal">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div id="modal-wizard-container">
                                          <div class="modal-header"> -->
                                                <ul class="steps">
                                                      <li data-step="1" class="active">
                                                            <span class="step">1</span>
                                                            <span class="title">Validation states</span>
                                                      </li>

                                                      <li data-step="2">
                                                            <span class="step">2</span>
                                                            <span class="title">Alerts</span>
                                                      </li>

                                                      <li data-step="3">
                                                            <span class="step">3</span>
                                                            <span class="title">Payment Info</span>
                                                      </li>

                                                      <li data-step="4">
                                                            <span class="step">4</span>
                                                            <span class="title">Other Info</span>
                                                      </li>
                                                </ul>
                                          <!-- </div> -->

                                          <div class="modal-body step-content">
                                                <div class="step-pane active" data-step="1">
                                                      <div class="center">
                                                            <h4 class="blue">Step 1</h4>
                                                      </div>
                                                </div>

                                                <div class="step-pane" data-step="2">
                                                      <div class="center">
                                                            <h4 class="blue">Step 2</h4>
                                                      </div>
                                                </div>

                                                <div class="step-pane" data-step="3">
                                                      <div class="center">
                                                            <h4 class="blue">Step 3</h4>
                                                      </div>
                                                </div>

                                                <div class="step-pane" data-step="4">
                                                      <div class="center">
                                                            <h4 class="blue">Step 4</h4>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="modal-footer wizard-actions">
                                          <button class="btn btn-sm btn-prev">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Prev
                                          </button>

                                          <button class="btn btn-success btn-sm btn-next" data-last="Finish">
                                                Next
                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                          </button>

                                          <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                                                <i class="ace-icon fa fa-times"></i>
                                                Cancel
                                          </button>
                                    </div>
                              </div>
                        </div>
                  <!-- </div>PAGE CONTENT ENDS -->
           
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>   -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- <script src="~/App_Theme/bootstrap/js/bootstrap.min.js"></script> -->
            <script src="<?php echo base_url();?>assets/dashboard/js/wizard.min.js"></script>
            <script src="<?php echo base_url();?>assets/dashboard/js/jquery.validate.min.js"></script>
            <script src="<?php echo base_url();?>assets/dashboard/js/jquery-additional-methods.min.js"></script>
            <script src="<?php echo base_url();?>assets/dashboard/js/bootbox.js"></script>
            <script src="<?php echo base_url();?>assets/dashboard/js/jquery.maskedinput.min.js"></script>
            <script src="<?php echo base_url();?>assets/dashboard/js/select2.min.js"></script>

            <script type="text/javascript">
                  jQuery(function($) {
                          // $('#sample-form').hide();
                          $('#validation-form').removeClass('hide');
                  
                        $('[data-rel=tooltip]').tooltip();
                  
                        $('.select2').css('width','200px').select2({allowClear:true})
                        .on('change', function(){
                              $(this).closest('form').validate().element($(this));
                        }); 
                  
                  
                        var $validation = false;
                        $('#fuelux-wizard-container')
                        .ace_wizard({
                              //step: 2 //optional argument. wizard will jump to step "2" at first
                              //buttons: '.wizard-actions:eq(0)'
                        })
                        .on('actionclicked.fu.wizard' , function(e, info){
                              if(info.step == 1 && $validation) {
                                    if(!$('#validation-form').valid()) e.preventDefault();
                              }
                        })
                        //.on('changed.fu.wizard', function() {
                        //})
                        .on('finished.fu.wizard', function(e) {
                              bootbox.dialog({
                                    message: "Thank you! Your information was successfully saved!", 
                                    buttons: {
                                          "success" : {
                                                "label" : "OK",
                                                "className" : "btn-sm btn-primary"
                                          }
                                    }
                              });
                        }).on('stepclick.fu.wizard', function(e){
                              //e.preventDefault();//this will prevent clicking and selecting steps
                        });
                  
                  
                        //jump to a step
                        /**
                        var wizard = $('#fuelux-wizard-container').data('fu.wizard')
                        wizard.currentStep = 3;
                        wizard.setState();
                        */
                  
                        //determine selected step
                        //wizard.selectedItem().step
                  
                  
                  
                        //hide or show the other form which requires validation
                        //this is for demo only, you usullay want just one form in your application
                        // $('#skip-validation').removeAttr('checked').on('click', function(){
                        //       $validation = this.checked;
                        //       if(this.checked) {
                        //             $('#sample-form').hide();
                        //             $('#validation-form').removeClass('hide');
                        //       }
                        //       else {
                        //             $('#sample-form').hide();
                        //             $('#validation-form').removeClass('hide');
                        //       }
                        // })
                  
                  
                  
                        //documentation : http://docs.jquery.com/Plugins/Validation/validate
                  
                  
                        $.mask.definitions['~']='[+-]';
                        $('#phone').mask('(999) 999-9999');
                  
                        jQuery.validator.addMethod("phone", function (value, element) {
                              return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
                        }, "Enter a valid phone number.");
                  
                        $('#validation-form').validate({
                              errorElement: 'div',
                              errorClass: 'help-block',
                              focusInvalid: false,
                              ignore: "",
                              rules: {
                                    email: {
                                          required: true,
                                          email:true
                                    },
                                    password: {
                                          required: true,
                                          minlength: 5
                                    },
                                    password2: {
                                          required: true,
                                          minlength: 5,
                                          equalTo: "#password"
                                    },
                                    name: {
                                          required: true
                                    },
                                    phone: {
                                          required: true,
                                          phone: 'required'
                                    },
                                    url: {
                                          required: true,
                                          url: true
                                    },
                                    comment: {
                                          required: true
                                    },
                                    state: {
                                          required: true
                                    },
                                    platform: {
                                          required: true
                                    },
                                    subscription: {
                                          required: true
                                    },
                                    gender: {
                                          required: true,
                                    },
                                    agree: {
                                          required: true,
                                    }
                              },
                  
                              messages: {
                                    email: {
                                          required: "Please provide a valid email.",
                                          email: "Please provide a valid email."
                                    },
                                    password: {
                                          required: "Please specify a password.",
                                          minlength: "Please specify a secure password."
                                    },
                                    state: "Please choose state",
                                    subscription: "Please choose at least one option",
                                    gender: "Please choose gender",
                                    agree: "Please accept our policy"
                              },
                  
                  
                              highlight: function (e) {
                                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                              },
                  
                              success: function (e) {
                                    $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                                    $(e).remove();
                              },
                  
                              errorPlacement: function (error, element) {
                                    if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                                          var controls = element.closest('div[class*="col-"]');
                                          if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                                          else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                                    }
                                    else if(element.is('.select2')) {
                                          error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                                    }
                                    else if(element.is('.chosen-select')) {
                                          error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                                    }
                                    else error.insertAfter(element.parent());
                              },
                  
                              submitHandler: function (form) {
                              },
                              invalidHandler: function (form) {
                              }
                        });
                  
                        
                        
                        
                        $('#modal-wizard-container').ace_wizard();
                        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
                        
                        
                        /**
                        $('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
                              $(this).closest('form').validate().element($(this));
                        });
                        
                        $('#mychosen').chosen().on('change', function(ev) {
                              $(this).closest('form').validate().element($(this));
                        });
                        */
                        
                        
                        $(document).one('ajaxloadstart.page', function(e) {
                              //in ajax mode, remove remaining elements before leaving page
                              $('[class*=select2]').remove();
                        });
                  })
            </script>