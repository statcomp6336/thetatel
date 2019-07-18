
<style type="text/css">
  .widget-main{
    height: fit-content;
  }
</style>



<?php //include('graphscript_data.php');?>

<?php if (IS_SPG == TRUE) { ?>
 
<div class="col-sm-7 infobox-container">
  <!-- Total scope -->
  <a href="<?php echo base_url(''.$user_type.'/total-scope');?>">
  <div class="infobox infobox-green">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-comments "></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_scope; ?></span>
      <div class="infobox-content">Total Scope</div>
    </div>

    <div class="stat stat-success">8%</div>
  </div>
</a>

  <!-- Total Current Particuler -->
  <a href="<?php echo base_url(''.$user_type.'/current-scope');?>">
  <div class="infobox infobox-blue">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-upload"></i>
    </div>

    <div class="infobox-data">
     <!--  <span class="infobox-data-number"><?php echo $total_bulk_update; ?></span>
      <div class="infobox-content">Bulk Update</div> -->
       <span class="infobox-data-number"><?php echo $total_bulk_update; ?></span>
      <div class="infobox-content">Current Particuler</div>
    </div>

    <div class="badge badge-success">
      +32%
      <i class="ace-icon fa fa-arrow-up"></i>
    </div>
  </div>
</a>

  <!-- Total complience --> 
  <a href="<?php echo base_url(''.$user_type.'/Complilnce-Done');?>">
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_complience; ?></span>
      <div class="infobox-content">Complience</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
</a>

  <!-- Total Non Complience -->
   <a href="<?php echo base_url(''.$user_type.'/Non-Compliance');?>">
  <div class="infobox infobox-red">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-flask"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_non_complience; ?></span>
      <div class="infobox-content">Non-Compliance</div>
    </div>
  </div>
</a>

  <!--  Total pending -->
  <a href="<?php echo base_url(''.$user_type.'/Pending-Compliance');?>">
  <div class="infobox infobox-orange2">
    <div class="infobox-icon">
      <i class="ace-icon fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_pending; ?></span>
      <div class="infobox-content">pending</div>
    </div>

    <div class="badge badge-success">
      7.2%
      <i class="ace-icon fa fa-arrow-up"></i>
    </div>
  </div>
</a>

  <!-- Total Complaints of Thise Month -->
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_compl; ?></span>
      <div class="infobox-content">Complaints of Month</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
  <!-- Total Alerts -->

  <a href="<?php echo base_url(''.$user_type.'/Alert-Compliance');?>">
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart animated"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_alerts; ?></span>
      <div class="infobox-content">Alerts</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
</a>

<!-- Total Approval -->
  <div class="infobox infobox-blue2">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="42" data-size="46">
        <span class="percent"><?php echo $total_approves; ?>
      </div>
    </div>

    <div class="infobox-data">
      <span class="infobox-text">My Approval</span>

      <div class="infobox-content">
        <span class="bigger-110">~</span>
        58GB remaining
      </div>
    </div>
  </div>
  <!-- Total Notis -->
  <div class="infobox infobox-red">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-bell icon-animated-bell"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_notis; ?></span>
      <div class="infobox-content">Notification</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>

  <div class="space-6"></div>

  <div class="infobox infobox-green infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent">61</span>%
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Task</div>
      <div class="infobox-content">Completion</div>
    </div>
  </div>

  <div class="infobox infobox-blue infobox-small infobox-dark">
    <div class="infobox-chart">
      <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Earnings</div>
      <div class="infobox-content">$32,000</div>
    </div>
  </div>

  <div class="infobox infobox-grey infobox-small infobox-dark">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-download"></i>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Downloads</div>
      <div class="infobox-content">1,205</div>
    </div>
  </div>
</div>
<?php 
}
elseif (IS_COMPANY == TRUE) {
  echo "this in company";
}
elseif (IS_BRANCH == TRUE) {
   echo "this in IS_BRANCH";
}
elseif (IS_SPGUSER == TRUE) { ?>
   <div class="col-sm-7 infobox-container">
  <!-- Total scope -->
  <a href="<?php echo base_url(''.$user_type.'/total-scope');?>">
  <div class="infobox infobox-green">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-comments "></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_scope; ?></span>
      <div class="infobox-content">Total Scope</div>
    </div>

    <div class="stat stat-success">8%</div>
  </div>
</a>

  <!-- Total Current Particuler -->
  <a href="<?php echo base_url(''.$user_type.'/current-scope');?>">
  <div class="infobox infobox-blue">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-upload"></i>
    </div>

    <div class="infobox-data">
     <!--  <span class="infobox-data-number"><?php echo $total_bulk_update; ?></span>
      <div class="infobox-content">Bulk Update</div> -->
       <span class="infobox-data-number"><?php echo $total_bulk_update; ?></span>
      <div class="infobox-content">Current Particuler</div>
    </div>

    <div class="badge badge-success">
      +32%
      <i class="ace-icon fa fa-arrow-up"></i>
    </div>
  </div>
</a>

  <!-- Total complience --> 
  <a href="<?php echo base_url(''.$user_type.'/Complilnce-Done');?>">
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_complience; ?></span>
      <div class="infobox-content">Complience</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
</a>

  <!-- Total Non Complience -->
   <a href="<?php echo base_url(''.$user_type.'/Non-Compliance');?>">
  <div class="infobox infobox-red">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-flask"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_non_complience; ?></span>
      <div class="infobox-content">Non-Compliance</div>
    </div>
  </div>
</a>

  <!--  Total pending -->
  <a href="<?php echo base_url(''.$user_type.'/Pending-Compliance');?>">
  <div class="infobox infobox-orange2">
    <div class="infobox-icon">
      <i class="ace-icon fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_pending; ?></span>
      <div class="infobox-content">pending</div>
    </div>

    <div class="badge badge-success">
      7.2%
      <i class="ace-icon fa fa-arrow-up"></i>
    </div>
  </div>
</a>

  <!-- Total Complaints of Thise Month -->
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_compl; ?></span>
      <div class="infobox-content">Complaints of Month</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
  <!-- Total Alerts -->

  <a href="<?php echo base_url(''.$user_type.'/Alert-Compliance');?>">
  <div class="infobox infobox-pink">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-shopping-cart animated"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_alerts; ?></span>
      <div class="infobox-content">Alerts</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>
</a>

<!-- Total Approval -->
  <div class="infobox infobox-blue2">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="42" data-size="46">
        <span class="percent"><?php echo $total_approves; ?>
      </div>
    </div>

    <div class="infobox-data">
      <span class="infobox-text">My Approval</span>

      <div class="infobox-content">
        <span class="bigger-110">~</span>
        58GB remaining
      </div>
    </div>
  </div>
  <!-- Total Notis -->
  <div class="infobox infobox-red">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-bell icon-animated-bell"></i>
    </div>

    <div class="infobox-data">
      <span class="infobox-data-number"><?php echo $total_notis; ?></span>
      <div class="infobox-content">Notification</div>
    </div>
    <div class="stat stat-important">4%</div>
  </div>

  <div class="space-6"></div>

  <div class="infobox infobox-green infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent">61</span>%
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Task</div>
      <div class="infobox-content">Completion</div>
    </div>
  </div>

  <div class="infobox infobox-blue infobox-small infobox-dark">
    <div class="infobox-chart">
      <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Earnings</div>
      <div class="infobox-content">$32,000</div>
    </div>
  </div>

  <div class="infobox infobox-grey infobox-small infobox-dark">
    <div class="infobox-icon">
      <i class="ace-icon fa fa-download"></i>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">Downloads</div>
      <div class="infobox-content">1,205</div>
    </div>
  </div>
</div>
<?php 
}
elseif (IS_CONTRACTOR == TRUE) {
   echo "this in IS_CONTRACTOR";
}
elseif (IS_SUBCONTRACTOR == TRUE) {
   echo "this in IS_SUBCONTRACTOR";
}

