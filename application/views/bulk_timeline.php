

<?php echo show_msg();?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/css/chosen.min.css" />
    
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
  <div class="widget-header">
    <h4 class="widget-title">Employee Master Table</h4>

    <div class="widget-toolbar">
      <a href="#" data-action="collapse">
        
        <button class="btn btn-success" id="import" > search</button> 
      </a>     
    </div>

  </div>
  <div class="widget-body ">
     
  
<table id="simple-table" class="table  table-bordered table-hover">
  <thead>
    <tr>
      <th class="center">
        <label class="pos-rel">
          
          <span class="lbl">Sr.No</span>
        </label>
      </th>    
      <th>Company Name</th>
      <th>File Recived</th>
      <th>File Uploade</th>

      <th>
        PF & ESIC Process    
      </th>
      <th>
        Bulk Compliance     
      </th>

      <th>Bulk Approval</th>

      <th>Completed</th>
    </tr>
  </thead>

  <tbody>
    <?php $count =0;
    foreach ($companies as $key) {
      $count++; 
      if($key->)    
    ?>
    <tr>
      <td class="center">
        <label class="pos-rel">
          
          <span class="lbl"><?php echo $count; ?></span>
        </label>
      </td>    

      <td>
        <a href="<?php echo base_url(''.$user_type.'/compliance/bulk-timeline/'.hash_id($key->custid).'');?>"><?php echo $key->entity_name;?></a>
      </td>
      <td class="center"><i class="fa fa-check" style="font-size:25px;color:<?php echo 'red';?>"></td>
      <td class="center"><i class="fa fa-check" style="font-size:25px;color:green"></i></td>
      <td class="center"><i class="fa fa-check" style="font-size:25px;color:skyblue"></i></td>

      
      <td class="center">
         <i class="fa fa-check" style="font-size:25px;color:orange"></i>
      </td>
      <td class="center">
         <i class="fa fa-times" style="font-size:25px;color:red"></i>
      </td>
      <td class="center">          
          <i class="fa fa-check" style="font-size:25px;color:green"></i>        
      </td>      
    </tr>    
  <?php }?>
    
  </tbody>

</table>
</div>
</div>  

</div>
</div>


   
