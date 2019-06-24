


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/colorbox.min.css" />
<div class="container">
<ul class="ace-thumbnails clearfix">
	<?php $count =0;
		foreach ($result as $key) {
			$count++;
					
		?>
	<li>
		<a href="<?php echo $key->doc_path; ?>" data-rel="colorbox">
		<!-- <a href="<?php echo base_url('assets/img/banner2.jpg'); ?>" data-rel="colorbox"> -->
			<img width="150" height="150" alt="150x150" src="<?php echo $key->doc_path; ?>" />
			<!-- <img width="150" height="150" alt="150x150" src="<?php echo base_url('assets/img/banner2.jpg'); ?>" /> -->
			<div class="tags">
				
			</div>
		</a>

		<div class="tools tools-top">
			<a href="#">
				<i class="ace-icon fa fa-link"></i>
			</a>

			<a href="#">
				<i class="ace-icon fa fa-paperclip"></i>
			</a>

			<!-- <a href="<?php echo $key->doc_path; ?>" download> -->
			<a href="<?php echo base_url('assets/img/banner2.jpg'); ?>" download>
				<i class="ace-icon fa fa-download"></i>
			</a>

			<a href="#">
				<i class="ace-icon fa fa-times red"></i>
			</a>
		</div>

	</li>
	<?php
}
	?>

	
</ul>
</div>
<script src="<?php echo base_url();?>assets/dashboard/js/jquery.colorbox.min.js"></script>
<script type="text/javascript">
			jQuery(function($) {
	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
   });
})
		</script>