?>

<div class="vspace-12-sm"></div>

<div class="col-sm-5">
  <div class="widget-box">
    <div class="widget-header widget-header-flat widget-header-small">
      <h5 class="widget-title">
        <i class="ace-icon fa fa-signal"></i>
        Traffic Sources
      </h5>

      <div class="widget-toolbar no-border">
        <div class="inline dropdown-hover">
          <button class="btn btn-minier btn-primary">
            This Week
            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
          </button>

          <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
            <li class="active">
              <a href="#" class="blue">
                <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                This Week
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                Last Week
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                This Month
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                Last Month
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="widget-body">
      <div class="widget-main">
        <!-- <div id="piechart-placeholder"></div> -->
         <!-- <div class="dasharea2">
                      <div id="chart_div" class="chart" style="margin-left:50px;">
                        
                      </div>
        </div> -->

      

        <div class="hr hr8 hr-double"></div>

        <div class="clearfix">
          <div class="grid3">
            <span class="grey">
              <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
              &nbsp; likes
            </span>
            <h4 class="bigger pull-right">1,255</h4>
          </div>

          <div class="grid3">
            <span class="grey">
              <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
              &nbsp; tweets
            </span>
            <h4 class="bigger pull-right">941</h4>
          </div>

          <div class="grid3">
            <span class="grey">
              <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
              &nbsp; pins
            </span>
            <h4 class="bigger pull-right">1,050</h4>
          </div>
        </div>
      </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
  </div><!-- /.widget-box -->
