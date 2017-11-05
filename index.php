<?php
session_start();
    if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    include 'dbConnections.php';
    $conn = getDatabaseConnection();
    
    function displayGames() {
        global $conn;
        $sql = "SELECT * 
                FROM `gp2_game` 
                ORDER BY name";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $games = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $games;
    }
    
?>

<html>
    <head>
        <title>Team Project</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <h1>Game Store</h1>
        
 
 
        <?php
        
        $games = displayGames();
        
        foreach($games as $g) {
            echo  "<a href='gameInfo.php?vgID=".$g['vgID']."'> ".$g['name']." </a>";
            echo "<form action='addToCart.php' style='display:inline'>
                    <input type='hidden' name='vgID' value='".$g['vgID']."'/>
                    <input type='submit' value='Add to Cart'>
                  </form>";
            echo "<br />";
        }
        
        //print_r($_SESSION['cart']);
        ?>
        
        <form action='shoppingCart.php'>
                <input type='submit' value='Shopping Cart'>
        </form>
        
    </body>
</html>