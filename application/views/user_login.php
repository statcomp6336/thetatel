<?php
// session_start();	
// $user=$_SESSION['SESS_USER_NAME'];
// $spgid=$_SESSION['SESS_CUST_ID'];
// //if ((empty($_SESSION['SESS_USER_NAME']))) {
//  //header('Location: index.php');
// // exit;
// //}
// require_once('../config/connection.php');
// //require_once('../config/config.php');
?>
<!DOCTYPE html>
<html>
<head runat="server">
<title><?php $title=!empty($page_title)?$page_title:"Complaincetrack"; echo $title;?></title>
<link href="<?php echo base_url('assets/css/style2.css');?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/scripts/jquery.js');?>" language="javascript" type="text/javascript"></script>
<script src="<?php echo base_url('assets/scripts/jquery.cycle.all.min.js');?>" type="text/javascript"></script>
<script type="text/javascript">
		jQuery(document).ready(function(){
			
			$('#slider').cycle({
				timeout:6000,
				fx: 'fade', 
				pager: '#pager', 
				pause: 0,
				pauseOnPagerHover: 0
       		 });
					
		});
</script>
</head>
<body>
<div id="maincontainer">
  <div class="bannerarea">
    <div id="slider-container">
      <ul id="slider">
        <li><img src="<?php echo base_url('assets/img/banner1.jpg');?>" border="0"></li>
        <li><img src="<?php echo base_url('assets/img/banner3.jpg');?>" border="0"></li>
        <li><img src="<?php echo base_url('assets/img/banner2.jpg');?>" border="0"></li>
      </ul>
    </div>
    <div id="pager"></div>
  </div>
  <!--Menu area-->
  <!--content area-->
  <div id="loginarea">
    <h1  >Account Login</h1>
    <div class="loginbox">
    <?php echo form_open(base_url( 'Home/login_exicution'), array( 'id' => 'login', 'class' => 'box', 'method'=> 'POST' ));?>

       <input type="text" name="cid" required autofocus="on" placeholder="Entity Code" class="username" required>
        <br>
        <br>
        <input type="text" name="username" required autofocus="on" placeholder="Username" class="username" required>
        <br>
        <br>
        <input type="password" name="password" required  placeholder="Password" class="password">
        <br>
        <br>
        <input type="submit" name="button" id="button" value="Login"  class="loginbtn">
        <a href="forgot_password.php">Forgot Password?</a>
     <?php echo form_close();
         

         echo "<span id ='msg'>".show_msg()."</span>";
            
     ?>
     <style type="text/css">
       #msg{
       
        color: red;
       }
     </style>
    </div>
  </div>
  <!--content area-->
</div>
</body>
</html>