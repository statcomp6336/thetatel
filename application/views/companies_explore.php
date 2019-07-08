<?php 
    if (!empty(show_msg())) {     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
    }
 ?>	
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Companies explore  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Sr.No</th>			
			<th>Company Name</th>
			<th>Company ID</th>
			<th>Completed Date</th>
						
		</tr>
	</thead>

	<tbody>
		<?php $count =0;
		if (!empty($result) && $result !== " ") {
			
		
		foreach ($result as $key) {
			$count++;
			if ($page=='explore') {
				$year=date('Y', strtotime(''.$key->Statutory_due_date.''));
				$date=$key->Statutory_due_date;
			}
			else
			{
				$year=$key->year;
				$date=$year;
			}
					
		?>
		<tr>
			<td class="center">
				<label class="pos-rel">
					
					<span class="lbl"><?php echo $count; ?></span>
				</label>
			</td>
			<td>
				<a href="<?php echo base_url(''.$user_type.'/'.$page.'/companies/'.$year.'/'.hash_id($key->custid).'');?>"><?php echo $key->entity_name;?></a>
			</td>
			<td class="center">
				<?php echo $key->custid;?>
			</td>
			<td><?php echo $date;?></td>
			
			
		</tr>

		
	<?php } } ?>
		
	</tbody>
</table>

</div>	
	</div>
</div>	

