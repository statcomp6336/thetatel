<?php echo show_msg();


?>
 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
 <div class="container">
 <div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title"> Form-Q Details  </h4>
		
			<a href="<?php echo base_url(''.$user_type.'/download/formq/'.user_id().'/'.$custid.'');?>">
				<button name="submit" value="SEND" class="btn-success"><?php echo "DOWNLOAD Form-Q";?></button>
			</a>
		
	</div>
	<div class="widget-body ">
		<div class="widget-main" >



<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	<thead>
		<tr>
			<th class="center">Name of the Establishment:<?php echo $entity_name;?></th>			
			<th class="center">Name of the Employer:<?php echo $location;?></th>
			<th class="center">Month and Year :<?php echo $month;echo $year;?></th>						
		</tr>
	</thead>
</table>
		
<table id="simple-table" class="table table-bordered table-hover w3-table-all w3-hoverable">
	
	<thead>
	<tr style="background-color:#FFFFFF;" rowspan="2">
        <th class="center">	Sr No</th>
        <th class="center"><span class="style3">EmpID</span></td>
        <th class="center"><span class="style3">Full Name of the worker</span></td>
        <th class="center"><span class="style3">Designation of the worker and nature of work</span></td>
        <th class="center"><span class="style3">Age</span></td>
        <th class="center"><span class="style3">Sex</span></td>
        <th class="center"><span class="style3">Date of entry into service</span></td>
        <th class="center" colspan="2"><span class="style3">Working hours</span></td>
        <th class="center" colspan="2"><span class="style3">Interval for Rest</span></td>
        <th class="center" colspan="31"><span class="style3">Date of the Month</span></td>
        <th class="center"><span class="style3">Total Days worked</span></td>
        <th class="center"><span class="style3">Minimum rate of wages payable Rs.</span></td>
        <th class="center"><span class="style3">Total production in case of piece rate Rs.</span></td>
        <th class="center"><span class="style3">Actual Wages Paid Rs.</span></td>
        <th class="center"><span class="style3">House Rent Allowance Paid Rs.</span></td>
        <th class="center"><span class="style3">All others</span></td>
        <th class="center"><span class="style3">Dearness Allowance Paid Rs.</span></td>
        <th class="center"><span class="style3">Total hours of overtime worked during the month</span></td>
        <th class="center"><span class="style3">Overtime earnings Rs.</span></td>
        <th class="center"><span class="style3">Gross Amount Payable Rs.</span></td>
        <th class="center"><span class="style3">Provident Fund Contribution Rs.</span></td>
        <th class="center"><span class="style3">Family Pension / VPF Rs.</span></td>
        <th class="center"><span class="style3">ESI Contribution Rs.</span></td>
        <th class="center"><span class="style3">Professional Tax Rs.</span></td>
        <th class="center"><span class="style3">Income Tax Rs. (if any)</span></td>
        <th class="center"><span class="style3">Loan and Interest Rs.</span></td>
        <th class="center"><span class="style3">Advances Rs.</span></td>
        <th class="center"><span class="style3">Other Deductions Rs. (if any)</span></td>
        <th class="center"><span class="style3">Total Deduction Rs.</span></td>
        <th class="center"><span class="style3">Net Payable Rs.</span></td>
        <th class="center"><span class="style3">Date of Payment</span></td>
        <th class="center"><span class="style3">Bank Account Number of Worker</span></td>
        <th class="center"><span class="style3">Cheque Number and date/ RTGS/NEFT transfer date</span></td>
        <th class="center"><span class="style3">Amount Deposited Rs.</span></td>
        <th class="center"><span class="style3">Signature / Thumb Impression of the worker(if required)</span></td>
     </tr>
   </thead>

   <thead>
   	<tr style="background-color:#FFFFFF;">
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3">From</span></td>
        <td align="center"><span class="style3">To</span></td>
        <td align="center"><span class="style3">From</span></td>
        <td align="center"><span class="style3">To</span></td>
        <td align="center"><span class="style3">1</span></td>
        <td align="center"><span class="style3">2</span></td>
        <td align="center"><span class="style3">3</span></td>
        <td align="center"><span class="style3">4</span></td>
        <td align="center"><span class="style3">5</span></td>
        <td align="center"><span class="style3">6</span></td>
        <td align="center"><span class="style3">7</span></td>
        <td align="center"><span class="style3">8</span></td>
        <td align="center"><span class="style3">9</span></td>
        <td align="center"><span class="style3">10</span></td>
        <td align="center"><span class="style3">11</span></td>
        <td align="center"><span class="style3">12</span></td>
        <td align="center"><span class="style3">13</span></td>
        <td align="center"><span class="style3">14</span></td>
        <td align="center"><span class="style3">15</span></td>
        <td align="center"><span class="style3">16</span></td>
        <td align="center"><span class="style3">17</span></td>
        <td align="center"><span class="style3">18</span></td>
        <td align="center"><span class="style3">19</span></td>
        <td align="center"><span class="style3">20</span></td>
        <td align="center"><span class="style3">21</span></td>
        <td align="center"><span class="style3">22</span></td>
        <td align="center"><span class="style3">23</span></td>
        <td align="center"><span class="style3">24</span></td>
        <td align="center"><span class="style3">25</span></td>
        <td align="center"><span class="style3">26</span></td>
        <td align="center"><span class="style3">27</span></td>
        <td align="center"><span class="style3">28</span></td>
        <td align="center"><span class="style3">29</span></td>
        <td align="center"><span class="style3">30</span></td>
        <td align="center"><span class="style3">31</span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>  
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>     
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>
        <td align="center"><span class="style3"></span></td>       
      </tr>
   </thead>

