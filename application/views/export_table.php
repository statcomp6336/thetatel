
<style type="text/css">
	
	table{
		width: 100%;
    height: -webkit-fill-available;
    max-width: 100%;
    margin-bottom: 20px;
    overflow: scroll;
    display: block;
	}
</style>
<?php echo show_msg();?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />		
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>


<div class="container-fluid">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"><?php echo $tableHeading; ?></h4>
		<?php if(!empty($tableTools)) { 
		
		echo "<div class='widget-toolbar'>";
		foreach ($tableTools as $tool) {
			$link=!empty($tool['link'])?$tool['link']:'#';
			$class=!empty($tool['class'])?$tool['class']:'btn-success';
			$button=!empty($tool['button'])?$tool['button']:'Export';

			echo "<a href='".$link."'>";				
			echo "<button class='btn ".$class."' id='import' >".$button."</button></a>";	
		}
		echo "</div>";				
	 } ?>
	</div>
<div class="widget-body ">		
	
<!-- <table id="simple-table" class="ui-jqgrid-htable ui-common-table" role="presentation" aria-labelledby="gbox_grid-table"> -->
<table id="simple-table" class="table  table-bordered table-hover">
	<thead>
		<tr>
		<?php
		$c=sizeof($tableCol);
		for ($i=0; $i < $c; $i++) { 
			echo "<th class='center' style='background-color: wheat'>".$tableCol[$i]."</th>";
		}			
		?>
		</tr>		
	</thead>

	<tbody>
		<?php $count =0;
		
		if (!empty($tableData)) {			
			foreach ($tableData as $val) {				
				if(is_object($val))
			    {
			     echo "<tr>";
			      	foreach($val as $td)
			        {   
			            echo "<td class='center'>".$td."</td>";
			        }			      
			    }			
			}	
		}
		else
		{
			echo " Data Not Found";
		}				
		?>			
		</tr>	
	</tbody>
</table></div>
</div>
</div>
</div>


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
			
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
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