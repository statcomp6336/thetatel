<?php
header("Refresh:3; url=".base_url('Home/user_login')."");
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php $title=!empty($page_title)?$page_title:"Complaincetrack"; echo $title;?></title>
<style type="text/css">
body {background:#f0f0f0 url(<?php echo base_url('assets/img/vrsntopbg.jpg');?>) repeat-x; z-index:1000;
	margin:0px; font-family:calibri;
}.style1 {
	color: #06358d;
	font-size: 38px;
}
.style2 {color: #FF0000}
</style></head>

<body>
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><img src="<?php echo base_url('assets/img/versionlogo.jpg');?>"></div></td>
    </tr>
    <tr>
      <td height="40">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"><img src="<?php echo base_url('assets/img/complianclogo.png');?>" width="253" height="136"><br>
        <br>
        <span class="style1">Version V2.7<br>
        </span><br>
        <br><br>
        <span class="style1">Powered by <strong>StatComp</strong><br>
        <!-- <img src="../library/img/powerlogo.jpg"></div></td> -->
    </tr>
  </table>
</div>
</body>
</html>
