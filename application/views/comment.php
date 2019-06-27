<!-- page specific plugin styles -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
		
<div id="myModal" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="container">
				<div class="modal-header">
					<h4>Comment Box</h4>
				</div>
				 	
				<div class="modal-body">
					
			<?php 
		$attributes = array('name' => 'frmRegistration', 'id' => 'signup-form');
		 echo form_open_multipart(base_url(''.$user_type.'/Spg/save_comment'),$attributes );?>	
			<div class="form-group ">
				<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Register Id</label>

				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" id="inputWarning" class="width-100" name="custid" value="<?php echo $comment['custid'];?>"  required />
						<input type="hidden" name="url" value="<?php echo $comment['url'];?>">
						<i class="ace-icon fa fa-leaf green"></i>
					</span>
				</div>
				<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
			</div>

			<div class="form-group ">
				<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Company Name</label>

				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" id="inputWarning" class="width-100" name="comp_name"  required />
						<i class="ace-icon fa fa-leaf green"></i>
					</span>
				</div>
				<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
			</div>

			<div class="form-group ">
				<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Subject</label>

				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" id="inputWarning" class="width-100" name="heading"  required />
						<input type="hidden" id="inputWarning" class="width-100" name="event" value="<?php echo $comment['event'];?>"  required />
						<i class="ace-icon fa fa-leaf green"></i>
					</span>
				</div>
				<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
			</div>

			<div class="form-group ">
				<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">who are commented</label>

				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" id="inputWarning" class="width-100" name="who" value="<?php echo USERNAME;?>"  required />		
						<i class="ace-icon fa fa-leaf green"></i>
					</span>
				</div>
				<div class="help-block col-xs-12 col-sm-reset inline"> Warning tip help! </div>
			</div>
			<textarea name="content" data-provide="markdown" class="wysiwyg-editor" id="editor1"></textarea>

<button class="btn btn-sm btn-success btn-white btn-round pull-right" type="submit" name="submit">
			<i class="ace-icon fa fa-globe bigger-125"></i>

				Publish
				<i class="ace-icon fa fa-arrow-right icon-on-right bigger-125"></i>
			</button>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

	<div class="modal-footer wizard-actions">
		

		

		<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
			<i class="ace-icon fa fa-times"></i>
			Cancel
		</button>
	</div>
	<?php echo form_close(); ?>

</div>
</div><!-- PAGE CONTENT ENDS -->

<script src="<?php echo base_url();?>assets/dashboard/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/markdown.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/jquery.hotkeys.index.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo base_url();?>assets/dashboard/js/bootbox.js"></script>

<script type="text/javascript">

			jQuery(function($){
	
	$('textarea[data-provide="markdown"]').each(function(){
        var $this = $(this);

		if ($this.data('markdown')) {
		  $this.data('markdown').showEditor();
		}
		else $this.markdown()
		
		$this.parent().find('.btn').addClass('btn-white btn-round');
    })
	
	
	
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			//console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons
 $('textarea[data-provide="markdown"]').attr('name', 'comment');
	//but we want to change a few buttons colors for the third style
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
			'font',
			null,
			'fontSize',
			null,
			{name:'bold', className:'btn-info btn-round'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			{name:'insertunorderedlist', className:'btn-success'},
			{name:'insertorderedlist', className:'btn-success'},
			{name:'outdent', className:'btn-purple'},
			{name:'indent', className:'btn-purple'},
			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		},
		'name' :'goutam'
	}).prev().addClass('wysiwyg-style2');

	
	/**
	//make the editor have all the available height
	$(window).on('resize.editor', function() {
		var offset = $('#editor1').parent().offset();
		var winHeight =  $(this).height();
		
		$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
	}).triggerHandler('resize.editor');
	*/
	

	$('#editor2').css({'height':'200px'}).ace_wysiwyg({
		toolbar_place: function(toolbar) {
			return $(this).closest('.widget-box')
			       .find('.widget-header').prepend(toolbar)
				   .find('.wysiwyg-toolbar').addClass('inline');
		},
		toolbar:
		[
			'bold',
			{name:'italic' , title:'Change Title!', icon: 'ace-icon fa fa-leaf'},
			'strikethrough',
			null,
			'insertunorderedlist',
			'insertorderedlist',
			null,
			'justifyleft',
			'justifycenter',
			'justifyright'
		],
		speech_button: false
	});
	
	


	$('[data-toggle="buttons"] .btn').on('click', function(e){
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		var toolbar = $('#editor1').prev().get(0);
		if(which >= 1 && which <= 4) {
			toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
			if(which == 1) $(toolbar).addClass('wysiwyg-style1');
			else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
			if(which == 4) {
				$(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
			} else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
		}
	});


	

	//RESIZE IMAGE
	
	//Add Image Resize Functionality to Chrome and Safari
	//webkit browsers don't have image resize functionality when content is editable
	//so let's add something using jQuery UI resizable
	//another option would be opening a dialog for user to enter dimensions.
	if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {
		
		var lastResizableImg = null;
		function destroyResizable() {
			if(lastResizableImg == null) return;
			lastResizableImg.resizable( "destroy" );
			lastResizableImg.removeData('resizable');
			lastResizableImg = null;
		}

		var enableImageResize = function() {
			$('.wysiwyg-editor')
			.on('mousedown', function(e) {
				var target = $(e.target);
				if( e.target instanceof HTMLImageElement ) {
					if( !target.data('resizable') ) {
						target.resizable({
							aspectRatio: e.target.width / e.target.height,
						});
						target.data('resizable', true);
						
						if( lastResizableImg != null ) {
							//disable previous resizable image
							lastResizableImg.resizable( "destroy" );
							lastResizableImg.removeData('resizable');
						}
						lastResizableImg = target;
					}
				}
			})
			.on('click', function(e) {
				if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
					destroyResizable();
				}
			})
			.on('keydown', function() {
				destroyResizable();
			});
	    }

		enableImageResize();

		/**
		//or we can load the jQuery UI dynamically only if needed
		if (typeof jQuery.ui !== 'undefined') enableImageResize();
		else {//load jQuery UI if not loaded
			//in Ace demo ./components will be replaced by correct components path
			$.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
				enableImageResize()
			});
		}
		*/
	}
	


});
		</script>
		<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