<?php $count =0;
foreach ($result as $key) {
	$count++;		
?>
	<tbody>
		<tr>
	        <td align="center" bgcolor="#FFF"><?php echo $count;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->empid;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->emp_name;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->designation;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['birth_date'];
	        $dateValue=$key->birth_date;
	        $time=strtotime($dateValue);
	        $month1=date("F",$time);
	        $year1=date("Y",$time);
	        $curryear=date('Y');
	        $age=$curryear-$year1;
	        //echo "curr=".$year;
	        //echo "curr1=".$year1;
	        echo $age;

	        ?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->gender;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->join_date;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['marital_status'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['mob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['adhar'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['temp_address'];?></td>

	        <td align="center" bgcolor="#FFF"><?php //echo $row['per_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['relname'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['reldob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['relage'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['reladhr'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $srno;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['nameadhr'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['fath_hus_name'];?></td>

	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['birth_date'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['join_date'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['gender'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['marital_status'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['mob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['adhar'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['temp_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['per_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['relname'];?></td>

	        <td align="center" bgcolor="#FFF"><?php //echo $row['reldob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['relage'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['reladhr'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $srno;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['nameadhr'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['fath_hus_name'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['birth_date'];?></td>

	        <td align="center" bgcolor="#FFF"><?php //echo $row['join_date'];?></td>

	        <td align="center" bgcolor="#FFF"><?php echo $key->paid_days;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo ($key->basic)+($key->DA);?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['mob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['adhar'];?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->HRA;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['per_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->DA;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['reldob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->OT;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->monthly_gross;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->PF;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->VPF;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $srno;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->PT;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['fath_hus_name'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo "nil";?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['birth_date'];?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->OD;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->total_deduction;?></td>
	        <td align="center" bgcolor="#FFF"><?php echo $key->net_pay;?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['mob'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['adhar'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['temp_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['per_address'];?></td>
	        <td align="center" bgcolor="#FFF"><?php //echo $row['per_address'];?></td>
	        
	      </tr>
	</tbody>
<?php } ?>
</table>

</div>	
	</div>
</div>	