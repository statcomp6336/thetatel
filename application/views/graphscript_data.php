<style>
#mask {
  position: absolute;
  left: 0;
  top: 0;
  z-index: 9000;
  background-color: #000;
  display: none;
}
#boxes .window {
  position: absolute;
  left: 0;
  top: 0;
  width: 440px;
  height: 200px;
  display: none;
  z-index: 9999;
  padding: 20px;
  border-radius: 15px;
  text-align: left;
}
#boxes #dialog {
  width: 750px;
  height: 300px;
  padding: 10px;
  background-color: #ffffff;
  font-size: 15px;
}
#popupfoot {
  font-size: 15px;
  position: absolute;
  bottom: 0px;
  width:750px;
  height:280px;
  overflow:auto;
  left:10px;
  top:20px;
}
.iagree {
  position:absolute;
  margin-top:280px;
  width:100%;
  text-align:center;
}

</style>
<script type="text/javascript">
           google.load('visualization', '1.0', {'packages':['corechart']});
           google.setOnLoadCallback(drawChart);
 
        function drawChart() {
      
        var x=<?php echo "200"; ?>;
        var y=<?php echo "200"; ?>;
        var z=<?php echo "200"; ?>;


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

</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script src="<?php echo base_url();?>assets/dashboard/js/jquery-2.1.4.min.js"></script>

<script>
$(document).ready(function(){
      $(function() {
      // Dropdown toggle
      $('.dropdown-toggle').click(function(){
        $(this).next('.popdown').toggle();
      });
      
      $(document).click(function(e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
        $('.popdown').hide(); }
      });
      
      });
      
      
      }); 
      
      
      
          </script>