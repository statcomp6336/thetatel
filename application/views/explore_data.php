 
<?php 
    if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?>	
<style type="text/css">
	.box.has-advanced-upload {
  background-color: white;
  outline: 2px dashed black;
  outline-offset: -10px;
}
.box.has-advanced-upload .box__dragndrop {
  display: inline;

</style>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/colorbox.min.css" />
<div class="container">
	<?php 
		if (IS_COMPANY == TRUE && $page=="share-files") { ?>		
	<div class="main">
		<?php
		$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 echo form_open_multipart(base_url(''.$user_type.'/save/share-files'),$attributes );?>		
			<div class="form-group box">
				<div class="col-xs-12 box__input">
					 <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
					<input multiple="" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected"  class="box__file" />
							
					<input type="hidden" name="custid" value="<?php echo $custid; ?>"/>		
					<input type="hidden" name="year" value="<?php echo $year; ?>"/>		
				</div>
				<div class="col-xs-12">
					<select name="month">
						<option value="Jan">Jan</option>
						<option value="Feb">Feb</option>
						<option value="Mar">Mar</option>
						<option value="Apr">Apr</option>
						<option value="May">May</option>
						<option value="Jun">Jun</option>
						<option value="Jul">Jul</option>
						<option value="Aug">Aug</option>
						<option value="Sept">Sept</option>
						<option value="Oct">Oct</option>
						<option value="Nov">Nov</option>
						<option value="Dec">Dec</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-4">
					<input  type="Submit" class="btn-primary" value="Upload" />
				</div>
			</div>
			 <?php echo form_close(); ?>		
		</div>
		<?php 	}
	?>	
<ul class="ace-thumbnails clearfix">
	<?php $count =0;
	if (!empty($result)) {
		
	
		foreach ($result as $key) {
			$count++;				
		?>
	<li><?php if (IS_COMPANY == FALSE && $page !=="share-files") { ?>
		<a href="<?php echo $key->doc_path; ?>" data-rel="colorbox">
		
			<img width="150" height="150" alt="150x150" src="<?php echo $key->doc_path; ?>" />
			
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
		<?php 
	}
	elseif ((IS_COMPANY == TRUE || IS_SPG == TRUE) && $page== 'share-files') 
	{ ?>
		<a href="<?php echo base_url(''.$key->send_doc.''); ?>" data-rel="colorbox">
		
			<img width="150" height="150" alt="150x150" src="<?php echo base_url(''.$key->send_doc.''); ?>" />			
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

			
			<a href="<?php echo base_url(''.$key->send_doc.''); ?>" download>
				<i class="ace-icon fa fa-download"></i>
			</a>

			<a href="#">
				<i class="ace-icon fa fa-times red"></i>
			</a>
		</div>	
	<?php }

		?>
	

	</li>
	<?php
} }
	?>

	
</ul>
</div>
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