</div><!-- /.col -->
<<<<<<< HEAD
</span>
</div>
<div class="row"> 
  <div class="col-sm-12">
    <div id="bar_chart"></div>
  </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript">
      // Load the Visualization API and the line package.
      google.charts.load('current', {'packages':['bar']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
        $.ajax({
        type: 'POST',
        url: 'http://localhost/newstatcomp/thetatel/spg/Spg/getdata',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Month');
      data.addColumn('number', 'employees');
      data.addColumn('number', 'Salary');
      data.addColumn('number', 'pf');
      data.addColumn('number', 'esic');
        
      var jsonData = $.parseJSON(data1);
      
      for (var i = 0; i < jsonData.length; i++) {
            data.addRow([jsonData[i].mnth, parseInt(jsonData[i].total_emp), parseInt(jsonData[i].total_sal), parseInt(jsonData[i].total_pf), parseInt(jsonData[i].total_esic)]);
      }
      var options = {
        
        width: 1200,
        height: 400,
        axes: {
          x: {
            0: {side: 'down'}
          }
        }
         
      };
      console.log(data);
      var chart = new google.charts.Bar(document.getElementById('bar_chart'));
      chart.draw(data, options);
       }
     });
    }
  </script>
  






 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
=======
 <!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script>
>>>>>>> a6363cd7383b6ca04a281e9ef514580d362ffce9
 <script src="<?php echo base_url();?>assets/dashboard/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
           google.load('visualization', '1.0', {'packages':['corechart']});
           google.setOnLoadCallback(drawChart);
 
        function drawChart() {
      
    var x=<?php echo $total_compl; ?>;
        var y=<?php echo $total_pending; ?>;
    var z=<?php echo $total_non_complience; ?>;


var data = google.visualization.arrayToDataTable([
          ['Report', 'Compliance Distribution'],
           ['Compliance',     x],
          ['Pending',      y],
          ['Noncompliance',  z]
          
        ]);

        var options = {
          title: 'My Daily Activities',thickness: 2,
          is3D: true,
      colors: ['Green','#ffc40c','Red']
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);

 }

</script>
<script>
$(document).ready(function() {  

var id = '#dialog';
  
//Get the screen height and width
var maskHeight = $(document).height();
var maskWidth = $(window).width();
  
//Set heigth and width to mask to fill up the whole screen
$('#mask').css({'width':maskWidth,'height':maskHeight});

//transition effect
$('#mask').fadeIn(500); 
$('#mask').fadeTo("slow",0.9);  
  
//Get the window height and width
var winH = $(window).height();
var winW = $(window).width();
              
//Set the popup window to center
$(id).css('top',  winH/2-$(id).height()/2);
$(id).css('left', winW/2-$(id).width()/2);
  
//transition effect
$(id).fadeIn(2000);   
  
//if close button is clicked
$('.window .close').click(function (e) {
//Cancel the link behavior
e.preventDefault();

$('#mask').hide();
$('.window').hide();
});

//if mask is clicked
$('#mask').click(function () {
$(this).hide();
$('.window').hide();
});
  
});

</script> -->




<!-- <link rel="stylesheet" href="<?php echo base_url().'assets/dashboard/css/morris.css'?>">
<script src="<?php echo base_url().'assets/dashboard/js/jquery.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/dashboard/js/raphael-min.js'?>"></script>
        <script src="<?php echo base_url().'assets/dashboard/js/morris.min.js'?>"></script>
        <script>
        Morris.Bar({
          element: 'graph',
          data: <?php echo $data;?>,
          xkey: 'year',
          ykeys: ['total_sal', 'total_pf', 'total_emp','total_esic'],
          labels: ['Purchase', 'Sale', 'Profit' , 'esic']
        });
    </script> -->
  











