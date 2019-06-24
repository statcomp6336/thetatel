<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style>
            body {
                font-family:tahoma;
                font-size:12px;
            }

            #signup-step {
                margin:auto;
                padding:0;
                width:53%
            }

            #signup-step li {
                list-style:none; 
                float:left;
                padding:5px 10px;
                border-top:#004C9C 1px solid;
                border-left:#004C9C 1px solid;
                border-right:#004C9C 1px solid;
                border-radius:5px 5px 0 0;
            }

            .activate {
                color:#FFF;
            }

            #signup-step li.activate {
                background-color:#004C9C;
            }

            #signup-form {
                clear:both;
                border:1px #004C9C solid;
                padding:20px;
                width:50%;
                margin:auto;
            }

            .demoInputBox {
                padding: 10px;
                border: #CDCDCD 1px solid;
                border-radius: 4px;
                background-color: #FFF;
                width: 50%;
            }

            .signup-error {
                color:#FF0000; 
                padding-left:15px;
            }

            .message {
                color: #00FF00;
                font-weight: bold;
                width: 100%;
                padding: 10;
            }

            .btnAction {
                padding: 5px 10px;
                background-color: #F00;
                border: 0;
                color: #FFF;
                cursor: pointer;
                margin-top:15px;
            }

            label {
                line-height:35px;
            }

        </style>

        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>

        <script>
            function validate() {
                var output = true;
                var data = {};
                $(".signup-error").html('');

                if ($("#personal-field").css('display') != 'none') {
                    if (!($("#ent_name").val())) {
                        output = false;
                        $("#ent_name-error").html("Entity Name required!");
                    }
                    else
                    {
                        data["ent_name"] = $("#ent_name").val();
                    }

                    if (!($("#ent_code").val())) {
                        output = false;
                        $("#ent_code-error").html("Entity Code required!");
                    }
                     else
                    {
                        data["ent_code"] = $("#ent_code").val();
                    }

                    if (!($("#comp_pan").val())) {
                        output = false;
                        $("#comp_pan-error").html("PAN Number required!");
                    }
                    else
                    {
                        data["comp_pan"] = $("#comp_pan").val();
                    }

                    if (!($("#comp_name").val())) {
                        output = false;
                        $("#comp_name-error").html("Company Name required!");
                    }
                     else
                    {
                        data["comp_name"] = $("#comp_name").val();
                    }

                     if (!($("#comp_addr").val())) {
                        output = false;
                        $("#comp_addr-error").html("Company Address required!");
                    }
                     else
                    {
                        data["comp_addr"] = $("#comp_addr").val();
                    }


                    if (!($("#comp_landmark").val())) {
                        output = false;
                        $("#comp_landmark-error").html("Company Landmark required!");
                    }
                     else
                    {
                        data["comp_landmark"] = $("#comp_landmark").val();
                    }
                     if (!($("#comp_state").val())) {
                        output = false;
                        $("#comp_state-error").html("Company State required!");
                    }
                     else
                    {
                        data["comp_state"] = $("#comp_state").val();
                    }

                     if (!($("#comp_pin").val())) {
                        output = false;
                        $("#comp_pin-error").html("Company Pincode required!");
                    }
                     else
                    {
                        data["comp_pin"] = $("#comp_pin").val();
                    }

                    if (!($("#comp_mail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))) {
                        output = false;
                        $("#comp_mail-error").html("Company Email required!");
                    }
                     else
                    {
                        data["comp_mail"] = $("#comp_mail").val();
                    }
                    if (!($("#comp_phone").val())) {
                        output = false;
                        $("#comp_phone-error").html("Company Phone required!");
                    }
                     else
                    {
                        data["comp_phone"] = $("#comp_phone").val();
                    }



                  
                }

                if ($("#password-field").css('display') != 'none') {
                    /* +++ Admin hr executive validation +++ */
                    if (!($("#hr_ex_name").val())) {
                        output = false;
                        $("#hr_ex_name-error").html("Executive Person Name required!");
                    }
                    if (!($("#hr_ex_mail").val())) {
                        output = false;
                        $("#hr_ex_mail-error").html("Executive Email required!");
                    }
                    if (!($("#hr_ex_phone").val())) {
                        output = false;
                        $("#hr_ex_phone-error").html("Executive Phone required!");
                    }
                    

                     /* +++ Admin hr Manager validation +++ */
                    if (!($("#hr_mg_name").val())) {
                        output = false;
                        $("#hr_mg_name-error").html("Manager Name required!");
                    }
                    if (!($("#hr_mg_mail").val())) {
                        output = false;
                        $("#hr_mg_mail-error").html("Manager Email required!");
                    }
                    if (!($("#hr_mg_phone").val())) {
                        output = false;
                        $("#hr_mg_phone-error").html("Manager Phone required!");
                    }
                   

                     /* +++ Vice Precident Admin OR hr  validation +++ */
                    if (!($("#hr_vp_name").val())) {
                        output = false;
                        $("#hr_vp_name-error").html("Vice Precident Name required!");
                    }
                    if (!($("#hr_vp_mail").val())) {
                        output = false;
                        $("#hr_vp_mail-error").html("Vice Precident Email required!");
                    }
                    if (!($("#hr_vp_phone").val())) {
                        output = false;
                        $("#hr_vp_phone-error").html("Vice Precident phone required!");
                    }
                  


                   
                }

                if ($("#contact-field").css('display') != 'none') {
                     /* +++ Admin hr executive validation +++ */
                    if (!($("#sp_ex_name").val())) {
                        output = false;
                        $("#sp_ex_name-error").html("Executive Person Name required!");
                    }
                    // if (!($("sp_ex_mail1").val())) {
                    //     output = false;
                    //     $("#sp_ex_mail1-error").html("Executive Email required!");
                    // }
                    if (!($("#sp_ex_phone").val())) {
                        output = false;
                        $("#sp_ex_phone-error").html("Executive Phone required!");
                    }
                    

                     /* +++ Admin hr Manager validation +++ */
                    if (!($("#sp_mg_name").val())) {
                        output = false;
                        $("#sp_mg_name-error").html("Manager Name required!");
                    }
                    if (!($("#sp_mg_mail").val())) {
                        output = false;
                        $("#sp_mg_mail-error").html("Manager Email required!");
                    }
                    if (!($("#sp_mg_phone").val())) {
                        output = false;
                        $("#sp_mg_phone-error").html("Manager Phone required!");
                    }
                   

                     /* +++ Vice Precident Admin OR hr  validation +++ */
                    if (!($("#sp_vp_name").val())) {
                        output = false;
                        $("#sp_vp_name-error").html("Vice Precident Name required!");
                    }
                    if (!($("#sp_vp_mail").val())) {
                        output = false;
                        $("sp_vp_mail-error").html("Vice Precident Email required!");
                    }
                    if (!($("#sp_vp_phone").val())) {
                        output = false;
                        $("#sp_vp_phone-error").html("Vice Precident phone required!");
                    }
                  
                }

                return output;
            }

            $(document).ready(function () {
                $("#next").click(function () {
                    var output = validate();
                    if (output === true) {
                         // $.ajax({
                         //        type: 'POST',
                         //        url: '<?php echo base_url('spg/Spg/ajax1');?>',
                         //        // data: $('form').serialize(),
                         //        data: $('form').serialize(),
                         //        success: function (ret) {
                         //          alert(ret);
                         //        }
                         //      });

                        var current = $(".activate");
                        var next = $(".activate").next("li");
                        if (next.length > 0) {
                            $("#" + current.attr("id") + "-field").hide();
                            $("#" + next.attr("id") + "-field").show();
                            $("#back").show();
                            $("#finish").hide();
                            $(".activate").removeClass("activate");





                            next.addClass("activate");
                            if ($(".activate").attr("id") == $("li").last().attr("id")) {
                                $("#next").hide();
                                $("#finish").show();
                            }
                        }
                    }
                });


                $("#back").click(function () {
                    var current = $(".activate");
                    var prev = $(".activate").prev("li");
                    if (prev.length > 0) {
                        $("#" + current.attr("id") + "-field").hide();
                        $("#" + prev.attr("id") + "-field").show();
                        $("#next").show();
                        $("#finish").hide();
                        $(".activate").removeClass("activate");
                        prev.addClass("activate");
                        if ($(".activate").attr("id") == $("li").first().attr("id")) {
                            $("#back").hide();
                        }
                    }
                });

                $("input#finish").click(function (e) {
                    var output = validate();
                    var current = $(".activate");

                    if (output === true) {
                        return true;
                    } else {
                        //prevent refresh
                        e.preventDefault();
                        $("#" + current.attr("id") + "-field").show();
                        $("#back").show();
                        $("#finish").show();
                    }
                });
            });
        </script>

    
<div ng-app="">

        <ul id="signup-step">
            <li id="personal" class="activate">Company Details</li>
            <li id="password">HR Details</li>
            <li id="contact">Service provider details</li>
            <li id="save">Comfirmation</li>
        </ul>

        <?php      
        echo show_msg();
        $attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
        echo form_open(base_url('spg/company/save'), $attributes);
        ?>
        <div id="personal-field">
<?php
if($reg_type=="company") {
?>
                <label>Entity Name</label><span id="ent_name-error" class="signup-error"></span>
            <div><input type="text" name="ent_name" id="ent_name" ng-model="ent_name" class="demoInputBox" /></div>

            <label>Entity Code  </label><span id="ent_code-error"  class="signup-error"></span>
            <div><input type="text" name="ent_code" id="ent_code" ng-model="ent_code" class="demoInputBox" /></div>

<?php } else{ ?>

               <label>Entity Name</label><span id="ent_name-error" class="signup-error"></span>
            <div><input type="text" name="ent_name" id="ent_name" ng-model="ent_name" class="demoInputBox" ng-init="ent_name='<?php echo is($name);?>'" value="<?php echo $name;?>" /></div>

            <label>Entity Code  </label><span id="ent_code-error"  class="signup-error"></span>
            <div><input type="text" name="ent_code" id="ent_code" ng-model="ent_code" class="demoInputBox" ng-init="ent_code='<?php echo is($custid);?>'" value="<?php echo $custid;?>"/></div> 
<?php } ?>
            

            <label>Company PAN No</label><span id="comp_pan-error" class="signup-error"></span>
            <div><input type="text" name="comp_pan" id="comp_pan" ng-model="comp_pan" class="demoInputBox"/></div>

            <label>Company Name    </label><span id="comp_name-error" class="signup-error"></span>
            <div><input type="text" name="comp_name" id="comp_name" ng-model="comp_name" class="demoInputBox"  /></div>

            <label>Company Address</label><span id="comp_addr-error" class="signup-error"></span>
            <div><input type="text" name="comp_addr" id="comp_addr" ng-model="comp_addr" class="demoInputBox"/></div>
          
            <label>Landmark </label><span id="comp_landmark-error" class="signup-error"></span>
            <div><input type="text" name="comp_landmark" id="comp_landmark" ng-model="comp_landmark" class="demoInputBox"/></div>

            <label>State</label>
                <div>
                <select name="comp_state" id="comp_state" class="demoInputBox" ng-model="comp_state">
                    <option value="male">Male</option>
                    <option value="female">Female</option>                                                                         
                </select>
                </div>
            <label>Pincode</label><span id="comp_pin-error" class="signup-error"></span>
            <div><input type="text" name="comp_pin" ng-model="comp_pin" id="comp_pin" class="demoInputBox"/></div>

             <label>Email ID</label><span id="comp_mail-error" class="signup-error"></span>
            <div><input type="text" name="comp_mail" ng-model="comp_mail" id="comp_mail" class="demoInputBox"/></div>

             <label>Corporate Phone </label><span id="comp_phone-error" class="signup-error"></span>
            <div><input type="text" name="comp_phone" id="comp_phone" ng-model="comp_phone" class="demoInputBox"/></div>
            
        </div>

        <div id="password-field" style="display:none;">
           <!--  <label>Enter Password</label><span id="password-error" class="signup-error"></span>
            <div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
            <label>Re-enter Password</label><span id="confirm-password-error" class="signup-error"></span>
            <div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div> -->
            <div><h2>Admin OR HR Executive :</h2></div>
            <label>Person Name</label><span id="hr_ex_name-error" class="signup-error"></span>
            <div><input type="text" name="hr_ex_name" ng-model="hr_ex_name" id="hr_ex_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="hr_ex_mail-error" class="signup-error"></span>
            <div><input type="text" name="hr_ex_mail" ng-model="hr_ex_mail" id="hr_ex_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="hr_ex_phone-error" class="signup-error"></span>
            <div><input type="text" name="hr_ex_phone" ng-model="hr_ex_phone" id="hr_ex_phone" class="demoInputBox"/></div><hr>

              <div><h2>Admin OR HR Manager :</h2></div>
            <label>Person Name</label><span id="hr_mg_name-error" class="signup-error"></span>
            <div><input type="text" name="hr_mg_name" ng-model="hr_mg_name" id="hr_mg_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="hr_mg_mail-error" class="signup-error"></span>
            <div><input type="text" name="hr_mg_mail" ng-model="hr_mg_mail" id="hr_mg_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="hr_mg_phone-error" class="signup-error"></span>
            <div><input type="text" name="hr_mg_phone" ng-model="hr_mg_phone" id="hr_mg_phone" class="demoInputBox"/></div><hr>

              <div><h2>Vice president Admin OR HR  :</h2></div>
            <label>Person Name</label><span id="hr_vp_name-error" class="signup-error"></span>
            <div><input type="text" name="hr_vp_name" ng-model="hr_vp_name" id="hr_vp_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="hr_vp_mail-error" class="signup-error"></span>
            <div><input type="text" name="hr_vp_mail" ng-model="hr_vp_mail" id="hr_vp_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="hr_vp_phone-error" class="signup-error"></span>
            <div><input type="text" name="hr_vp_phone" ng-model="hr_vp_phone" id="hr_vp_phone" class="demoInputBox"/></div><hr>




        </div>

        <div id="contact-field" style="display:none;">
             <div><h2>Service Provider Executive :</h2></div>
            <label>Person Name</label><span id="sp_ex_name-error" class="signup-error"></span>
            <div><input type="text" name="sp_ex_name" ng-model="sp_ex_name" id="sp_ex_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="sp_ex_mail-error" class="signup-error"></span>
            <div><input type="text" name="sp_ex_mail" ng-model="sp_ex_mail" id="sp_ex_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="sp_ex_phone-error" class="signup-error"></span>
            <div><input type="text" name="sp_ex_phone" ng-model="sp_ex_phone" id="sp_ex_phone" class="demoInputBox"/></div><hr>

              <div><h2>Service Provider Manager :</h2></div>
            <label>Person Name</label><span id="sp_mg_name-error" class="signup-error"></span>
            <div><input type="text" name="sp_mg_name" ng-model="sp_mg_name" id="sp_mg_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="sp_mg_mail-error" class="signup-error"></span>
            <div><input type="text" name="sp_mg_mail" ng-model="sp_mg_mail" id="sp_mg_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="sp_mg_phone-error" class="signup-error"></span>
            <div><input type="text" name="sp_mg_phone" ng-model="sp_mg_phone" id="sp_mg_phone" class="demoInputBox"/></div><hr>

              <div><h2>Vice president Service Provider  :</h2></div>
            <label>Person Name</label><span id="sp_vp_name-error" class="signup-error"></span>
            <div><input type="text" name="sp_vp_name" ng-model="sp_vp_name" id="sp_vp_name" class="demoInputBox"/></div>

             <label>Email ID</label><span id="sp_vp_mail-error" class="signup-error"></span>
            <div><input type="text" name="sp_vp_mail" ng-model="sp_vp_mail" id="sp_vp_mail" class="demoInputBox"/></div>

             <label>Phone </label><span id="sp_vp_phone-error" class="signup-error"></span>
            <div><input type="text" name="sp_vp_phone" ng-model="sp_vp_phone" id="sp_vp_phone" class="demoInputBox"/></div><hr>
           
        </div>
        <div id="save-field" style="display:none;">
            <?php $temp_data=$this->session->userdata('temp_sess_wizard');?>
           <span>The first step is to register the customer and make his mobile number as his number. 

            If you type the first three digit of the mobile, it tries to find the details of the customer from the global database. 

            If available, select the number, rest of the fields automatically fills up</span>


            <div>
            <label>Entity Name:</label><div>{{ent_name}}</div>
            <label>Entity code:</label><div>{{ent_code}}</div>
            <label>Company Name:</label><div>{{comp_name}}</div>
            <label>Company PAN number:</label><div>{{comp_pan}}</div>
            <label>Company Address:</label><div>{{comp_addr}}</div>
            <label>Company State:</label><div>{{comp_state}}</div>
            <label>Landmark:</label><div>{{comp_landmark}}</div>
            <label>Pincode:</label><div>{{comp_pin}}</div>
            <label>Company mail address:</label><div>{{comp_mail}}</div>
            <label>Company Phone Number:</label><div>{{comp_phone}}</div>

            <label>Admin OR HR Executive Person Name:</label><div>{{hr_ex_name}}></div>
            <label>Admin OR HR Executive Email:</label><div>{{hr_ex_mail}}</div>
            <label>Admin OR HR Executive Phone Number:</label><div>{{hr_ex_phone}}</div>

            <label>Admin OR HR Manager Person Name:</label><div>{{hr_mg_name}}</div>
            <label>Admin OR HR Manager Email:</label><div>{{hr_mg_mail}}</div>
            <label>Admin OR HR Manager Phone Number:</label><div>{{hr_mg_phone}}</div>

            <label>Vice Precident Person Name:</label><div>{{ hr_vp_name }}</div>
            <label>Vice Precidentr Email:</label><div>{{hr_mg_mail}}</div>
            <label>Vice Precident Phone Number:</label><div>{{hr_mg_phone}}</div>

            <label>Serviece Provider Execute person Name:</label><div>{{sp_ex_name}}</div>
            <label>Serviece Provider Execute Email:</label><div>{{sp_ex_mail}}</div>
            <label>Serviece Provider Execute phone:</label><div>{{sp_ex_phone}}</div>

            <label>Serviece Provider Manager person Name:</label><div>{{sp_mg_name}}</div>
            <label>Serviece Provider Manager Email:</label><div>{{sp_mg_mail}}</div>
            <label>Serviece Provider Manager phone:</label><div>{{sp_mg_phone}}</div>

            <label>Serviece Provider Vice Precident person Name:</label><div>{{sp_vp_name}}</div>
            <label>Serviece Provider Vice Precident Email:</label><div>{{sp_vp_mail}}</div>
            <label>Serviece Provider Vice Precident phone:</label><div>{{sp_vp_phone}}</div>
           
            
                

            </div>
            <span></span>

        </div>

        <div>
            <input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
            <input class="btnAction" type="button" name="next" id="next" value="Next" >
            <input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
