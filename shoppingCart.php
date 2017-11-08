<?php
session_start();
    
function displayCart() {
    include 'dbConnections.php';
    $conn = getDatabaseConnection();
    $array = $_SESSION['vgID'];
    
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Game</th>";
    echo "<th>Price</th>";
    echo "</tr>";
          
    foreach($array as $a){
        $sql = "SELECT * FROM gp2_game WHERE vgID = $a";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<tr>";
        echo "<td>".ucwords($records['name'])."</td>";
        echo "<td>".ucwords($records['price'])."</td>";
        echo "</tr>";
    }
    echo "</table>";
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
        
        <form action ='clear.php'>
            <input type='submit' value = 'Clear'>
       </form>
        <form action='back.php'>
                <input type='submit' value='Back'>
        </form>
    </body>
</html>