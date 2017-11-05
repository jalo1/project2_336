<?php
session_start();


function displayCart() {
    include 'dbConnections.php';
    $conn = getDatabaseConnection();

    $sql = "SELECT * FROM gp2_game a JOIN gp2_published name = :name";
    
    $namedParam = array(":name"=>$_SESSION['cart']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        echo "Name: ". $record['name'];
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Shopping Cart </title>
    </head>
    <body>
        <h2> Shopping Cart </h2>
        <?=displayCart()?>
    </body>
</html>