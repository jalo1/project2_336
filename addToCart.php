<?php 
session_start();
include 'dbConnections.php';
$conn = getDatabaseConnection();
$sql = "SELECT * FROM gp2_game WHERE vgID = :vgId";
    
$namedParam = array(":vgId"=>$_GET['vgID']);
    
$stmt = $conn->prepare($sql);
$stmt->execute($namedParam);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
foreach ($records as $record) {
    array_push($_SESSION['vgID'],$record['vgID']);
}
print_r($_SESSION['vgID']);
header("Location: index.php?".$_SESSION['sortBy']."&".$_SESSION['filter']."&" .$_SESSION['submit']);
?>