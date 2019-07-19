 <?php 
 $company=0;
 $branch=0;
 $contractor=0;
 $sub_contractor=0;
foreach ($result as $val) {
	if ($val->custtype == 1) {
		$company++;
	}
	elseif ($val->custtype == 2) {
		$branch++;
	}
	elseif ($val->custtype == 3) {
		$contractor++;
	}
	elseif ($val->custtype == 4) {
		$sub_contractor++;
	}
}

?>
<style type="text/css">
	.widget-main{
		height: fit-content;
	}
	.infobox-small {
     width: 200px; 
}
	.infobox-small>.infobox-data {    
    max-width: max-content;   
	}
	.deleteButton {
background: transparent;
border: 1px solid #f00;
border-radius: 2em;
display: inline-block;
font-size: 12px;
height: 20px;
line-height: 2px;
margin: 0 0 8px;
padding: 0;
text-align: center;
width: 50px;
  background-color :#d15b47;
}
.editButton {
background: transparent;
border: 1px solid ;
border-radius: 2em;
display: inline-block;
font-size: 12px;
height: 20px;
line-height: 2px;
margin: 0 0 8px;
padding: 0;
text-align: center;
width: 50px;
  
}


</style>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
<div class="center">
 	<div class="infobox infobox-green infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent"><?php echo $company; ?></span>
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">TOTAL</div>
      <div class="infobox-content">COMPANY</div>
    </div>
  </div>

  <div class="infobox infobox-blue infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent"><?php echo $branch; ?></span>
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">TOTAL</div>
      <div class="infobox-content">BRANCH</div>
    </div>
  </div>

  <div class="infobox infobox-grey infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent"><?php echo $contractor; ?></span>
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">TOTAL</div>
      <div class="infobox-content">CONTRACTOR</div>
    </div>
  </div>

  <div class="infobox infobox-orange infobox-small infobox-dark">
    <div class="infobox-progress">
      <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
        <span class="percent"><?php echo $sub_contractor; ?></span>
      </div>
    </div>

    <div class="infobox-data">
      <div class="infobox-content">TOTAL</div>
      <div class="infobox-content">SUB-CONTRACTOR</div>
    </div>
  </div>
</div>
  



 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Entity Details  </h4>
	
	</div>
	<div class="widget-body ">
		<div class="widget-main" >	
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">	Sr.No</th>			
			<th class="center">Entity Name</th>
			<th class="center">Entity Code</th>
			<th class="center">Type</th>							
			<th class="center">Update</th>
			<th class="center">Remove</th>

		</tr>
	</thead>

	<tbody>
<?php $count =0;//$spgid=$this->session->SESS_CUST_ID;


foreach ($result as $key) {

	$entity_name=$key->entity_name;
	$custid=$key->custid;
	
	$count++;		
?>
		<tr>
			<td class="center">
				<label class="pos-rel"><span class="lbl"><?php echo $count; ?></span></label>
			</td>
			<td>


	<?php echo $entity_name;?></a> 
			</td>
			<td class="center"><?php echo $custid;?></td>
			<td class="center"><?php echo $key->catagory;?></td>
			<td class="center">
				<a href="<?php echo base_url(''.$user_type.'/entity-edit/'.hash_id($key->custid).''); ?>">
						<button class="editButton btn btn-primary"><i class="ace-icon fa fa-pencil-square-o"></i></button>		
				</a></td>
			<td class="center">
				<a href="<?php echo base_url(''.$user_type.'/entity-remove/'.hash_id($key->custid).''); ?>">
						<button class="deleteButton btn btn-danger" onclick="return confirm('Are you sure for entity deleteing..?')"><i class="ace-icon fa fa-times"></i></button>						
				</a></td>
		</tr>		
<?php }?>		
	</tbody>
</table>

</div>	
	</div>
</div>	
 <?php 
    if (!empty(show_msg())) {
     
        $data['msg'] =array('msg' => show_msg());
        $this->load->view('alert',$data);
       

    }

    ?> 