<?php

// var_dump($result);

?>
<link href="<?php echo base_url();?>assets/files/css/styles.css" rel="stylesheet"/>

<div class="filemanager">

		<div class="search">
			<input type="search" placeholder="Find a file.." />
		</div>

		<div class="breadcrumbs"></div>

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>No files here.</span>
		</div>

</div>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url();?>assets/files/js/script.js"></script>