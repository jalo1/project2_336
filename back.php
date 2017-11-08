<?php 
session_start();
header("Location: index.php?".$_SESSION['sortBy']."&".$_SESSION['filter']."&" .$_SESSION['submit']);
?>