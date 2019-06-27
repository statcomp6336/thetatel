<?php echo show_msg();


?>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Compliance Document Details  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Sr.No</th>	

			<th class="center">Company Name</th>
			<th class="center">Company ID</th>
			
			<th class="center">Act</th>
			<th class="center">Date</th>
			<th class="center">file name</th>
			<th class="center">Email Send </th>	

		</tr>
	</thead>

	<tbody>
 <?php $count =0;
foreach ($result as $key) { 
				$doc_path=$key->doc_path;
				$str_arr = explode ("_", $doc_path);					
// 				$date=$str_arr[1];
// 				$act=$str_arr[2];
 				$path=$str_arr[3];
				$count++;		
?>
		<tr>
			<td class="center">
				<label class="pos-rel"><span class="lbl"><?php echo $count; ?></span></label>
			</td>
			<td class="center"><?php echo $key->entity_name ;?></td>
			<td class="center"><?php echo $key->custid;?></td>			
			<td class="center"><?php echo $key->act;?></td>
			<td class="center"><?php echo $key->due_date;?></td>
			<td class="center"><?php echo $key->doc_path;?>
			<a href="<?php echo $doc_path;?>"><img src="<?php echo base_url();?>assets/dashboard/images/downloadicon.png"></a>
			</td>
			<td class="center">
				<a href="<?php echo base_url(''.$user_type.'/download/spgusers/'.hash_id($path).'');?>">

					<button name="submit" value="SEND"><?php echo "SEND";?></button>
				</a>
			</td>
			
		</tr>		
<?php }?>		
	</tbody>
</table>

</div>	
	</div>
</div>	