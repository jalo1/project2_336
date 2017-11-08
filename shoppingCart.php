<?php
session_start();
    
function displayCart() {
    include 'dbConnections.php';
    $conn = getDatabaseConnection();
    $array = $_SESSION['vgID'];
    foreach($array as $a){
        $sql = "SELECT * FROM gp2_game WHERE vgID = $a";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Name: ". $records['name'] . "     Price: ". $records['price'] . "<br/><br/>";
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
        
        
        <form action='index.php'>
                <input type='submit' value='Back'>
        </form>
    </body>
</html>