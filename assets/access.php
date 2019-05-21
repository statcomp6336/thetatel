<?php 
$user = $_GET['spg']; 
$user = $user.".php";
require_once('../../application/'.$user); 
?>