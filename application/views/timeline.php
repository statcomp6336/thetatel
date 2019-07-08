<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/ace-rtl.min.css" />
<style type="text/css">
  *,
*:after,
*:before {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
            
.timeline {
  width: 100%;
  height: 100px;
  max-width: 1000px;
  margin: 0 auto;
  display: flex;      
  justify-content: center;    
}

.timeline .events {
  position: relative;
  background-color: #606060;
  height: 3px;
  width: 100%;
  border-radius: 4px;
  margin: 5em 0;
 }

.timeline .events ol {
  margin: 0;
  padding: 0;
  text-align: center;
}

.timeline .events ul {
  list-style: none;
}

.timeline .events ul li {
  display: inline-block;
  width: 16.29%;
  margin: 0;
  padding: 0;
}

.timeline .events ul li a {
  font-family: 'Arapey', sans-serif;
  font-style: italic;
  font-size: 1.25em;
  color: #606060;
  text-decoration: none;
  position: relative;
  top: -32px;
}

.timeline .events ul li a:after {
  content: '';
  position: absolute;
  bottom: -25px;
  left: 50%;
  right: auto;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  border: 3px solid #606060;
  background-color: #fff;
  transition: 0.3s ease;
  transform: translateX(-50%);
}

.timeline .events ul li a:hover::after {
  background-color: #194693;
  border-color: #194693;
}

.timeline .events ul li .green:after {
  background-color: green;
  border-color: green;
}
.timeline .events ul li .blue:after {
  background-color: blue;
  border-color: blue;
}
.timeline .events ul li .orange:after {
  background-color: orange;
  border-color: orange;
}
.timeline .events ul li .skyblue:after {
  background-color: skyblue;
  border-color: skyblue;
}
.timeline .events ul li .red:after {
  background-color: red;
  border-color: red;
}
.timeline .events ul li .green:hover::after {
  background-color: red;
  border-color: green;
}

            
.events-content {
  width: 100%;
  height: 100px;
  max-width: 800px;
  margin: 0 auto;
  display: flex;      
  justify-content: left;
}

.events-content li {
  display: none;
  list-style: none;
}



.events-content li h2 {
  font-family: 'Frank Ruhl Libre', serif;
  font-weight: 500;
  color: #919191;
  font-size: 2.5em;
}

.name{
       font-family: 'Frank Ruhl Libre', serif;
    font-weight: 500;
    color: #281e1e;
    font-size: 23.25px;
    position: relative;
    top: 38%;
    left: -5%;
    text-align: -webkit-center;
    font-size: xx-large;
}
.widget-main {
    padding: 12px;
    height: -webkit-fill-available;
    display: initial;
    overflow: scroll;
}
</style>

<div class="container">

    
    <div class="timeline">
      
      <div class="events">
        <ol>
          <ul>
            <li>
             <?php
                if ($timeline->IS_FileRecive == 0 ) {
                 echo "<a href='#0' class='red'>File Recived</a>";
                }
                else
                {
                   echo "<a href='#0' class='green'>File Recived</a>";
                }

              ?>
            </li>
            <li>
              <?php
                if ($timeline->IS_FileUpload == 0 ) {
                  echo "<a href='#1' class='red'>File Upload</a>";
                }
                else
                {
                   echo "<a href='#1' class='green'>File Upload</a>";
                }

              ?>  
              
            </li>

            <li>
               <?php
                  if ($timeline->IS_PfProcess == 0 ) {
                    echo "<a href='#2' class='red'>PF & ESIC</a>";
                  }

                  else
                  {
                     echo "<a href='#2' class='green'>PF & ESIC</a>";
                  }

                ?>  
             
            </li>

            <li>
                 <?php
                    if ($timeline->IS_Compliation == 0 ) {
                      echo "<a href='#3' class='red'>Bulk Compilation</a>";
                    }
                     elseif ($timeline->IS_Compliation == 2 ) {
                     echo "<a href='#3' class='skyblue'>Bulk Compilation</a>";
                    }
                     elseif ($timeline->IS_Compliation == 3 ) {
                      echo "<a href='#3' class='orange'>Bulk Compilation</a>";
                    }
                    else
                    {
                       echo "<a href='#3' class='green'>Bulk Compilation</a>";
                    }

                  ?> 
            </li>

            <li>
              <?php
                if ($timeline->IS_Approve == 0 ) {
                 echo "<a href='#4' class='red'>Bulk Approve</a>";
                }
                elseif ($timeline->IS_Approve == 2) {
                  echo "<a href='#4' class='orange'>Bulk Approve</a>";
                }
                else
                {
                   echo "<a href='#4' class='green'>Bulk Approve</a>";
                }

              ?>  

              
            </li>
            <li>
              <?php
                  if ($timeline->IS_Complete == 0 ) {
                   echo "<a href='#5' class='red'>Complete</a>";
                  }
                  else
                  {
                     echo "<a href='#5' class='green'>Complete</a>";
                  }

                ?> 
            
              
            </li>

          </ul>
        </ol>
      </div>
    </div>
     <div class="name"><?php echo $timeline->entity_name;?></div>

</div>
<!-- horizontal timeline end -->
<!-- vertical timeline start -->
<div class="align-right">
    <span class="green middle bolder">Choose timeline: &nbsp;</span>

    <div class="btn-toolbar inline middle no-margin">
      <div data-toggle="buttons" class="btn-group no-margin">
        <label class="btn btn-sm btn-yellow active">
          <span class="bigger-110">1</span>

          <input type="radio" value="1" />
        </label>

        <label class="btn btn-sm btn-yellow">
          <span class="bigger-110">2</span>

          <input type="radio" value="2" />
        </label>
      </div>
    </div>
  </div>

  <div id="timeline-1">
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="timeline-container">
          <div class="timeline-label">
            <span class="label label-primary arrowed-in-right label-lg">
              <b>Today</b>
            </span>
          </div>

          <div class="timeline-items">
            <?php 
              foreach ($result as $key ) { ?>
            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <img alt="Susan't Avatar" src="<?php echo base_url();?>assets/dashboard/images/avatars/avatar1.png" />
                <span class="label label-info label-sm"> <?php echo date('d-M', strtotime($key->created_at));?></span>
              </div>

              <div class="widget-box transparent">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">
                    <a href="#" class="blue"><?php echo $key->who; ?></a>
                    <span class="grey"><?php echo "File Share with UNH ADMIN"; ?></span>
                  </h5>

                  <span class="widget-toolbar no-border">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    <?php echo date('H:i:s', strtotime($key->created_at));?>
                  </span>

                  <span class="widget-toolbar">
                    <a href="#" data-action="reload">
                      <i class="ace-icon fa fa-refresh"></i>
                    </a>

                    <a href="#" data-action="collapse">
                      <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                  </span>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                      <?php echo $key->comment;?>
                    <div class="space-6"></div>

                    <div class="widget-toolbox clearfix">
                      <div class="pull-left">
                        <i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
                        <a href="#" class="bigger-110">Click to read &hellip;</a>
                      </div>

                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
              
              


            <!-- <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-body">
                  <div class="widget-main">
                    Going to cafe for lunch
                    <div class="pull-right">
                      <i class="ace-icon fa fa-clock-o bigger-110"></i>
                      12:30
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
<!-- 
            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-star btn btn-warning no-hover green"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">New logo</h5>

                  <span class="widget-toolbar no-border">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    9:15
                  </span>

                  <span class="widget-toolbar">
                    <a href="#" data-action="reload">
                      <i class="ace-icon fa fa-refresh"></i>
                    </a>

                    <a href="#" data-action="collapse">
                      <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                  </span>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    Designed a new logo for our website. Would appreciate feedback.
                    <div class="space-6"></div>

                    <div class="widget-toolbox clearfix">
                      <div class="pull-right action-buttons">
                        <div class="space-4"></div>

                        <div>
                          <a href="#">
                            <i class="ace-icon fa fa-heart red bigger-125"></i>
                          </a>

                          <a href="#">
                            <i class="ace-icon fa fa-facebook blue bigger-125"></i>
                          </a>

                          <a href="#">
                            <i class="ace-icon fa fa-reply light-green bigger-130"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-flask btn btn-default no-hover"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-body">
                  <div class="widget-main"> Took the final exam. Phew! </div>
                </div>
              </div>
            </div> -->
          </div><!-- /.timeline-items -->
        </div><!-- /.timeline-container -->

        <!-- <div class="timeline-container">
          <div class="timeline-label">
            <span class="label label-success arrowed-in-right label-lg">
              <b>Yesterday</b>
            </span>
          </div>

          <div class="timeline-items">
            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-beer btn btn-inverse no-hover"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">Haloween party</h5>

                  <span class="widget-toolbar">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    1 hour ago
                  </span>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    <div class="clearfix">
                      <div class="pull-left">
                        Lots of fun at Haloween party.
                        <br />
                        Take a look at some pics:
                      </div>

                      <div class="pull-right">
                        <i class="ace-icon fa fa-chevron-left blue bigger-110"></i>

                        &nbsp;
                        <img alt="Image 4" width="36" src="<?php echo base_url();?>assets/dashboard/images/gallery/thumb-4.jpg" />
                        <img alt="Image 3" width="36" src="<?php echo base_url();?>assets/dashboard/images/gallery/thumb-3.jpg" />
                        <img alt="Image 2" width="36" src="<?php echo base_url();?>assets/dashboard/images/gallery/thumb-2.jpg" />
                        <img alt="Image 1" width="36" src="<?php echo base_url();?>assets/dashboard/images/gallery/thumb-1.jpg" />
                        &nbsp;
                        <i class="ace-icon fa fa-chevron-right blue bigger-110"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-trophy btn btn-pink no-hover green"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">Lorum Ipsum</h5>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    Anim pariatur cliche reprehenderit, enim eiusmod
                    <span class="green bolder">high life</span>
                    accusamus terry richardson ad squid &hellip;
                  </div>
                </div>
              </div>
            </div>

            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-body">
                  <div class="widget-main"> Going to cafe for lunch </div>
                </div>
              </div>
            </div>

            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-bug btn btn-danger no-hover"></i>
              </div>

              <div class="widget-box widget-color-red2">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">Critical security patch released</h5>

                  <span class="widget-toolbar no-border">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    9:15
                  </span>

                  <span class="widget-toolbar">
                    <a href="#" data-action="reload">
                      <i class="ace-icon fa fa-refresh"></i>
                    </a>

                    <a href="#" data-action="collapse">
                      <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                  </span>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    Please download the new patch for maximum security.
                  </div>
                </div>
              </div>
            </div> -->
          <!-- </div>/.timeline-items -->
        <!-- </div>/.timeline-container -->

        <!-- <div class="timeline-container">
          <div class="timeline-label">
            <span class="label label-grey arrowed-in-right label-lg">
              <b>May 17</b>
            </span>
          </div> -->

         <!--  <div class="timeline-items">
            <div class="timeline-item clearfix">
              <div class="timeline-info">
                <i class="timeline-indicator ace-icon fa fa-leaf btn btn-primary no-hover green"></i>
              </div>

              <div class="widget-box transparent">
                <div class="widget-header widget-header-small">
                  <h5 class="widget-title smaller">Lorum Ipsum</h5>

                  <span class="widget-toolbar no-border">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    10:22
                  </span>

                  <span class="widget-toolbar">
                    <a href="#" data-action="reload">
                      <i class="ace-icon fa fa-refresh"></i>
                    </a>

                    <a href="#" data-action="collapse">
                      <i class="ace-icon fa fa-chevron-up"></i>
                    </a>
                  </span>
                </div>

                <div class="widget-body">
                  <div class="widget-main">
                    Anim pariatur cliche reprehenderit, enim eiusmod
                    <span class="blue bolder">high life</span>
                    accusamus terry richardson ad squid &hellip;
                  </div>
                </div>
              </div>
            </div>
          </div>--><!-- /.timeline-items -->
        <!-- </div>/.timeline-container  -->
      </div>
    </div>
  </div>

  






</div>
<script src="<?php echo base_url();?>assets/dashboard/js/jquery-2.1.4.min.js"></script>
<!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
        $('[data-toggle="buttons"] .btn').on('click', function(e){
          var target = $(this).find('input[type=radio]');
          var which = parseInt(target.val());
          $('[id*="timeline-"]').addClass('hide');
          $('#timeline-'+which).removeClass('hide');
        });
      });
    </script>