<?php 
session_start();
$_SESSION['vgID']=array();
print_r($_SESSION['vgID']);
header("Location: shoppingCart.php");
?>